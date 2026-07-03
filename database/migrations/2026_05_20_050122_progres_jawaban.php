<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('progres_jawaban', function (Blueprint $table) {
            $table->increments('id_progres_jawaban');
            $table->integer('id_progres_kuis')->unsigned();
            $table->integer('id_soal')->unsigned();
            $table->integer('id_soal_jawaban')->unsigned()->nullable();
            $table->boolean('benar')->default(false);
            $table->integer('poin_diperoleh')->default(0);

            $table->foreign('id_progres_kuis')->references('id_progres_kuis')->on('progres_kuis')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_soal')->references('id_soal')->on('soal')->cascadeOnUpdate();
            $table->foreign('id_soal_jawaban')->references('id_soal_jawaban')->on('soal_jawaban')->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progres_jawaban');
    }
};
