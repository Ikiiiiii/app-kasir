<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'level_akses' => 'admin'
        ]);
        User::create([
            'username' => 'rizky',
            'email' => 'rizky@gmail.com',
            'password' => bcrypt('petugas'),
            'level_akses' => 'petugas'
        ]);
    }
}
