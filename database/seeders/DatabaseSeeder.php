<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            PenggunaSeeder::class,
            KategoriSeeder::class,
            KategoriSubSeeder::class,
            TagSeeder::class,
        ]);
    }
}