<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Pemesanan - Rattan Handmade</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; padding: 0; }
        html { overflow-y: scroll; } /* <-- Ini adalah kunci ajaibnya */
        body { background-color: #FDFBF7; color: #1f2937; line-height: 1.6; min-height: 100vh; display: flex; flex-direction: column; }
        
        /* NAVBAR (Sama dengan Halaman Publik) */
        .navbar { background-color: #2C4C3B; padding: 16px 5%; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { text-decoration: none; font-size: 1.5rem; font-weight: 800; color: white; letter-spacing: 1px; display: flex; align-items: center; }
        .nav-brand span { color: #EFC480; }
        .nav-menu { display: flex; align-items: center; gap: 24px; }
        .nav-link { color: #e2e8f0; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: color 0.3s; display: flex; align-items: center; gap: 6px; }
        .nav-link:hover, .nav-link.active { color: #EFC480; }
        .nav-link svg { width: 18px; height: 18px; }
        
        .user-info { display: flex; align-items: center; gap: 16px; padding-left: 24px; border-left: 1px solid rgba(255,255,255,0.2); }
        .user-name { font-size: 0.85rem; color: white; font-weight: 700; text-align: right; line-height: 1.2; }
        .user-name span { display: block; font-size: 0.7rem; color: #cbd5e1; font-weight: 500; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 16px; border-radius: 6px; font-weight: 700; font-size: 0.85rem; cursor: pointer; transition: background 0.3s; }
        .btn-logout:hover { background-color: #dc2626; }

        /* KONTEN DASHBOARD PELANGGAN */
        .customer-container { padding: 40px 5%; max-width: 1200px; margin: 0 auto; flex: 1; width: 100%; }
        .page-header { margin-bottom: 32px; border-bottom: 2px solid #e5e7eb; padding-bottom: 16px; }
        .page-title { font-size: 2rem; font-weight: 800; color: #2C4C3B; }
        .page-subtitle { color: #6b7280; font-size: 1rem; margin-top: 8px; }

        /* TABEL RIWAYAT PESANAN */
        .table-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; }
        .custom-table { width: 100%; border-collapse: collapse; text-align: left; }
        .custom-table th { background-color: #2C4C3B; color: white; padding: 16px 24px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .custom-table td { padding: 16px 24px; font-size: 0.95rem; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
        
        .order-id { font-weight: 800; color: #2C4C3B; font-size: 1.05rem; }
        .order-date { font-size: 0.8rem; color: #6b7280; font-weight: 600; margin-top: 4px; }
        .order-price { font-weight: 700; color: #8B5A2B; }
        
        /* BADGE STATUS */
        .badge-status { display: inline-block; padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }

        .empty-state { text-align: center; padding: 60px 20px; color: #6b7280; font-size: 1.1rem; }
        .btn-shop { background-color: #8B5A2B; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 700; margin-top: 16px; display: inline-block; transition: background 0.3s; }
        .btn-shop:hover { background-color: #724a23; }

        @media (max-width: 768px) {
            .navbar { flex-direction: column; gap: 16px; padding: 16px; }
            .nav-menu { flex-wrap: wrap; justify-content: center; }
            .user-info { border-left: none; padding-left: 0; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.2); width: 100%; justify-content: space-between; }
            .custom-table th, .custom-table td { padding: 12px 16px; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <!-- NAVBAR RATTAN HANDMADE (SMART NAVIGATION) -->
    <nav class="navbar">
        <a href="{{ url('/') }}" class="nav-brand">
            <span>Rattan</span>Handmade
        </a>
        
        <div class="nav-menu">
            @auth
                <!-- Menu akan otomatis menyala (kuning) sesuai halaman yang sedang dibuka -->
                <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Katalog
                </a>
                <a href="{{ route('cart.index') }}" class="nav-link {{ request()->routeIs('cart.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Keranjang
                </a>
                <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    Riwayat Pemesanan
                </a>
                
                <div class="user-info">
                    <div class="user-name">
                        <span>Halo,</span>
                        {{ Auth::user()->name }}
                    </div>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn-logout">Keluar</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-login">Masuk</a>
                <a href="{{ route('register') }}" class="btn-register">Daftar Sekarang</a>
            @endauth
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <main class="customer-container">
        <div class="page-header">
            <h1 class="page-title">Riwayat Pesanan Saya</h1>
            <p class="page-subtitle">Pantau status transaksi dan riwayat belanja Anda di Rattan Handmade.</p>
        </div>

        <div class="table-card">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Belanja</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                    <tr>
                        <td>
                            <div class="order-id">#{{ $trx->order_id }}</div>
                        </td>
                        <td>
                            <div class="order-date">{{ $trx->created_at->format('d M Y, H:i') }} WIB</div>
                        </td>
                        <td class="order-price">
                            Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                        </td>
                        <td>
                            @php
                                $c = 'background-color:#f3f4f6; color:#4b5563;';
                                if($trx->status == 'Menunggu Pembayaran') $c = 'background-color:#fef3c7; color:#d97706;';
                                if($trx->status == 'Pembayaran Dikonfirmasi') $c = 'background-color:#dbeafe; color:#2563eb;';
                                if($trx->status == 'Diproses') $c = 'background-color:#e0e7ff; color:#4338ca;';
                                if($trx->status == 'Dikirim') $c = 'background-color:#fce7f3; color:#be185d;';
                                if($trx->status == 'Selesai') $c = 'background-color:#dcfce7; color:#16a34a;';
                                if($trx->status == 'Dibatalkan') $c = 'background-color:#fef2f2; color:#dc2626;';
                            @endphp
                            <span class="badge-status" style="{{ $c }}">{{ $trx->status }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <svg style="width: 64px; height: 64px; color: #d1d5db; margin: 0 auto 16px auto;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                <p>Belum ada riwayat pesanan.</p>
                                <a href="{{ url('/') }}" class="btn-shop">Mulai Belanja Sekarang</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
