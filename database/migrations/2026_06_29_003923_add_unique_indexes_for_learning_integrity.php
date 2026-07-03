<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->unique(
                ['id_pengguna', 'id_kelas'],
                'pendaftaran_pengguna_kelas_unique'
            );
        });

        Schema::table('progres_kelas', function (Blueprint $table) {
            $table->unique(
                ['id_pendaftaran', 'id_materi'],
                'progres_kelas_pendaftaran_materi_unique'
            );
        });

        Schema::table('progres_kuis', function (Blueprint $table) {
            $table->unique(
                ['id_pendaftaran', 'id_kuis'],
                'progres_kuis_pendaftaran_kuis_unique'
            );
        });

        Schema::table('progres_jawaban', function (Blueprint $table) {
            $table->unique(
                ['id_progres_kuis', 'id_soal'],
                'progres_jawaban_kuis_soal_unique'
            );
        });

        Schema::table('kelas_usulan', function (Blueprint $table) {
            $table->unique(
                ['id_kelas', 'id_pengguna'],
                'kelas_usulan_kelas_pengguna_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('kelas_usulan', function (Blueprint $table) {
            $table->dropUnique('kelas_usulan_kelas_pengguna_unique');
        });

        Schema::table('progres_jawaban', function (Blueprint $table) {
            $table->dropUnique('progres_jawaban_kuis_soal_unique');
        });

        Schema::table('progres_kuis', function (Blueprint $table) {
            $table->dropUnique('progres_kuis_pendaftaran_kuis_unique');
        });

        Schema::table('progres_kelas', function (Blueprint $table) {
            $table->dropUnique('progres_kelas_pendaftaran_materi_unique');
        });

        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropUnique('pendaftaran_pengguna_kelas_unique');
        });
    }
};