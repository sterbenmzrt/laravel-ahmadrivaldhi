@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">Your Wishlist</h1>

    @if($wishlistItems->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($wishlistItems as $item)
                <div class="bg-white dark:bg-gray-700 rounded-xl shadow-lg overflow-hidden group transform hover:shadow-2xl transition-all duration-300">
                    {{-- Placeholder untuk gambar --}}
                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-gray-400">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 truncate">{{ $item->product->name }}</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-2">
                            {{ $item->product->category->name ?? 'N/A' }}
                        </p>
                        <p class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-3">${{ number_format($item->product->price, 2) }}</p>
                        <div class="flex items-center justify-between">
                            <a href="{{ route('products.show', $item->product) }}" class="text-sm text-center bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">
                                View
                            </a>
                            <form action="{{ route('wishlist.toggle', $item->product) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300" title="Remove from wishlist">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-500 dark:text-gray-400">Your wishlist is empty.</p>
        <div class="text-center mt-4">
            <a href="{{ route('products') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Find something to love</a>
        </div>
    @endif
</div>
@endsection