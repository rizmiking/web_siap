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
            <a href="{{ route('pelatihan.index') }}" class="text-xs text-blue-600 font-medium hover:underline">&larr; Kembali ke Daftar Pelatihan</a>
            <h2 class="text-xl font-bold text-slate-800 mt-1">{{ $pelatihan->nama_pelatihan }}</h2>
            <p class="text-xs text-slate-500">Kelola berkas dan persyaratan administrasi secara dinamis untuk kegiatan ini.</p>
        </div>
        
        <button @click="showCreateModal = true" 
           class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition shadow-sm self-start md:self-auto">
            + Tambah Kebutuhan Dokumen
        </button>
    </div>

    <!-- Table Dokumen Administrasi -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold uppercase text-slate-500">
                        <th class="p-4">Nama Dokumen</th>
                        <th class="p-4">Jenis</th>
                        <th class="p-4">Sifat</th>
                        <th class="p-4">Status & File</th>
                        <th class="p-4">Keterangan</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse ($administrasis as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="p-4 font-semibold text-slate-800">{{ $item->nama }}</td>
                            <td class="p-4 text-slate-600"><span class="px-2 py-0.5 text-xs bg-slate-100 rounded text-slate-700 font-medium">{{ $item->jenis }}</span></td>
                            <td class="p-4">
                                @if($item->wajib)
                                    <span class="px-2 py-0.5 text-xs font-semibold bg-rose-100 text-rose-700 rounded">Wajib</span>
                                @else
                                    <span class="px-2 py-0.5 text-xs font-semibold bg-slate-100 text-slate-600 rounded">Opsional</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <div class="flex items-center space-x-2">
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                        {{ $item->status == 'Sudah Diunggah' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ $item->status }}
                                    </span>
                                    @if ($item->file)
                                        <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="text-xs text-blue-600 hover:underline font-medium">
                                            [ Unduh File ]
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4 text-slate-500 text-xs">{{ $item->keterangan ?? '-' }}</td>
                            <td class="p-4 text-center space-x-2">
                                <button @click="openEdit({{ json_encode($item) }})" class="text-amber-600 hover:text-amber-700 font-medium text-xs">Edit / Upload</button>
                                <form action="{{ route('administrasi.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus dokumen administrasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700 font-medium text-xs">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-400">Belum ada dokumen administrasi yang ditentukan. Silakan tambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ==================== MODAL TAMBAH ADMINISTRASI ==================== -->
    <div x-show="showCreateModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div @click.away="showCreateModal = false" class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-100">
            <div class="flex justify-between items-center border-b border-slate-100 pb-3 mb-4">
                <h3 class="text-lg font-bold text-slate-800">Tambah Syarat Administrasi</h3>
                <button @click="showCreateModal = false" class="text-slate-400 hover:text-slate-600 text-lg font-bold">&times;</button>
            </div>

            <form action="{{ route('pelatihan.administrasi.store', $pelatihan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Dokumen</label>
                    <input type="text" name="nama" placeholder="cth: Proposal Kegiatan / RAB / TOR" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Jenis Dokumen</label>
                        <input type="text" name="jenis" placeholder="cth: Perencanaan / Laporan" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Sifat Dokumen</label>
                        <select name="wajib" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                            <option value="1">Wajib</option>
                            <option value="0">Opsional</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Unggah Berkas (Opsional saat ini)</label>
                    <input type="file" name="file" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <span class="text-[10px] text-slate-400">Format: PDF, DOCX, XLSX, ZIP (Maks 5MB)</span>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Keterangan / Catatan</label>
                    <textarea name="keterangan" rows="2" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div class="pt-3 flex justify-end space-x-2 border-t border-slate-100">
                    <button type="button" @click="showCreateModal = false" class="px-4 py-2 bg-slate-100 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-200">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan Dokumen</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== MODAL EDIT ADMINISTRASI ==================== -->
    <div x-show="showEditModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div @click.away="showEditModal = false" class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-slate-100">
            <div class="flex justify-between items-center border-b border-slate-100 pb-3 mb-4">
                <h3 class="text-lg font-bold text-slate-800">Edit / Unggah Berkas Administrasi</h3>
                <button @click="showEditModal = false" class="text-slate-400 hover:text-slate-600 text-lg font-bold">&times;</button>
            </div>

            <form :action="'/administrasi/' + editData.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Nama Dokumen</label>
                    <input type="text" name="nama" x-model="editData.nama" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Jenis Dokumen</label>
                        <input type="text" name="jenis" x-model="editData.jenis" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Sifat Dokumen</label>
                        <select name="wajib" x-model="editData.wajib" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                            <option value="1">Wajib</option>
                            <option value="0">Opsional</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Status Dokumen</label>
                    <select name="status" x-model="editData.status" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500">
                        <option value="Belum Ada">Belum Ada</option>
                        <option value="Sudah Diunggah">Sudah Diunggah</option>
                        <option value="Diverifikasi">Diverifikasi</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Ganti / Unggah Berkas</label>
                    <input type="file" name="file" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                    <span class="text-[10px] text-slate-400">Biarkan kosong jika tidak ingin mengganti file.</span>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Keterangan / Catatan</label>
                    <textarea name="keterangan" x-model="editData.keterangan" rows="2" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500"></textarea>
                </div>

                <div class="pt-3 flex justify-end space-x-2 border-t border-slate-100">
                    <button type="button" @click="showEditModal = false" class="px-4 py-2 bg-slate-100 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-200">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-amber-600 text-white rounded-lg text-sm font-semibold hover:bg-amber-700">Update Dokumen</button>
                </div>
            </form>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection