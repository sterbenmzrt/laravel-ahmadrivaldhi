<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User::factory(10)->create(); // Original line

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); // Original line

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
