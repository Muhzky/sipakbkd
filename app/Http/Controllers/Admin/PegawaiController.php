<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Pangkat;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::with('user', 'jabatan', 'pangkat')->paginate(15);
        return view('admin.pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        $jabatans = Jabatan::all();
        $pangkats = Pangkat::all();
        return view('admin.pegawai.create', compact('jabatans', 'pangkats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|unique:users,nip',
            'nama' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'tempat_lahir' => 'nullable|max:255',
            'tgl_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'jabatan_id' => 'nullable|exists:jabatans,id',
            'pangkat_id' => 'nullable|exists:pangkats,id',
            'unit_kerja' => 'nullable|max:255',
            'no_hp' => 'nullable|max:20',
        ]);

        $user = User::create([
            'nip' => $validated['nip'],
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'tempat_lahir' => $validated['tempat_lahir'] ?? null,
            'tgl_lahir' => $validated['tgl_lahir'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
        ]);

        $user->assignRole('Pegawai');

        Pegawai::create([
            'user_id' => $user->id,
            'jabatan_id' => $validated['jabatan_id'] ?? null,
            'pangkat_id' => $validated['pangkat_id'] ?? null,
            'unit_kerja' => $validated['unit_kerja'] ?? null,
            'no_hp' => $validated['no_hp'] ?? null,
        ]);

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function edit(Pegawai $pegawai)
    {
        $pegawai->load('user');
        $jabatans = Jabatan::all();
        $pangkats = Pangkat::all();
        return view('admin.pegawai.edit', compact('pegawai', 'jabatans', 'pangkats'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate([
            'nip' => 'required|unique:users,nip,' . $pegawai->user_id,
            'nama' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $pegawai->user_id,
            'password' => 'nullable|min:8',
            'tempat_lahir' => 'nullable|max:255',
            'tgl_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'jabatan_id' => 'nullable|exists:jabatans,id',
            'pangkat_id' => 'nullable|exists:pangkats,id',
            'unit_kerja' => 'nullable|max:255',
            'no_hp' => 'nullable|max:20',
        ]);

        $userData = [
            'nip' => $validated['nip'],
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'tempat_lahir' => $validated['tempat_lahir'] ?? null,
            'tgl_lahir' => $validated['tgl_lahir'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $pegawai->user()->update($userData);

        $pegawai->update([
            'jabatan_id' => $validated['jabatan_id'] ?? null,
            'pangkat_id' => $validated['pangkat_id'] ?? null,
            'unit_kerja' => $validated['unit_kerja'] ?? null,
            'no_hp' => $validated['no_hp'] ?? null,
        ]);

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->user()->delete();
        $pegawai->delete();

        return redirect()->route('admin.pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
