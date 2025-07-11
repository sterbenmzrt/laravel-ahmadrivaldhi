@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Detail Pesanan #{{ $order->id }}</h1>
            <p class="text-gray-600 dark:text-gray-400">Dipesan pada {{ $order->created_at->format('d F Y, H:i') }}</p>
        </div>
        <span class="px-3 py-1 text-sm font-semibold rounded-full
            @if($order->status == 'completed') bg-green-200 text-green-800 @elseif($order->status == 'processing') bg-yellow-200 text-yellow-800 @else bg-gray-200 text-gray-800 @endif">
            {{ ucfirst($order->status) }}
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <div>
            <h2 class="text-xl font-semibold mb-2 text-gray-700 dark:text-gray-300">Info Pembayaran</h2>
            <p class="text-gray-600 dark:text-gray-400">Metode: {{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</p>
        </div>
    </div>

    <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white">Rincian Produk</h2>
    <div class="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Kuantitas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Harga Satuan</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Subtotal</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($order->items as $item)
                <tr>
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $item->product->name }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $item->quantity }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-right font-medium text-gray-900 dark:text-white">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gray-50 dark:bg-gray-700">
                    <td colspan="3" class="text-right px-6 py-4 font-bold text-gray-900 dark:text-white text-lg">Total Pesanan</td>
                    <td class="px-6 py-4 text-right font-bold text-gray-900 dark:text-white text-lg">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="mt-8">
        <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">&larr; Kembali ke Riwayat Pesanan</a>
    </div>
</div>
@endsection
