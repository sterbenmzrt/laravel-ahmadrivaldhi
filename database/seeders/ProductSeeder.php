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

        $categories = Category::pluck('id', 'name');

        $products = [
            // AI Assistants
            [
                'name' => 'ChatGPT Plus',
                'description' => 'Akses prioritas ke fitur-fitur terbaru dari OpenAI, respons lebih cepat, dan ketersediaan tinggi.',
                'price' => 100000,
                'image' => 'images/chatgpt.png',
                'category_name' => 'AI Assistants'
            ],
            [
                'name' => 'Claude Pro',
                'description' => 'Lima kali lebih banyak penggunaan dibandingkan versi gratis, akses prioritas saat lalu lintas tinggi, dan akses awal ke fitur baru.',
                'price' => 100000,
                'image' => 'images/claude.png',
                'category_name' => 'AI Assistants'
            ],
            [
                'name' => 'Gemini Advanced',
                'description' => 'Akses ke model AI tercanggih dari Google, Gemini 1.5 Pro, dengan fitur-fitur eksklusif.',
                'price' => 100000,
                'image' => 'images/gemini.png',
                'category_name' => 'AI Assistants'
            ],
            [
                'name' => 'Perplexity Pro',
                'description' => 'Pencarian tanpa batas dengan Copilot (GPT-4), upload file tanpa batas, dan dukungan pelanggan prioritas.',
                'price' => 100000,
                'image' => 'images/perplexity.png',
                'category_name' => 'AI Assistants'
            ],
            // Entertainment
            [
                'name' => 'Netflix Premium',
                'description' => 'Streaming film dan acara TV tanpa batas dalam kualitas Ultra HD (4K) di empat perangkat sekaligus.',
                'price' => 100000,
                'image' => 'images/netflix.png',
                'category_name' => 'Entertainment'
            ],
            [
                'name' => 'Spotify Premium',
                'description' => 'Dengarkan musik tanpa iklan, putar lagu apa pun, dan unduh musik untuk didengarkan secara offline.',
                'price' => 100000,
                'image' => 'images/spotify.png',
                'category_name' => 'Entertainment'
            ],
            [
                'name' => 'YouTube Premium',
                'description' => 'Tonton video tanpa iklan, putar di latar belakang, dan akses YouTube Music Premium.',
                'price' => 100000,
                'image' => 'images/youtube.png',
                'category_name' => 'Entertainment'
            ],
            [
                'name' => 'Disney+ Hotstar',
                'description' => 'Akses ke ribuan film dan serial dari Disney, Pixar, Marvel, Star Wars, dan National Geographic.',
                'price' => 100000,
                'image' => 'images/disney.png',
                'category_name' => 'Entertainment'
            ],
            [
                'name' => 'HBO GO',
                'description' => 'Streaming semua serial dan film original HBO, bersama dengan film-film Hollywood blockbuster.',
                'price' => 100000,
                'image' => 'images/hbo.png',
                'category_name' => 'Entertainment'
            ],
            // Productivity
            [
                'name' => 'Microsoft 365 Personal',
                'description' => 'Akses ke Word, Excel, PowerPoint, Outlook, dan 1 TB penyimpanan cloud OneDrive.',
                'price' => 100000,
                'image' => 'images/microsoft365.png',
                'category_name' => 'Productivity'
            ],
            [
                'name' => 'Canva Pro',
                'description' => 'Buka semua fitur premium Canva, termasuk ribuan template, foto, dan alat desain canggih.',
                'price' => 100000,
                'image' => 'images/canva.png',
                'category_name' => 'Productivity'
            ],
            [
                'name' => 'Notion AI',
                'description' => 'Tingkatkan produktivitas Anda dengan fitur AI terintegrasi langsung di dalam Notion workspace Anda.',
                'price' => 100000,
                'image' => 'images/notion.png',
                'category_name' => 'Productivity'
            ],
            [
                'name' => 'Grammarly Premium',
                'description' => 'Perbaiki tata bahasa, ejaan, dan gaya penulisan Anda dengan asisten penulisan bertenaga AI.',
                'price' => 100000,
                'image' => 'images/grammarly.png',
                'category_name' => 'Productivity'
            ],
            [
                'name' => 'Lovable',
                'description' => 'Aplikasi AI untuk meningkatkan hubungan personal dan profesional Anda.',
                'price' => 100000,
                'image' => 'images/lovable.png',
                'category_name' => 'Productivity'
            ],
        ];

        foreach ($products as $productData) {
            Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'image' => $productData['image'],
                'category_id' => $categories[$productData['category_name']],
            ]);
        }
    }
}
