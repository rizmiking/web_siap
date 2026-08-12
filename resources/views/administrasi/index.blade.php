@extends('layouts.app')

@section('title', 'Kelola Administrasi')
@section('header', 'Administrasi Pelatihan')

@section('content')
    <div x-data="{ 
        showCreateModal: false, 
        showEditModal: false,
        editData: {
            id: '',
            nama: '',
            jenis: '',
            wajib: '1',
            status: '',
            keterangan: '',
            file: ''
        },
        openEdit(item) {
            this.editData = JSON.parse(JSON.stringify(item));
            this.showEditModal = true;
        }
    }">

        <!-- Back Button & Header -->
        <div class="mb-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <a href="{{ route('pelatihan.index') }}" class="text-xs text-blue-600 font-medium hover:underline">&larr;
                    Kembali ke Daftar Pelatihan</a>
                <h2 class="text-xl font-bold text-slate-800 mt-1">{{ $pelatihan->nama_pelatihan }}</h2>
                <p class="text-xs text-slate-500">Kelola berkas dan persyaratan administrasi secara dinamis untuk kegiatan
                    ini.</p>
            </div>

            <button @click="showCreateModal = true"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition shadow-sm self-start md:self-auto">
                + Tambah Kebutuhan Dokumen
            </button>
        </div>

        <!-- Table Dokumen Administrasi -->
        <!-- ==================== DOKUMEN ADMINISTRASI ==================== -->
        <div class="mb-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-800">
                        Dokumen Administrasi
                    </h3>
                    <p class="text-xs text-slate-500 mt-1">
                        Kelola seluruh dokumen dan persyaratan administrasi pelatihan.
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <span class="px-3 py-1.5 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">
                        {{ $administrasis->count() }} Dokumen
                    </span>
                </div>
            </div>

            @if($administrasis->count() > 0)

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

                    @foreach ($administrasis as $item)

                        <div class="group bg-white rounded-2xl border border-slate-200 
                                        hover:border-blue-200 hover:shadow-lg 
                                        transition-all duration-300 overflow-hidden">

                            <!-- Top Card -->
                            <div class="p-5">

                                <div class="flex items-start justify-between gap-3">

                                    <!-- Icon -->
                                    <div class="w-11 h-11 rounded-xl bg-blue-50 
                                                    flex items-center justify-center 
                                                    text-blue-600 flex-shrink-0">

                                        @if(str_contains(strtolower($item->jenis), 'keuangan'))
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-10v1m0 10v1m9-6a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @elseif(str_contains(strtolower($item->nama), 'proposal'))
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0119 9v10a2 2 0 01-2 2z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 3h8l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                            </svg>
                                        @endif

                                    </div>

                                    <!-- Wajib -->
                                    <div>
                                        @if($item->wajib)
                                            <span class="inline-flex items-center gap-1 
                                                                 px-2.5 py-1 rounded-full 
                                                                 bg-rose-50 text-rose-600 
                                                                 text-[10px] font-bold uppercase">

                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                Wajib
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 
                                                                 px-2.5 py-1 rounded-full 
                                                                 bg-slate-100 text-slate-500 
                                                                 text-[10px] font-bold uppercase">

                                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                                Opsional
                                            </span>
                                        @endif
                                    </div>

                                </div>


                                <!-- Nama & Jenis -->
                                <div class="mt-4">

                                    <h4 class="font-bold text-slate-800 text-sm leading-5">
                                        {{ $item->nama }}
                                    </h4>

                                    <div class="mt-2">
                                        <span class="inline-flex px-2 py-1 
                                                         rounded-md bg-slate-100 
                                                         text-slate-600 text-[10px] 
                                                         font-medium">
                                            {{ $item->jenis }}
                                        </span>
                                    </div>

                                </div>


                                <!-- Status -->
                                <div class="mt-5 p-3 rounded-xl 
                                                {{ $item->status == 'Sudah Diunggah'
                        ? 'bg-emerald-50 border border-emerald-100'
                        : ($item->status == 'Diverifikasi'
                            ? 'bg-blue-50 border border-blue-100'
                            : 'bg-amber-50 border border-amber-100') }}">

                                    <div class="flex items-center justify-between">

                                        <div class="flex items-center gap-2">

                                            @if($item->status == 'Sudah Diunggah')

                                                <div class="w-7 h-7 rounded-lg bg-emerald-100 
                                                                    text-emerald-600 flex items-center justify-center">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M5 13l4 4L19 7" />
                                                    </svg>

                                                </div>

                                            @elseif($item->status == 'Diverifikasi')

                                                <div class="w-7 h-7 rounded-lg bg-blue-100 
                                                                    text-blue-600 flex items-center justify-center">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>

                                                </div>

                                            @else

                                                <div class="w-7 h-7 rounded-lg bg-amber-100 
                                                                    text-amber-600 flex items-center justify-center">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>

                                                </div>

                                            @endif


                                            <div>
                                                <p class="text-[9px] uppercase font-semibold 
                                                              text-slate-400">
                                                    Status
                                                </p>

                                                <p class="text-xs font-bold 
                                                        {{ $item->status == 'Sudah Diunggah'
                        ? 'text-emerald-700'
                        : ($item->status == 'Diverifikasi'
                            ? 'text-blue-700'
                            : 'text-amber-700') }}">

                                                    {{ $item->status }}

                                                </p>
                                            </div>

                                        </div>


                                        @if($item->file)

                                            <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="text-xs font-semibold text-blue-600 
                                                              hover:text-blue-700 hover:underline">

                                                Lihat File →

                                            </a>

                                        @endif

                                    </div>

                                </div>


                                <!-- Keterangan -->
                                <div class="mt-4 min-h-[42px]">

                                    <p class="text-[10px] uppercase font-semibold 
                                                  text-slate-400 mb-1">
                                        Keterangan
                                    </p>

                                    <p class="text-xs text-slate-500 leading-relaxed">
                                        {{ $item->keterangan ?? 'Tidak ada keterangan.' }}
                                    </p>

                                </div>

                            </div>


                            <!-- Footer Action -->
                            <div class="px-5 py-3 bg-slate-50 border-t border-slate-100 
                                            flex items-center justify-between">

                                <button @click="openEdit({{ json_encode($item) }})" class="inline-flex items-center gap-1.5 
                                               text-xs font-semibold text-amber-600 
                                               hover:text-amber-700 transition">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 013 3L12 14l-4 1 1-4 7.5-7.5z" />

                                    </svg>

                                    Edit / Upload

                                </button>


                                <form action="{{ route('administrasi.destroy', $item->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus dokumen administrasi ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="inline-flex items-center gap-1.5 
                                                   text-xs font-semibold text-red-500 
                                                   hover:text-red-700 transition">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m-4 0h14" />

                                        </svg>

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <!-- Empty State -->
                <div class="bg-white rounded-2xl border border-dashed 
                            border-slate-300 p-12 text-center">

                    <div class="mx-auto w-16 h-16 rounded-2xl bg-blue-50 
                                flex items-center justify-center text-blue-500 mb-4">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0119 9v10a2 2 0 01-2 2z" />

                        </svg>

                    </div>

                    <h3 class="font-bold text-slate-700 text-sm">
                        Belum Ada Dokumen
                    </h3>

                    <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">
                        Belum ada dokumen administrasi yang ditentukan untuk
                        pelatihan ini.
                    </p>

                    <button @click="showCreateModal = true" class="mt-5 px-4 py-2 bg-blue-600 
                               hover:bg-blue-700 text-white 
                               rounded-lg text-xs font-semibold 
                               transition">

                        + Tambah Dokumen

                    </button>

                </div>

            @endif

        </div>

        <!-- ==================== MODAL TAMBAH ADMINISTRASI ==================== -->
        <div x-show="showCreateModal" x-cloak
            class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.away="showCreateModal = false"
                class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-100">
                <div class="flex justify-between items-center border-b border-slate-100 pb-3 mb-4">
                    <h3 class="text-lg font-bold text-slate-800">Tambah Syarat Administrasi</h3>
                    <button @click="showCreateModal = false"
                        class="text-slate-400 hover:text-slate-600 text-lg font-bold">&times;</button>
                </div>

                <form action="{{ route('pelatihan.administrasi.store', $pelatihan->id) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Dokumen</label>
                        <input type="text" name="nama" placeholder="cth: Proposal Kegiatan / RAB / TOR" required
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Jenis Dokumen</label>
                            <input type="text" name="jenis" placeholder="cth: Perencanaan / Laporan" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Sifat Dokumen</label>
                            <select name="wajib"
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                                <option value="1">Wajib</option>
                                <option value="0">Opsional</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Unggah Berkas (Opsional saat
                            ini)</label>
                        <input type="file" name="file"
                            class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <span class="text-[10px] text-slate-400">Format: PDF, DOCX, XLSX, ZIP (Maks 5MB)</span>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Keterangan / Catatan</label>
                        <textarea name="keterangan" rows="2"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="pt-3 flex justify-end space-x-2 border-t border-slate-100">
                        <button type="button" @click="showCreateModal = false"
                            class="px-4 py-2 bg-slate-100 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-200">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan
                            Dokumen</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ==================== MODAL EDIT ADMINISTRASI ==================== -->
        <div x-show="showEditModal" x-cloak
            class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.away="showEditModal = false"
                class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-100">
                <div class="flex justify-between items-center border-b border-slate-100 pb-3 mb-4">
                    <h3 class="text-lg font-bold text-slate-800">Edit / Unggah Berkas Administrasi</h3>
                    <button @click="showEditModal = false"
                        class="text-slate-400 hover:text-slate-600 text-lg font-bold">&times;</button>
                </div>

                <form :action="'/administrasi/' + editData.id" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Dokumen</label>
                        <input type="text" name="nama" x-model="editData.nama" required
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Jenis Dokumen</label>
                            <input type="text" name="jenis" x-model="editData.jenis" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Sifat Dokumen</label>
                            <select name="wajib" x-model="editData.wajib"
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                                <option value="1">Wajib</option>
                                <option value="0">Opsional</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Status Dokumen</label>
                        <select name="status" x-model="editData.status"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                            <option value="Belum Ada">Belum Ada</option>
                            <option value="Sudah Diunggah">Sudah Diunggah</option>
                            <option value="Diverifikasi">Diverifikasi</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Ganti / Unggah Berkas</label>
                        <input type="file" name="file"
                            class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                        <span class="text-[10px] text-slate-400">Biarkan kosong jika tidak ingin mengganti file.</span>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Keterangan / Catatan</label>
                        <textarea name="keterangan" x-model="editData.keterangan" rows="2"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500"></textarea>
                    </div>

                    <div class="pt-3 flex justify-end space-x-2 border-t border-slate-100">
                        <button type="button" @click="showEditModal = false"
                            class="px-4 py-2 bg-slate-100 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-200">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-amber-600 text-white rounded-lg text-sm font-semibold hover:bg-amber-700">Update
                            Dokumen</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
@endsection