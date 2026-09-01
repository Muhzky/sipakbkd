<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Pegawai;
use App\Models\Pengajuan;
use App\Models\User;
use App\Notifications\PengajuanBaru;
use App\Notifications\PengajuanDiverifikasi;
use App\Notifications\PengajuanDitolakOperator;
use App\Notifications\PengajuanTerverifikasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    public function create()
    {
        $pegawai = Auth::user()->pegawai;

        if (!$pegawai) {
            return redirect()->route('profil')->with('error', 'Lengkapi profil terlebih dahulu.');
        }

        $pangkats = \App\Models\Pangkat::all();
        return view('pegawai.pengajuan.create', compact('pegawai', 'pangkats'));
    }

    public function store(Request $request)
    {
        $pegawai = Auth::user()->pegawai;

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'pangkat_lama' => 'required|max:255',
            'pangkat_baru' => 'required|max:255',
            'jenis_kenaikan' => 'required|max:255',
            'keterangan' => 'nullable|string',
            'sk_pangkat' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
            'skp' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
            'ijazah' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
            'dokumen_pendukung' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $nomorPengajuan = 'KP-' . date('Ymd') . '-' . str_pad(Pengajuan::count() + 1, 4, '0', STR_PAD_LEFT);

        $pengajuan = Pengajuan::create([
            'pegawai_id' => $pegawai->id,
            'nomor_pengajuan' => $nomorPengajuan,
            'tanggal' => $validated['tanggal'],
            'pangkat_lama' => $validated['pangkat_lama'],
            'pangkat_baru' => $validated['pangkat_baru'],
            'jenis_kenaikan' => $validated['jenis_kenaikan'],
            'keterangan' => $validated['keterangan'] ?? null,
            'status' => 'menunggu',
        ]);

        $dokumenData = ['pengajuan_id' => $pengajuan->id];
        foreach (['sk_pangkat', 'skp', 'ijazah', 'dokumen_pendukung'] as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->storeAs(
                    'dokumen/' . $pengajuan->id,
                    $field . '_' . time() . '.' . $request->file($field)->getClientOriginalExtension(),
                    'public'
                );
                $dokumenData[$field] = $path;
            }
        }

        Dokumen::create($dokumenData);
        $dokumen = $pengajuan->dokumen;

        $dokumenFields = ['sk_pangkat', 'skp', 'ijazah', 'dokumen_pendukung'];
        $allComplete = true;
        $missingLabels = [];
        $fieldLabels = [
            'sk_pangkat' => 'SK Pangkat',
            'skp' => 'SKP',
            'ijazah' => 'Ijazah',
            'dokumen_pendukung' => 'Dokumen Pendukung',
        ];

        foreach ($dokumenFields as $field) {
            if (!$dokumen || !$dokumen->$field) {
                $allComplete = false;
                $missingLabels[] = $fieldLabels[$field];
            }
        }

        if ($allComplete) {
            $pengajuan->update(['status' => 'menunggu_verifikasi']);

            $admins = User::role('Admin BKD')->get();
            Notification::send($admins, new PengajuanBaru($pengajuan));

            $message = 'Pengajuan berhasil dikirim dan dokumen lengkap. Pengajuan telah diteruskan ke operator untuk verifikasi.';
        } else {
            $pengajuan->update([
                'status' => 'dokumen_tidak_lengkap',
                'alasan_penolakan' => 'Dokumen berikut belum diunggah: ' . implode(', ', $missingLabels) . '. Silakan lengkapi dokumen terlebih dahulu.',
            ]);
            $message = 'Pengajuan berhasil dikirim namun dokumen belum lengkap. Silakan lengkapi dokumen yang masih kurang.';
        }

        return redirect()->route('pegawai.riwayat')->with('success', $message);
    }

    public function riwayat()
    {
        $pegawai = Auth::user()->pegawai;
        $pengajuans = Pengajuan::where('pegawai_id', $pegawai->id)
            ->with('dokumen')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pegawai.pengajuan.riwayat', compact('pengajuans'));
    }

    public function show(Pengajuan $pengajuan)
    {
        $this->authorizeView($pengajuan);
        $pengajuan->load('dokumen', 'pegawai.user', 'pegawai.jabatan', 'pegawai.pangkat');
        return view('pegawai.pengajuan.show', compact('pengajuan'));
    }

    public function editDokumen(Pengajuan $pengajuan)
    {
        $this->authorizeView($pengajuan);

        if (!in_array($pengajuan->status, ['dokumen_tidak_lengkap', 'ditolak_operator'])) {
            return redirect()->route('pegawai.riwayat')->with('error', 'Tidak dapat mengubah dokumen pada status ini.');
        }

        $pengajuan->load('dokumen');
        return view('pegawai.pengajuan.edit_dokumen', compact('pengajuan'));
    }

    public function updateDokumen(Request $request, Pengajuan $pengajuan)
    {
        $this->authorizeView($pengajuan);

        if (!in_array($pengajuan->status, ['dokumen_tidak_lengkap', 'ditolak_operator'])) {
            return redirect()->route('pegawai.riwayat')->with('error', 'Tidak dapat mengubah dokumen pada status ini.');
        }

        $validated = $request->validate([
            'sk_pangkat' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
            'skp' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
            'ijazah' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
            'dokumen_pendukung' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $dokumen = $pengajuan->dokumen;
        if (!$dokumen) {
            $dokumen = new Dokumen(['pengajuan_id' => $pengajuan->id]);
        }

        foreach (['sk_pangkat', 'skp', 'ijazah', 'dokumen_pendukung'] as $field) {
            if ($request->hasFile($field)) {
                if ($dokumen->$field) {
                    Storage::disk('public')->delete($dokumen->$field);
                }
                $path = $request->file($field)->storeAs(
                    'dokumen/' . $pengajuan->id,
                    $field . '_' . time() . '.' . $request->file($field)->getClientOriginalExtension(),
                    'public'
                );
                $dokumen->$field = $path;
            }
        }
        $dokumen->save();

        $dokumenFields = ['sk_pangkat', 'skp', 'ijazah', 'dokumen_pendukung'];
        $allComplete = true;
        $fieldLabels = [
            'sk_pangkat' => 'SK Pangkat',
            'skp' => 'SKP',
            'ijazah' => 'Ijazah',
            'dokumen_pendukung' => 'Dokumen Pendukung',
        ];
        $missingLabels = [];

        foreach ($dokumenFields as $field) {
            if (!$dokumen->$field) {
                $allComplete = false;
                $missingLabels[] = $fieldLabels[$field];
            }
        }

        if ($allComplete) {
            $pengajuan->update(['status' => 'menunggu_verifikasi', 'alasan_penolakan' => null]);

            $admins = User::role('Admin BKD')->get();
            Notification::send($admins, new PengajuanBaru($pengajuan));

            $message = 'Dokumen berhasil diperbarui dan lengkap. Pengajuan telah diteruskan ke operator untuk verifikasi.';
        } else {
            $pengajuan->update([
                'status' => 'dokumen_tidak_lengkap',
                'alasan_penolakan' => 'Dokumen berikut belum diunggah: ' . implode(', ', $missingLabels) . '. Silakan lengkapi dokumen terlebih dahulu.',
            ]);
            $message = 'Dokumen berhasil diperbarui namun masih ada yang kurang. Silakan lengkapi semua dokumen.';
        }

        return redirect()->route('pegawai.riwayat')->with('success', $message);
    }

    // Admin methods
    public function index(Request $request)
    {
        $query = Pengajuan::with('pegawai.user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengajuans = $query->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.pengajuan.index', compact('pengajuans'));
    }

    public function verifikasi(Pengajuan $pengajuan)
    {
        $pengajuan->load('dokumen', 'pegawai.user', 'pegawai.jabatan', 'pegawai.pangkat');
        return view('admin.pengajuan.verifikasi', compact('pengajuan'));
    }

    public function updateStatus(Request $request, Pengajuan $pengajuan)
    {
        $validated = $request->validate([
            'status' => 'required|in:terverifikasi,ditolak_operator',
            'alasan_penolakan' => 'required_if:status,ditolak_operator|nullable|string',
        ]);

        $pengajuan->update([
            'status' => $validated['status'],
            'alasan_penolakan' => $validated['alasan_penolakan'] ?? null,
        ]);

        if ($validated['status'] === 'terverifikasi') {
            $pimpinan = User::role('Pimpinan')->get();
            Notification::send($pimpinan, new PengajuanTerverifikasi($pengajuan));

            $pengajuan->pegawai->user->notify(new PengajuanDiverifikasi($pengajuan));
        }

        if ($validated['status'] === 'ditolak_operator') {
            $pengajuan->load('pegawai.user');
            $pengajuan->pegawai->user->notify(new PengajuanDitolakOperator($pengajuan));
        }

        $message = $validated['status'] === 'terverifikasi'
            ? 'Pengajuan telah diverifikasi dan diteruskan ke pimpinan untuk persetujuan.'
            : 'Pengajuan dikembalikan kepada pegawai untuk diperbaiki.';

        return redirect()->route('admin.pengajuan.index')->with('success', $message);
    }

    public function downloadDokumen($id, $field)
    {
        $dokumen = Dokumen::findOrFail($id);
        $file = $dokumen->$field;

        if (!$file || !Storage::disk('public')->exists($file)) {
            return back()->with('error', 'Dokumen tidak ditemukan.');
        }

        return Storage::disk('public')->download($file);
    }

    public function downloadSk(Pengajuan $pengajuan)
    {
        $this->authorizeView($pengajuan);

        if ($pengajuan->status !== 'disetujui') {
            return back()->with('error', 'SK hanya tersedia untuk pengajuan yang telah disetujui.');
        }

        $pengajuan->load('pegawai.user', 'pegawai.jabatan', 'pegawai.pangkat');

        $pimpinan = User::role('Pimpinan')->first();
        $sekretaris = User::where('email', 'aleksanderstmm@bkd.go.id')->first();
        $kabid = $pimpinan;
        $kepalaBkd = $pimpinan;

        $pdf = Pdf::loadView('admin.pengajuan.sk', compact('pengajuan', 'sekretaris', 'kabid', 'kepalaBkd'))
            ->setPaper(array(0, 0, 609.448, 935.433), 'portrait');
        return $pdf->download('SK-' . $pengajuan->nomor_pengajuan . '.pdf');
    }

    public function destroy(Pengajuan $pengajuan)
    {
        if ($pengajuan->dokumen) {
            Storage::disk('public')->deleteDirectory('dokumen/' . $pengajuan->id);
            $pengajuan->dokumen->delete();
        }

        $pengajuan->delete();

        return redirect()->route('admin.pengajuan.index')->with('success', 'Pengajuan berhasil dihapus.');
    }

    private function authorizeView(Pengajuan $pengajuan)
    {
        $user = Auth::user();
        if ($user->hasRole('Pegawai') && $pengajuan->pegawai->user_id !== $user->id) {
            abort(403);
        }
    }
}
