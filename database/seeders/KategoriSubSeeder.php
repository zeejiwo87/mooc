<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSubSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori_sub')->insert([

            // Umum 
            [
                'id_kategori' => 1,
                'nama' => 'Soft Skills',
                'deskripsi' => 'Pengembangan kemampuan komunikasi, kepemimpinan, dan kerja sama tim.',
                'urutan' => 1,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 1,
                'nama' => 'Penelitian',
                'deskripsi' => 'Metodologi penelitian dan penulisan karya ilmiah.',
                'urutan' => 2,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 1,
                'nama' => 'Bahasa Indonesia',
                'deskripsi' => 'Pembelajaran tata bahasa, penulisan, dan komunikasi Bahasa Indonesia.',
                'urutan' => 3,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 1,
                'nama' => 'Bahasa Inggris',
                'deskripsi' => 'Pembelajaran kemampuan berbahasa Inggris untuk kebutuhan akademik dan profesional.',
                'urutan' => 4,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Teknik 
            [
                'id_kategori' => 2,
                'nama' => 'Laravel',
                'deskripsi' => 'Framework Laravel untuk pengembangan aplikasi web modern.',
                'urutan' => 1,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 2,
                'nama' => 'PHP',
                'deskripsi' => 'Bahasa pemrograman PHP untuk pengembangan aplikasi web.',
                'urutan' => 2,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 2,
                'nama' => 'Database',
                'deskripsi' => 'Perancangan, pengelolaan, dan optimasi basis data.',
                'urutan' => 3,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 2,
                'nama' => 'Jaringan Komputer',
                'deskripsi' => 'Konsep dasar jaringan komputer, konfigurasi, dan administrasi jaringan.',
                'urutan' => 4,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 2,
                'nama' => 'Business Intelligence',
                'deskripsi' => 'Analisis data, visualisasi, dan pengambilan keputusan berbasis data.',
                'urutan' => 5,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Fakultas Agama Islam 
            [
                'id_kategori' => 3,
                'nama' => 'Pendidikan Agama Islam',
                'deskripsi' => 'Pembelajaran ilmu-ilmu keislaman dan pendidikan agama.',
                'urutan' => 1,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 3,
                'nama' => 'Ekonomi Syariah',
                'deskripsi' => 'Pembelajaran ekonomi dan keuangan berbasis syariah.',
                'urutan' => 2,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Sosial & Humaniora
            [
                'id_kategori' => 4,
                'nama' => 'Manajemen',
                'deskripsi' => 'Pembelajaran manajemen organisasi, bisnis, dan sumber daya manusia.',
                'urutan' => 1,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 4,
                'nama' => 'Hukum',
                'deskripsi' => 'Pembelajaran dasar hukum dan peraturan perundang-undangan.',
                'urutan' => 2,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 4,
                'nama' => 'Kewirausahaan',
                'deskripsi' => 'Pembelajaran dasar membangun dan mengembangkan usaha.',
                'urutan' => 3,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kesehatan 
            [
                'id_kategori' => 5,
                'nama' => 'Keperawatan',
                'deskripsi' => 'Pembelajaran dasar ilmu keperawatan.',
                'urutan' => 1,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 5,
                'nama' => 'Kebidanan',
                'deskripsi' => 'Pembelajaran dasar ilmu kebidanan.',
                'urutan' => 2,
                'aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}