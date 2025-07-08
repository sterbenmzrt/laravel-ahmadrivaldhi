@extends('layouts.app')

@section('content')
<div class="container mx-auto">

    <section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-16 sm:py-20 md:py-24 rounded-xl shadow-2xl mb-12 text-center">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-4 leading-tight">
                Discover Your Next Favorite Thing
            </h1>
            <p class="text-lg sm:text-xl md:text-2xl mb-8 max-w-2xl mx-auto opacity-90">
                Browse our curated collection of high-quality products.
            </p>
            <div class="flex justify-center">
                 <a href="{{ route('products') }}" class="bg-white text-indigo-700 font-bold py-3 px-10 rounded-lg shadow-lg hover:bg-gray-100 transform hover:scale-105 transition duration-300 ease-in-out text-lg">
                    Shop All Products
                </a>
            </div>
        </div>
    </section>

    <section class="mb-12 py-6">
        <form method="GET" action="{{ route('products') }}" class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md flex items-center">
            <input class="appearance-none bg-transparent border-none w-full text-gray-700 dark:text-gray-200 mr-3 py-2 px-3 leading-tight focus:outline-none" type="text" name="search" placeholder="Search for products..." aria-label="Search products">
            <button class="flex-shrink-0 bg-green-500 hover:bg-green-600 border-green-500 hover:border-green-600 text-sm font-semibold border-4 text-white py-2 px-4 rounded-lg transition duration-150" type="submit">
                Search
            </button>
        </form>
    </section>

    @if($featuredProducts->count() > 0)
    <section class="mb-16">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Featured Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($featuredProducts as $product)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden group transform hover:shadow-2xl transition-all duration-300">
                <div class="w-full h-56 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-400">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 truncate group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-300">{{ $product->name }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mb-1">
                        Category: <span class="font-medium text-indigo-500 dark:text-indigo-400">{{ $product->category->name ?? 'N/A' }}</span>
                    </p>
                    <p class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">${{ number_format($product->price, 2) }}</p>
                    <a href="{{ route('products.show', $product) }}" class="inline-block w-full text-center bg-indigo-600 text-white text-md font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 transform group-hover:scale-105">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    @if($categories->count() > 0)
    <section class="mb-12 py-8 bg-gray-50 dark:bg-gray-800/50 rounded-xl shadow">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">Shop by Category</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-4">
            @foreach ($categories as $category)
            <a href="{{ route('products', ['category_id' => $category->id]) }}" class="block bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-xl hover:bg-indigo-50 dark:hover:bg-gray-700 transition-all duration-300 transform hover:scale-105">
                <h3 class="text-xl font-semibold text-indigo-700 dark:text-indigo-400 mb-2">{{ $category->name }}</h3>
                <p class="text-gray-600 dark:text-gray-400">{{ $category->products_count }} Products</p>
            </a>
            @endforeach
        </div>
    </section>
    @endif

</div>
@endsection