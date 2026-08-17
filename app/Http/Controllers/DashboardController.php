<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin BKD')) {
            return $this->adminDashboard();
        } elseif ($user->hasRole('Pimpinan')) {
            return $this->pimpinanDashboard();
        }

        return $this->pegawaiDashboard();
    }

    private function pegawaiDashboard()
    {
        $pegawai = Auth::user()->pegawai;

        if (!$pegawai) {
            $pegawai = Pegawai::create(['user_id' => Auth::id()]);
        }

        $pengajuans = Pengajuan::where('pegawai_id', $pegawai->id);
        $totalMenunggu = (clone $pengajuans)->whereIn('status', ['menunggu', 'dokumen_tidak_lengkap', 'ditolak_operator'])->count();
        $totalDiproses = (clone $pengajuans)->whereIn('status', ['menunggu_verifikasi', 'terverifikasi'])->count();
        $totalDisetujui = (clone $pengajuans)->where('status', 'disetujui')->count();
        $totalDitolak = (clone $pengajuans)->where('status', 'ditolak')->count();

        return view('dashboard.pegawai', compact('pengajuans', 'totalMenunggu', 'totalDiproses', 'totalDisetujui', 'totalDitolak'));
    }

    private function adminDashboard()
    {
        $totalPegawai = Pegawai::whereDoesntHave('user.roles', fn ($q) => $q->where('name', 'Admin BKD'))->count();
        $totalPengajuan = Pengajuan::count();
        $menunggu = Pengajuan::whereIn('status', ['menunggu', 'dokumen_tidak_lengkap'])->count();
        $menungguVerifikasi = Pengajuan::where('status', 'menunggu_verifikasi')->count();
        $terverifikasi = Pengajuan::where('status', 'terverifikasi')->count();
        $ditolakOperator = Pengajuan::where('status', 'ditolak_operator')->count();
        $disetujui = Pengajuan::where('status', 'disetujui')->count();
        $ditolak = Pengajuan::where('status', 'ditolak')->count();

        $chartData = Pengajuan::selectRaw("EXTRACT(MONTH FROM tanggal) as bulan, count(*) as total")
            ->whereYear('tanggal', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $values = [];
        for ($i = 1; $i <= 12; $i++) {
            $values[] = $chartData->get($i, 0);
        }

        return view('dashboard.admin', compact(
            'totalPegawai', 'totalPengajuan', 'menunggu', 'menungguVerifikasi',
            'terverifikasi', 'ditolakOperator', 'disetujui', 'ditolak', 'labels', 'values'
        ));
    }

    private function pimpinanDashboard()
    {
        $totalPegawai = Pegawai::whereDoesntHave('user.roles', fn ($q) => $q->where('name', 'Admin BKD'))->count();
        $totalPengajuan = Pengajuan::count();
        $menungguPersetujuan = Pengajuan::where('status', 'terverifikasi')->count();
        $disetujui = Pengajuan::where('status', 'disetujui')->count();
        $ditolak = Pengajuan::where('status', 'ditolak')->count();

        $chartData = Pengajuan::selectRaw("EXTRACT(MONTH FROM tanggal) as bulan, count(*) as total")
            ->whereYear('tanggal', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $values = [];
        for ($i = 1; $i <= 12; $i++) {
            $values[] = $chartData->get($i, 0);
        }

        return view('dashboard.pimpinan', compact(
            'totalPegawai', 'totalPengajuan', 'menungguPersetujuan', 'disetujui', 'ditolak',
            'labels', 'values'
        ));
    }
}
