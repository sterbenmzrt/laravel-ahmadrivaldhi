@extends('layouts.app')

@section('content')
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $product->name }}</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Category: <span
                class="font-semibold text-indigo-500 dark:text-indigo-400">{{ $product->category->name ?? 'N/A' }}</span>
        </p>

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">Description</h2>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $product->description }}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">Price</h2>
            <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        </div>

        <div class="mt-6">
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <div class="flex items-center">
                    <label for="quantity" class="mr-4 text-gray-700 dark:text-gray-300">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1"
                        class="w-20 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 rounded">
                    <button type="submit"
                        class="ml-4 px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700">Add
                        to Cart</button>
                </div>
            </form>
        </div>

        <div class="mt-8 flex items-center space-x-4">
            <a href="{{ route('products') }}"
                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-150">Back
                to List</a>
            <a href="{{ route('products.edit', $product) }}"
                class="px-6 py-2 bg-yellow-500 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-600 transition duration-150">Edit
                Product</a>
        </div>
        {{-- ... setelah form Add to Cart --}}
        <div class="mt-4">
            <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex items-center text-gray-600 dark:text-gray-300 hover:text-red-500 dark:hover:text-red-400 transition duration-150">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                    Add to Wishlist
                </button>
            </form>
        </div>
    </div>
@endsection
