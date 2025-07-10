@extends('layouts.app')

@section('content')
    <div class="container mx-auto">

        <section
            class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-16 sm:py-20 md:py-24 rounded-xl shadow-2xl mb-12 text-center">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-4 leading-tight">
                    Discover Your Next Favorite Thing
                </h1>
                <p class="text-lg sm:text-xl md:text-2xl mb-8 max-w-2xl mx-auto opacity-90">
                    Browse our curated collection of high-quality products.
                </p>
                <div class="flex justify-center">
                    <a href="{{ route('products') }}"
                        class="bg-white text-indigo-700 font-bold py-3 px-10 rounded-lg shadow-lg hover:bg-gray-100 transform hover:scale-105 transition duration-300 ease-in-out text-lg">
                        Shop All Products
                    </a>
                </div>
            </div>
        </section>

        <section class="mb-12 py-6">
            <form method="GET" action="{{ route('products') }}"
                class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md flex items-center">
                <input
                    class="appearance-none bg-transparent border-none w-full text-gray-700 dark:text-gray-200 mr-3 py-2 px-3 leading-tight focus:outline-none"
                    type="text" name="search" placeholder="Search for products..." aria-label="Search products">
                <button
                    class="flex-shrink-0 bg-green-500 hover:bg-green-600 border-green-500 hover:border-green-600 text-sm font-semibold border-4 text-white py-2 px-4 rounded-lg transition duration-150"
                    type="submit">
                    Search
                </button>
            </form>
        </section>

        @if ($featuredProducts->count() > 0)
            <section class="mb-16">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Featured Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($featuredProducts as $product)
                        <div
                            class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden group transform hover:shadow-2xl transition-all duration-300">
                            {{-- Tampilkan gambar logo --}}
                            <div class="w-full h-56 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                    class="h-full w-full object-contain p-4">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 truncate">
                                    {{ $product->name }}</h3>
                                {{-- ... --}}
                                {{-- Ubah format harga --}}
                                <p class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>
                                {{-- ... --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($categories->count() > 0)
            <section class="mb-12 py-8 bg-gray-50 dark:bg-gray-800/50 rounded-xl shadow">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Shop by Category</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-4">
                    @foreach ($categories as $category)
                        <a href="{{ route('products', ['category_id' => $category->id]) }}"
                            class="block bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-xl hover:bg-indigo-50 dark:hover:bg-gray-700 transition-all duration-300 transform hover:scale-105">
                            <h3 class="text-xl font-semibold text-indigo-700 dark:text-indigo-400 mb-2">
                                {{ $category->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $category->products_count }} Products</p>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

    </div>
@endsection
