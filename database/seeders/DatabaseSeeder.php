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
            'email' => 'admin@example.com',
            'is_admin' => true,
            'type' => 'admin',
        ]
    );

    // Regular user
    User::updateOrCreate(
        ['email' => 'user@example.com'],
        [
            'name' => 'User',
            'password' => bcrypt('password'),
            'email' => 'user@example.com',
            'is_admin' => false,
            'type' => 'user',
        ]
    );

    // Seed categories first
        $this->call(CategorySeeder::class);

        // Then seed posts
        $this->call(PostSeeder::class);
    
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
