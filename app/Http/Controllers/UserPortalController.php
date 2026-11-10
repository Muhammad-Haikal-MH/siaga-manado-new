<?php

namespace App\Http\Controllers;

use App\Services\AuthMockService;
use App\Services\FeedbackMockService;
use App\Services\MitigationMockService;
use App\Services\NewsMockService;
use App\Services\ReportMockService;
use Illuminate\Http\Request;

class UserPortalController extends Controller
{
    public function __construct(
        private AuthMockService $authService,
        private ReportMockService $reportService,
        private NewsMockService $newsService,
        private MitigationMockService $mitigationService,
        private FeedbackMockService $feedbackService
    ) {
    }

    /**
     * Halaman Utama / Beranda (Use Case 4.1, 4.2, 4.3, 4.4, 4.5)
     */
    public function home()
    {
        $user = $this->authService->getCurrentUser();
        $reports = $this->reportService->getMyReports($user['id']);
        $disasterTypes = $this->reportService->getDisasterTypes();
        $latestNews = array_slice($this->newsService->getPublishedNews(), 0, 3);
        $mitigations = $this->mitigationService->getAllMitigations();
        $weather = $this->newsService->getWeatherHighlight();

        return view('user.home', [
            'user' => $user,
            'reports' => $reports,
            'disasterTypes' => $disasterTypes,
            'latestNews' => $latestNews,
            'mitigations' => $mitigations,
            'weather' => $weather,
        ]);
    }

    /**
     * Halaman Daftar Berita Terkini (Use Case 4.2)
     */
    public function newsIndex(Request $request)
    {
        $user = $this->authService->getCurrentUser();
        $disasterTypes = $this->reportService->getDisasterTypes();
        $search = $request->query('q', '');
        $category = $request->query('kategori', 'Semua Berita');

        $weather = $this->newsService->getWeatherHighlight();
        $newsList = $this->newsService->getPublishedNews($search, $category);

        return view('user.news-index', [
            'user' => $user,
            'disasterTypes' => $disasterTypes,
            'weather' => $weather,
            'newsList' => $newsList,
            'search' => $search,
            'selectedCategory' => $category,
        ]);
    }

    /**
     * Halaman Detail Berita (Use Case 4.2)
     */
    public function newsShow(string $slug)
    {
        $user = $this->authService->getCurrentUser();
        $disasterTypes = $this->reportService->getDisasterTypes();
        $article = $this->newsService->getNewsBySlug($slug);

        if (!$article) {
            abort(404, 'Berita tidak ditemukan atau belum dipublikasikan.');
        }

        return view('user.news-detail', [
            'user' => $user,
            'disasterTypes' => $disasterTypes,
            'article' => $article,
        ]);
    }

    /**
     * Halaman Daftar Mitigasi Bencana (Use Case 4.4)
     */
    public function mitigationIndex()
    {
        $user = $this->authService->getCurrentUser();
        $disasterTypes = $this->reportService->getDisasterTypes();
        $mitigations = $this->mitigationService->getAllMitigations();

        return view('user.mitigation-index', [
            'user' => $user,
            'disasterTypes' => $disasterTypes,
            'mitigations' => $mitigations,
        ]);
    }

    /**
     * Halaman Detail Mitigasi Bencana (Use Case 4.4)
     */
    public function mitigationShow(string $slug)
    {
        $user = $this->authService->getCurrentUser();
        $disasterTypes = $this->reportService->getDisasterTypes();
        $mitigation = $this->mitigationService->getMitigationBySlug($slug);

        if (!$mitigation) {
            abort(404, 'Panduan mitigasi tidak ditemukan.');
        }

        return view('user.mitigation-detail', [
            'user' => $user,
            'disasterTypes' => $disasterTypes,
            'mitigation' => $mitigation,
        ]);
    }

    /**
     * Halaman Riwayat Laporan Saya (Use Case 4.3)
     */
    public function reportHistory()
    {
        $user = $this->authService->getCurrentUser();
        $disasterTypes = $this->reportService->getDisasterTypes();
        $reports = $this->reportService->getMyReports($user['id']);

        return view('user.report-history', [
            'user' => $user,
            'disasterTypes' => $disasterTypes,
            'reports' => $reports,
        ]);
    }

