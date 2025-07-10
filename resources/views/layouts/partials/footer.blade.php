<footer class="bg-gray-800 dark:bg-gray-900 text-white mt-16">
    <div class="container mx-auto py-12 px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-2xl font-bold mb-2">Ramean.id</h3>
                <p class="text-gray-400 max-w-md">Platform patungan untuk membeli akun premium. Lebih hemat, lebih cepat, dan tidak perlu menunggu grup penuh. Nikmati akses penuh dengan harga terjangkau.</p>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Link Cepat</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Home</a></li>
                    <li><a href="{{ route('products') }}" class="text-gray-400 hover:text-white transition">Semua Produk</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Cara Kerja</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Kontak Kami</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Kategori Populer</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('products', ['category_id' => 1]) }}" class="text-gray-400 hover:text-white transition">AI Assistants</a></li>
                    <li><a href="{{ route('products', ['category_id' => 2]) }}" class="text-gray-400 hover:text-white transition">Entertainment</a></li>
                    <li><a href="{{ route('products', ['category_id' => 3]) }}" class="text-gray-400 hover:text-white transition">Productivity</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-10 border-t border-gray-700 pt-6 text-center text-gray-500">
            <p>&copy; {{ date('Y') }} Ramean.id. Semua Hak Cipta Dilindungi.</p>
        </div>
    </div>
</footer>