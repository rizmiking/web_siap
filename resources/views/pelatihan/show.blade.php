@extends('layouts.app')

@section('title', 'Detail Pelatihan')
@section('header', $pelatihan->nama_pelatihan)

@section('content')
<div class="mb-4">
    <a href="{{ route('pelatihan.index') }}" class="text-sm text-blue-600 hover:underline">&larr; Kembali ke daftar pelatihan</a>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 max-w-4xl">
    <div class="flex justify-between items-start border-b border-slate-100 pb-4 mb-6">
        <div>
            <span class="inline-block px-2.5 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-md mb-2">{{ $pelatihan->jenis_pelatihan }}</span>
            <h2 class="text-xl font-bold text-slate-800">{{ $pelatihan->nama_pelatihan }}</h2>
            <p class="text-sm text-slate-500 mt-1">Tema: {{ $pelatihan->tema }}</p>
        </div>
        <span class="px-3 py-1 text-xs font-semibold rounded-full 
            {{ $pelatihan->status == 'Selesai' ? 'bg-emerald-100 text-emerald-800' : ($pelatihan->status == 'Berjalan' ? 'bg-blue-100 text-blue-800' : 'bg-amber-100 text-amber-800') }}">
            {{ $pelatihan->status }}
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
        <div>
            <p class="text-slate-400 font-medium text-xs uppercase mb-1">Tanggal Pelaksanaan</p>
            <p class="text-slate-800 font-semibold">
                {{ \Carbon\Carbon::parse($pelatihan->tanggal_mulai)->format('d F Y') }} - 
                {{ \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->format('d F Y') }}
            </p>
        </div>
        <div>
            <p class="text-slate-400 font-medium text-xs uppercase mb-1">Tempat / Lokasi</p>
            <p class="text-slate-800 font-semibold">{{ $pelatihan->tempat }}</p>
        </div>
        <div>
            <p class="text-slate-400 font-medium text-xs uppercase mb-1">Penyelenggara</p>
            <p class="text-slate-800 font-semibold">{{ $pelatihan->penyelenggara }}</p>
        </div>
        <div>
            <p class="text-slate-400 font-medium text-xs uppercase mb-1">Target Peserta</p>
            <p class="text-slate-800 font-semibold">{{ $pelatihan->target_peserta }} Orang</p>
        </div>
    </div>

    <div class="mt-6 pt-6 border-t border-slate-100">
        <p class="text-slate-400 font-medium text-xs uppercase mb-2">Deskripsi Kegiatan</p>
        <div class="text-sm text-slate-600 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100">
            {{ $pelatihan->deskripsi ?? 'Tidak ada deskripsi.' }}
        </div>
    </div>
</div>
@endsection