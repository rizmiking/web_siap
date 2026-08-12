<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrasi;
use App\Models\Panitia;
use App\Models\Pelatihan;
use App\Models\Peserta;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // 1. Ringkasan Statistik Utama
        $totalPelatihan = Pelatihan::count();
        $dokumenPending = Administrasi::where('status', 'Belum Ada')->count();
        $totalPeserta = Peserta::count();
        $totalPanitia = 0;
       // $totalPanitia = Panitia::count();

        // 2. Data Pelatihan Terbaru untuk Widget Ringkasan
        $pelatihanTerbaru = Pelatihan::withCount(['pesertas', 'administrasis'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalPelatihan',
            'dokumenPending',
            'totalPeserta',
            'totalPanitia',
            'pelatihanTerbaru'
        ));
    }
}
