<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="themeSwitcher"
      :class="{ 'dark': dark }">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-200 font-sans">
    
    {{-- Navigasi ditempatkan di sini agar muncul di setiap halaman --}}
    <nav class="bg-white dark:bg-gray-800 shadow-md">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div>
                    <a class="text-xl font-semibold text-gray-800 dark:text-white hover:text-gray-900" href="{{ route('home') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <div class="flex items-center">
                    
                    {{-- TOMBOL THEME SWITCHER --}}
                    <button @click="toggleTheme" class="mr-4 text-gray-600 dark:text-gray-300 focus:outline-none">
                        <svg x-show="!dark" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        <svg x-show="dark" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </button>
                    
                    <a class="px-3 py-2 text-gray-700 dark:text-gray-200 hover:text-gray-900 rounded" href="{{ route('home') }}">Home</a>
                    <a class="px-3 py-2 text-gray-700 dark:text-gray-200 hover:text-gray-900 rounded" href="{{ route('products') }}">Products</a>

                    @auth
                        {{-- Link ini hanya muncul jika user sudah login --}}
                        <a class="px-3 py-2 text-gray-700 dark:text-gray-200 hover:text-gray-900 rounded" href="{{ route('wishlist.index') }}">Wishlist</a>
                        <a class="px-3 py-2 text-gray-700 dark:text-gray-200 hover:text-gray-900 rounded" href="{{ route('cart.index') }}">Cart</a>
                        <a class="px-3 py-2 text-gray-700 dark:text-gray-200" href="{{ route('orders.index') }}">My Orders</a>
                        <span class="px-3 py-2 text-gray-500 dark:text-gray-400">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="px-3 py-2 text-gray-700 dark:text-gray-200 hover:text-gray-900 rounded">
                                Log Out
                            </a>
                        </form>
                    @else
                        {{-- Link ini hanya muncul untuk tamu (belum login) --}}
                        <a href="{{ route('login') }}" class="px-3 py-2 text-gray-700 dark:text-gray-200 hover:text-gray-900 rounded">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-3 py-2 text-gray-700 dark:text-gray-200 hover:text-gray-900 rounded">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Konten Utama Halaman --}}
    <main class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        {{-- Bagian untuk menampilkan notifikasi (success, error, dll.) --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-200 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-200 rounded">
                <strong class="font-bold">Oops! Something went wrong.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Di sini kita menggunakan @yield agar semua file view lain dapat menampilkan kontennya --}}
        @yield('content')
    </main>

</body>
</html>