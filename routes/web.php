<?php

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

// Form Actions
Route::post('/lapor-bencana', [UserPortalController::class, 'storeReport'])->name('reports.store');
Route::post('/feedback', [UserPortalController::class, 'storeFeedback'])->name('feedback.store');
Route::post('/profil', [UserPortalController::class, 'updateProfile'])->name('profile.update');
