<?php

namespace App\Console\Commands;

use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Pangkat;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class ImportPegawaiCommand extends Command
{
    protected $signature = 'pegawai:import';
    protected $description = 'Import data pegawai dari file database/import/pegawai.xlsx';

    private array $usedEmails = [];
    private array $jabatanCache = [];

    public function handle(): int
    {
        $filePath = database_path('import/pegawai.xlsx');

        if (!file_exists($filePath)) {
            $this->error('File tidak ditemukan: ' . $filePath);
            return 1;
        }

        $this->info('Memulai import data pegawai...');
        $this->newLine();

        $rows = Excel::toCollection([], $filePath)->first();
        $header = $rows->shift()->toArray();

        $created = 0;
        $skipped = 0;

        foreach ($rows as $index => $row) {
            $rowIndex = $index + 2;
            $data = array_combine($header, $row->toArray());

            $nip = trim((string) ($data['NIP Pegawai'] ?? ''));
            $nama = trim((string) ($data['Nama Pegawai'] ?? ''));

            if (empty($nip) || empty($nama)) {
                $this->warn("Baris {$rowIndex}: NIP atau Nama kosong, dilewati.");
                $skipped++;
                continue;
            }

            if (User::where('nip', $nip)->exists()) {
                $this->warn("Baris {$rowIndex}: NIP {$nip} sudah ada, dilewati.");
                $skipped++;
                continue;
            }

            $email = $this->generateEmail($nama);
            $tglLahir = $this->parseDate($data['Tanggal Lahir Pegawai'] ?? null);
            $jenisKelamin = $this->guessGender($nip);

            $user = User::create([
                'nip' => $nip,
                'nama' => $nama,
                'email' => $email,
                'password' => Hash::make('password'),
                'tgl_lahir' => $tglLahir,
                'jenis_kelamin' => $jenisKelamin,
            ]);

            $user->assignRole('Pegawai');

            $jabatanId = $this->resolveJabatan($data['Nama Jabatan'] ?? null);
            $pangkatId = $this->resolvePangkat($data['Golongan'] ?? null);

            Pegawai::create([
                'user_id' => $user->id,
                'jabatan_id' => $jabatanId,
                'pangkat_id' => $pangkatId,
                'unit_kerja' => null,
                'no_hp' => null,
            ]);

            $created++;
            $this->line("  <info>[{$created}]</info> {$nama} ({$nip}) - Email: {$email}");
        }

        $this->newLine();
        $this->info("Import selesai: {$created} pegawai berhasil, {$skipped} dilewati.");
        return 0;
    }

    private function generateEmail(string $nama): string
    {
        $base = strtolower(preg_replace('/[^a-zA-Z]/', '', $nama));
        $email = $base . '@bkd.go.id';

        if (!in_array($email, $this->usedEmails) && !User::where('email', $email)->exists()) {
            $this->usedEmails[] = $email;
            return $email;
        }

        $counter = 1;
        while (true) {
            $email = $base . $counter . '@bkd.go.id';
            if (!in_array($email, $this->usedEmails) && !User::where('email', $email)->exists()) {
                $this->usedEmails[] = $email;
                return $email;
            }
            $counter++;
        }
    }

    private function guessGender(string $nip): string
    {
        if (strlen($nip) >= 14) {
            $digit14 = (int) $nip[13];
            return $digit14 % 2 === 1 ? 'L' : 'P';
        }
        return 'L';
    }

    private function parseDate(?string $date): ?string
    {
        if (empty($date)) {
            return null;
        }

        $date = trim((string) $date);
        $formats = ['d-m-Y', 'd/m/Y', 'Y-m-d', 'd M Y'];

        foreach ($formats as $format) {
            $parsed = \DateTime::createFromFormat($format, $date);
            if ($parsed && $parsed->format($format) === $date) {
                return $parsed->format('Y-m-d');
            }
        }

        return null;
    }

    private function resolveJabatan(?string $namaJabatan): ?int
    {
        if (empty($namaJabatan)) {
            return null;
        }

        $namaJabatan = trim((string) $namaJabatan);

        if (isset($this->jabatanCache[$namaJabatan])) {
            return $this->jabatanCache[$namaJabatan];
        }

        $jabatan = Jabatan::where('nama_jabatan', $namaJabatan)->first();

        if (!$jabatan) {
            $jabatan = Jabatan::create(['nama_jabatan' => $namaJabatan]);
            $this->warn("  Jabatan baru dibuat: {$namaJabatan}");
        }

        $this->jabatanCache[$namaJabatan] = $jabatan->id;
        return $jabatan->id;
    }

    private function resolvePangkat(?string $golongan): ?int
    {
        if (empty($golongan)) {
            return null;
        }

        $golongan = trim((string) $golongan);
        $parts = explode('/', $golongan);
        $normalized = strtoupper($parts[0]) . '/' . strtolower($parts[1] ?? '');

        $pangkat = Pangkat::whereRaw('UPPER(golongan) = ?', [$normalized])->first();

        return $pangkat?->id;
    }
}
