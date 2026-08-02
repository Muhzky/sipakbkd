<?php

namespace Database\Seeders;

use App\Models\Pegawai;
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

        $pegawaiUser = User::create([
            'nip' => '198503122009122003',
            'nama' => 'Rina Febriyanti, S.Sos',
            'email' => 'pegawai@bkd.go.id',
            'password' => Hash::make('password'),
            'tempat_lahir' => 'Surabaya',
            'tgl_lahir' => '1985-03-12',
            'jenis_kelamin' => 'P',
        ]);
        $pegawaiUser->assignRole('Pegawai');

        Pegawai::create([
            'user_id' => $pegawaiUser->id,
            'jabatan_id' => 6,
            'pangkat_id' => 9,
            'unit_kerja' => 'Bidang Pengembangan',
            'no_hp' => '081234567890',
        ]);

        $pegawaiUser2 = User::create([
            'nip' => '199001152014061001',
            'nama' => 'Budi Santoso, S.Kom',
            'email' => 'budi@bkd.go.id',
            'password' => Hash::make('password'),
            'tempat_lahir' => 'Yogyakarta',
            'tgl_lahir' => '1990-01-15',
            'jenis_kelamin' => 'L',
        ]);
        $pegawaiUser2->assignRole('Pegawai');

        Pegawai::create([
            'user_id' => $pegawaiUser2->id,
            'jabatan_id' => 8,
            'pangkat_id' => 10,
            'unit_kerja' => 'Bidang Mutasi',
            'no_hp' => '081298765432',
        ]);
    }
}
