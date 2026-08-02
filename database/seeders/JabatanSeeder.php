<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        $jabatans = [
            'Kepala BKD',
            'Sekretaris BKD',
            'Kepala Bidang Pengembangan',
            'Kepala Bidang Mutasi',
            'Kepala Bidang Umum',
            'Analis Kepegawaian',
            'Penyusun Program',
            'Pengelola Kepegawaian',
            'Staf Administrasi',
            'Fungsional Umum',
        ];

        foreach ($jabatans as $nama) {
            Jabatan::create(['nama_jabatan' => $nama]);
        }
    }
}
