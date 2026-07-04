<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tag')->insert([

            // Umum
            [
                'nama' => 'Soft Skills',
                'slug' => 'soft-skills',
                'total_kelas' => 0,
            ],
            [
                'nama' => 'Penelitian',
                'slug' => 'penelitian',
                'total_kelas' => 0,
            ],

            // Teknik
            [
                'nama' => 'Laravel',
                'slug' => 'laravel',
                'total_kelas' => 0,
            ],
            [
                'nama' => 'PHP',
                'slug' => 'php',
                'total_kelas' => 0,
            ],
            [
                'nama' => 'Database',
                'slug' => 'database',
                'total_kelas' => 0,
            ],
            [
                'nama' => 'Jaringan Komputer',
                'slug' => 'jaringan-komputer',
                'total_kelas' => 0,
            ],
            [
                'nama' => 'Business Intelligence',
                'slug' => 'business-intelligence',
                'total_kelas' => 0,
            ],

            // Fakultas Agama Islam
            [
                'nama' => 'Ekonomi Syariah',
                'slug' => 'ekonomi-syariah',
                'total_kelas' => 0,
            ],

            // Sosial dan Humaniora
            [
                'nama' => 'Bahasa Inggris',
                'slug' => 'bahasa-inggris',
                'total_kelas' => 0,
            ],

            // Kesehatan
            [
                'nama' => 'Keperawatan',
                'slug' => 'keperawatan',
                'total_kelas' => 0,
            ],
        ]);
    }
}