<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisArsip;
use App\Models\Box;
use App\Models\Rak;

class ArsipSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Jenis Arsip (Level 1)
        $up = JenisArsip::create(['nama' => 'UP Bendahara']);
        JenisArsip::create(['nama' => 'SPM']);
        JenisArsip::create(['nama' => 'PNBP']);
        JenisArsip::create(['nama' => 'Laporan Keuangan']);

        // 2. Contoh Box untuk UP Bendahara (Level 2)
        // Box ini akan muncul jika Anda klik UP Bendahara
        $box2024 = $up->boxes()->create(['tahun' => 2024, 'nomor_box' => 'Box-01-2024']);
        $box2023 = $up->boxes()->create(['tahun' => 2023, 'nomor_box' => 'Box-02-2023']);

        // 3. Contoh Rak untuk Box 2024 (Level 3)
        // Rak ini akan muncul jika Anda klik Box-01-2024
        $box2024->raks()->create(['nama_rak' => 'KKP']);
        $box2024->raks()->create(['nama_rak' => 'RM']);
        $box2024->raks()->create(['nama_rak' => 'TUP']);
    }
}