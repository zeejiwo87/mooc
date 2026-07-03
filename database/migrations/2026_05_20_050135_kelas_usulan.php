<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kelas_usulan', function (Blueprint $table) {
            $table->increments('id_kelas_usulan');
            $table->integer('id_kelas')->unsigned();
            $table->integer('id_pengguna')->unsigned();
            $table->integer('rating')->nullable();
            $table->text('ulasan')->nullable();
            $table->timestamps();

            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas_usulan');
    }
};
