<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin')->insert([
            [
                'id_admin' => '1',
                'nama' => 'Ahmad',
                'email' => 'ahmad@gmail.com',
                'password' => Hash::make('ahmad123'),
                'role' => 'admin',
            ],
            [
                'id_admin' => '2',
                'nama' => 'Wati',
                'email' => 'wati@gmail.com',
                'password' => Hash::make('wati123'),
                'role' => 'developer',
            ],
            [
                'id_admin' => '3',
                'nama' => 'Ahmad Halimi',
                'email' => 'ahmadhalimi@example.com',
                'password' => Hash::make('halimi123'),
                'role' => 'admin',
            ],
        ]);
    }
}