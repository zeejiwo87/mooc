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
        Schema::create('materi', function (Blueprint $table) {
            $table->increments('id_materi');
            $table->integer('id_bagian_kelas')->unsigned();
            $table->string('judul', 255);
            $table->enum('tipe', ['video', 'kuis', 'text'])->index();
            $table->text('content')->nullable();
            $table->string('url_video', 255)->nullable();
            $table->string('url_lampiran', 255)->nullable();
            $table->integer('urutan')->index();
            $table->integer('durasi_detik')->nullable();
            $table->boolean('preview')->default(false);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
           
            $table->foreign('id_bagian_kelas')->references('id_bagian_kelas')->on('bagian_kelas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};