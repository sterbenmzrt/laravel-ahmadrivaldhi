@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="container mx-auto px-6 py-16 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-blue-900">Tentang Ramean.id</h1>
        <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Membuat layanan premium lebih mudah diakses dan terjangkau untuk semua orang.</p>
    </div>

    <div class="bg-gray-50 py-20">
        <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-semibold mb-4">Misi Kami</h2>
                <p class="text-gray-700 leading-relaxed">
                    Di Ramean.id, kami percaya bahwa setiap orang berhak mendapatkan akses ke alat dan hiburan terbaik tanpa harus terbebani oleh biaya langganan yang mahal. Misi kami adalah menyediakan platform patungan yang aman, legal, dan super mudah digunakan, sehingga Anda bisa fokus menikmati layanan premium favorit Anda. Kami berkomitmen pada transparansi, keamanan, dan kepuasan pelanggan.
                </p>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Our Mission" class="rounded-lg shadow-xl w-64 h-64">
            </div>
        </div>
    </div>
</div>
@endsection
