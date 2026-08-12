@extends('layouts.app')

@section('title', 'Kelola Peserta')
@section('header', 'Data Peserta Pelatihan')

@section('content')
    <div x-data="{ 
        showCreateModal: false, 
        showEditModal: false,
        editData: {
            id: '',
            nama: '',
            nik_nim: '',
            no_hp: '',
            email: '',
            instansi: '',
            status: ''
        },
        openEdit(item) {
            this.editData = JSON.parse(JSON.stringify(item));
            this.showEditModal = true;
        }
    }">

        <!-- Header & Navigation -->
        <div class="mb-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <a href="{{ route('pelatihan.index') }}" class="text-xs text-blue-600 font-medium hover:underline">&larr;
                    Kembali ke Daftar Pelatihan</a>
                <h2 class="text-xl font-bold text-slate-800 mt-1">{{ $pelatihan->nama_pelatihan }}</h2>
                <p class="text-xs text-slate-500">Total Kuota / Target: {{ $pelatihan->target_peserta }} Peserta |
                    Terdaftar: {{ $pesertas->count() }} Orang</p>
            </div>

            <button @click="showCreateModal = true"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition shadow-sm self-start md:self-auto">
                + Tambah Peserta
            </button>
        </div>

        <!-- Table Peserta -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold uppercase text-slate-500">
                            <th class="p-4">Nama Peserta</th>
                            <th class="p-4">NIK / NIM</th>
                            <th class="p-4">Kontak & Email</th>
                            <th class="p-4">Instansi</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($pesertas as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="p-4 font-semibold text-slate-800">{{ $item->nama }}</td>
                                <td class="p-4 text-slate-600 text-xs font-mono">{{ $item->nik_nim }}</td>
                                <td class="p-4 text-xs">
                                    <div class="text-slate-800 font-medium">{{ $item->no_hp }}</div>
                                    <div class="text-slate-400">{{ $item->email }}</div>
                                </td>
                                <td class="p-4 text-slate-600 text-xs">{{ $item->instansi }}</td>
                                <td class="p-4">
                                    <span
                                        class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                            {{ $item->status == 'Lulus' ? 'bg-emerald-100 text-emerald-800' : ($item->status == 'Hadir' ? 'bg-blue-100 text-blue-800' : 'bg-slate-100 text-slate-700') }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-center space-x-2">
                                    <button @click="openEdit({{ json_encode($item) }})"
                                        class="text-amber-600 hover:text-amber-700 font-medium text-xs">Edit</button>
                                    <form action="{{ route('peserta.destroy', $item->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus peserta ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-700 font-medium text-xs">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-slate-400">Belum ada data peserta yang terdaftar.
                                    Silakan tambahkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ==================== MODAL TAMBAH PESERTA ==================== -->
        <div x-show="showCreateModal" x-cloak
            class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.away="showCreateModal = false"
                class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-100">
                <div class="flex justify-between items-center border-b border-slate-100 pb-3 mb-4">
                    <h3 class="text-lg font-bold text-slate-800">Tambah Peserta Baru</h3>
                    <button @click="showCreateModal = false"
                        class="text-slate-400 hover:text-slate-600 text-lg font-bold">&times;</button>
                </div>

                <form action="{{ route('pelatihan.peserta.store', $pelatihan->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" required
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">NIK / NIM</label>
                            <input type="text" name="nik_nim" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">No. HP / WA</label>
                            <input type="text" name="no_hp" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Email</label>
                            <input type="email" name="email" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Instansi / Asal</label>
                            <input type="text" name="instansi" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Status Keikutsertaan</label>
                        <select name="status"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                            <option value="Terdaftar">Terdaftar</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Lulus">Lulus</option>
                            <option value="Tidak Lulus">Tidak Lulus</option>
                        </select>
                    </div>

                    <div class="pt-3 flex justify-end space-x-2 border-t border-slate-100">
                        <button type="button" @click="showCreateModal = false"
                            class="px-4 py-2 bg-slate-100 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-200">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan
                            Peserta</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ==================== MODAL EDIT PESERTA ==================== -->
        <div x-show="showEditModal" x-cloak
            class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div @click.away="showEditModal = false"
                class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-100">
                <div class="flex justify-between items-center border-b border-slate-100 pb-3 mb-4">
                    <h3 class="text-lg font-bold text-slate-800">Edit Data Peserta</h3>
                    <button @click="showEditModal = false"
                        class="text-slate-400 hover:text-slate-600 text-lg font-bold">&times;</button>
                </div>

                <form :action="'/peserta/' + editData.id" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" x-model="editData.nama" required
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">NIK / NIM</label>
                            <input type="text" name="nik_nim" x-model="editData.nik_nim" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">No. HP / WA</label>
                            <input type="text" name="no_hp" x-model="editData.no_hp" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Email</label>
                            <input type="email" name="email" x-model="editData.email" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Instansi / Asal</label>
                            <input type="text" name="instansi" x-model="editData.instansi" required
                                class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Status Keikutsertaan</label>
                        <select name="status" x-model="editData.status"
                            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                            <option value="Terdaftar">Terdaftar</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Lulus">Lulus</option>
                            <option value="Tidak Lulus">Tidak Lulus</option>
                        </select>
                    </div>

                    <div class="pt-3 flex justify-end space-x-2 border-t border-slate-100">
                        <button type="button" @click="showEditModal = false"
                            class="px-4 py-2 bg-slate-100 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-200">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-amber-600 text-white rounded-lg text-sm font-semibold hover:bg-amber-700">Update
                            Peserta</button>
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