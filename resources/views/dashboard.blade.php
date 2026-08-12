@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard Utama')

@section('content')

    <div class="space-y-6">

        <!-- ==================== WELCOME ==================== -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-blue-600 to-indigo-700 rounded-2xl p-6 md:p-7 text-white shadow-lg">

            <!-- Decorative -->
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full"></div>
            <div class="absolute right-20 -bottom-20 w-52 h-52 bg-white/5 rounded-full"></div>

            <div class="relative z-10">

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">

                    <div>
                        <p class="text-blue-100 text-xs font-medium mb-2">
                            SISTEM INFORMASI ADMINISTRASI PELATIHAN
                        </p>

                        <h2 class="text-2xl md:text-3xl font-bold">
                            Selamat Datang, {{ Auth::user()->name }}! 👋
                        </h2>

                        <p class="text-blue-100 text-sm mt-2 max-w-2xl leading-relaxed">
                            Kelola kegiatan pelatihan, administrasi dokumen,
                            peserta, dan panitia melalui satu sistem terintegrasi.
                        </p>
                    </div>


                    <div class="hidden md:flex w-20 h-20 rounded-2xl bg-white/10
                                border border-white/10 items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />

                        </svg>

                    </div>

                </div>

            </div>

        </div>


        <!-- ==================== STATISTICS ==================== -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

            <!-- Pelatihan -->
            <div class="bg-white rounded-2xl border border-slate-200 p-5
                        hover:shadow-md transition">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">
                            Total Pelatihan
                        </p>

                        <p class="text-3xl font-bold text-slate-800 mt-2">
                            {{ $totalPelatihan }}
                        </p>

                        <p class="text-xs text-slate-400 mt-1">
                            Kegiatan terdaftar
                        </p>
                    </div>

                    <div class="w-11 h-11 rounded-xl bg-blue-50
                                flex items-center justify-center text-blue-600">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />

                        </svg>

                    </div>

                </div>

                <div class="mt-4 h-1 bg-blue-100 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-500 rounded-full w-2/3"></div>
                </div>

            </div>


            <!-- Dokumen -->
            <div class="bg-white rounded-2xl border border-slate-200 p-5
                        hover:shadow-md transition">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">
                            Dokumen Pending
                        </p>

                        <p class="text-3xl font-bold text-slate-800 mt-2">
                            {{ $dokumenPending }}
                        </p>

                        <p class="text-xs text-slate-400 mt-1">
                            Perlu ditindaklanjuti
                        </p>
                    </div>

                    <div class="w-11 h-11 rounded-xl bg-amber-50
                                flex items-center justify-center text-amber-600">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />

                        </svg>

                    </div>

                </div>

                <div class="mt-4 h-1 bg-amber-100 rounded-full overflow-hidden">
                    <div class="h-full bg-amber-500 rounded-full w-1/3"></div>
                </div>

            </div>


            <!-- Peserta -->
            <div class="bg-white rounded-2xl border border-slate-200 p-5
                        hover:shadow-md transition">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">
                            Total Peserta
                        </p>

                        <p class="text-3xl font-bold text-slate-800 mt-2">
                            {{ $totalPeserta }}
                        </p>

                        <p class="text-xs text-slate-400 mt-1">
                            Peserta terdaftar
                        </p>
                    </div>

                    <div class="w-11 h-11 rounded-xl bg-emerald-50
                                flex items-center justify-center text-emerald-600">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 110 8 4 4 0 000-8zm6 4a3 3 0 100-6 3 3 0 000 6z" />

                        </svg>

                    </div>

                </div>

                <div class="mt-4 h-1 bg-emerald-100 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 rounded-full w-3/4"></div>
                </div>

            </div>


            <!-- Panitia -->
            <div class="bg-white rounded-2xl border border-slate-200 p-5
                        hover:shadow-md transition">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">
                            Total Panitia
                        </p>

                        <p class="text-3xl font-bold text-slate-800 mt-2">
                            {{ $totalPanitia }}
                        </p>

                        <p class="text-xs text-slate-400 mt-1">
                            Panitia terdaftar
                        </p>
                    </div>

                    <div class="w-11 h-11 rounded-xl bg-purple-50
                                flex items-center justify-center text-purple-600">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 110 8 4 4 0 000-8zm6 4a3 3 0 100-6 3 3 0 000 6z" />

                        </svg>

                    </div>

                </div>

                <div class="mt-4 h-1 bg-purple-100 rounded-full overflow-hidden">
                    <div class="h-full bg-purple-500 rounded-full w-1/2"></div>
                </div>

            </div>

        </div>


        <!-- ==================== MAIN CONTENT ==================== -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            <!-- Pelatihan Terbaru -->
            <div class="xl:col-span-2 bg-white rounded-2xl border
                        border-slate-200 shadow-sm overflow-hidden">

                <div class="p-5 border-b border-slate-100">

                    <div class="flex items-center justify-between">

                        <div>
                            <h3 class="font-bold text-slate-800">
                                Pelatihan Terbaru
                            </h3>

                            <p class="text-xs text-slate-400 mt-1">
                                Kegiatan pelatihan yang baru ditambahkan
                            </p>
                        </div>

                        <a href="{{ route('pelatihan.index') }}" class="text-xs font-semibold text-blue-600
                                  hover:text-blue-700">

                            Lihat Semua →

                        </a>

                    </div>

                </div>


                @forelse($pelatihanTerbaru as $item)

                    <div class="p-5 border-b border-slate-100 last:border-0
                                    hover:bg-slate-50 transition">

                        <div class="flex items-start gap-4">

                            <!-- Icon -->
                            <div class="w-11 h-11 rounded-xl bg-blue-50
                                            flex items-center justify-center
                                            text-blue-600 flex-shrink-0">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />

                                </svg>

                            </div>


                            <!-- Info -->
                            <div class="flex-1 min-w-0">

                                <div class="flex flex-col md:flex-row
                                                md:items-center md:justify-between gap-2">

                                    <div>

                                        <h4 class="text-sm font-bold text-slate-800 truncate">
                                            {{ $item->nama_pelatihan }}
                                        </h4>

                                        <p class="text-xs text-slate-400 mt-1">
                                            {{ $item->penyelenggara }}
                                        </p>

                                    </div>


                                    <!-- Status -->
                                    @if($item->status == 'Selesai')

                                        <span class="self-start px-2.5 py-1
                                                             rounded-full bg-emerald-50
                                                             text-emerald-700 text-[10px]
                                                             font-bold">

                                            ● Selesai

                                        </span>

                                    @elseif($item->status == 'Berjalan')

                                        <span class="self-start px-2.5 py-1
                                                             rounded-full bg-blue-50
                                                             text-blue-700 text-[10px]
                                                             font-bold">

                                            ● Berjalan

                                        </span>

                                    @elseif($item->status == 'Dibatalkan')

                                        <span class="self-start px-2.5 py-1
                                                             rounded-full bg-red-50
                                                             text-red-700 text-[10px]
                                                             font-bold">

                                            ● Dibatalkan

                                        </span>

                                    @else

                                        <span class="self-start px-2.5 py-1
                                                             rounded-full bg-amber-50
                                                             text-amber-700 text-[10px]
                                                             font-bold">

                                            ● Direncanakan

                                        </span>

                                    @endif

                                </div>


                                <!-- Metadata -->
                                <div class="flex flex-wrap gap-x-5 gap-y-2 mt-3">

                                    <span class="text-[11px] text-slate-500">
                                        📅
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                                    </span>

                                    <span class="text-[11px] text-slate-500">
                                        📍 {{ $item->tempat }}
                                    </span>

                                    <span class="text-[11px] text-slate-500">
                                        👥 {{ $item->pesertas_count }} Peserta
                                    </span>

                                    <span class="text-[11px] text-slate-500">
                                        📄 {{ $item->administrasis_count }} Dokumen
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="p-10 text-center">

                        <div class="w-14 h-14 mx-auto rounded-2xl bg-slate-50
                                        flex items-center justify-center text-slate-400">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />

                            </svg>

                        </div>

                        <p class="text-sm font-semibold text-slate-600 mt-3">
                            Belum ada pelatihan
                        </p>

                        <p class="text-xs text-slate-400 mt-1">
                            Tambahkan kegiatan pelatihan pertama kamu.
                        </p>

                    </div>

                @endforelse

            </div>


            <!-- ==================== QUICK ACTION ==================== -->
            <div class="bg-white rounded-2xl border border-slate-200
                        shadow-sm overflow-hidden">

                <div class="p-5 border-b border-slate-100">

                    <h3 class="font-bold text-slate-800">
                        Akses Cepat
                    </h3>

                    <p class="text-xs text-slate-400 mt-1">
                        Menu yang sering digunakan
                    </p>

                </div>


                <div class="p-4 space-y-2">

                    <!-- Tambah Pelatihan -->
                    <a href="{{ route('pelatihan.index') }}" class="flex items-center gap-3 p-3 rounded-xl
                              hover:bg-blue-50 group transition">

                        <div class="w-10 h-10 rounded-xl bg-blue-50
                                    group-hover:bg-blue-100
                                    flex items-center justify-center
                                    text-blue-600">

                            <span class="text-lg">＋</span>

                        </div>

                        <div class="flex-1">

                            <p class="text-xs font-bold text-slate-700">
                                Kelola Pelatihan
                            </p>

                            <p class="text-[10px] text-slate-400">
                                Tambah dan edit kegiatan
                            </p>

                        </div>

                        <span class="text-slate-300 group-hover:text-blue-500">
                            →
                        </span>

                    </a>


                    <!-- Administrasi -->
                    <a href="{{ route('pelatihan.index') }}" class="flex items-center gap-3 p-3 rounded-xl
                              hover:bg-amber-50 group transition">

                        <div class="w-10 h-10 rounded-xl bg-amber-50
                                    group-hover:bg-amber-100
                                    flex items-center justify-center
                                    text-amber-600">

                            <span class="text-lg">📄</span>

                        </div>

                        <div class="flex-1">

                            <p class="text-xs font-bold text-slate-700">
                                Administrasi
                            </p>

                            <p class="text-[10px] text-slate-400">
                                Kelola dokumen pelatihan
                            </p>

                        </div>

                        <span class="text-slate-300 group-hover:text-amber-500">
                            →
                        </span>

                    </a>


                    <!-- Peserta -->
                    <a href="{{ route('pelatihan.index') }}" class="flex items-center gap-3 p-3 rounded-xl
                              hover:bg-emerald-50 group transition">

                        <div class="w-10 h-10 rounded-xl bg-emerald-50
                                    group-hover:bg-emerald-100
                                    flex items-center justify-center
                                    text-emerald-600">

                            <span class="text-lg">👥</span>

                        </div>

                        <div class="flex-1">

                            <p class="text-xs font-bold text-slate-700">
                                Peserta
                            </p>

                            <p class="text-[10px] text-slate-400">
                                Kelola data peserta
                            </p>

                        </div>

                        <span class="text-slate-300 group-hover:text-emerald-500">
                            →
                        </span>

                    </a>


                    <!-- Panitia -->
                    <a href="{{ route('pelatihan.index') }}" class="flex items-center gap-3 p-3 rounded-xl
                              hover:bg-purple-50 group transition">

                        <div class="w-10 h-10 rounded-xl bg-purple-50
                                    group-hover:bg-purple-100
                                    flex items-center justify-center
                                    text-purple-600">

                            <span class="text-lg">👤</span>

                        </div>

                        <div class="flex-1">

                            <p class="text-xs font-bold text-slate-700">
                                Panitia
                            </p>

                            <p class="text-[10px] text-slate-400">
                                Kelola kepanitiaan
                            </p>

                        </div>

                        <span class="text-slate-300 group-hover:text-purple-500">
                            →
                        </span>

                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection