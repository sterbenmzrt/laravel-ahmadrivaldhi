@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-200">Product List</h1>

<div class="mb-6 flex justify-end">
    <a href="{{ route('products.create') }}" class="inline-block px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-150">
        Add New Product
    </a>
</div>

<form method="GET" action="{{ route('products') }}" class="mb-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div>
            <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search Products</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Name or description">
        </div>
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
            <select name="category_id" id="category_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="min_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Min Price</label>
            <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="0.00" step="0.01">
        </div>
        <div>
            <label for="max_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Max Price</label>
            <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Any" step="0.01">
        </div>
        <div>
            <label for="sort_by" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sort By</label>
            <select name="sort_by" id="sort_by" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="name" {{ request('sort_by', 'name') == 'name' ? 'selected' : '' }}>Name</option>
                <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Price</option>
                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Newest</option>
            </select>
        </div>
        <div>
            <label for="sort_direction" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Direction</label>
            <select name="sort_direction" id="sort_direction" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="asc" {{ request('sort_direction', 'asc') == 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>
        </div>
    </div>
    <div class="mt-6 flex items-center justify-start space-x-3">
        <button type="submit" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-150">Filter</button>
        <a href="{{ route('products') }}" class="px-6 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 font-semibold rounded-lg shadow-md hover:bg-gray-400 dark:hover:bg-gray-500 transition duration-150">Reset</a>
    </div>
</form>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($products as $product)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $product->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $product->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 max-w-xs truncate" title="{{ $product->description }}">{{ Str::limit($product->description, 50) }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${{ number_format($product->price, 2) }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $product->category->name ?? 'N/A' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                    <a href="{{ route('products.show', $product) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">View</a>
                    <a href="{{ route('products.edit', $product) }}" class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">No products found matching your criteria.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">
    {{ $products->links() }}
</div>
@endsection