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
}