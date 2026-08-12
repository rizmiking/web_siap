@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard Utama')

@section('content')
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <h2 class="text-lg font-semibold text-slate-800 mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p class="text-slate-600 text-sm leading-relaxed mb-6">
            Anda masuk ke dalam Sistem Informasi Administrasi Pelatihan (SIAP). Gunakan menu navigasi di sebelah kiri untuk
            mengelola data pelatihan, dokumen administrasi, data peserta, dan panitia.
        </p>

        <!-- Ringkasan Singkat / Stats Card (Opsional) -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
            <div class="p-4 bg-blue-50 border border-blue-100 rounded-xl">
                <span class="text-xs font-semibold text-blue-600 uppercase">Total Pelatihan</span>
                <p class="text-2xl font-bold text-slate-800 mt-1">0</p>
            </div>
            <div class="p-4 bg-amber-50 border border-amber-100 rounded-xl">
                <span class="text-xs font-semibold text-amber-600 uppercase">Dokumen Pending</span>
                <p class="text-2xl font-bold text-slate-800 mt-1">0</p>
            </div>
            <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-xl">
                <span class="text-xs font-semibold text-emerald-600 uppercase">Total Peserta</span>
                <p class="text-2xl font-bold text-slate-800 mt-1">0</p>
            </div>
            <div class="p-4 bg-purple-50 border border-purple-100 rounded-xl">
                <span class="text-xs font-semibold text-purple-600 uppercase">Total Panitia</span>
                <p class="text-2xl font-bold text-slate-800 mt-1">0</p>
            </div>
        </div>
    </div>
@endsection