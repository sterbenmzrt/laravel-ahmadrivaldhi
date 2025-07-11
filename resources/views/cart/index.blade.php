@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">Keranjang Belanja Anda</h1>

    @if(isset($cartItems) && $cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($cartItems as $item)
                        <li class="p-6 flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                            <div class="w-32 h-32 flex-shrink-0 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="max-h-full w-auto object-contain p-2">
                            </div>
                            <div class="flex-grow text-center md:text-left">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $item->product->name }}</h3>
                                <p class="text-gray-500 dark:text-gray-400">{{ $item->product->category->name ?? 'N/A' }}</p>
                                <p class="text-lg font-bold text-blue-800 dark:text-blue-400 mt-2">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" class="w-16 text-center border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-md focus:ring-blue-500 focus:border-blue-500" min="1">
                                    <button type="submit" class="ml-2 px-3 py-1 bg-gray-200 dark:bg-gray-600 text-xs font-semibold rounded-md hover:bg-gray-300 dark:hover:bg-gray-500">Update</button>
                                </form>
                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500" title="Hapus item">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 sticky top-28">
                    <h2 class="text-2xl font-semibold border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">Ringkasan Pesanan</h2>

                    @if(!session()->has('coupon'))
                    <form action="{{ route('cart.applyCoupon') }}" method="POST" class="mb-6">
                        @csrf
                        <label for="coupon_code" class="block mb-1 font-medium">Punya Kupon?</label>
                        <div class="flex">
                            <input type="text" name="coupon_code" id="coupon_code" placeholder="Masukkan kode" class="w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-l-md focus:ring-blue-500 focus:border-blue-500">
                            <button type="submit" class="bg-gray-800 text-white font-semibold px-4 rounded-r-md hover:bg-black">Pakai</button>
                        </div>
                    </form>
                    @endif

                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                            <span class="font-bold text-gray-900 dark:text-white">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        @if(session()->has('coupon'))
                        <div class="flex justify-between items-center text-green-600 dark:text-green-400">
                            <span>Diskon ({{ session('coupon')->code }})</span>
                            <div class="flex items-center">
                                <span>- Rp {{ number_format($discount, 0, ',', '.') }}</span>
                                <form action="{{ route('cart.removeCoupon') }}" method="POST" class="ml-2">
                                    @csrf
                                    <button type="submit" class="text-red-500 text-xs">[Hapus]</button>
                                </form>
                            </div>
                        </div>
                        @endif
                        <div class="border-t border-gray-200 dark:border-gray-700 my-4"></div>
                        <div class="flex justify-between text-xl font-bold">
                            <span class="text-gray-900 dark:text-white">Total</span>
                            <span class="text-blue-800 dark:text-blue-400">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <a href="{{ route('checkout.create') }}" class="mt-8 block w-full text-center bg-blue-800 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-blue-900 transition text-lg">
                        Lanjut ke Pembayaran
                    </a>
                </div>
            </div>

        </div>
    @else
        <div class="text-center py-20 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Keranjang Anda Kosong</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Sepertinya Anda belum menambahkan produk apa pun.</p>
            <a href="{{ route('products') }}" class="mt-6 inline-block bg-blue-800 text-white font-bold py-3 px-8 rounded-lg shadow-lg hover:bg-blue-900 transition">
                Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection
