<?php

namespace Database\Seeders;

use App\Models\Dokumen;
use App\Models\Pengajuan;
use Illuminate\Database\Seeder;

class PengajuanSeeder extends Seeder
{
    public function run(): void
    {
        $pengajuans = [
            [
                'pegawai_id' => 1,
                'nomor_pengajuan' => 'KP-20260701-0001',
                'tanggal' => '2026-07-01',
                'pangkat_lama' => 'III/a - Penata Muda',
                'pangkat_baru' => 'III/b - Penata Muda Tingkat I',
                'jenis_kenaikan' => 'Reguler',
                'status' => 'disetujui',
                'keterangan' => 'Pengajuan kenaikan pangkat reguler.',
            ],
            [
                'pegawai_id' => 1,
                'nomor_pengajuan' => 'KP-20260710-0002',
                'tanggal' => '2026-07-10',
                'pangkat_lama' => 'III/b - Penata Muda Tingkat I',
                'pangkat_baru' => 'III/c - Penata',
                'jenis_kenaikan' => 'Pilihan',
                'status' => 'menunggu_verifikasi',
                'keterangan' => 'Kenaikan pangkat pilihan.',
            ],
            [
                'pegawai_id' => 1,
                'nomor_pengajuan' => 'KP-20260715-0003',
                'tanggal' => '2026-07-15',
                'pangkat_lama' => 'II/d - Pengatur Tingkat I',
                'pangkat_baru' => 'III/a - Penata Muda',
                'jenis_kenaikan' => 'Reguler',
                'status' => 'dokumen_tidak_lengkap',
                'keterangan' => 'Pengajuan kenaikan pangkat golongan.',
                'alasan_penolakan' => 'Dokumen berikut belum diunggah: SKP, Ijazah. Silakan lengkapi dokumen terlebih dahulu.',
            ],
            [
                'pegawai_id' => 2,
                'nomor_pengajuan' => 'KP-20260620-0004',
                'tanggal' => '2026-06-20',
                'pangkat_lama' => 'III/c - Penata',
                'pangkat_baru' => 'III/d - Penata Tingkat I',
                'jenis_kenaikan' => 'Reguler',
                'status' => 'ditolak',
                'keterangan' => 'Pengajuan kenaikan pangkat.',
                'alasan_penolakan' => 'Dokumen SKP belum lengkap. Harap melengkapi SKP 2 tahun terakhir.',
            ],
            [
                'pegawai_id' => 2,
                'nomor_pengajuan' => 'KP-20260712-0005',
                'tanggal' => '2026-07-12',
                'pangkat_lama' => 'III/a - Penata Muda',
                'pangkat_baru' => 'III/b - Penata Muda Tingkat I',
                'jenis_kenaikan' => 'Struktural',
                'status' => 'terverifikasi',
                'keterangan' => 'Kenaikan pangkat struktural.',
            ],
        ];

        foreach ($pengajuans as $data) {
            Pengajuan::create($data);
        }
    }
}
