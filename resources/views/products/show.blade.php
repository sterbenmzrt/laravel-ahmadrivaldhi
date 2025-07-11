@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12"> {{-- Penyesuaian: Menambah jarak dari navbar --}}
        <div class="max-w-5xl mx-auto" x-data="productCheckout({
            basePrice: {{ $product->price }},
            maxMembers: 4,
            groupDiscount: 0.20
        })">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                {{-- Kolom Kiri: Detail Produk & Skema Grup --}}
                <div>
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-6">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-80 object-contain p-4">
                    </div>

                    <div class="mb-8">
                        <div class="flex justify-between items-start">
                            <div>
                                <span
                                    class="text-sm text-gray-500 dark:text-gray-400">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                <h1 class="text-4xl font-bold text-gray-800 dark:text-white mt-1">{{ $product->name }}</h1>
                            </div>
                            <div x-data="{
                                isInWishlist: {{ $isInWishlist ? 'true' : 'false' }},
                                isLoading: false,
                                toggleWishlist() {
                                    this.isLoading = true;
                                    fetch('{{ route('wishlist.toggle', $product) }}', {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                                'Content-Type': 'application/json',
                                                'Accept': 'application/json',
                                            },
                                        })
                                        .then(res => res.json())
                                        .then(data => {
                                            this.isInWishlist = (data.status === 'added');
                                            window.dispatchEvent(new CustomEvent('notify', { detail: { message: data.message } }));
                                            this.isLoading = false;
                                        })
                                        .catch(() => {
                                            this.isLoading = false;
                                            alert('Oops! Something went wrong.');
                                        });
                                }
                            }">
                                <button @click="toggleWishlist()" :disabled="isLoading"
                                    class="p-2 rounded-full text-gray-400 transition"
                                    :class="{ 'text-red-500 bg-red-100': isInWishlist, 'hover:text-red-500 hover:bg-red-100': !
                                            isInWishlist }">
                                    <svg class="w-7 h-7" :class="{ 'fill-current': isInWishlist }" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 mt-4">
                            {{ $product->description }}
                        </p>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Pilih Skema Patungan</h2>
                        <div class="space-y-3">
                            <template x-for="i in maxMembers" :key="i">
                                <label @click="selectedMembers = i"
                                    :class="{ 'border-blue-800 bg-blue-50 dark:bg-blue-900/50': selectedMembers ===
                                        i, 'border-gray-300 dark:border-gray-600': selectedMembers !== i }"
                                    class="flex items-center p-4 border-2 rounded-lg cursor-pointer transition-all duration-200">
                                    <input type="radio" name="group_scheme" :value="i"
                                        x-model="selectedMembers" class="h-5 w-5 text-blue-800 focus:ring-blue-700">
                                    <span class="ml-4 text-gray-700 dark:text-gray-200">
                                        <span class="font-bold" x-text="i"></span> Anggota
                                        <span x-show="i === maxMembers"
                                            class="text-xs ml-2 bg-green-200 text-green-800 font-bold px-2 py-0.5 rounded-full">HARGA
                                            TERMURAH</span>
                                    </span>
                                </label>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Rincian Harga & Checkout --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 self-start sticky top-28">
                    <h2 class="text-2xl font-semibold border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">Rincian Harga
                    </h2>
                    <div class="space-y-3 text-lg">
                        <div class="flex justify-between"><span class="text-gray-600 dark:text-gray-400">Harga per
                                Anggota</span><span class="font-bold text-gray-900 dark:text-white"
                                x-text="formatRupiah(pricePerMember)"></span></div>
                        <div class="flex justify-between"><span class="text-gray-600 dark:text-gray-400">Jumlah
                                Anggota</span><span class="font-bold text-gray-900 dark:text-white"
                                x-text="selectedMembers"></span></div>
                        <div class="border-t border-gray-200 dark:border-gray-700 my-4"></div>
                        <div class="flex justify-between text-2xl font-bold"><span
                                class="text-gray-900 dark:text-white">Total Bayar</span><span
                                class="text-blue-800 dark:text-blue-400" x-text="formatRupiah(totalPrice)"></span></div>
                    </div>
                    <p class="text-xs text-center text-gray-500 dark:text-gray-400 my-4">*Harga akan lebih murah jika
                        membeli dalam grup penuh (4 orang).</p>
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <input type="hidden" name="final_price" :value="pricePerMember">
                        <input type="hidden" name="quantity" :value="selectedMembers">
                        <button type="submit"
                            class="w-full bg-blue-800 text-white font-bold py-4 px-6 rounded-lg shadow-lg hover:bg-blue-900 transition duration-300 text-xl">Beli
                            Sekarang</button>
                    </form>

                    {{-- Tombol Share Media Sosial --}}
                    <div class="mt-8 text-center">
                        <h3 class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-3">Bagikan Produk Ini</h3>
                        <div class="flex justify-center space-x-4">
                            @php
                                $shareText = urlencode(
                                    'Dapatkan ' . $product->name . ' dengan harga terjangkau di Ramean.id!',
                                );
                                $shareUrl = urlencode(url()->current());
                            @endphp
                            <a href="https://api.whatsapp.com/send?text={{ $shareText }}%20{{ $shareUrl }}"
                                target="_blank" class="text-gray-400 hover:text-green-500 transition">
                                <p>WhatsApp</p>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank"
                                class="text-gray-400 hover:text-blue-600 transition">
                                <p>Facebook</p>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}"
                                target="_blank" class="text-gray-400 hover:text-blue-400 transition">
                                <p>Twitter</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
