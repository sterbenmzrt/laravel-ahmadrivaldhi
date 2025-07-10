@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto"
     x-data="productCheckout({ basePrice: {{ $product->price }}, maxMembers: 4, groupDiscount: 0.20 })">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-6">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-80 object-contain p-4">
            </div>
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-2">{{ $product->name }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Category: <span class="font-semibold text-brand-600 dark:text-brand-400">{{ $product->category->name ?? 'N/A' }}</span></p>
                <p class="text-gray-600 dark:text-gray-300 mt-4">{{ $product->description }}</p>
            </div>
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Pilih Skema Patungan</h2>
                <div class="space-y-3">
                    <template x-for="i in maxMembers" :key="i">
                        <label @click="selectedMembers = i"
                               :class="{ 'border-brand-600 bg-brand-50 dark:bg-brand-900/50': selectedMembers === i, 'border-gray-300 dark:border-gray-600': selectedMembers !== i }"
                               class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition-all duration-200">
                            <input type="radio" name="group_scheme" :value="i" x-model="selectedMembers" class="h-5 w-5 text-brand-600 focus:ring-brand-500">
                            <span class="ml-4 text-gray-700 dark:text-gray-200">
                                <span class="font-bold" x-text="i"></span> Anggota
                                <span x-show="i === maxMembers" class="text-xs ml-2 bg-green-200 text-green-800 font-bold px-2 py-0.5 rounded-full">HARGA TERMURAH</span>
                            </span>
                        </label>
                    </template>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 self-start sticky top-8">
            <h2 class="text-2xl font-semibold border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">Rincian Harga</h2>
            <div class="space-y-3 text-lg">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Harga per Anggota</span>
                    <span class="font-bold text-gray-900 dark:text-white" x-text="formatRupiah(pricePerMember)"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Jumlah Anggota</span>
                    <span class="font-bold text-gray-900 dark:text-white" x-text="selectedMembers"></span>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700 my-4"></div>
                <div class="flex justify-between text-2xl font-bold">
                    <span class="text-gray-900 dark:text-white">Total Bayar</span>
                    <span class="text-brand-600 dark:text-brand-400" x-text="formatRupiah(totalPrice)"></span>
                </div>
            </div>
            <p class="text-xs text-center text-gray-500 dark:text-gray-400 my-4">*Harga akan lebih murah jika membeli dalam grup penuh (4 orang).</p>
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <input type="hidden" name="final_price" :value="pricePerMember">
                <input type="hidden" name="quantity" :value="selectedMembers">
                <button type="submit" class="w-full bg-brand-600 text-white font-bold py-4 px-6 rounded-lg shadow-lg hover:bg-brand-700 transition duration-300 text-xl">
                    Beli Sekarang
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
