<?php

namespace App\Http\Controllers\Arsip;

use App\Http\Controllers\Controller;
use App\Models\Folder; // Model induk
use App\Models\Dokumen; // Model yang akan diisi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Penting untuk file upload!

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource (READ).
     */
    public function index(Folder $folder)
    {
        // Ambil semua dokumen yang terkait dengan folder ini
        $dokumens = $folder->dokumens()->get();

        return view('arsip.dokumen.index', compact('folder', 'dokumens'));
    }

    public function edit(Folder $folder, Dokumen $dokumen)
    {
        // Cek keamanan: memastikan dokumen ini memang milik folder yang sedang diakses
        if ($dokumen->folder_id !== $folder->id) {
            // Jika tidak sesuai, kembalikan error (atau redirect)
            return redirect()->route('arsip.dokumen.index', $folder)->with('error', 'Akses tidak valid.');
        }
        return view('arsip.dokumen.edit', compact('folder', 'dokumen'));
    }

    public function update(Request $request, Folder $folder, Dokumen $dokumen)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kode_klasifikasi' => 'required|string|max:50',
            'nomor_item' => 'required|string|max:50',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240', // File opsional (nullable)
        ]);

        // Update metadata
        $dokumen->judul = $request->judul;
        $dokumen->kode_klasifikasi = $request->kode_klasifikasi;
        $dokumen->nomor_item = $request->nomor_item;

        // Logika Penggantian File (Jika ada file baru diupload)
        if ($request->hasFile('file_pdf')) {
            // Hapus file lama secara fisik
            Storage::disk('public')->delete($dokumen->file_path);

            // Simpan file baru
            $path = $request->file('file_pdf')->store('dokumen_arsip', 'public');
            $dokumen->file_path = $path;
        }

        $dokumen->save();

        return redirect()->route('arsip.dokumen.index', $folder)->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Store a newly created resource in storage (CREATE/UPLOAD).
     */
    public function store(Request $request, Folder $folder)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kode_klasifikasi' => 'required|string|max:50',
            'nomor_item' => 'required|string|max:50',
            // Pastikan file harus PDF dan maksimal 10MB
            'file_pdf' => 'required|file|mimes:pdf|max:10240',
        ]);

        // 1. Simpan File PDF ke storage (storage/app/public/dokumen_arsip)
        // Pastikan symbolic link sudah dibuat: php artisan storage:link
        $path = $request->file('file_pdf')->store('dokumen_arsip', 'public');

        // 2. Simpan Metadata ke Database
        $folder->dokumens()->create([
            'judul' => $request->judul,
            'kode_klasifikasi' => $request->kode_klasifikasi,
            'nomor_item' => $request->nomor_item,
            'file_path' => $path, // Simpan path yang dihasilkan
        ]);

        return redirect()->route('arsip.dokumen.index', $folder)->with('success', 'Dokumen berhasil diunggah dan disimpan.');
    }

    public function destroy(Folder $folder, Dokumen $dokumen)
    {
        // 1. Hapus file fisik dari storage (storage/app/public)
        // Ini penting agar file sampah tidak menumpuk!
        Storage::disk('public')->delete($dokumen->file_path);

        // 2. Hapus data dari database
        $dokumen->delete();

        return redirect()->route('arsip.dokumen.index', $folder)->with('success', 'Dokumen berhasil dihapus secara permanen.');
    }
}
