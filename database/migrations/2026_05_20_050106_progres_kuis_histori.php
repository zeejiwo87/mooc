<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('progres_kuis_histori', function (Blueprint $table) {
            $table->increments('id_progres_kuis_histori');
            $table->integer('id_progres_kuis')->unsigned();
            $table->integer('percobaan_ke');
            $table->decimal('nilai', 5, 2)->default(0);
            $table->integer('total_soal')->default(0);
            $table->integer('jawaban_benar')->default(0);
            $table->boolean('lulus')->default(false);
            $table->timestamp('diserahkan_pada')->nullable();
            $table->timestamps();
            
            $table->foreign('id_progres_kuis')->references('id_progres_kuis')->on('progres_kuis')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progres_kuis_histori');
    }
};
