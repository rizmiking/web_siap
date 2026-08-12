@extends('layouts.app')

@section('title', 'Kelola Pelatihan')
@section('header', 'Daftar Kegiatan Pelatihan')

@section('content')
    <div x-data="{ 
                    showCreateModal: false, 
                    showEditModal: false,
                    editData: {
                        id: '',
                        nama_pelatihan: '',
                        tema: '',
                        jenis_pelatihan: '',
                        tanggal_mulai: '',
                        tanggal_selesai: '',
                        tempat: '',
                        penyelenggara: '',
                        target_peserta: '',
                        status: '',
                        deskripsi: ''
                    },
                    openEdit(item) {
                        this.editData = JSON.parse(JSON.stringify(item));
                        this.showEditModal = true;
                    }
                }">

        <!-- Header Section -->
        <div class="mb-4 flex justify-between items-center">
            <p class="text-sm text-slate-500">Kelola dan pantau seluruh kegiatan pelatihan[cite: 1].</p>
            <button @click="showCreateModal = true"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition shadow-sm">
                + Tambah Pelatihan
            </button>
        </div>

        <!-- Table Section -->
        <!-- ==================== PELATIHAN CARDS ==================== -->
        <div class="mb-6">

            <!-- Section Header -->
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-base font-bold text-slate-800">
                        Semua Kegiatan
                    </h3>
                    <p class="text-xs text-slate-500 mt-1">
                        Pilih kegiatan untuk mengelola dokumen, peserta, dan detail pelatihan.
                    </p>
                </div>

                <div class="px-3 py-1.5 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">
                    {{ $pelatihans->count() }} Pelatihan
                </div>
            </div>


            @if($pelatihans->count() > 0)

                <!-- Card Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

                    @foreach ($pelatihans as $item)

                        <div class="group bg-white rounded-2xl border border-slate-200
                                        hover:border-blue-200 hover:shadow-xl
                                        transition-all duration-300 overflow-hidden">

                            <!-- Card Header -->
                            <div class="p-5">

                                <div class="flex items-start justify-between gap-3">

                                    <!-- Icon -->
                                    <div class="w-12 h-12 rounded-xl bg-blue-50
                                                    flex items-center justify-center
                                                    text-blue-600 flex-shrink-0">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>

                                    </div>


                                    <!-- Status -->
                                    @if($item->status == 'Selesai')

                                        <span class="inline-flex items-center gap-1.5
                                                             px-2.5 py-1 rounded-full
                                                             bg-emerald-50 text-emerald-700
                                                             text-[10px] font-bold">

                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                            Selesai

                                        </span>

                                    @elseif($item->status == 'Berjalan')

                                        <span class="inline-flex items-center gap-1.5
                                                             px-2.5 py-1 rounded-full
                                                             bg-blue-50 text-blue-700
                                                             text-[10px] font-bold">

                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>

                                            Berjalan

                                        </span>

                                    @elseif($item->status == 'Dibatalkan')

                                        <span class="inline-flex items-center gap-1.5
                                                             px-2.5 py-1 rounded-full
                                                             bg-red-50 text-red-700
                                                             text-[10px] font-bold">

                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>

                                            Dibatalkan

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5
                                                             px-2.5 py-1 rounded-full
                                                             bg-amber-50 text-amber-700
                                                             text-[10px] font-bold">

                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                                            Direncanakan

                                        </span>

                                    @endif

                                </div>


                                <!-- Title -->
                                <div class="mt-4">

                                    <h3 class="font-bold text-slate-800 text-base leading-6">
                                        {{ $item->nama_pelatihan }}
                                    </h3>

                                    <p class="text-xs text-slate-400 mt-1">
                                        Penyelenggara: {{ $item->penyelenggara }}
                                    </p>

                                </div>


                                <!-- Jenis & Tema -->
                                <div class="mt-4">

                                    <span class="inline-flex px-2.5 py-1
                                                     rounded-lg bg-slate-100
                                                     text-slate-600 text-[10px]
                                                     font-semibold">

                                        {{ $item->jenis_pelatihan }}

                                    </span>

                                    <p class="text-xs text-slate-500 mt-2 line-clamp-2">
                                        {{ $item->tema }}
                                    </p>

                                </div>


                                <!-- Information -->
                                <div class="mt-5 space-y-3">

                                    <!-- Date -->
                                    <div class="flex items-center gap-3">

                                        <div class="w-8 h-8 rounded-lg bg-slate-50
                                                        flex items-center justify-center
                                                        text-slate-500">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />

                                            </svg>

                                        </div>

                                        <div>
                                            <p class="text-[9px] uppercase font-semibold text-slate-400">
                                                Tanggal
                                            </p>

                                            <p class="text-xs font-semibold text-slate-700">
                                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}

                                                @if($item->tanggal_mulai != $item->tanggal_selesai)
                                                    -
                                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                                @endif
                                            </p>
                                        </div>

                                    </div>


                                    <!-- Location -->
                                    <div class="flex items-center gap-3">

                                        <div class="w-8 h-8 rounded-lg bg-slate-50
                                                        flex items-center justify-center
                                                        text-slate-500">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M17.657 16.657L13.414 21l-4.243-4.343a8 8 0 1111.314 0z" />

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />

                                            </svg>

                                        </div>

                                        <div>
                                            <p class="text-[9px] uppercase font-semibold text-slate-400">
                                                Lokasi
                                            </p>

                                            <p class="text-xs font-semibold text-slate-700">
                                                {{ $item->tempat }}
                                            </p>
                                        </div>

                                    </div>


                                    <!-- Target -->
                                    <div class="flex items-center gap-3">

                                        <div class="w-8 h-8 rounded-lg bg-slate-50
                                                        flex items-center justify-center
                                                        text-slate-500">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                    d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 110 8 4 4 0 000-8zm6 4a3 3 0 100-6 3 3 0 000 6z" />

                                            </svg>

                                        </div>

                                        <div>
                                            <p class="text-[9px] uppercase font-semibold text-slate-400">
                                                Target Peserta
                                            </p>

                                            <p class="text-xs font-semibold text-slate-700">
                                                {{ $item->target_peserta }} Peserta
                                            </p>
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- Action Area -->
                            <div class="border-t border-slate-100 bg-slate-50">

                                <!-- Main Actions -->
                                <div class="grid grid-cols-2 divide-x divide-slate-200">

                                    <a href="{{ route('pelatihan.administrasi.index', $item->id) }}" class="py-3 flex items-center justify-center gap-2
                                                  text-xs font-semibold text-blue-600
                                                  hover:bg-blue-50 transition">

                                        <span>📁</span>
                                        Dokumen

                                    </a>


                                    <a href="{{ route('pelatihan.peserta.index', $item->id) }}" class="py-3 flex items-center justify-center gap-2
                                                  text-xs font-semibold text-emerald-600
                                                  hover:bg-emerald-50 transition">

                                        <span>👥</span>
                                        Peserta

                                    </a>

                                </div>


                                <!-- Secondary Actions -->
                                <div class="px-4 py-2.5 flex items-center justify-between
                                                border-t border-slate-200">

                                    <a href="{{ route('pelatihan.show', $item->id) }}" class="text-[11px] font-semibold text-slate-500
                                                  hover:text-blue-600 transition">

                                        Detail →

                                    </a>


                                    <div class="flex items-center gap-3">

                                        <button @click="openEdit({{ json_encode($item) }})" class="text-[11px] font-semibold text-amber-600
                                                       hover:text-amber-700 transition">

                                            Edit

                                        </button>


                                        <form action="{{ route('pelatihan.destroy', $item->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Yakin ingin menghapus pelatihan ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="text-[11px] font-semibold text-red-500
                                                           hover:text-red-700 transition">

                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <!-- Empty State -->
                <div class="bg-white rounded-2xl border border-dashed
                            border-slate-300 p-12 text-center">

                    <div class="mx-auto w-16 h-16 rounded-2xl bg-blue-50
                                flex items-center justify-center
                                text-blue-500 mb-4">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />

                        </svg>

                    </div>

                    <h3 class="font-bold text-slate-700 text-sm">
                        Belum Ada Pelatihan
                    </h3>

                    <p class="text-xs text-slate-400 mt-1">
                        Belum ada kegiatan pelatihan yang ditambahkan.
                    </p>

                    <button @click="showCreateModal = true" class="mt-5 px-4 py-2 bg-blue-600
                               hover:bg-blue-700 text-white
                               rounded-lg text-xs font-semibold transition">

                        + Tambah Pelatihan

                    </button>

                </div>

            @endif

        </div>

        <!-- ==================== MODAL TAMBAH PELATIHAN ==================== -->
        <div x-show="showCreateModal" x-cloak
            class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">

            <div @click.away="showCreateModal = false"
                class="bg-white rounded-2xl max-w-2xl w-full p-6 shadow-xl border border-slate-100 transform transition-all">

                <div class="flex justify-between items-center border-b border-slate-100 pb-3 mb-4">
                    <h3 class="text-lg font-bold text-slate-800">Tambah Pelatihan Baru</h3>
                    <button @click="showCreateModal = false"
                        class="text-slate-400 hover:text-slate-600 text-lg font-bold">&times;</button>
                </div>

                <form action="{{ route('pelatihan.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Pelatihan</label>
                        <input type="text" name="nama_pelatihan" required
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Tema Pelatihan</label>
                            <input type="text" name="tema" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Jenis Pelatihan</label>
                            <input type="text" name="jenis_pelatihan" placeholder="cth: Workshop / Seminar" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Tempat / Lokasi</label>
                            <input type="text" name="tempat" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Penyelenggara</label>
                            <input type="text" name="penyelenggara" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Target Peserta</label>
                            <input type="number" name="target_peserta" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Status Kegiatan</label>
                        <select name="status"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                            <option value="Direncanakan">Direncanakan</option>
                            <option value="Berjalan">Berjalan</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Dibatalkan">Dibatalkan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Deskripsi Kegiatan</label>
                        <textarea name="deskripsi" rows="3"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="pt-3 flex justify-end space-x-2 border-t border-slate-100">
                        <button type="button" @click="showCreateModal = false"
                            class="px-4 py-2 bg-slate-100 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-200">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan
                            Data</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ==================== MODAL EDIT PELATIHAN ==================== -->
        <div x-show="showEditModal" x-cloak
            class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">

            <div @click.away="showEditModal = false"
                class="bg-white rounded-2xl max-w-2xl w-full p-6 shadow-xl border border-slate-100 transform transition-all">

                <div class="flex justify-between items-center border-b border-slate-100 pb-3 mb-4">
                    <h3 class="text-lg font-bold text-slate-800">Edit Data Pelatihan</h3>
                    <button @click="showEditModal = false"
                        class="text-slate-400 hover:text-slate-600 text-lg font-bold">&times;</button>
                </div>

                <form :action="'/pelatihan/' + editData.id" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Pelatihan</label>
                        <input type="text" name="nama_pelatihan" x-model="editData.nama_pelatihan" required
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Tema Pelatihan</label>
                            <input type="text" name="tema" x-model="editData.tema" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Jenis Pelatihan</label>
                            <input type="text" name="jenis_pelatihan" x-model="editData.jenis_pelatihan" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" x-model="editData.tanggal_mulai" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" x-model="editData.tanggal_selesai" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Tempat / Lokasi</label>
                            <input type="text" name="tempat" x-model="editData.tempat" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Penyelenggara</label>
                            <input type="text" name="penyelenggara" x-model="editData.penyelenggara" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Target Peserta</label>
                            <input type="number" name="target_peserta" x-model="editData.target_peserta" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Status Kegiatan</label>
                        <select name="status" x-model="editData.status"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                            <option value="Direncanakan">Direncanakan</option>
                            <option value="Berjalan">Berjalan</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Dibatalkan">Dibatalkan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Deskripsi Kegiatan</label>
                        <textarea name="deskripsi" x-model="editData.deskripsi" rows="3"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500"></textarea>
                    </div>

                    <div class="pt-3 flex justify-end space-x-2 border-t border-slate-100">
                        <button type="button" @click="showEditModal = false"
                            class="px-4 py-2 bg-slate-100 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-200">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-amber-600 text-white rounded-lg text-sm font-semibold hover:bg-amber-700">Update
                            Data</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Style khusus Alpine.js agar elemen modal tidak berkedip saat pertama di-load -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
@endsection