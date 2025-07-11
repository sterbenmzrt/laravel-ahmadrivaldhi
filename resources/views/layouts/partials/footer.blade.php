<footer class="bg-gray-800 text-white">
    <div class="container mx-auto py-12 px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Ramean.id Logo" class="h-8 w-auto mr-2">
                    <span class="text-xl font-semibold">Ramean.id</span>
                </div>
                <p class="text-gray-400">
                    Layanan patungan akun premium terpercaya untuk kebutuhan entertainment, produktivitas, dan AI Anda.
                </p>
            </div>
            <div>
                <h3 class="font-bold mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('products') }}" class="text-gray-400 hover:text-white">Semua Produk</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white">Tentang Kami</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold mb-4">Ikuti Kami</h3>
                <div class="flex space-x-4">
                    {{-- Ganti # dengan link sosial media Anda --}}
                    <a href="#" class="text-gray-400 hover:text-white">Facebook</a>
                    <a href="#" class="text-gray-400 hover:text-white">Instagram</a>
                    <a href="#" class="text-gray-400 hover:text-white">Twitter</a>
                </div>
            </div>
        </div>
        <div class="mt-12 border-t border-gray-700 pt-8 text-center text-gray-500">
            © {{ date('Y') }} Ramean.id. All Rights Reserved.
        </div>
    </div>
</footer>
