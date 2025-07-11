<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>

<body class="bg-white text-gray-800 font-sans">

    {{-- Navbar Baru dengan Styling Badge --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                {{-- Logo dan Nama Aplikasi --}}
                <div>
                    <a class="flex items-center" href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Ramean.id Logo" class="h-8 w-auto mr-2">
                        <span class="text-xl font-semibold text-gray-800">
                            {{ config('app.name', 'Laravel') }}
                        </span>
                    </a>
                </div>

                {{-- Menu Navigasi Baru --}}
                <div class="flex items-center space-x-2">
                    <a href="{{ route('products') }}"
                        class="px-4 py-2 text-gray-700 hover:text-blue-700 font-medium rounded-lg hover:bg-gray-100 transition">Products</a>
                    <a href="{{ route('faq') }}"
                        class="px-4 py-2 text-gray-700 hover:text-blue-700 font-medium rounded-lg hover:bg-gray-100 transition">FAQ</a>

                    @auth
                        {{-- Menu untuk user yang sudah login --}}
                        <a href="{{ route('wishlist.index') }}"
                            class="px-4 py-2 text-gray-700 hover:text-blue-700 font-medium rounded-lg hover:bg-gray-100 transition">Wishlist</a>
                        <a href="{{ route('cart.index') }}"
                            class="px-4 py-2 text-gray-700 dark:text-gray-200 hover:text-blue-700 font-medium rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">Keranjang</a>
                        <a href="{{ route('orders.index') }}"
                            class="px-4 py-2 text-gray-700 hover:text-blue-700 font-medium rounded-lg hover:bg-gray-100 transition">Pesanan
                            Saya</a>

                        {{-- Dropdown untuk Akun Pengguna --}}
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="px-4 py-2 text-gray-700 hover:text-blue-700 font-medium rounded-lg hover:bg-gray-100 transition flex items-center">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                                <a href="/admin/login" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin
                                    Panel</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Log Out
                                    </a>
                                </form>
                            </div>
                        </div>
                    @else
                        {{-- Menu untuk tamu --}}
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-gray-700 hover:text-blue-700 font-medium rounded-lg hover:bg-gray-100 transition">Login</a>
                        <a href="{{ route('register') }}"
                            class="ml-2 px-4 py-2 bg-blue-800 text-white font-semibold rounded-lg shadow-md hover:bg-blue-900 transition">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <div x-data="toast" x-show="visible" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2" @notify.window="show($event.detail.message)"
        class="fixed bottom-5 right-5 bg-blue-800 text-white py-3 px-5 rounded-lg shadow-lg" style="display: none;">
        <p x-text="message"></p>
    </div>

</body>

</html>
