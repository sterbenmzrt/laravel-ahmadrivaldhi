@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-8 text-center">Selesaikan Pesanan Anda</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                    <h2 class="text-2xl font-semibold mb-4">1. Detail Kontak</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Pastikan email dan nomor WhatsApp Anda aktif untuk pengiriman akun dan konfirmasi pesanan.</p>

                    <div class="space-y-4">
                        {{-- Field Email (Read-only) --}}
                        <div>
                            <label for="email" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Email Anda</label>
                            <input type="email" id="email" value="{{ auth()->user()->email }}" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 rounded-md" readonly>
                            <p class="text-xs text-gray-500 mt-1">Akun akan dikirimkan ke email ini.</p>
                        </div>

                        {{-- Field Nomor WhatsApp --}}
                        <div>
                            <label for="whatsapp_number" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Nomor WhatsApp Aktif</label>
                            <input type="tel" name="whatsapp_number" id="whatsapp_number" required placeholder="Contoh: 081234567890" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="mt-8">
                        <h2 class="text-2xl font-semibold mb-4">2. Instruksi Pembayaran</h2>
                        <ol class="list-decimal list-inside space-y-2 text-gray-600 dark:text-gray-400">
                            <li>Scan kode QRIS di samping menggunakan aplikasi e-wallet Anda.</li>
                            <li>Pastikan jumlah pembayaran sesuai dengan **Total Tagihan**.</li>
                            <li>Klik tombol **"Konfirmasi & Buat Pesanan"** di bawah setelah Anda berhasil transfer.</li>
                        </ol>
                    </div>

                    <button type="submit" class="w-full mt-8 bg-blue-800 text-white font-bold py-4 px-6 rounded-lg shadow-lg hover:bg-blue-900 transition text-xl">
                        Konfirmasi & Buat Pesanan
                    </button>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md sticky top-28">
                <h2 class="text-2xl font-semibold text-center mb-4">Scan QRIS Untuk Membayar</h2>
                <div class="w-full aspect-square bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center p-4">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=PEMBAYARAN-RAMEAN-ID-TOTAL-{{$subtotal}}" alt="QRIS Code" class="w-full h-full object-contain">
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 mt-6 pt-6">
                    <div class="flex justify-between font-bold text-xl">
                        <span>Total Tagihan</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
