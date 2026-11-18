<?php

use App\Http\Controllers\PetugasController;
use App\Http\Controllers\UserPortalController;
use Illuminate\Support\Facades\Route;

// =========================================================================
// ROLE 1: MASYARAKAT (USER)
// =========================================================================
Route::get('/', [UserPortalController::class, 'home'])->name('home');
Route::get('/berita', [UserPortalController::class, 'newsIndex'])->name('news.index');
Route::get('/berita/{slug}', [UserPortalController::class, 'newsShow'])->name('news.show');
Route::get('/mitigasi', [UserPortalController::class, 'mitigationIndex'])->name('mitigation.index');
Route::get('/mitigasi/{slug}', [UserPortalController::class, 'mitigationShow'])->name('mitigation.show');
Route::get('/riwayat-laporan', [UserPortalController::class, 'reportHistory'])->name('reports.history');
Route::get('/profil', [UserPortalController::class, 'profile'])->name('profile');

Route::post('/lapor-bencana', [UserPortalController::class, 'storeReport'])->name('reports.store');
Route::post('/feedback', [UserPortalController::class, 'storeFeedback'])->name('feedback.store');
Route::post('/profil', [UserPortalController::class, 'updateProfile'])->name('profile.update');

// =========================================================================
// ROLE 2: PETUGAS BPBD (TIM REAKSI CEPAT / TRC)
// =========================================================================
Route::prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/', [PetugasController::class, 'dashboard'])->name('dashboard');
    Route::post('/check-in-radio', [PetugasController::class, 'checkInRadio'])->name('radio.checkin');

    Route::get('/penugasan', [PetugasController::class, 'assignments'])->name('assignments');
    Route::get('/penugasan/{id}', [PetugasController::class, 'assignmentDetail'])->name('assignments.show');
    Route::post('/penugasan/{id}/terima', [PetugasController::class, 'acceptAssignment'])->name('assignments.accept');

    Route::get('/pengajuan-izin', [PetugasController::class, 'leaveCreate'])->name('leave');
    Route::post('/pengajuan-izin', [PetugasController::class, 'leaveStore'])->name('leave.store');

    Route::get('/notifikasi', [PetugasController::class, 'notifications'])->name('notifications');
    Route::post('/notifikasi/baca-semua', [PetugasController::class, 'markAllNotificationsRead'])->name('notifications.readAll');
});
