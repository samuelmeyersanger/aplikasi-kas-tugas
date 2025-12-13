<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\TugasController as AdminTugasController;
use App\Http\Controllers\Admin\TagihanController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Admin\TransaksiKasController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\TugasController as MahasiswaTugasController;
use App\Http\Controllers\Mahasiswa\PembayaranController as MahasiswaPembayaranController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('Admin')) {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->hasRole('Mahasiswa')) {
        return redirect()->route('mahasiswa.dashboard');
    }
    abort(403, 'Unauthorized action.');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('tugas', AdminTugasController::class);
    Route::resource('tagihan', TagihanController::class);
    Route::resource('kas', TransaksiKasController::class)->parameters(['kas' => 'transaksiKas']);
    Route::get('pembayaran', [AdminPembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('pembayaran/{pembayaran}', [AdminPembayaranController::class, 'show'])->name('pembayaran.show');
    Route::put('pembayaran/{pembayaran}', [AdminPembayaranController::class, 'update'])->name('pembayaran.update');
});

Route::middleware(['auth', 'verified', 'role:Mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/tugas', [MahasiswaTugasController::class, 'index'])->name('tugas.index');
    Route::post('/tugas/{tugas}/complete', [MahasiswaTugasController::class, 'complete'])->name('tugas.complete');
    Route::get('/pembayaran', [MahasiswaPembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran/{tagihan}', [MahasiswaPembayaranController::class, 'store'])->name('pembayaran.store');
});

require __DIR__.'/auth.php';