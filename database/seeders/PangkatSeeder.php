<?php

namespace Database\Seeders;

use App\Models\Pangkat;
use Illuminate\Database\Seeder;

class PangkatSeeder extends Seeder
{
    public function run(): void
    {
        $pangkats = [
            ['golongan' => 'I/a', 'nama_pangkat' => 'Juru Muda'],
            ['golongan' => 'I/b', 'nama_pangkat' => 'Juru Muda Tingkat I'],
            ['golongan' => 'I/c', 'nama_pangkat' => 'Juru'],
            ['golongan' => 'I/d', 'nama_pangkat' => 'Juru Tingkat I'],
            ['golongan' => 'II/a', 'nama_pangkat' => 'Pengatur Muda'],
            ['golongan' => 'II/b', 'nama_pangkat' => 'Pengatur Muda Tingkat I'],
            ['golongan' => 'II/c', 'nama_pangkat' => 'Pengatur'],
            ['golongan' => 'II/d', 'nama_pangkat' => 'Pengatur Tingkat I'],
            ['golongan' => 'III/a', 'nama_pangkat' => 'Penata Muda'],
            ['golongan' => 'III/b', 'nama_pangkat' => 'Penata Muda Tingkat I'],
            ['golongan' => 'III/c', 'nama_pangkat' => 'Penata'],
            ['golongan' => 'III/d', 'nama_pangkat' => 'Penata Tingkat I'],
            ['golongan' => 'IV/a', 'nama_pangkat' => 'Pembina'],
            ['golongan' => 'IV/b', 'nama_pangkat' => 'Pembina Tingkat I'],
            ['golongan' => 'IV/c', 'nama_pangkat' => 'Pembina Muda'],
            ['golongan' => 'IV/d', 'nama_pangkat' => 'Pembina Madya'],
            ['golongan' => 'IV/e', 'nama_pangkat' => 'Pembina Utama'],
        ];

        foreach ($pangkats as $pangkat) {
            Pangkat::create($pangkat);
        }
    }
}
