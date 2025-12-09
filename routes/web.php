<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Arsip\JenisArsipController;
use App\Http\Controllers\Arsip\BoxController;
use App\Http\Controllers\Arsip\RakController;
use App\Http\Controllers\Arsip\FolderController;
use App\Http\Controllers\Arsip\DokumenController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/folder/{folder}/dokumen', [DokumenController::class, 'index'])->name('arsip.dokumen.index');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // LEVEL 1: Jenis Arsip (Dashboard Keuangan)
    Route::get('/arsip', [JenisArsipController::class, 'index'])->name('arsip.index');
});
// LEVEL 2: Box berdasarkan Jenis Arsip (Mirip Gambar 3.png)
Route::get('/arsip/{jenisArsip}/box', [BoxController::class, 'index'])->name('arsip.box.index');
// LEVEL 3: Rak berdasarkan Box (Rak KKP/RM/TUP)
Route::get('/box/{box}/rak', [RakController::class, 'index'])->name('arsip.rak.index');
// LEVEL 4: Folder berdasarkan Rak (Mirip Gambar 4.png)
Route::get('/rak/{rak}/folder', [FolderController::class, 'index'])->name('arsip.folder.index');
// LEVEL 5: Dokumen (CRUD) berdasarkan Folder (Mirip Gambar 5.png)
// Route Resource untuk menangani store, edit, update, destroy
Route::resource('folder.dokumen', DokumenController::class)->except(['index']);

require __DIR__ . '/auth.php';
