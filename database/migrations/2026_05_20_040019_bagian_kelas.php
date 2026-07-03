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
        Schema::create('bagian_kelas', function (Blueprint $table) {
            $table->increments('id_bagian_kelas');
            $table->integer('id_kelas')->unsigned();
            $table->string('judul', 255);
            $table->text('deskripsi')->nullable();           
            $table->integer('urutan')->index();           
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bagian_kelas');
    }
};