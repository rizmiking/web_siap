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
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold uppercase text-slate-500">
                            <th class="p-4">Nama Pelatihan</th>
                            <th class="p-4">Jenis & Tema</th>
                            <th class="p-4">Tanggal Execution</th>
                            <th class="p-4">Target</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($pelatihans as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="p-4 font-semibold text-slate-800">
                                    {{ $item->nama_pelatihan }}
                                    <div class="text-xs font-normal text-slate-400">Penyelenggara: {{ $item->penyelenggara }}
                                    </div>
                                </td>
                                <td class="p-4 text-slate-600">
                                    <span
                                        class="inline-block px-2 py-0.5 text-xs bg-slate-100 rounded text-slate-700 font-medium mb-1">{{ $item->jenis_pelatihan }}</span>
                                    <div class="text-xs text-slate-500">{{ $item->tema }}</div>
                                </td>
                                <td class="p-4 text-slate-600 text-xs">
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }} -
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                </td>
                                <td class="p-4 text-slate-600 font-medium">{{ $item->target_peserta }} Peserta</td>
                                <td class="p-4">
                                    <span
                                        class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                            {{ $item->status == 'Selesai' ? 'bg-emerald-100 text-emerald-800' : ($item->status == 'Berjalan' ? 'bg-blue-100 text-blue-800' : 'bg-amber-100 text-amber-800') }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-center space-x-2">
                                    <a href="{{ route('pelatihan.show', $item->id) }}"
                                        class="text-slate-600 hover:text-blue-600 font-medium text-xs">Detail</a>
                                    <button @click="openEdit({{ json_encode($item) }})"
                                        class="text-amber-600 hover:text-amber-700 font-medium text-xs">Edit</button>
                                    <form action="{{ route('pelatihan.destroy', $item->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus pelatihan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-700 font-medium text-xs">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-slate-400">Belum ada data pelatihan. Silakan
                                    tambahkan baru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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