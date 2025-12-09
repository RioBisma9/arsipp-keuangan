<?php

namespace App\Http\Controllers\Arsip;

use App\Http\Controllers\Controller;
use App\Models\Rak; // Model induk
use App\Models\Folder; // Model yang akan dibuat
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index(Rak $rak)
    {
        // Menggunakan relasi untuk mengambil semua Folder yang terkait dengan Rak ini
        $folders = $rak->folders()->get();

        // Tampilkan data ini di view
        return view('arsip.folder.index', compact('rak', 'folders'));
    }

    /**
     * Store a newly created resource in storage (CRUD Create Folder).
     */
    public function store(Request $request, Rak $rak)
    {
        $request->validate([
            'nomor_folder' => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $rak->folders()->create([
            'nomor_folder' => $request->nomor_folder,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('arsip.folder.index', $rak)->with('success', 'Folder berhasil dibuat.');
    }
}