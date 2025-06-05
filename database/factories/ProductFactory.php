<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->catchPhrase(), // Changed from commerce_product_name()
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->randomFloat(2, 5, 2000),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory()->create()->id,
        ];
    }
}
