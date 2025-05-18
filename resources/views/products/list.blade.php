@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Product List</h1>

<a href="{{ route('products.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
    Add new product
</a>

<table class="min-w-full bg-white rounded shadow overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="py-2 px-4 border-b">ID</th>
            <th class="py-2 px-4 border-b">Name</th>
            <th class="py-2 px-4 border-b">Description</th>
            <th class="py-2 px-4 border-b">Price</th>
            <th class="py-2 px-4 border-b">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr class="hover:bg-gray-100">
            <td class="py-2 px-4 border-b">{{ $product['id'] }}</td>
            <td class="py-2 px-4 border-b">{{ $product['name'] }}</td>
            <td class="py-2 px-4 border-b">{{ $product['description'] }}</td>
            <td class="py-2 px-4 border-b">${{ $product['price'] }}</td>
            <td class="py-2 px-4 border-b space-x-2">
                <a href="{{ route('products.show', $product['id']) }}" class="text-blue-600 hover:underline">View</a>
                <a href="{{ route('products.edit', $product['id']) }}" class="text-yellow-600 hover:underline">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
