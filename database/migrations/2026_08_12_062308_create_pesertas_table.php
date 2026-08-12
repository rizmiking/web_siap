<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelatihan_id')->constrained('pelatihans')->onDelete('cascade');
            $table->string('nama');
            $table->string('nik_nim');
            $table->string('no_hp');
            $table->string('email');
            $table->string('instansi');
            $table->string('status')->default('Terdaftar'); // Contoh: Terdaftar, Lulus, Tidak Lulus, Hadir
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
