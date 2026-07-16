<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keranjang Belanja - KayuKraft</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans">

    <!-- Navbar Utama (KONSISTEN) -->
    <nav class="bg-brand-primary text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ url('/') }}" class="flex-shrink-0 font-bold text-2xl tracking-wider">
                    <span class="text-brand-accent">KAYU</span>KRAFT
                </a>
                
                <div class="flex items-center">
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
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Keranjang -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-extrabold text-brand-primary mb-8 border-b-2 border-brand-accent pb-2 inline-block">Keranjang Belanja</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded mb-6 font-bold shadow-sm">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-500 text-white px-4 py-2 rounded mb-6 font-bold shadow-sm">{{ session('error') }}</div>
        @endif

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-brand-primary text-white text-sm uppercase tracking-wider">
                        <th class="px-6 py-4">Produk</th>
                        <th class="px-6 py-4">Harga</th>
                        <th class="px-6 py-4 text-center">Kuantitas</th>
                        <th class="px-6 py-4">Subtotal</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php $grandTotal = 0; @endphp
                    @forelse($carts as $cart)
                        @php
                            $subtotal = $cart->product->price * $cart->quantity;
                            $grandTotal += $subtotal;
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-bold text-brand-primary">{{ $cart->product->name }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 font-semibold text-center">{{ $cart->quantity }}</td>
                            <td class="px-6 py-4 font-extrabold text-brand-primary">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-100 text-red-600 px-3 py-1 rounded text-sm font-bold hover:bg-red-600 hover:text-white transition">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 font-medium text-lg">
                                Keranjang masih kosong. <br>
                                <a href="{{ url('/') }}" class="text-brand-accent hover:underline mt-2 inline-block">Yuk, lihat katalog produk!</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($carts->count() > 0)
        <div class="mt-8 bg-white p-6 rounded-lg shadow-sm border border-gray-200 flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm font-bold uppercase tracking-wider">Total Tagihan Sementara</p>
                <p class="text-3xl font-extrabold text-brand-primary mt-1">Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>
            </div>
            <div>
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-brand-primary text-brand-accent px-8 py-3 rounded-md font-bold text-lg hover:bg-opacity-90 transition shadow-lg">Lanjut ke Pembayaran</button>
                </form>
            </div>
        </div>
        @endif
    </div>
</body>
</html>