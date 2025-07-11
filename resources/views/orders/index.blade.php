@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">Riwayat Pesanan Saya</h1>

        <div class="space-y-6">
            @forelse($orders as $order)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6 flex flex-col md:flex-row justify-between items-center">
                        <div class="mb-4 md:mb-0">
                            <div class="font-bold text-lg text-gray-900 dark:text-white">Order #{{ $order->id }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Tanggal: {{ $order->created_at->format('d M Y') }}</div>
                        </div>
                        <div class="flex items-center space-x-6">
                            <div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Total</div>
                                <div class="font-bold text-gray-900 dark:text-white">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Status</div>
                                <span class="px-3 py-1 text-sm font-semibold rounded-full
                                    @if($order->status == 'completed') bg-green-200 text-green-800 @elseif($order->status == 'processing') bg-yellow-200 text-yellow-800 @else bg-gray-200 text-gray-800 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <a href="{{ route('orders.show', $order) }}" class="px-4 py-2 bg-blue-800 text-white font-semibold rounded-lg shadow-md hover:bg-blue-900 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <p class="text-xl text-gray-500 dark:text-gray-400">Anda belum memiliki riwayat pesanan.</p>
                    <a href="{{ route('products') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Mulai belanja sekarang!</a>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
