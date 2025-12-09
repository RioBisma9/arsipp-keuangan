<?php

namespace App\Http\Controllers\Arsip;

use App\Http\Controllers\Controller;
use App\Models\Box; // Model induk
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function index(Box $box)
    {
        // Menggunakan relasi untuk mengambil semua Rak yang terkait dengan Box ini
        $raks = $box->raks()->get();

        // Tampilkan data ini di view
        return view('arsip.rak.index', compact('box', 'raks'));
    }
}