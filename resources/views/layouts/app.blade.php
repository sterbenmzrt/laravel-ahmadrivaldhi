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
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />
</head>
<body class="bg-white text-gray-800 font-sans">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div>
                    <a class="flex items-center" href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Ramean.id Logo" class="h-8 w-auto mr-2">
                        <span class="text-xl font-semibold text-gray-800">
                            {{ config('app.name', 'Laravel') }}
                        </span>
                    </a>
                </div>
                <div class="flex items-center">
                    <a class="px-3 py-2 text-gray-700 hover:text-gray-900 rounded" href="{{ route('products') }}">Produk</a>
                    @auth
                        <a class="px-3 py-2 text-gray-700 hover:text-gray-900 rounded" href="{{ route('wishlist.index') }}">Wishlist</a>
                        <a class="px-3 py-2 text-gray-700" href="{{ route('orders.index') }}">Pesanan Saya</a>
                        <a class="px-3 py-2 text-gray-700" href="/1">Admin</a>
                        <form method="POST" action="{{ route('logout') }}"> @csrf <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="px-3 py-2 text-gray-700 hover:text-gray-900 rounded">Log Out</a></form>
                    @else
                        <a href="{{ route('login') }}" class="px-3 py-2 text-gray-700 hover:text-gray-900 rounded">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-3 py-2 text-gray-700 hover:text-gray-900 rounded">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

</body>
</html>
