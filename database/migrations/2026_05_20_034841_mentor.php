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
        Schema::create('mentor', function (Blueprint $table) {
            $table->increments('id_mentor');
            $table->string('nama', 255);
            $table->string('email', 191)->unique();
            $table->string('password', 255);
            $table->string('foto_profil', 255)->nullable()->default('profile.png');
            $table->text('bio')->nullable();
            $table->string('spesialisasi', 255)->nullable();
            $table->string('remember_token', 191)->nullable();
            $table->integer('total_siswa')->default(0);
            $table->decimal('rating_rata', 3, 2)->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor');
    }
};