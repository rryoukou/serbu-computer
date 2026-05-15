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
        // User::factory(10)->create();

        // 2. Seed Regular User
        User::updateOrCreate(
            ['username' => 'user'],
            [
                'email' => 'user@example.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'pengguna',
                'nama' => 'Bismillah User',
                'tanggal_lahir' => '2000-01-01',
                'jenis_kelamin' => 'P',
                'no_hp' => '08987654321',
                'alamat' => 'Jakarta, Indonesia',
            ]
        );

        // 3. Call Product Seeder
        // $this->call([
        //     ProductSeeder::class,
        // ]);
    }
}
