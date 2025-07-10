@extends('layouts.app')

@section('content')
<div class="text-gray-800 dark:text-gray-200">

    <section class="text-center py-20 bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 text-white rounded-xl shadow-2xl">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-4">Akses Premium, Harga Patungan.</h1>
            <p class="text-lg md:text-xl max-w-3xl mx-auto opacity-90 mb-8">
                Selamat datang di Ramean.id! Platform pertama untuk patungan akun premium favoritmu. Lebih hemat dan bisa langsung dipakai.
            </p>
            <a href="{{ route('products') }}" class="bg-white text-indigo-700 font-bold py-3 px-10 rounded-full shadow-lg hover:bg-gray-100 transform hover:scale-105 transition duration-300 ease-in-out text-lg">
                Lihat Semua Akun
            </a>
        </div>
    </section>

    <section class="text-center py-12">
        <h2 class="text-2xl md:text-3xl font-bold text-indigo-600 dark:text-indigo-400">
            "Tidak Perlu Nunggu Penuh, Udah Bisa Akses Penuh"
        </h2>
    </section>

    <section class="mb-16">
        <h3 class="text-3xl font-bold mb-8 text-center">Produk Andalan Kami</h3>
        <div class="flex flex-wrap justify-center items-center gap-8">
            @foreach ($featuredProducts as $product)
            <a href="{{ route('products.show', $product) }}" class="group" title="{{ $product->name }}">
                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="h-20 w-20 mx-auto object-contain transition-transform duration-300 group-hover:scale-110">
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <section class="py-16 bg-gray-50 dark:bg-gray-800 rounded-xl">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-2">Pesan Cuma 3 Langkah</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-12">Bisa langsung pesan, login belakangan juga boleh!</p>
            <div class="grid md:grid-cols-3 gap-8 relative">
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-px bg-gray-300 dark:bg-gray-600" style="transform: translateY(-50%); z-index: 0;"></div>
                
                <div class="relative z-10 bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg">
                    <div class="bg-indigo-500 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">1</div>
                    <h4 class="text-xl font-semibold mb-2">Pilih Akun</h4>
                    <p class="text-gray-600 dark:text-gray-400">Pilih akun premium yang kamu inginkan dari daftar produk kami.</p>
                </div>
                <div class="relative z-10 bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg">
                    <div class="bg-indigo-500 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">2</div>
                    <h4 class="text-xl font-semibold mb-2">Lakukan Pembayaran</h4>
                    <p class="text-gray-600 dark:text-gray-400">Selesaikan pembayaran dengan metode yang kamu pilih. Aman dan cepat.</p>
                </div>
                <div class="relative z-10 bg-white dark:bg-gray-700 p-6 rounded-lg shadow-lg">
                    <div class="bg-indigo-500 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4">3</div>
                    <h4 class="text-xl font-semibold mb-2">Akses Langsung</h4>
                    <p class="text-gray-600 dark:text-gray-400">Detail akun akan langsung dikirimkan setelah pembayaran berhasil.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-12">Kenapa Beli di Ramean.id?</h3>
            <div class="grid md:grid-cols-3 gap-10">
                <div>
                    <div class="bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-400 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01"></path></svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2">Jauh Lebih Hemat</h4>
                    <p class="text-gray-600 dark:text-gray-400">Nikmati layanan premium dengan membayar sebagian kecil dari harga aslinya.</p>
                </div>
                <div>
                    <div class="bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2">Proses Instan</h4>
                    <p class="text-gray-600 dark:text-gray-400">Tidak perlu menunggu grup penuh. Bayar dan langsung dapatkan akses.</p>
                </div>
                <div>
                    <div class="bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-400 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 20.944a11.955 11.955 0 018.618-3.04 11.955 11.955 0 018.618 3.04 12.02 12.02 0 003-7.944a11.955 11.955 0 01-2.382-5.984z"></path></svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2">Aman & Terpercaya</h4>
                    <p class="text-gray-600 dark:text-gray-400">Kami menjamin keamanan dan keabsahan semua akun yang kami sediakan.</p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection