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
        Schema::create('kelas_mentor', function (Blueprint $table) {
            $table->increments('id_kelas_mentor');
            $table->integer('id_kelas')->unsigned();
            $table->integer('id_mentor')->unsigned();
            $table->string('peran');
            $table->timestamps();

            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_mentor')->references('id_mentor')->on('mentor')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('kelas_mentor');
    }
};
