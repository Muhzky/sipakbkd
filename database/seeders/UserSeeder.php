<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'nip' => '196501011990031001',
            'nama' => 'Drs. H. Ahmad Syukri, M.Si',
            'email' => 'admin@bkd.go.id',
            'password' => Hash::make('password'),
            'tempat_lahir' => 'Jakarta',
            'tgl_lahir' => '1965-01-01',
            'jenis_kelamin' => 'L',
        ]);
        $admin->assignRole('Admin BKD');

        $pimpinan = User::create([
            'nip' => '197002011995121002',
            'nama' => 'Ir. Hj. Siti Rahmawati, MM',
            'email' => 'pimpinan@bkd.go.id',
            'password' => Hash::make('password'),
            'tempat_lahir' => 'Bandung',
            'tgl_lahir' => '1970-02-01',
            'jenis_kelamin' => 'P',
        ]);
        $pimpinan->assignRole('Pimpinan');
    }
}
