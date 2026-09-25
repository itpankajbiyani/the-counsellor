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
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $counsellorNames = ['Dr. John Doe', 'Dr. Jane Smith', 'Dr. Alice Johnson', 'Dr. Bob Brown', 'Dr. Charlie Davis'];
        foreach ($counsellorNames as $index => $name) {
            \App\Models\User::create([
                'name' => $name,
                'email' => 'counsellor' . ($index + 1) . '@example.com',
                'password' => bcrypt('password'),
                'role' => 'counsellor',
            ]);
        }
    }
}
