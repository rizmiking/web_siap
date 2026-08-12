<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Administrasi;
use App\Models\Pelatihan;
use Illuminate\Support\Facades\Storage;

class AdministrasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil pelatihan pertama untuk dikaitkan dengan administrasi
        $pelatihan = Pelatihan::first();

        if (!$pelatihan) {
            $this->command->info('Pelatihan belum ada! Jalankan PelatihanSeeder terlebih dahulu.');
            return;
        }

        // Pastikan folder penyimpanan file contoh sudah terbuat di storage
        Storage::disk('public')->makeDirectory('administrasi_files');

        // Buat file PDF/TXT dummy sederhana untuk kebutuhan demo download
        $dummyFileName = 'administrasi_files/sample_proposal.txt';
        Storage::disk('public')->put($dummyFileName, 'Ini adalah isi file dummy proposal kegiatan pelatihan.');

        $dataAdministrasi = [
            [
                'pelatihan_id' => $pelatihan->id,
                'nama' => 'Proposal Kegiatan',
                'jenis' => 'Dokumen Perencanaan',
                'wajib' => true,
                'status' => 'Sudah Diunggah',
                'keterangan' => 'Proposal pengajuan dana kegiatan pelatihan.',
                'file' => $dummyFileName,
            ],
            [
                'pelatihan_id' => $pelatihan->id,
                'nama' => 'Rencana Anggaran Biaya (RAB)',
                'jenis' => 'Dokumen Keuangan',
                'wajib' => true,
                'status' => 'Sudah Diunggah',
                'keterangan' => 'Rincian alokasi anggaran operasional pelatihan.',
                'file' => $dummyFileName,
            ],
            [
                'pelatihan_id' => $pelatihan->id,
                'nama' => 'Surat Tugas Panitia',
                'jenis' => 'Dokumen Legalitas',
                'wajib' => true,
                'status' => 'Belum Ada',
                'keterangan' => 'Menunggu tanda tangan dari pimpinan.',
                'file' => null,
            ],
            [
                'pelatihan_id' => $pelatihan->id,
                'nama' => 'Laporan Pertanggungjawaban (LPJ)',
                'jenis' => 'Dokumen Pelaporan',
                'wajib' => false,
                'status' => 'Belum Ada',
                'keterangan' => 'Disusun setelah kegiatan selesai dilaksanakan.',
                'file' => null,
            ],
        ];

        foreach ($dataAdministrasi as $administrasi) {
            Administrasi::create($administrasi);
        }
    }
}
