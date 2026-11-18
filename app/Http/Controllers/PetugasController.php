<?php

namespace App\Http\Controllers;

use App\Services\PetugasMockService;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function __construct(
        private PetugasMockService $petugasService
    ) {
    }

    /**
     * Frame 50.png — Dashboard Utama Petugas BPBD
     */
    public function dashboard()
    {
        $officer = $this->petugasService->getOfficerProfile();
        $assignments = $this->petugasService->getAllAssignments();
        $weather = $this->petugasService->getWeatherAndEarlyWarning();
        $notifications = $this->petugasService->getNotifications();

        $priorityAssignment = $assignments[0] ?? null;
        $unreadCount = count(array_filter($notifications, fn ($n) => $n['isUnread']));

        return view('petugas.dashboard', [
            'officer' => $officer,
            'assignments' => $assignments,
            'priorityAssignment' => $priorityAssignment,
            'weather' => $weather,
            'unreadCount' => $unreadCount,
        ]);
    }

    /**
     * Frame 51.png — Penugasan Petugas Lapangan
     */
    public function assignments()
    {
        $officer = $this->petugasService->getOfficerProfile();
        $assignments = $this->petugasService->getAllAssignments();
        $notifications = $this->petugasService->getNotifications();
        $unreadCount = count(array_filter($notifications, fn ($n) => $n['isUnread']));

        return view('petugas.assignments', [
            'officer' => $officer,
            'assignments' => $assignments,
            'unreadCount' => $unreadCount,
        ]);
    }

    /**
     * Frame 54.png — Detail Penugasan & Konfirmasi "Diterima"
     */
    public function assignmentDetail(string $id)
    {
        $officer = $this->petugasService->getOfficerProfile();
        $assignment = $this->petugasService->getAssignmentById($id);
        $notifications = $this->petugasService->getNotifications();
        $unreadCount = count(array_filter($notifications, fn ($n) => $n['isUnread']));

        if (!$assignment) {
            abort(404, 'Data penugasan tidak ditemukan.');
        }

        // Sesuai protokol SOP di Frame 52: Notifikasi otomatis ditandai terbaca saat membuka detail penugasan
        foreach ($notifications as $n) {
            if ($n['assignmentId'] && strtolower($n['assignmentId']) === strtolower($assignment['id'])) {
                $this->petugasService->markNotificationRead($n['id']);
            }
        }

        return view('petugas.assignment-detail', [
            'officer' => $officer,
            'assignment' => $assignment,
            'unreadCount' => $unreadCount,
        ]);
    }

    /**
     * Aksi Tombol "Diterima" pada Detail Penugasan (Frame 54.png)
     */
    public function acceptAssignment(string $id)
    {
        $updated = $this->petugasService->acceptAssignment($id);

        if (!$updated) {
            abort(404, 'Penugasan tidak ditemukan.');
        }

        return redirect()
            ->route('petugas.assignments.show', $id)
            ->with('petugas_success', 'Penugasan ' . $updated['dispatchCode'] . ' telah diterima dan berstatus Sedang Ditangani.');
    }

    /**
     * Frame 53.png — Pengajuan Izin Petugas
     */
    public function leaveCreate()
    {
        $officer = $this->petugasService->getOfficerProfile();
        $leaveTypes = $this->petugasService->getLeaveTypes();
        $leaveHistory = $this->petugasService->getLeaveRequests();
        $notifications = $this->petugasService->getNotifications();
        $unreadCount = count(array_filter($notifications, fn ($n) => $n['isUnread']));

        return view('petugas.leave', [
            'officer' => $officer,
            'leaveTypes' => $leaveTypes,
            'leaveHistory' => $leaveHistory,
            'unreadCount' => $unreadCount,
        ]);
    }

    /**
     * Simpan Formulir Pengajuan Izin (Frame 53.png)
     */
    public function leaveStore(Request $request)
    {
        $validated = $request->validate([
            'leave_type' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'reason' => ['required', 'string', 'min:10', 'max:500'],
        ], [
            'leave_type.required' => 'Jenis izin wajib dipilih.',
            'start_date.required' => 'Tanggal mulai izin wajib diisi.',
            'end_date.required' => 'Tanggal selesai izin wajib diisi.',
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',
            'reason.required' => 'Alasan pengajuan izin wajib diisi.',
            'reason.min' => 'Alasan pengajuan minimal 10 karakter agar jelas.',
        ]);

        $this->petugasService->submitLeaveRequest($validated);

        return redirect()
            ->route('petugas.leave')
            ->with('petugas_success', 'Formulir pengajuan izin berhasil dikirim ke Posko Induk BPBD.');
    }

    /**
     * Frame 52.png — Notifikasi & Peringatan Tugas
     */
    public function notifications(Request $request)
    {
        $officer = $this->petugasService->getOfficerProfile();
        $allNotifications = $this->petugasService->getNotifications();
        $filter = $request->query('tab', 'semua');
        $selectedId = $request->query('pilih', $allNotifications[0]['id'] ?? null);

        $filtered = $allNotifications;
        if ($filter === 'belum_dibaca') {
            $filtered = array_values(array_filter($allNotifications, fn ($n) => $n['isUnread']));
        } elseif ($filter === 'penugasan_baru') {
            $filtered = array_values(array_filter($allNotifications, fn ($n) => $n['category'] === 'penugasan_baru'));
        } elseif ($filter === 'izin') {
            $filtered = array_values(array_filter($allNotifications, fn ($n) => $n['category'] === 'izin'));
        }

        $selectedNotification = null;
        foreach ($allNotifications as $item) {
            if ($item['id'] === $selectedId) {
                $selectedNotification = $item;
                break;
            }
        }
        if (!$selectedNotification && count($filtered) > 0) {
            $selectedNotification = $filtered[0];
        }

        $counts = [
            'semua' => count($allNotifications),
            'belum_dibaca' => count(array_filter($allNotifications, fn ($n) => $n['isUnread'])),
            'penugasan_baru' => count(array_filter($allNotifications, fn ($n) => $n['category'] === 'penugasan_baru')),
            'izin' => count(array_filter($allNotifications, fn ($n) => $n['category'] === 'izin')),
        ];

        return view('petugas.notifications', [
            'officer' => $officer,
            'notifications' => $filtered,
            'allNotifications' => $allNotifications,
            'selectedNotification' => $selectedNotification,
            'activeTab' => $filter,
            'counts' => $counts,
            'unreadCount' => $counts['belum_dibaca'],
        ]);
    }

    /**
     * Tandai Semua Notifikasi Sudah Dibaca (Frame 52.png)
     */
    public function markAllNotificationsRead()
    {
        $this->petugasService->markAllNotificationsRead();

        return redirect()
            ->route('petugas.notifications')
            ->with('petugas_success', 'Seluruh notifikasi telah ditandai sudah dibaca.');
    }

    /**
     * Check-in Radio pada Dashboard (Frame 50.png)
     */
    public function checkInRadio()
    {
        $officer = $this->petugasService->toggleRadioCheckIn();
        $msg = $officer['radioCheckedIn']
            ? 'Check-in Radio berhasil! Status komunikasi Regu Alfa terhubung ke ' . $officer['radioChannel'] . '.'
            : 'Status Check-in Radio dinonaktifkan.';

        return redirect()->back()->with('petugas_success', $msg);
    }
}
