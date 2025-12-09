<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Arsip\JenisArsipController;
use App\Http\Controllers\Arsip\BoxController;
use App\Http\Controllers\Arsip\RakController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // LEVEL 1: Jenis Arsip (Dashboard Keuangan)
    Route::get('/arsip', [JenisArsipController::class, 'index'])->name('arsip.index');
});
// LEVEL 2: Box berdasarkan Jenis Arsip (Mirip Gambar 3.png)
Route::get('/arsip/{jenisArsip}/box', [BoxController::class, 'index'])->name('arsip.box.index');
// LEVEL 3: Rak berdasarkan Box (Rak KKP/RM/TUP)
Route::get('/box/{box}/rak', [RakController::class, 'index'])->name('arsip.rak.index');

require __DIR__ . '/auth.php';
