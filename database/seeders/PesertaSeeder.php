<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelatihan;
use App\Models\Peserta;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil pelatihan pertama untuk dikaitkan dengan peserta
        $pelatihan = Pelatihan::first();

        if (!$pelatihan) {
            $this->command->info('Pelatihan belum ada! Jalankan PelatihanSeeder terlebih dahulu.');
            return;
        }

        $dataPeserta = [
            [
                'pelatihan_id' => $pelatihan->id,
                'nama'         => 'Ahmad Fauzi',
                'nik_nim'      => '3273011203980001',
                'no_hp'        => '081234567890',
                'email'        => 'ahmad.fauzi@example.com',
                'instansi'     => 'Universitas Komputer Indonesia',
                'status'       => 'Hadir',
            ],
            [
                'pelatihan_id' => $pelatihan->id,
                'nama'         => 'Siti Rahmawati',
                'nik_nim'      => '3273015507990002',
                'no_hp'        => '082198765432',
                'email'        => 'siti.rahma@example.com',
                'instansi'     => 'Dinas Pendidikan Kota Bandung',
                'status'       => 'Lulus',
            ],
            [
                'pelatihan_id' => $pelatihan->id,
                'nama'         => 'Budi Santoso',
                'nik_nim'      => '3273012210970003',
                'no_hp'        => '085712344321',
                'email'        => 'budi.santoso@example.com',
                'instansi'     => 'PT Teknologi Nusatama',
                'status'       => 'Terdaftar',
            ],
        ];

        foreach ($dataPeserta as $peserta) {
            Peserta::create($peserta);
        }
    }
}
