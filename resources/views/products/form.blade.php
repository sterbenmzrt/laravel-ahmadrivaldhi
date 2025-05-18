@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h1>

<form action="{{ isset($product) ? route('products.update', $product['id']) : route('products.store') }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg">
    @csrf
    <div class="mb-4">
        <label for="name" class="block mb-1 font-medium">Name</label>
        <input type="text" name="name" id="name" value="{{ $product['name'] ?? '' }}" required
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-600" />
    </div>

    <div class="mb-4">
        <label for="description" class="block mb-1 font-medium">Description</label>
        <textarea name="description" id="description" rows="4" required
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-600">{{ $product['description'] ?? '' }}</textarea>
    </div>

    <div class="mb-4">
        <label for="price" class="block mb-1 font-medium">Price</label>
        <input type="number" name="price" id="price" value="{{ $product['price'] ?? '' }}" required
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-600" />
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
        Submit
    </button>
</form>
@endsection