    /**
     * Halaman Profil Pengguna & Akses Riwayat Laporan (Use Case 4.3)
     */
    public function profile()
    {
        $user = $this->authService->getCurrentUser();
        $disasterTypes = $this->reportService->getDisasterTypes();
        $reports = $this->reportService->getMyReports($user['id']);

        return view('user.profile', [
            'user' => $user,
            'disasterTypes' => $disasterTypes,
            'reports' => $reports,
        ]);
    }

    /**
     * Simpan Laporan Bencana dari Modal (Use Case 4.1)
     */
    public function storeReport(Request $request)
    {
        $user = $this->authService->getCurrentUser();

        $validated = $request->validate([
            'phone' => ['required', 'regex:/^[0-9+]{10,15}$/'],
            'disaster_type' => ['required', 'string'],
            'incident_date' => ['required', 'date', 'after_or_equal:' . date('Y-m-d', strtotime('-2 days')), 'before_or_equal:' . date('Y-m-d')],
            'incident_time' => ['required', 'string'],
            'location' => ['required', 'string', 'min:8', 'max:250'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'coordinates' => ['nullable', 'string'],
            'description' => ['required', 'string', 'min:15', 'max:500'],
            'media_list' => ['required', 'array', 'min:1'],
            'media_list.*.type' => ['required', 'in:image,video'],
            'media_list.*.url' => ['required', 'string'],
            'media_list.*.name' => ['required', 'string'],
            'media_list.*.size' => ['required', 'string'],
        ], [
            'phone.required' => 'Nomor telepon wajib diisi untuk koordinasi petugas darurat.',
            'phone.regex' => 'Format nomor telepon tidak valid (gunakan 10–15 digit angka, contoh: 081234567890).',
            'disaster_type.required' => 'Jenis bencana wajib dipilih.',
            'incident_date.required' => 'Tanggal kejadian wajib diisi.',
            'incident_date.after_or_equal' => 'Anda hanya dapat memilih mundur maksimal 2 hari lalu (H-2).',
            'incident_date.before_or_equal' => 'Tanggal masa depan terkunci. Pilih maksimal hari ini.',
            'location.required' => 'Lokasi kejadian bencana wajib diisi.',
            'location.min' => 'Tuliskan lokasi lebih spesifik (minimal 8 karakter, misal nama jalan/kelurahan).',
            'description.required' => 'Deskripsi detail kejadian wajib diisi.',
            'description.min' => 'Deskripsi terlalu singkat (minimal 15 karakter agar situasi jelas).',
            'description.max' => 'Deskripsi maksimal 500 karakter.',
            'media_list.required' => 'Minimal 1 dokumentasi foto atau video kejadian wajib diunggah.',
            'media_list.min' => 'Minimal 1 dokumentasi foto atau video kejadian wajib diunggah.',
        ]);

        $created = $this->reportService->createReport($validated, $user);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Laporan berhasil dikirim!',
                'report' => $created,
            ]);
        }

        return redirect()->back()->with('report_success', 'Laporan berhasil dikirim!');
    }

    /**
     * Kirim Feedback pada Halaman Utama (Use Case 4.5)
     */
    public function storeFeedback(Request $request)
    {
        $user = $this->authService->getCurrentUser();

        $validated = $request->validate([
            'message' => ['required', 'string', 'min:5', 'max:500'],
        ], [
            'message.required' => 'Pesan feedback tidak boleh kosong.',
            'message.min' => 'Pesan feedback minimal 5 karakter agar informatif.',
            'message.max' => 'Pesan feedback maksimal 500 karakter.',
        ]);

        $entry = $this->feedbackService->submitFeedback($validated['message'], $user);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Terima kasih! Masukan dan feedback Anda berhasil dikirim.',
                'feedback' => $entry,
            ]);
        }

        return redirect()->to(route('home') . '#feedback')
            ->with('feedback_success', 'Terima kasih! Masukan dan feedback Anda berhasil dikirim.');
    }

    /**
     * Simpan Perubahan Profil
     */
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'phone' => ['required', 'regex:/^[0-9+]{10,15}$/'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.min' => 'Nama lengkap minimal 3 karakter.',
            'phone.required' => 'Nomor telepon / WhatsApp wajib diisi.',
            'phone.regex' => 'Format nomor telepon tidak valid (10–15 digit angka).',
        ]);

        $this->authService->updateProfile($validated);

        return redirect()->route('profile')
            ->with('profile_success', 'Perubahan informasi profil berhasil disimpan.');
    }
}
