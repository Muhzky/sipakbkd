<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Notifications\StatusPersetujuan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengajuan::with('pegawai.user', 'pegawai.jabatan', 'pegawai.pangkat');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengajuans = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('pimpinan.pengajuan.index', compact('pengajuans'));
    }

    public function show(Pengajuan $pengajuan)
    {
        $pengajuan->load('dokumen', 'pegawai.user', 'pegawai.jabatan', 'pegawai.pangkat');
        return view('pimpinan.pengajuan.show', compact('pengajuan'));
    }

    public function approve(Pengajuan $pengajuan)
    {
        if ($pengajuan->status !== 'terverifikasi') {
            return redirect()->route('pimpinan.pengajuan.index')
                ->with('error', 'Hanya pengajuan dengan status Terverifikasi yang dapat disetujui.');
        }

        $pengajuan->update([
            'status' => 'disetujui',
            'alasan_penolakan' => null,
        ]);

        $pengajuan->load('pegawai.user', 'pegawai.jabatan', 'pegawai.pangkat');

        $pengajuan->pegawai->user->notify(new StatusPersetujuan($pengajuan, 'disetujui'));

        return redirect()->route('pimpinan.pengajuan.index')
            ->with('success', 'Pengajuan telah disetujui. SK akan diterbitkan secara otomatis.');
    }

    public function reject(Request $request, Pengajuan $pengajuan)
    {
        if ($pengajuan->status !== 'terverifikasi') {
            return redirect()->route('pimpinan.pengajuan.index')
                ->with('error', 'Hanya pengajuan dengan status Terverifikasi yang dapat ditolak.');
        }

        $validated = $request->validate([
            'alasan_penolakan' => 'required|string',
        ]);

        $pengajuan->update([
            'status' => 'ditolak',
            'alasan_penolakan' => $validated['alasan_penolakan'],
        ]);

        $pengajuan->pegawai->user->notify(new StatusPersetujuan($pengajuan, 'ditolak'));

        return redirect()->route('pimpinan.pengajuan.index')
            ->with('success', 'Pengajuan telah ditolak.');
    }
}
