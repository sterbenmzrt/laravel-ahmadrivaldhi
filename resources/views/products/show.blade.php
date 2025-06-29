@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
        <p class="text-sm text-gray-500 mb-4">Category: <span
                class="font-semibold">{{ $product->category->name ?? 'N/A' }}</span></p>

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Description</h2>
            <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Price</h2>
            <p class="text-2xl font-bold text-indigo-600">${{ number_format($product->price, 2) }}</p>
        </div>

        <div class="mt-6">
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <div class="flex items-center">
                    <label for="quantity" class="mr-4">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1"
                        class="w-20 border-gray-300 rounded">
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
    </div>
@endsection
