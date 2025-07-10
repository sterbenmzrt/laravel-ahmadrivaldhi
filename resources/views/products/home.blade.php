@extends('layouts.app')

@section('content')
<div>
    <section class="bg-blue-900 text-white">
        <div class="container mx-auto flex flex-col md:flex-row items-center px-6 py-24">
            <div class="md:w-1/2 text-center md:text-left">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">Patungan Akun Premium, Jadi Lebih Hemat.</h1>
                <p class="mt-4 text-lg md:text-xl text-blue-200">Nikmati layanan premium favoritmu dengan harga lebih terjangkau bersama Ramean.id. Aman, cepat, dan terpercaya.</p>
                <a href="{{ route('products') }}" class="mt-8 inline-block bg-white text-blue-900 font-bold py-3 px-8 rounded-lg shadow-lg hover:bg-gray-200 transition">Mulai Berlangganan</a>
            </div>
            <div class="md:w-1/2 mt-10 md:mt-0 flex justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Hero Image" class="w-64 h-64">
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-blue-900">Gaperlu Nunggu Penuh, Udah Bisa Akses Penuh!</h2>
            <div class="mt-12 grid md:grid-cols-3 gap-12">
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 mx-auto bg-blue-200 text-blue-700 rounded-full text-3xl">✓</div>
                    <h3 class="text-xl font-semibold mt-6 mb-2">Aktivasi Instan</h3>
                    <p class="text-gray-600">Akun langsung aktif dan dikirim ke email Anda setelah pembayaran berhasil. Tidak ada drama menunggu.</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 mx-auto bg-blue-200 text-blue-700 rounded-full text-3xl">✓</div>
                    <h3 class="text-xl font-semibold mt-6 mb-2">Grup Fleksibel</h3>
                    <p class="text-gray-600">Anda bisa memulai grup sendiri atau bergabung dengan grup yang ada tanpa harus menunggu kuota penuh.</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 mx-auto bg-blue-200 text-blue-700 rounded-full text-3xl">✓</div>
                    <h3 class="text-xl font-semibold mt-6 mb-2">Garansi Penuh</h3>
                    <p class="text-gray-600">Kami memberikan garansi penuh selama masa berlangganan. Keamanan dan kenyamanan Anda prioritas kami.</p>
                </div>
            </div>
        </div>
    </section>

    @if(isset($featuredProducts) && $featuredProducts->count() > 0)
    <section class="py-20">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Pilih Layanan Favoritmu</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
                @foreach ($featuredProducts as $product)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden text-center group transform hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="h-40 bg-gray-100 flex items-center justify-center p-4">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="max-h-full w-auto object-contain">
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500 mb-4">{{ $product->category->name ?? 'N/A' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('products') }}" class="bg-blue-800 text-white font-bold py-3 px-10 rounded-lg shadow-lg hover:bg-blue-900 transition">Pesan Sekarang</a>
            </div>
        </div>
    </section>
    @endif

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Proses Pemesanan Super Cepat</h2>
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div class="p-4">
                    <div class="flex items-center justify-center h-16 w-16 mx-auto bg-blue-200 text-blue-700 rounded-full text-2xl font-bold">1</div>
                    <h3 class="text-xl font-semibold mt-6 mb-2">Pilih Produk & Skema</h3>
                    <p class="text-gray-600">Pilih akun premium dan tentukan jumlah anggota grup patungan.</p>
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-center h-16 w-16 mx-auto bg-blue-200 text-blue-700 rounded-full text-2xl font-bold">2</div>
                    <h3 class="text-xl font-semibold mt-6 mb-2">Lakukan Pembayaran</h3>
                    <p class="text-gray-600">Selesaikan pembayaran dengan metode yang aman dan mudah.</p>
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-center h-16 w-16 mx-auto bg-blue-200 text-blue-700 rounded-full text-2xl font-bold">3</div>
                    <h3 class="text-xl font-semibold mt-6 mb-2">Akun Langsung Dikirim</h3>
                    <p class="text-gray-600">Data akun dikirim instan ke email Anda setelah pembayaran berhasil.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-12">Keuntungan Berlangganan Dengan Ramean.id</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-lg">Legal & Aman</h3>
                    <p class="text-gray-600 mt-2">Semua akun yang kami sediakan adalah 100% legal dan aman dari pembajakan.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-lg">Harga Terbaik</h3>
                    <p class="text-gray-600 mt-2">Dengan sistem patungan, Anda mendapatkan harga yang jauh lebih hemat.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-lg">Dukungan Cepat</h3>
                    <p class="text-gray-600 mt-2">Tim support kami siap membantu Anda jika terjadi kendala pada akun.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-lg">Tanpa Iklan</h3>
                    <p class="text-gray-600 mt-2">Nikmati semua layanan premium tanpa gangguan iklan yang menyebalkan.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-blue-800 text-white">
        <div class="container mx-auto px-6 py-16 text-center">
            <h2 class="text-3xl font-bold">Masih Bingung atau Ragu?</h2>
            <p class="mt-4 mb-8 text-lg text-blue-200">Jangan ragu untuk bertanya! Tim kami siap menjawab semua pertanyaan Anda.</p>
            <a href="https://wa.me/6281234567890?text=Halo%20admin%20Ramean.id,%20saya%20mau%20bertanya." target="_blank" class="bg-green-500 text-white font-bold py-3 px-8 rounded-lg shadow-lg hover:bg-green-600 transition">
                Hubungi Admin via WhatsApp
            </a>
        </div>
    </section>

</div>
@endsection
