<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. Akun Sekjur (Admin)
        User::create([
            'name' => 'Sekjur (Admin)',
            'email' => 'sekjur@admin.com',
            'role' => 'sekjur',
            'password' => bcrypt('password123'),
        ]);

        // 2. Akun Pengurus HIMA
        User::create([
            'name' => 'Budi HIMA IF',
            'email' => 'hima@admin.com',
            'role' => 'hima',
            'password' => bcrypt('password123'),
        ]);

        // 3. Akun Kaprodi
        User::create([
            'name' => 'Kaprodi',
            'email' => 'kaprodi@admin.com',
            'role' => 'kaprodi',
            'password' => bcrypt('password123'),
        ]);

        // 4. Akun Dekan / Wadek
        User::create([
            'name' => 'Dekan',
            'email' => 'dekan@admin.com',
            'role' => 'dekan',
            'password' => bcrypt('password123'),
        ]);

        // 5. Akun Mahasiswa
        User::create([
            'name' => 'Silvia Mahasiswa',
            'email' => 'mahasiswa@admin.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('password123'),
        ]);
    }
}