<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{-- Kode Anda untuk CSRF token sudah benar, ini praktik yang bagus --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Fonts & Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    {{-- Kita gunakan font 'Instrument Sans' agar konsisten dengan proyek awal --}}
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>
<body class="bg-gray-100 min-h-screen font-sans">

    {{-- Navigasi ditempatkan di sini agar muncul di setiap halaman --}}
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div>
                    <a class="text-xl font-semibold text-gray-800 hover:text-gray-900" href="{{ route('home') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <div class="flex items-center">
                    <a class="px-3 py-2 text-gray-700 hover:text-gray-900 rounded" href="{{ route('home') }}">Home</a>
                    <a class="px-3 py-2 text-gray-700 hover:text-gray-900 rounded" href="{{ route('products') }}">Products</a>

                    @auth
                        {{-- Link ini hanya muncul jika user sudah login --}}
                        <a class="px-3 py-2 text-gray-700 hover:text-gray-900 rounded" href="{{ route('cart.index') }}">Cart</a>
                        <a class="px-3 py-2 text-gray-700" href="{{ route('orders.index') }}">My Orders</a>
                        <span class="px-3 py-2 text-gray-500">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="px-3 py-2 text-gray-700 hover:text-gray-900 rounded">
                                Log Out
                            </a>
                        </form>
                    @else
                        {{-- Link ini hanya muncul untuk tamu (belum login) --}}
                        <a href="{{ route('login') }}" class="px-3 py-2 text-gray-700 hover:text-gray-900 rounded">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-3 py-2 text-gray-700 hover:text-gray-900 rounded">Register</a>
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
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
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
