<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('soal', function (Blueprint $table) {
            $table->increments('id_soal');
            $table->integer('id_kuis')->unsigned();
            $table->text('teks_soal');
            $table->string('gambar_soal')->nullable();
            $table->tinyInteger('nilai')->default(1);
            $table->text('penjelasan')->nullable();
            $table->timestamps();

            $table->foreign('id_kuis')->references('id_kuis')->on('kuis')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soal');
    }
};
