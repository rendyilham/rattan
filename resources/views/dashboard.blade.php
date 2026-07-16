<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Pesanan - KayuKraft</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">

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

    <!-- Konten Riwayat Pesanan -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex justify-between items-end mb-8 border-b-2 border-brand-accent pb-2">
            <h2 class="text-3xl font-extrabold text-brand-primary">Riwayat Pesanan Saya</h2>
            <span class="text-gray-500 text-sm font-medium">Memantau status pengiriman paket Anda</span>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                        <th class="px-6 py-4">ID Pesanan</th>
                        <th class="px-6 py-4">Tanggal Pesan</th>
                        <th class="px-6 py-4">Total Belanja</th>
                        <th class="px-6 py-4">Status Pengiriman</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($transactions as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-bold text-brand-primary">{{ $order->order_id }}</td>
                        <td class="px-6 py-4 text-gray-600 font-medium">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 font-extrabold text-brand-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @php
                                $color = 'bg-gray-200 text-gray-700 border-gray-300';
                                $status = trim($order->status);
                                if($status == 'Menunggu Pembayaran') $color = 'bg-yellow-100 text-yellow-700 border-yellow-200';
                                if($status == 'Pembayaran Dikonfirmasi') $color = 'bg-blue-100 text-blue-700 border-blue-200';
                                if($status == 'Diproses') $color = 'bg-purple-100 text-purple-700 border-purple-200';
                                if($status == 'Dikirim') $color = 'bg-indigo-100 text-indigo-700 border-indigo-200';
                                if($status == 'Selesai') $color = 'bg-green-100 text-green-700 border-green-200';
                                if($status == 'Dibatalkan') $color = 'bg-red-100 text-red-700 border-red-200';
                            @endphp
                            <span class="{{ $color }} border text-xs px-3 py-1.5 rounded-md font-bold uppercase tracking-wider inline-block">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500 font-medium text-lg">
                            Anda belum memiliki riwayat pesanan. <br>
                            <a href="{{ url('/') }}" class="text-brand-accent hover:underline mt-2 inline-block">Yuk, mulai belanja di katalog!</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>