@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12"> {{-- Penyesuaian: Menambah padding vertikal --}}

    <div class="flex flex-col md:flex-row justify-between items-center mb-12">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4 md:mb-0">Semua Produk</h1>

        <div class="w-full md:w-auto">
            <form method="GET" action="{{ route('products') }}" class="flex items-center bg-white dark:bg-gray-800 rounded-lg shadow p-2 space-x-2">
                <div class="relative flex-grow">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 border-none rounded-md focus:ring-0 bg-transparent dark:text-white" placeholder="Cari akun...">
                </div>
                <select name="category_id" onchange="this.form.submit()" class="border-none rounded-md focus:ring-0 bg-gray-100 dark:bg-gray-700 dark:text-white cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-8">
        @forelse ($products as $product)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden group transform hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                <div class="w-full h-48 bg-gray-100 dark:bg-gray-700 flex items-center justify-center p-4">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="max-h-full w-auto object-contain transition-transform duration-300 group-hover:scale-110">
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $product->category->name ?? 'N/A' }}</p>
                    <div class="mt-auto pt-4">
                        <a href="{{ route('products.show', $product) }}" class="block w-full text-center bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-900 transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20">
                <p class="text-xl text-gray-500 dark:text-gray-400">Oops! Produk yang Anda cari tidak ditemukan.</p>
                <a href="{{ route('products') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Lihat semua produk</a>
            </div>
        @endforelse
    </div>

    <div class="mt-16">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
