<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('soal_jawaban', function (Blueprint $table) {
            $table->increments('id_soal_jawaban');
            $table->integer('id_soal')->unsigned();
            $table->text('teks_jawaban');
            $table->boolean('benar')->default(false);
            $table->timestamps();

            $table->foreign('id_soal')->references('id_soal')->on('soal')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soal_jawaban');
    }
};
