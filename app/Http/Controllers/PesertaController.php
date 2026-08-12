<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    // Menampilkan daftar peserta untuk 1 pelatihan spesifik
    public function index(Pelatihan $pelatihan)
    {
        $pesertas = $pelatihan->pesertas()->latest()->get();
        return view('peserta.index', compact('pelatihan', 'pesertas'));
    }

    // Menyimpan data peserta baru
    public function store(Request $request, Pelatihan $pelatihan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik_nim' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'instansi' => 'required|string|max:255',
            'status' => 'required|string|max:100',
        ]);

        $pelatihan->pesertas()->create($validated);

        return back()->with('success', 'Data peserta berhasil ditambahkan!');
    }

    // Memperbarui data peserta
    public function update(Request $request, Peserta $peserta)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik_nim' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'instansi' => 'required|string|max:255',
            'status' => 'required|string|max:100',
        ]);

        $peserta->update($validated);

        return back()->with('success', 'Data peserta berhasil diperbarui!');
    }

    // Menghapus data peserta
    public function destroy(Peserta $peserta)
    {
        $peserta->delete();

        return back()->with('success', 'Data peserta berhasil dihapus!');
    }
}
