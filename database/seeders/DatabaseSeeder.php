<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         // Admin
    User::updateOrCreate(
        ['email' => 'admin@example.com'],
        [
            'name' => 'Admin',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]
    );

    // Regular user
    User::updateOrCreate(
        ['email' => 'user@example.com'],
        [
            'name' => 'User',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]
    );
    
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        //     'type' => 'admin',
        // ]);
        // User::factory()->create([
        //     'name' => 'User',
        //     'email' => 'user@example.com',
        //     'type' => 'user',
        // ]);
    }
}
