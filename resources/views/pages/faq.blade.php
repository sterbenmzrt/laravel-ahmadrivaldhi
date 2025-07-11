@extends('layouts.app')

@section('content')
<div class="bg-gray-50">
    <div class="container mx-auto px-6 py-16">
        <h1 class="text-4xl font-bold text-center text-blue-900 mb-4">Frequently Asked Questions (FAQ)</h1>
        <p class="text-lg text-center text-gray-600 mb-12">Jawaban untuk pertanyaan yang paling sering diajukan.</p>

        <div class="max-w-3xl mx-auto space-y-4" x-data="{ open: 1 }">
            <div class="bg-white rounded-lg shadow-md">
                <button @click="open = (open === 1 ? null : 1)" class="w-full flex justify-between items-center p-6 text-left">
                    <span class="text-lg font-semibold">Apakah akun ini legal?</span>
                    <span x-show="open !== 1">▼</span>
                    <span x-show="open === 1">▲</span>
                </button>
                <div x-show="open === 1" class="p-6 border-t border-gray-200 text-gray-700">
                    Tentu saja! Semua akun yang kami sediakan 100% legal dan dibeli langsung dari penyedia resmi. Kami tidak menggunakan metode ilegal seperti carding atau sejenisnya.
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md">
                <button @click="open = (open === 2 ? null : 2)" class="w-full flex justify-between items-center p-6 text-left">
                    <span class="text-lg font-semibold">Bagaimana jika akun bermasalah?</span>
                    <span x-show="open !== 2">▼</span>
                    <span x-show="open === 2">▲</span>
                </button>
                <div x-show="open === 2" x-cloak class="p-6 border-t border-gray-200 text-gray-700">
                    Kami memberikan garansi penuh selama masa berlangganan. Jika akun Anda mengalami masalah, tim support kami akan segera memberikan akun pengganti.
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md">
                <button @click="open = (open === 3 ? null : 3)" class="w-full flex justify-between items-center p-6 text-left">
                    <span class="text-lg font-semibold">Berapa lama proses pengiriman akun?</span>
                    <span x-show="open !== 3">▼</span>
                    <span x-show="open === 3">▲</span>
                </button>
                <div x-show="open === 3" x-cloak class="p-6 border-t border-gray-200 text-gray-700">
                    Prosesnya instan! Setelah pembayaran Anda terkonfirmasi oleh sistem, detail akun akan otomatis dikirimkan ke email Anda dalam hitungan detik.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
