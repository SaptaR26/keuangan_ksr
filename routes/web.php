<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasController;

// Jalur Akses Terbuka untuk Login & Keluar
Route::get('/login', [KasController::class, 'showLogin'])->name('login');
Route::post('/login/proses', [KasController::class, 'prosesLogin'])->name('login.proses');
Route::get('/logout', [KasController::class, 'logout'])->name('logout');

// Proteksi Halaman Internal KSR menggunakan Middleware
Route::middleware([\App\Http\Middleware\CheckKsrAuth::class])->group(function () {
    Route::get('/', [KasController::class, 'dashboard'])->name('dashboard');
    Route::get('/anggota', [KasController::class, 'anggotaIndex'])->name('anggota.index');
    Route::get('/kas-masuk', [KasController::class, 'kasIndex'])->name('kas.index');
    Route::post('/kas-masuk/simpan', [KasController::class, 'storeKas'])->name('kas.store');
    Route::get('/pengeluaran', [KasController::class, 'pengeluaranIndex'])->name('pengeluaran.index');
    Route::post('/pengeluaran/simpan', [KasController::class, 'storePengeluaran'])->name('pengeluaran.store');
    Route::get('/pengeluaran/hapus/{id}', [KasController::class, 'deletePengeluaran'])->name('pengeluaran.delete');
    Route::get('/kas/cetak-lpj', [KasController::class, 'cetakLPJ'])->name('kas.cetak');
});
