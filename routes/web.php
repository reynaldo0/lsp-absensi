<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\Dashboard\SiswaDashboardController;
use App\Http\Controllers\ManagaUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SelfieController;
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
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/absensi', [AbsensiController::class, 'index'])->name('admin.absensi');

    Route::get('/admin/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/admin/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/admin/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/admin/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/admin/siswa/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/admin/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

    Route::get('/admin/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/admin/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('/admin/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::delete('/admin/absensi/{id}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');

    Route::get('/admin/user', [ManagaUserController::class, 'index'])->name('user.index');
    Route::get('/admin/user/{user}/edit', [ManagaUserController::class, 'edit'])->name('user.edit');
    Route::put('/admin/user/{user}', [ManagaUserController::class, 'update'])->name('user.update');

    Route::delete('/admin/user/{id}', [ManagaUserController::class, 'destroy'])->name('user.destroy');

    Route::get('/admin/selfie', [SelfieController::class, 'index'])->name('selfie.index');
    Route::get('/admin/selfie/create', [SelfieController::class, 'create'])->name('selfie.create');

    // Rute untuk menyimpan selfie (POST)
    Route::post('/admin/selfie/create', [SelfieController::class, 'store'])->name('selfie.store');
});


Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaDashboardController::class, 'index'])->name('siswa.dashboard');
});

require __DIR__ . '/auth.php';
