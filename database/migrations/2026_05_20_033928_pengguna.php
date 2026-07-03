<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->increments('id_pengguna');
            $table->string('nama', 255);
            $table->string('email', 191)->unique();
            $table->string('password', 255);
            $table->string('foto_profil', 255)->nullable();
            $table->text('bio')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->boolean('terverifikasi')->default(false)->index();
            $table->string('remember_token', 191)->nullable();
            $table->timestamp('last_login')->nullable();
            $table->integer('total_kelas_selesai')->default(0);
            $table->integer('total_poin')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};