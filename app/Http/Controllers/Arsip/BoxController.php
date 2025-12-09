<?php

namespace App\Http\Controllers\Arsip;

use App\Http\Controllers\Controller;
use App\Models\JenisArsip; // Model induk
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function index(JenisArsip $jenisArsip)
    {
        // Menggunakan relasi untuk mengambil semua Box yang terkait dengan JenisArsip ini
        $boxes = $jenisArsip->boxes()->orderBy('tahun', 'desc')->get();

        // Tampilkan data ini di view
        return view('arsip.box.index', compact('jenisArsip', 'boxes'));
    }
}