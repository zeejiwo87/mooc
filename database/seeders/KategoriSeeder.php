<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            [
                'nama' => 'Umum',
                'deskripsi' => 'Kelas yang dapat diikuti oleh seluruh mahasiswa dari berbagai fakultas dan program studi, seperti soft skills, penelitian, bahasa, serta pengembangan diri.',
                'urutan' => 1,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Teknik',
                'deskripsi' => 'Kelas yang membahas teknologi informasi, pemrograman, jaringan, dan pengembangan perangkat lunak.',
                'urutan' => 2,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Fakultas Agama Islam',
                'deskripsi' => 'Kelas yang berkaitan dengan ilmu keislaman, syariah, pendidikan Islam, dan dakwah.',
                'urutan' => 3,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sosial dan Humaniora',
                'deskripsi' => 'Kelas yang membahas bidang sosial, bahasa, hukum, ekonomi, dan manajemen.',
                'urutan' => 4,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kesehatan',
                'deskripsi' => 'Kelas yang berkaitan dengan keperawatan, kebidanan, dan kesehatan masyarakat.',
                'urutan' => 5,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}