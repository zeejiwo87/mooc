<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->increments('id_sertifikat');
            $table->integer('id_pendaftaran')->unsigned();
            $table->string('nomor_sertifikat', 100);
            $table->char('kode_verifikasi', 36);
            $table->string('qr_code_url')->nullable();
            $table->string('pdf_url')->nullable();
            $table->string('nama_penerima');
            $table->string('judul_kelas');
            $table->date('tanggal_selesai');
            $table->boolean('sudah_dicetak')->default(false);
            $table->timestamp('dicetak_pada')->nullable();

            $table->foreign('id_pendaftaran')->references('id_pendaftaran')->on('pendaftaran')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sertifikat');
    }
};
