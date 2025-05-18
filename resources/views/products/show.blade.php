@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow-md max-w-lg">
    <h1 class="text-3xl font-bold mb-4">{{ $product['name'] }}</h1>
    <p class="mb-2"><strong>Description:</strong> {{ $product['description'] }}</p>
    <p class="mb-4"><strong>Price:</strong> ${{ $product['price'] }}</p>
    <a href="{{ route('products') }}" class="text-blue-600 hover:underline">Back to List</a>
</div>
@endsection
