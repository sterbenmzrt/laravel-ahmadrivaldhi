@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-2">Order #{{ $order->id }}</h1>
    <p class="text-gray-600 mb-6">Placed on {{ $order->created_at->format('F j, Y') }}</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <div>
            <h2 class="text-xl font-semibold mb-2">Shipping Address</h2>
            <p>{{ $order->address->street }}</p>
            <p>{{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->postal_code }}</p>
        </div>
        <div>
            <h2 class="text-xl font-semibold mb-2">Payment Info</h2>
            <p>Method: {{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</p>
            <p>Status: <span class="font-medium text-green-600">{{ ucfirst($order->status) }}</span></p>
        </div>
    </div>

    <h2 class="text-2xl font-semibold mb-4">Items Ordered</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($order->items as $item)
                <tr>
                    <td class="px-6 py-4">{{ $item->product->name }}</td>
                    <td class="px-6 py-4">${{ number_format($item->price, 2) }}</td>
                    <td class="px-6 py-4">{{ $item->quantity }}</td>
                    <td class="px-6 py-4">${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right px-6 py-4 font-bold text-lg">Total</td>
                    <td class="px-6 py-4 font-bold text-lg">${{ number_format($order->total_amount, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="mt-8">
        <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800">&larr; Back to My Orders</a>
    </div>
</div>
@endsection
