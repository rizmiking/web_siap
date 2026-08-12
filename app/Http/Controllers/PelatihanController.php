<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelatihans = Pelatihan::with('user')->latest()->get();
        return view('pelatihan.index', compact('pelatihans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('pelatihan.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelatihan' => 'required|string|max:255',
            'tema' => 'required|string|max:255',
            'jenis_pelatihan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tempat' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'target_peserta' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();

        Pelatihan::create($validated);

        return redirect()->route('pelatihan.index')->with('success', 'Data pelatihan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelatihan $pelatihan)
    {
        return view('pelatihan.show', compact('pelatihan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Pelatihan $pelatihan)
    // {
    //     return view('pelatihan.edit', compact('pelatihan'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelatihan $pelatihan)
    {
        $validated = $request->validate([
            'nama_pelatihan' => 'required|string|max:255',
            'tema' => 'required|string|max:255',
            'jenis_pelatihan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tempat' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'target_peserta' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $pelatihan->update($validated);

        return redirect()->route('pelatihan.index')->with('success', 'Data pelatihan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelatihan $pelatihan)
    {
        $pelatihan->delete();

        return redirect()->route('pelatihan.index')->with('success', 'Data pelatihan berhasil dihapus!');

    }
}
