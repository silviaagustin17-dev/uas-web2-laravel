<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    ProdiController,
    RuanganController,
    EventController,
    DashboardController,
    ApprovalController,
    ReportController,
    ProfileController
};

Route::get('/', fn() => view('welcome'));

// GUEST ZONE
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

// AUTH ZONE
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::put('/profile', 'update')->name('profile.update');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Download Proposal (bisa diakses siapa saja yang login)
    Route::get('/event/download/{id}', [ApprovalController::class, 'downloadProposal'])->name('event.download');

    // SEKJUR
    Route::middleware('role:sekjur')->group(function () {
        Route::resources([
            'prodi'   => ProdiController::class,
            'ruangan' => RuanganController::class,
            'event'   => EventController::class,
        ]);
        Route::get('/sekjur/endorsement', [ApprovalController::class, 'sekjurIndex'])->name('sekjur.endorsement');
        Route::post('/sekjur/endorsement/{id}', [ApprovalController::class, 'sekjurProcess'])->name('sekjur.endorsement.process');
        Route::get('/reports/rekapitulasi', [ReportController::class, 'rekapEvent'])->name('reports.rekap');
    });

    // HIMA
    Route::middleware('role:hima')->group(function () {
        Route::get('/hima/pengajuan', [EventController::class, 'himaCreate'])->name('hima.pengajuan.create');
        Route::post('/hima/pengajuan', [EventController::class, 'himaStore'])->name('hima.pengajuan.store');
        Route::get('/tracking-status', [EventController::class, 'trackingStatus'])->name('tracking.status');
        Route::post('/hima/upload-lhk/{id}', [EventController::class, 'uploadLhk'])->name('hima.upload_lhk');
    });

    // KAPRODI
    Route::middleware('role:kaprodi')->group(function () {
        Route::get('/kaprodi/review', [ApprovalController::class, 'kaprodiIndex'])->name('kaprodi.review');
        Route::get('/kaprodi/dashboard', [ApprovalController::class, 'kaprodiIndex'])->name('kaprodi.dashboard');
        Route::post('/kaprodi/review/process/{id}', [ApprovalController::class, 'kaprodiProcess'])->name('kaprodi.review.process');
    });

    // DEKAN
    Route::middleware('role:dekan')->group(function () {
        Route::get('/dekan/approval', [ApprovalController::class, 'dekanIndex'])->name('dekan.dashboard');
        Route::get('/dekan/approval', [ApprovalController::class, 'dekanIndex'])->name('dekan.approval');
        Route::post('/dekan/approval/{id}', [ApprovalController::class, 'dekanProcess'])->name('dekan.approval.process');
        Route::post('/dekan/lhk/process/{id}', [ApprovalController::class, 'dekanLhkProcess'])->name('dekan.lhk.process');
    });
});