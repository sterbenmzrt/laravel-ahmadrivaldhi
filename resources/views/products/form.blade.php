@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h1>

    <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" method="POST">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label for="name" class="block mb-1 font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <div class="mb-4">
            <label for="category_id" class="block mb-1 font-medium text-gray-700">Category</label>
            <select name="category_id" id="category_id" required class="w-full px-4 py-2 border border-gray-300 bg-white rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="description" class="block mb-1 font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $product->description ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="price" class="block mb-1 font-medium text-gray-700">Price</label>
            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price ?? '') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <div class="mt-6 flex items-center space-x-4">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-150">
                {{ isset($product) ? 'Update Product' : 'Create Product' }}
            </button>
            <a href="{{ route('products') }}" class="px-6 py-2 bg-gray-300 text-gray-700 font-semibold rounded-lg shadow-md hover:bg-gray-400 transition duration-150">Cancel</a>
        </div>
    </form>
</div>
@endsection
