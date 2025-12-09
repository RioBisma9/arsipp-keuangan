<?php

namespace App\Http\Controllers\Arsip;

use App\Http\Controllers\Controller;
use App\Models\JenisArsip; // Panggil model
use Illuminate\Http\Request;

class JenisArsipController extends Controller
{
    public function index()
    {
        // Ambil semua jenis arsip yang telah kita buat di Seeder
        $jenisArsips = JenisArsip::all();

        // Tampilkan data ini di view
        return view('arsip.jenisarsip.index', compact('jenisArsips'));
    }
}