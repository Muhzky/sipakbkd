<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    public function index()
    {
        $pangkats = Pangkat::all();
        return view('admin.pangkat.index', compact('pangkats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'golongan' => 'required|max:20',
            'nama_pangkat' => 'required|max:255',
        ]);

        Pangkat::create($validated);

        return redirect()->route('admin.pangkat.index')->with('success', 'Pangkat berhasil ditambahkan.');
    }

    public function update(Request $request, Pangkat $pangkat)
    {
        $validated = $request->validate([
            'golongan' => 'required|max:20',
            'nama_pangkat' => 'required|max:255',
        ]);

        $pangkat->update($validated);

        return redirect()->route('admin.pangkat.index')->with('success', 'Pangkat berhasil diperbarui.');
    }

    public function destroy(Pangkat $pangkat)
    {
        $pangkat->delete();
        return redirect()->route('admin.pangkat.index')->with('success', 'Pangkat berhasil dihapus.');
    }
}
