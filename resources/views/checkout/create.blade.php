@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Checkout</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Kolom Kiri: Form Alamat dan Pembayaran --}}
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-6">Shipping & Payment</h2>
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                {{-- Shipping Address --}}
                <div class="mb-4">
                    <label for="street" class="block mb-1 font-medium">Street</label>
                    <input type="text" name="street" id="street" required class="w-full border-gray-300 rounded">
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="city" class="block mb-1 font-medium">City</label>
                        <input type="text" name="city" id="city" required class="w-full border-gray-300 rounded">
                    </div>
                    <div>
                        <label for="state" class="block mb-1 font-medium">State</label>
                        <input type="text" name="state" id="state" required class="w-full border-gray-300 rounded">
                    </div>
                </div>
                <div class="mb-6">
                    <label for="postal_code" class="block mb-1 font-medium">Postal Code</label>
                    <input type="text" name="postal_code" id="postal_code" required class="w-full border-gray-300 rounded">
                </div>

                {{-- Payment Method --}}
                <div class="mb-6">
                     <label for="payment_method" class="block mb-1 font-medium">Payment Method</label>
                     <select name="payment_method" id="payment_method" required class="w-full border-gray-300 rounded">
                         <option value="bank_transfer">Bank Transfer</option>
                         <option value="credit_card">Credit Card (Dummy)</option>
                         <option value="cod">Cash on Delivery</option>
                     </select>
                </div>

                <button type="submit" class="w-full px-8 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700">
                    Place Order
                </button>
            </form>
        </div>

        {{-- Kolom Kanan: Ringkasan Order --}}
        <div class="bg-gray-50 p-8 rounded-lg shadow-inner">
            <h2 class="text-2xl font-semibold mb-6">Order Summary</h2>
            <div class="space-y-4">
                @foreach($cartItems as $item)
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-semibold">{{ $item->product->name }}</p>
                        <p class="text-sm text-gray-600">Qty: {{ $item->quantity }}</p>
                    </div>
                    <p class="font-medium">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                </div>
                @endforeach
            </div>
            <hr class="my-6">
            <div class="flex justify-between font-bold text-xl">
                <span>Total</span>
                <span>${{ number_format($subtotal, 2) }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
