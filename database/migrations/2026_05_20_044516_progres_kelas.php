<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('progres_kelas', function (Blueprint $table) {
            $table->increments('id_progres_kelas');
            $table->integer('id_pendaftaran')->unsigned();
            $table->integer('id_bagian_kelas')->unsigned();
            $table->integer('id_materi')->unsigned();
            $table->integer('urutan_bagian_kelas');
            $table->integer('urutan_materi');
            $table->boolean('selesai')->default(false);
            $table->integer('waktu_belajar_detik')->default(0);
            $table->integer('posisi_video_terakhir')->nullable();
            $table->timestamp('selesai_pada')->nullable();
            $table->timestamps();
            
            $table->foreign('id_pendaftaran')->references('id_pendaftaran')->on('pendaftaran')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_bagian_kelas')->references('id_bagian_kelas')->on('bagian_kelas');
            $table->foreign('id_materi')->references('id_materi')->on('materi')->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progres_kelas');
    }
};
