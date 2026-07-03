<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->increments('id_pendaftaran');
            $table->integer('id_pengguna')->unsigned();
            $table->integer('id_kelas')->unsigned();
            $table->timestamp('terdaftar_pada')->useCurrent();
            $table->decimal('persentase_progres', 5, 2)->default(0);
            $table->enum('status', ['aktif','selesai','expired'])->default('aktif');
            $table->timestamp('selesai_pada')->nullable();
            $table->timestamp('terakhir_akses')->nullable();

            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
