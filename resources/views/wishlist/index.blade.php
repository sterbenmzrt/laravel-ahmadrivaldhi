@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">Wishlist Saya</h1>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md">
            @if($wishlistItems->count() > 0)
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($wishlistItems as $item)
                        <li x-data="{ removed: false }" x-show="!removed" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 transform -translate-x-8"
                            class="p-6 flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">

                            <div class="w-32 h-32 flex-shrink-0 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="max-h-full w-auto object-contain p-2">
                            </div>

                            <div class="flex-grow text-center md:text-left">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $item->product->name }}</h3>
                                <p class="text-gray-500 dark:text-gray-400">{{ $item->product->category->name ?? 'N/A' }}</p>
                                <p class="text-lg font-bold text-blue-800 dark:text-blue-400 mt-2">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                            </div>

                            <div class="flex items-center space-x-4">
                                <button @click="
                                    fetch('{{ route('cart.add', $item->product) }}', {
                                        method: 'POST',
                                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json', 'Accept': 'application/json'},
                                        body: JSON.stringify({ quantity: 1, final_price: {{ $item->product->price }} })
                                    }).then(res => {
                                        if (res.ok) {
                                            removed = true;
                                            window.dispatchEvent(new CustomEvent('notify', { detail: { message: 'Produk dipindahkan ke keranjang.' } }));
                                        }
                                    })"
                                    class="px-4 py-2 bg-blue-800 text-white font-semibold rounded-lg shadow-md hover:bg-blue-900 transition">
                                    Pindah ke Keranjang
                                </button>
                                <button @click="
                                    fetch('{{ route('wishlist.toggle', $item->product) }}', {
                                        method: 'POST',
                                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                                    }).then(() => { removed = true; })"
                                    class="text-gray-400 hover:text-red-500" title="Hapus dari Wishlist">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="text-center py-16">
                    <p class="text-xl text-gray-500 dark:text-gray-400">Wishlist Anda masih kosong.</p>
                    <a href="{{ route('products') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Cari produk untuk ditambahkan!</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
