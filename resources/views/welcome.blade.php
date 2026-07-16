<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Kayu - Kerajinan Tangan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 antialiased font-sans">

    <!-- Navbar Utama (KONSISTEN) -->
    <nav class="bg-brand-primary text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ url('/') }}" class="flex-shrink-0 font-bold text-2xl tracking-wider">
                    <span class="text-brand-accent">KAYU</span>KRAFT
                </a>
                
                <div class="flex items-center">
                    @auth
                        <!-- Menu Belanja -->
                        <div class="hidden sm:flex items-center space-x-6 mr-6 pr-6 border-r border-gray-500">
                            <a href="{{ url('/') }}" class="text-sm font-medium hover:text-brand-accent transition flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                Katalog
                            </a>
                            <a href="{{ route('cart.index') }}" class="text-sm font-medium hover:text-brand-accent transition flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Keranjang
                            </a>
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-brand-accent transition flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                Riwayat Pesanan
                            </a>
                        </div>

                        <!-- Info User & Logout -->
                        <div class="flex items-center space-x-4">
                            <div class="text-right hidden md:block">
                                <p class="text-xs text-gray-400">Masuk sebagai,</p>
                                <p class="text-sm font-bold leading-tight">{{ Auth::user()->name }}</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="inline m-0">
                                @csrf
                                <button type="submit" class="bg-gray-700 border border-gray-600 text-white px-4 py-2 rounded-md text-sm font-bold hover:bg-red-500 hover:border-red-500 transition shadow-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Pengunjung Belum Login -->
                        <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-brand-accent transition mr-4">Log in</a>
                        <a href="{{ route('register') }}" class="bg-brand-accent text-brand-primary px-4 py-2 rounded-md text-sm font-bold hover:bg-yellow-500 transition">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- AREA NOTIFIKASI -->
    @if(session('success'))
        <div class="bg-green-500 text-white text-center py-2 font-bold shadow-sm">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-500 text-white text-center py-2 font-bold shadow-sm">{{ session('error') }}</div>
    @endif

    <!-- Hero Section -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-extrabold text-brand-primary mb-4">Kerajinan Tangan Kualitas Premium</h1>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">Temukan koleksi furnitur dan dekorasi dari bahan kayu, rotan, dan sintetis terbaik untuk memperindah ruangan Anda.</p>
            <a href="#katalog" class="bg-brand-primary text-white px-6 py-3 rounded-md font-semibold hover:bg-opacity-90 transition shadow-lg">Lihat Katalog</a>
        </div>
    </div>

    <!-- Katalog Section -->
    <div id="katalog" class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold text-brand-primary mb-8 border-b-2 border-brand-accent pb-2 inline-block">Produk Terbaru</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $product)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-400 font-bold tracking-widest text-xl">
                        KAYUKRAFT
                    </div>
                    <div class="p-5">
                        <span class="text-xs font-bold text-brand-accent uppercase tracking-wider">{{ $product->category->name }}</span>
                        <h3 class="text-lg font-bold text-brand-primary mt-1">{{ $product->name }}</h3>
                        <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ $product->description }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-xl font-extrabold text-brand-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @auth
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="bg-brand-accent text-brand-primary px-3 py-1 rounded font-bold text-sm hover:bg-yellow-500 transition shadow-sm">+ Keranjang</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="bg-gray-200 text-gray-600 px-3 py-1 rounded font-bold text-sm hover:bg-gray-300 transition shadow-sm">Login untuk Beli</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 py-8">Belum ada produk yang tersedia saat ini.</div>
            @endforelse
        </div>
    </div>
</body>
</html>