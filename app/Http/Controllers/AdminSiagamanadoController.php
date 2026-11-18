<?php

namespace App\Http\Controllers;

use App\Services\AdminMockService;
use Illuminate\Http\Request;

class AdminSiagamanadoController extends Controller
{
    public function __construct(
        private AdminMockService $adminService
    ) {
    }

    /**
     * Dashboard Overview (Frame 40)
     */
    public function dashboard()
    {
        $profile = $this->adminService->getAdminProfile();
        $metrics = $this->adminService->getDashboardMetrics();

        return view('admin.dashboard', [
            'profile' => $profile,
            'metrics' => $metrics,
            'activeNav' => 'dashboard',
        ]);
    }

    /**
     * Data Pelaporan (Frame 41, Frame 64, Html -> Body-1)
     */
    public function laporanIndex(Request $request)
    {
        $profile = $this->adminService->getAdminProfile();
        $reports = $this->adminService->getAllReports();

        return view('admin.laporan.index', [
            'profile' => $profile,
            'reports' => $reports,
            'activeNav' => 'laporan',
        ]);
    }

    /**
     * Verifikasi Laporan Action
     */
    public function verifikasiLaporan(Request $request, string $id)
    {
        $priority = $request->input('priority', 'Siaga 2 (Tinggi)');
        $notes = $request->input('action_notes', 'Laporan valid, tim relawan BPBD telah diterjunkan ke lokasi.');

        $this->adminService->updateReportStatus($id, 'diverifikasi', $priority, $notes);

        if ($request->wantsJson() || $request->ajax()) {
            $report = $this->adminService->findReport($id);
            return response()->json([
                'success' => true,
                'message' => 'Laporan berhasil diverifikasi!',
                'report' => $report,
            ]);
        }

        return redirect()->route('admin.laporan.index')
            ->with('verification_success', [
                'id' => $id,
                'name' => $request->input('reporter_name', 'Pelapor'),
                'priority' => $priority,
            ]);
    }

    /**
     * Tolak Laporan Action
     */
    public function tolakLaporan(Request $request, string $id)
    {
        $notes = $request->input('action_notes', 'Laporan ditolak setelah pengecekan lapangan.');
        $this->adminService->updateReportStatus($id, 'ditolak', 'Tidak Prioritas', $notes);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Laporan berhasil ditolak.',
            ]);
        }

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil ditolak.');
    }

    /**
     * Berita - Statistik Berita (Frame 42)
     */
    public function beritaIndex()
    {
        $profile = $this->adminService->getAdminProfile();
        $metrics = $this->adminService->getNewsMetrics();

        return view('admin.berita.index', [
            'profile' => $profile,
            'metrics' => $metrics,
            'activeNav' => 'berita',
        ]);
    }

    /**
     * Berita - Draft Berita (Frame 44)
     */
    public function beritaDraft(Request $request)
    {
        $profile = $this->adminService->getAdminProfile();
        $search = $request->query('q', '');
        $drafts = $this->adminService->getDraftNews($search);

        return view('admin.berita.draft', [
            'profile' => $profile,
            'drafts' => $drafts,
            'search' => $search,
            'activeNav' => 'berita',
        ]);
    }

    /**
     * Berita - Edit Berita (Frame 45)
     */
    public function beritaEdit($id)
    {
        $profile = $this->adminService->getAdminProfile();
        $news = $this->adminService->findNews((int) $id);

        if (!$news) {
            return redirect()->route('admin.berita.draft')->with('error', 'Berita tidak ditemukan.');
        }

        return view('admin.berita.edit', [
            'profile' => $profile,
            'news' => $news,
            'activeNav' => 'berita',
        ]);
    }

    /**
     * Berita - Update Berita
     */
    public function beritaUpdate(Request $request, $id)
    {
        $data = [
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'content' => $request->input('content'),
            'date' => $request->input('date'),
        ];

        if ($request->input('action') === 'publish') {
            $data['status'] = 'Published';
        }

        $this->adminService->updateNews((int) $id, $data);

        if ($request->input('action') === 'publish') {
            return redirect()->route('admin.berita.draft')->with('success', 'Berita berhasil dipublikasikan!');
        }

        return redirect()->route('admin.berita.edit', $id)->with('success', 'Perubahan draft berita berhasil disimpan!');
    }

    /**
     * Berita - Publish Berita
     */
    public function beritaPublish($id)
    {
        $this->adminService->publishNews((int) $id);
        return redirect()->route('admin.berita.draft')->with('success', 'Berita berhasil dipublikasikan!');
    }

    /**
     * Berita - Delete Berita
     */
    public function beritaDelete($id)
    {
        $this->adminService->deleteNews((int) $id);
        return redirect()->route('admin.berita.draft')->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Feedback (Frame 39)
     */
    public function feedbackIndex()
    {
        $profile = $this->adminService->getAdminProfile();
        $feedbacks = $this->adminService->getAllFeedbacks();

        return view('admin.feedback.index', [
            'profile' => $profile,
            'feedbacks' => $feedbacks,
            'activeNav' => 'feedback',
        ]);
    }

    /**
     * Mitigasi - Draft Mitigasi Bencana Alam (Frame 46)
     */
    public function mitigasiIndex(Request $request)
    {
        $profile = $this->adminService->getAdminProfile();
        $search = $request->query('q', '');
        $mitigations = $this->adminService->getAllMitigations($search);

        return view('admin.mitigasi.index', [
            'profile' => $profile,
            'mitigations' => $mitigations,
            'search' => $search,
            'activeNav' => 'mitigasi',
        ]);
    }

    /**
     * Mitigasi - Publish
     */
    public function mitigasiPublish($id)
    {
        $this->adminService->publishMitigation((int) $id);
        return redirect()->route('admin.mitigasi.index')->with('success', 'Dokumen mitigasi berhasil dipublikasikan!');
    }

    /**
     * Mitigasi - Delete
     */
    public function mitigasiDelete($id)
    {
        $this->adminService->deleteMitigation((int) $id);
        return redirect()->route('admin.mitigasi.index')->with('success', 'Dokumen mitigasi berhasil dihapus.');
    }
}
