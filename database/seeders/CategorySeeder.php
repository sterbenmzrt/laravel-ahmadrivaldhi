<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Electronics', 'Books', 'Clothing', 'Home Goods', 'Sports'];
        foreach ($categories as $category) {
            Category::factory()->create(['name' => $category]);
        }
    }
}
