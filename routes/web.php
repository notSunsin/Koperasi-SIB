<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\Auth\RegisteredUserController;



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

require __DIR__.'/auth.php';
