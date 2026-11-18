<?php

use App\Http\Controllers\AdminSiagamanadoController;
use App\Http\Controllers\UserPortalController;
use Illuminate\Support\Facades\Route;

// Role Masyarakat (User) Routes
Route::get('/', [UserPortalController::class, 'home'])->name('home');
Route::get('/berita', [UserPortalController::class, 'newsIndex'])->name('news.index');
Route::get('/berita/{slug}', [UserPortalController::class, 'newsShow'])->name('news.show');
Route::get('/mitigasi', [UserPortalController::class, 'mitigationIndex'])->name('mitigation.index');
Route::get('/mitigasi/{slug}', [UserPortalController::class, 'mitigationShow'])->name('mitigation.show');
Route::get('/riwayat-laporan', [UserPortalController::class, 'reportHistory'])->name('reports.history');
Route::get('/profil', [UserPortalController::class, 'profile'])->name('profile');

// Form Actions User
Route::post('/lapor-bencana', [UserPortalController::class, 'storeReport'])->name('reports.store');
Route::post('/feedback', [UserPortalController::class, 'storeFeedback'])->name('feedback.store');
Route::post('/profil', [UserPortalController::class, 'updateProfile'])->name('profile.update');

// Role Petugas Admin Siaga Manado Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminSiagamanadoController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [AdminSiagamanadoController::class, 'dashboard'])->name('dashboard.index');

    // Data Pelaporan & Verifikasi (Frame 41, Frame 64, Html -> Body-1)
    Route::get('/laporan', [AdminSiagamanadoController::class, 'laporanIndex'])->name('laporan.index');
    Route::post('/laporan/{id}/verifikasi', [AdminSiagamanadoController::class, 'verifikasiLaporan'])->name('laporan.verifikasi');
    Route::post('/laporan/{id}/tolak', [AdminSiagamanadoController::class, 'tolakLaporan'])->name('laporan.tolak');

    // Berita: Statistik & Draft Berita (Frame 42, Frame 44, Frame 45)
    Route::get('/berita', [AdminSiagamanadoController::class, 'beritaIndex'])->name('berita.index');
    Route::get('/berita/draft', [AdminSiagamanadoController::class, 'beritaDraft'])->name('berita.draft');
    Route::get('/berita/{id}/edit', [AdminSiagamanadoController::class, 'beritaEdit'])->name('berita.edit');
    Route::post('/berita/{id}/update', [AdminSiagamanadoController::class, 'beritaUpdate'])->name('berita.update');
    Route::post('/berita/{id}/publish', [AdminSiagamanadoController::class, 'beritaPublish'])->name('berita.publish');
    Route::delete('/berita/{id}', [AdminSiagamanadoController::class, 'beritaDelete'])->name('berita.delete');

    // Feedback (Frame 39)
    Route::get('/feedback', [AdminSiagamanadoController::class, 'feedbackIndex'])->name('feedback.index');

    // Mitigasi (Frame 46)
    Route::get('/mitigasi', [AdminSiagamanadoController::class, 'mitigasiIndex'])->name('mitigasi.index');
    Route::post('/mitigasi/{id}/publish', [AdminSiagamanadoController::class, 'mitigasiPublish'])->name('mitigasi.publish');
    Route::delete('/mitigasi/{id}', [AdminSiagamanadoController::class, 'mitigasiDelete'])->name('mitigasi.delete');
});
