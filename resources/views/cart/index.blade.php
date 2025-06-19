@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Your Shopping Cart</h1>

    @if($cartItems->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($cartItems as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${{ number_format($item->product->price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" class="w-16 border-gray-300 rounded" min="1">
                                    <button type="submit" class="ml-2 text-sm text-blue-600 hover:text-blue-800">Update</button>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 text-right">
            <p class="text-xl font-semibold">Total: <span class="text-green-600">${{ number_format($subtotal, 2) }}</span></p>
            <a href="{{ route('checkout.create') }}" class="mt-4 inline-block px-8 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700">
                Proceed to Checkout
            </a>
        </div>
    @else
        <p class="text-center text-gray-500">Your cart is empty.</p>
        <div class="text-center mt-4">
            <a href="{{ route('products') }}" class="text-blue-600 hover:text-blue-800">Continue Shopping</a>
        </div>
    @endif
</div>
@endsection
