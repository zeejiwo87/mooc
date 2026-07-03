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
        Schema::create('kategori_sub', function (Blueprint $table) {
            $table->increments('id_kategori_sub');
            $table->integer('id_kategori')->unsigned();
            $table->string('nama', 255);
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->index();
            $table->boolean('aktif')->default(true)->index();
            $table->timestamps();
            
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_sub');
    }
};
