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
    // Akun HIMA
    \App\Models\User::create([
        'name' => 'HIMA',
        'email' => 'hima@admin.com',
        'password' => bcrypt('password123'),
        'role' => 'hima'
    ]);

    // Akun Sekjur
    \App\Models\User::create([
        'name' => 'Sekretaris Jurusan',
        'email' => 'sekjur@gmail.com',
        'password' => bcrypt('password123'),
        'role' => 'sekjur'
    ]);

    // Akun Kaprodi
    \App\Models\User::create([
        'name' => 'Ketua Prodi',
        'email' => 'kaprodi@gmail.com',
        'password' => bcrypt('password123'),
        'role' => 'kaprodi'
    ]);

    // Akun Dekan
    \App\Models\User::create([
        'name' => 'Dekan Fakultas',
        'email' => 'dekan@gmail.com',
        'password' => bcrypt('password123'),
        'role' => 'dekan'
    ]);
}
}
