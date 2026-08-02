<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function preview(Request $request)
    {
        $query = Pengajuan::with('pegawai.user', 'pegawai.jabatan', 'pegawai.pangkat');

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengajuans = $query->orderBy('created_at', 'desc')->get();
        $params = $request->only(['bulan', 'tahun', 'status']);

        return view('admin.laporan.preview', compact('pengajuans', 'params'));
    }

    public function pdf(Request $request)
    {
        $query = Pengajuan::with('pegawai.user', 'pegawai.jabatan', 'pegawai.pangkat');

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengajuans = $query->orderBy('created_at', 'desc')->get();
        $params = $request->only(['bulan', 'tahun', 'status']);

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('pengajuans', 'params'));
        return $pdf->download('laporan-pengajuan-' . date('YmdHis') . '.pdf');
    }

    public function pimpinanIndex()
    {
        return view('pimpinan.laporan.index');
    }

    public function pimpinanPreview(Request $request)
    {
        $query = Pengajuan::with('pegawai.user', 'pegawai.jabatan', 'pegawai.pangkat');

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengajuans = $query->orderBy('created_at', 'desc')->get();
        $params = $request->only(['bulan', 'tahun', 'status']);

        return view('pimpinan.laporan.preview', compact('pengajuans', 'params'));
    }
}
