<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('progres_kuis', function (Blueprint $table) {
            $table->increments('id_progres_kuis');
            $table->integer('id_pendaftaran')->unsigned();
            $table->integer('id_kuis')->unsigned();
            $table->integer('id_progres_kelas')->unsigned();
            $table->decimal('nilai', 5, 2)->default(0);
            $table->tinyInteger('total_soal');
            $table->tinyInteger('jawaban_benar')->default(0);
            $table->boolean('lulus')->default(false);
            $table->timestamp('diserahkan_pada')->nullable();
            $table->timestamps();

            $table->foreign('id_pendaftaran')->references('id_pendaftaran')->on('pendaftaran')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_kuis')->references('id_kuis')->on('kuis')->cascadeOnUpdate();
            $table->foreign('id_progres_kelas')->references('id_progres_kelas')->on('progres_kelas')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progres_kuis');
    }
};
