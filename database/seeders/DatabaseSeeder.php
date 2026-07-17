<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::insert([
    [
        'name' => 'Lucius Artorius Castus',
        'email' => 'lucius@gmail.com',
        'role' => 'admin',
        'password' => bcrypt('admin123'),
    ],
    [
        'name' => 'Basit Al Fath',
        'email' => 'basitalfat@gmail.com',
        'role' => 'pengguna',
        'password' => bcrypt('admin123'),
    ],
]);
    }
}
