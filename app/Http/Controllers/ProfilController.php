<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pegawai = $user->pegawai;

        if (!$pegawai) {
            $pegawai = Pegawai::create(['user_id' => $user->id]);
        }

        $jabatans = \App\Models\Jabatan::all();
        $pangkats = \App\Models\Pangkat::all();

        return view('profil.index', compact('user', 'pegawai', 'jabatans', 'pangkats'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $pegawai = $user->pegawai;

        $request->validate([
            'nama' => 'required|max:255',
            'tempat_lahir' => 'nullable|max:255',
            'tgl_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'unit_kerja' => 'nullable|max:255',
            'no_hp' => 'nullable|max:20',
            'jabatan_id' => 'nullable|exists:jabatans,id',
            'pangkat_id' => 'nullable|exists:pangkats,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->update($request->only(['nama', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin']));

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::delete('public/' . $user->foto);
            }
            $foto = $request->file('foto')->store('foto-profil', 'public');
            $user->update(['foto' => $foto]);
        }

        $pegawai->update($request->only(['unit_kerja', 'no_hp', 'jabatan_id', 'pangkat_id']));

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
