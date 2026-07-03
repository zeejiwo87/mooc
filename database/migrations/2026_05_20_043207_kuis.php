<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kuis', function (Blueprint $table) {
            $table->increments('id_kuis');
            $table->integer('id_materi')->unsigned();
            $table->string('judul');
            $table->string('deskripsi')->nullable();
            $table->text('instruksi')->nullable();
            $table->enum('tipe', ['kuis_materi','ujian_akhir']);
            $table->integer('durasi_menit')->default(10);
            $table->tinyInteger('nilai_lulus')->default(80);
            $table->boolean('tampilkan_jawaban_benar')->default(true);
            $table->boolean('acak_soal')->default(true);
            $table->boolean('acak_jawaban')->default(false);
            $table->boolean('aktif')->default(true);
            $table->timestamps();

            $table->foreign('id_materi')->references('id_materi')->on('materi')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kuis');
    }
};
