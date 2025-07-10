<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'AI Assistants']);
        Category::create(['name' => 'Entertainment']);
        Category::create(['name' => 'Productivity']);
    }
}