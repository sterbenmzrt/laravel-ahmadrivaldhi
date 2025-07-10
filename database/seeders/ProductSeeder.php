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

        $products = [
            [
                'name' => 'ChatGPT Plus',
                'description' => 'Akses prioritas ke fitur-fitur terbaru dari OpenAI, respons lebih cepat, dan ketersediaan tinggi.',
                'price' => 350000,
                'image' => 'images/chatgpt.png',
                'category_name' => 'AI Assistants'
            ],
            [
                'name' => 'Claude Pro',
                'description' => 'Lima kali lebih banyak penggunaan dibandingkan versi gratis, akses prioritas saat lalu lintas tinggi, dan akses awal ke fitur baru.',
                'price' => 380000,
                'image' => 'images/claude.png',
                'category_name' => 'AI Assistants'
            ],
            [
                'name' => 'Gemini Advanced',
                'description' => 'Akses ke model AI tercanggih dari Google, Gemini 1.5 Pro, dengan fitur-fitur eksklusif.',
                'price' => 310000,
                'image' => 'images/gemini.png',
                'category_name' => 'AI Assistants'
            ],
            [
                'name' => 'Perplexity Pro',
                'description' => 'Pencarian tanpa batas dengan Copilot (GPT-4), upload file tanpa batas, dan dukungan pelanggan prioritas.',
                'price' => 320000,
                'image' => 'images/perplexity.png',
                'category_name' => 'AI Assistants'
            ],
            [
                'name' => 'Lovable',
                'description' => 'Aplikasi AI untuk meningkatkan hubungan personal dan profesional Anda.',
                'price' => 250000,
                'image' => 'images/lovable.png',
                'category_name' => 'Productivity'
            ],
        ];

        foreach ($products as $productData) {
            $category = Category::firstOrCreate(['name' => $productData['category_name']]);
            Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'image' => $productData['image'],
                'category_id' => $category->id,
            ]);
        }
    }
}
