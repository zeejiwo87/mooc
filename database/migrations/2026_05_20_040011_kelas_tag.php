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
        Schema::create('kelas_tag', function (Blueprint $table) {
            $table->unsignedInteger('id_kelas');
            $table->unsignedInteger('id_tag');
            $table->timestamp('created_at')->nullable();

            $table->primary(['id_kelas', 'id_tag']);

            $table->foreign('id_kelas')
                ->references('id_kelas')
                ->on('kelas')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_tag')
                ->references('id_tag')
                ->on('tag')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_tag');
    }
};