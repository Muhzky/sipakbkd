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
            'no_hp' => 'nullable|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }
            $path = $request->file('foto')->storeAs(
                'foto-profil',
                $user->id . '_' . time() . '.' . $request->file('foto')->getClientOriginalExtension(),
                'public'
            );
            $user->update(['foto' => $path]);
        }

        $pegawai->update($request->only(['no_hp']));

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
