<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PinjamanAdminController;
use App\Http\Controllers\SimpananAdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('/auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('simpanans', SimpananController::class);
    Route::resource('pinjamen', PinjamanController::class);
});

Route::middleware(['auth', 'role:admin'])->prefix('dashboard')->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('dashboard.laporan');
});

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.home');
    Route::get('/pegawai', fn() => view('dashboard.pegawai'))->name('dashboard.pegawai');
    Route::get('/anggota', fn() => view('dashboard.anggota'))->name('dashboard.anggota');
    Route::get('/simpanan', fn() => view('dashboard.simpanan'))->name('dashboard.simpanan');
    Route::get('/laporan', fn() => view('dashboard.laporan'))->name('dashboard.laporan');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', fn() => view('dashboard.index'))->name('dashboard');
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('dashboard.pegawai');
    Route::get('/pegawai/tambah', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.store');
});

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/nasabah', [NasabahController::class, 'index'])->name('dashboard.nasabah');
    Route::get('/nasabah/tambah', [NasabahController::class, 'create'])->name('nasabah.create');
    Route::post('/nasabah/store', [NasabahController::class, 'store'])->name('nasabah.store');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // ========== ADMIN AREA ==========
    Route::middleware(['role:admin'])->prefix('dashboard')->group(function () {
        Route::get('/', fn() => view('dashboard.index'))->name('dashboard');
        Route::get('/pegawai', [PegawaiController::class, 'index'])->name('dashboard.pegawai');
        Route::get('/nasabah', [NasabahController::class, 'index'])->name('dashboard.nasabah');
        Route::get('/simpanan', [SimpananAdminController::class, 'index'])->name('dashboard.simpanan');
        Route::get('/simpanan/tambah', [SimpananAdminController::class, 'create'])->name('simpanan.create');
        Route::post('/simpanan/store', [SimpananAdminController::class, 'store'])->name('simpanan.store');
        Route::get('/simpanan/edit/{simpanan}', [SimpananAdminController::class, 'edit'])->name('simpanan.edit');
        Route::post('/simpanan/update/{simpanan}', [SimpananAdminController::class, 'update'])->name('simpanan.update');
        Route::delete('/simpanan/{simpanan}', [SimpananAdminController::class, 'destroy'])->name('simpanan.destroy');
        Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('dashboard.laporan');
        Route::get('/laporan/download', [App\Http\Controllers\LaporanController::class, 'download'])->name('laporan.download');
        Route::post('/laporan/store', [LaporanController::class, 'store'])->name('laporan.store');
        Route::get('/pinjaman', [PinjamanAdminController::class, 'index'])->name('dashboard.pinjaman');
        Route::get('/pinjaman/tambah', [PinjamanAdminController::class, 'create'])->name('pinjaman.create');
        Route::post('/pinjaman/store', [PinjamanAdminController::class, 'store'])->name('pinjaman.store');
        Route::get('/pinjaman/edit/{pinjaman}', [PinjamanAdminController::class, 'edit'])->name('pinjaman.edit');
        Route::post('/pinjaman/update/{pinjaman}', [PinjamanAdminController::class, 'update'])->name('pinjaman.update');
        Route::delete('/pinjaman/{pinjaman}', [PinjamanAdminController::class, 'destroy'])->name('pinjaman.destroy');
    });

    // ========== NASABAH AREA ==========
    Route::middleware(['role:nasabah'])->prefix('nasabah')->group(function () {
        Route::get('/', fn() => view('nasabah.home'))->name('nasabah.home');
        Route::get('/pinjaman', [PinjamanController::class, 'index'])->name('nasabah.pinjaman');
        Route::get('/simpanan', [App\Http\Controllers\SimpananController::class, 'index'])->name('nasabah.simpanan');
        Route::get('/laporan', [App\Http\Controllers\LaporanNasabahController::class, 'index'])->name('nasabah.laporan');
        Route::get('/laporan/download', [App\Http\Controllers\LaporanNasabahController::class, 'download'])->name('nasabah.laporan.download');
    });
});

require __DIR__.'/auth.php';
