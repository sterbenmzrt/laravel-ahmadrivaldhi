@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-gray-200">Semua Produk</h1>
    <p class="text-gray-600 dark:text-gray-400 mb-8">Jelajahi semua akun premium yang kami tawarkan.</p>

    <form method="GET" action="{{ route('products') }}" class="mb-10 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div class="md:col-span-2">
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cari Produk</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="mt-1 block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Contoh: ChatGPT Plus">
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Semua</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-150">
                    Filter
                </button>
                <a href="{{ route('products') }}" class="w-full text-center px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 font-semibold rounded-lg shadow-md hover:bg-gray-400 dark:hover:bg-gray-500 transition duration-150">
                    Reset
                </a>
            </div>
        </div>
    </form>

    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($products as $product)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden group transition-transform duration-300 ease-in-out hover:-translate-y-2">
                <a href="{{ route('products.show', $product) }}">
                    <div class="relative">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-contain p-4 bg-gray-100 dark:bg-gray-700">
                        <div class="absolute inset-0 bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <p class="text-white text-lg font-bold">Lihat Detail</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate" title="{{ $product->name }}">{{ $product->name }}</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ $product->category->name }}</p>
                        <p class="text-xl font-bold text-gray-800 dark:text-gray-200 mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-300">Produk Tidak Ditemukan</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Coba ubah kata kunci pencarian atau filter Anda.</p>
        </div>
    @endif
</div>
@endsection