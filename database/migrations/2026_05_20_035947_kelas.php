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
        Schema::create('kelas', function (Blueprint $table) {
            $table->increments('id_kelas');
            $table->integer('id_kategori_sub')->unsigned()->index();
            $table->integer('id_pemilik')->unsigned()->index();
            $table->string('judul', 255);
            $table->string('slug', 255)->unique()->index();
            $table->string('deskripsi_singkat', 500);
            $table->text('deskripsi_lengkap');
            $table->string('banner', 255)->nullable();
            $table->string('sertifikat', 255)->nullable();
            $table->string('video_intro_url', 255)->nullable();
            $table->enum('tingkat', ['pemula','menengah','lanjutan' ])->index();
            $table->enum('bahasa', ['ID','EN','AR']);
            $table->integer('total_durasi_menit')->default(0);
            $table->integer('jumlah_materi')->default(0);
            $table->decimal('rating', 3, 2)->default(0)->index();
            $table->integer('nilai_lulus')->unsigned()->default(0);
            $table->integer('total_pendaftaran')->default(0);
            $table->integer('total_selesai')->default(0);
            $table->integer('total_review')->default(0);
            $table->enum('status', ['draft','terbit','arsip'])->default('draft')->index();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('id_kategori_sub')->references('id_kategori_sub')->on('kategori_sub')->onDelete('cascade');
            $table->foreign('id_pemilik')->references('id_mentor')->on('mentor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
