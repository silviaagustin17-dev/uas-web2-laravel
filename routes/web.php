<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PresensiController;

// Halaman utama bawaan Laravel
Route::get('/', function () {
    return view('welcome');
});

// --- GROUP GUEST (Hanya bisa diakses jika BELUM login) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

// --- GROUP AUTH (Hanya bisa diakses jika SUDAH sukses login) ---
Route::middleware('auth')->group(function () {
    
    // Fitur Keluar Aplikasi
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route Master Prodi
    Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
    Route::post('/prodi', [ProdiController::class, 'store'])->name('prodi.store');
    Route::get('/prodi/{id}/edit', [ProdiController::class, 'edit'])->name('prodi.edit');
    Route::put('/prodi/{id}', [ProdiController::class, 'update'])->name('prodi.update');
    Route::delete('/prodi/{id}', [ProdiController::class, 'destroy'])->name('prodi.destroy');

    // Route Master Ruangan
    Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
    Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
    Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
    Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
    Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');

    // Route Master Event
    Route::get('/event', [EventController::class, 'index'])->name('event.index');
    Route::post('/event', [EventController::class, 'store'])->name('event.store');
    Route::get('/event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('/event/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event/{id}', [EventController::class, 'destroy'])->name('event.destroy');

    // Route Presensi Mahasiswa
    Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');
});