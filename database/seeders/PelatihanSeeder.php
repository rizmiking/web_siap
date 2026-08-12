<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Pelatihan;
use Illuminate\Database\Seeder;

class PelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID user admin pertama (pembuat data)
        $admin = User::first();

        // Jika belum ada user, hentikan agar tidak error
        if (!$admin) {
            $this->command->info('User belum ada! Jalankan DatabaseSeeder terlebih dahulu.');
            return;
        }

        $dataPelatihan = [
            [
                'user_id' => $admin->id,
                'nama_pelatihan' => 'Pelatihan Web Development Laravel 11',
                'tema' => 'Membangun Aplikasi Web Modern Berbasis Framework',
                'jenis_pelatihan' => 'Workshop Technical',
                'tanggal_mulai' => '2026-09-01',
                'tanggal_selesai' => '2026-09-03',
                'tempat' => 'Lab Komputer Gedung B',
                'penyelenggara' => 'Divisi IT & Pengembangan',
                'target_peserta' => 30,
                'deskripsi' => 'Pelatihan hands-on pembuatan aplikasi web dari tingkat dasar hingga tingkat lanjut menggunakan Laravel 11.',
                'status' => 'Direncanakan',
            ],
            [
                'user_id' => $admin->id,
                'nama_pelatihan' => 'Pelatihan Manajemen Administrasi Organisasi',
                'tema' => 'Digitalisasi Tata Kelola Surat dan Dokumen Organisasi',
                'jenis_pelatihan' => 'Seminar & Training',
                'tanggal_mulai' => '2026-08-10',
                'tanggal_selesai' => '2026-08-11',
                'tempat' => 'Aula Utama Lantai 2',
                'penyelenggara' => 'Sekretariat Organisasi',
                'target_peserta' => 50,
                'deskripsi' => 'Pelatihan pengelolaan dokumen administrasi secara terstruktur untuk meningkatkan efisiensi tata kelola.',
                'status' => 'Berjalan',
            ],
            [
                'user_id' => $admin->id,
                'nama_pelatihan' => 'Workshop Design Graphic & Branding',
                'tema' => 'Visual Communication Strategy for Digital Marketing',
                'jenis_pelatihan' => 'Creative Workshop',
                'tanggal_mulai' => '2026-07-15',
                'tanggal_selesai' => '2026-07-16',
                'tempat' => 'Ruang Multimedia 1',
                'penyelenggara' => 'Divisi Humas & Kreatif',
                'target_peserta' => 25,
                'deskripsi' => 'Pelatihan pembuatan aset visual dan media promosi menggunakan software grafis populer.',
                'status' => 'Selesai',
            ],
        ];

        foreach ($dataPelatihan as $pelatihan) {
            Pelatihan::create($pelatihan);
        }
    }
}
