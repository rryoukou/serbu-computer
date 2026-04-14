<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Seed Admin
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'email' => 'admin@serbu.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'nama' => 'Admin Serbu Computer',
                'tanggal_lahir' => '1990-01-01',
                'jenis_kelamin' => 'L',
                'no_hp' => '08123456789',
                'alamat' => 'Malang, Jawa Timur',
            ]
        );

        // 2. Seed Regular User
        User::updateOrCreate(
            ['username' => 'user'],
            [
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'role' => 'pengguna',
                'nama' => 'Bismillah User',
                'tanggal_lahir' => '2000-01-01',
                'jenis_kelamin' => 'P',
                'no_hp' => '08987654321',
                'alamat' => 'Jakarta, Indonesia',
            ]
        );

        // 3. Call Product Seeder
        $this->call([
            ProductSeeder::class,
        ]);
    }
}
