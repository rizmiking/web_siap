<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdministrasiController extends Controller
{
    // Menampilkan halaman kelola administrasi khusus untuk 1 pelatihan
    public function index(Pelatihan $pelatihan)
    {
        $administrasis = $pelatihan->administrasis()->latest()->get();
        return view('administrasi.index', compact('pelatihan', 'administrasis'));
    }

    // Menambah kebutuhan administrasi baru pada pelatihan
    public function store(Request $request, Pelatihan $pelatihan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'wajib' => 'required|boolean',
            'keterangan' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:5120', // Maks 5MB
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('administrasi_files', 'public');
            $validated['file'] = $path;
            $validated['status'] = 'Sudah Diunggah';
        } else {
            $validated['status'] = 'Belum Ada';
        }

        $pelatihan->administrasis()->create($validated);

        return back()->with('success', 'Persyaratan administrasi berhasil ditambahkan!');
    }

    // Memperbarui data / Mengunggah ulang file berkas
    public function update(Request $request, Administrasi $administrasi)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'wajib' => 'required|boolean',
            'status' => 'required|string',
            'keterangan' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:5120',
        ]);

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($administrasi->file && Storage::disk('public')->exists($administrasi->file)) {
                Storage::disk('public')->delete($administrasi->file);
            }

            $path = $request->file('file')->store('administrasi_files', 'public');
            $validated['file'] = $path;
            $validated['status'] = 'Sudah Diunggah';
        }

        $administrasi->update($validated);

        return back()->with('success', 'Data administrasi berhasil diperbarui!');
    }

    // Menghapus item administrasi beserta filenya
    public function destroy(Administrasi $administrasi)
    {
        if ($administrasi->file && Storage::disk('public')->exists($administrasi->file)) {
            Storage::disk('public')->delete($administrasi->file);
        }

        $administrasi->delete();

        return back()->with('success', 'Item administrasi berhasil dihapus!');
    }
}
