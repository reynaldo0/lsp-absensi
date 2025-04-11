<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Guru\GuruDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Siswa\SiswaDashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/absensi', [AbsensiController::class, 'index'])->name('admin.absensi');
});

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])->name('guru.dashboard');

    Route::get('/guru/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/guru/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/guru/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/guru/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/guru/siswa/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/guru/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');


    Route::get('/guru/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/guru/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('/guru/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {});

require __DIR__ . '/auth.php';
