<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        if (Category::count() == 0) {
            $this->call(CategorySeeder::class);
        }
        Product::factory(35)->create(); // Create at least 30 products
    }
}
