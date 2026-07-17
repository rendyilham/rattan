<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keranjang Belanja - Rattan Handmade</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; padding: 0; }
        html { overflow-y: scroll; } /* <-- Ini adalah kunci ajaibnya */
        body { background-color: #FDFBF7; color: #1f2937; line-height: 1.6; min-height: 100vh; display: flex; flex-direction: column; }
        
        /* NAVBAR KONSISTEN */
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

        /* KONTEN KERANJANG */
        .cart-container { padding: 40px 5%; max-width: 1200px; margin: 0 auto; flex: 1; width: 100%; }
        .page-header { margin-bottom: 32px; border-bottom: 2px solid #e5e7eb; padding-bottom: 16px; display: flex; justify-content: space-between; align-items: flex-end; }
        .page-title { font-size: 2rem; font-weight: 800; color: #2C4C3B; }
        .page-subtitle { color: #6b7280; font-size: 1rem; margin-top: 8px; }
        .btn-back { color: #8B5A2B; text-decoration: none; font-weight: 700; font-size: 0.95rem; display: flex; align-items: center; gap: 6px; transition: color 0.2s; }
        .btn-back:hover { color: #724a23; }

        /* TABEL KERANJANG */
        .cart-content { display: grid; grid-template-columns: 2fr 1fr; gap: 32px; align-items: start; }
        .table-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; }
        .custom-table { width: 100%; border-collapse: collapse; text-align: left; }
        .custom-table th { background-color: #2C4C3B; color: white; padding: 16px 24px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .custom-table td { padding: 20px 24px; font-size: 0.95rem; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
        
        .product-info { display: flex; align-items: center; gap: 16px; }
        .img-placeholder { width: 60px; height: 60px; background-color: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 0.7rem; font-weight: 800; }
        .product-name { font-weight: 800; color: #2C4C3B; font-size: 1.05rem; margin-bottom: 4px; }
        .product-price { color: #6b7280; font-weight: 600; font-size: 0.9rem; }
        
        .subtotal-price { font-weight: 800; color: #8B5A2B; }
        
        .btn-delete { color: #ef4444; background: #fef2f2; border: none; padding: 8px 12px; border-radius: 6px; font-weight: 700; font-size: 0.8rem; cursor: pointer; transition: all 0.2s; }
        .btn-delete:hover { background: #dc2626; color: white; }

        /* RINGKASAN BELANJA (CHECKOUT BOX) */
        .summary-card { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; position: sticky; top: 100px; }
        .summary-title { font-size: 1.25rem; font-weight: 800; color: #2C4C3B; margin-bottom: 20px; border-bottom: 1px solid #e5e7eb; padding-bottom: 12px; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 16px; font-size: 1rem; color: #4b5563; font-weight: 600; }
        .summary-total { display: flex; justify-content: space-between; margin-top: 24px; padding-top: 16px; border-top: 2px dashed #e5e7eb; font-size: 1.25rem; font-weight: 800; color: #2C4C3B; }
        .summary-total span:last-child { color: #8B5A2B; }
        
        .btn-checkout { width: 100%; background-color: #8B5A2B; color: white; border: none; padding: 14px; border-radius: 8px; font-weight: 800; font-size: 1rem; margin-top: 24px; cursor: pointer; transition: background 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-checkout:hover { background-color: #724a23; }

        .empty-state { text-align: center; padding: 80px 20px; color: #6b7280; font-size: 1.1rem; grid-column: 1 / -1; background: white; border-radius: 12px; border: 1px dashed #cbd5e1; }
        .btn-shop { background-color: #EFC480; color: #2C4C3B; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 800; margin-top: 16px; display: inline-block; transition: background 0.3s; }
        .btn-shop:hover { background-color: #d9b170; }

        @media (max-width: 992px) {
            .cart-content { grid-template-columns: 1fr; }
            .summary-card { position: static; }
        }
        @media (max-width: 768px) {
            .navbar { flex-direction: column; gap: 16px; padding: 16px; }
            .nav-menu { flex-wrap: wrap; justify-content: center; }
            .user-info { border-left: none; padding-left: 0; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.2); width: 100%; justify-content: space-between; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 12px; }
            .custom-table th, .custom-table td { padding: 12px; }
            .product-info { flex-direction: column; align-items: flex-start; gap: 8px; }
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
    <main class="cart-container">
        <div class="page-header">
            <div>
                <h1 class="page-title">Keranjang Belanja</h1>
                <p class="page-subtitle">Periksa kembali barang pilihanmu sebelum *checkout*.</p>
            </div>
            <a href="{{ url('/') }}" class="btn-back">
                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Lanjut Belanja
            </a>
        </div>

        <div class="cart-content">
            @php $totalHarga = 0; @endphp
            
            @if(isset($carts) && count($carts) > 0)
                <!-- Bagian Kiri: Tabel Produk -->
                <div class="table-card">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th style="text-align: center;">Qty</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carts as $cart)
                                @php 
                                    $subtotal = $cart->product->price * $cart->quantity;
                                    $totalHarga += $subtotal;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="product-info">
                                            <div class="img-placeholder">FOTO</div>
                                            <div>
                                                <div class="product-name">{{ $cart->product->name }}</div>
                                                <div class="product-price">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: center; font-weight: 800; font-size: 1.1rem; color: #2C4C3B;">
                                        {{ $cart->quantity }}
                                    </td>
                                    <td>
                                        <div class="subtotal-price">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" title="Hapus dari keranjang">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Bagian Kanan: Ringkasan Checkout -->
                <div class="summary-card">
                    <h3 class="summary-title">Ringkasan Pesanan</h3>
                    <div class="summary-row">
                        <span>Total Item</span>
                        <span>{{ count($carts) }} Produk</span>
                    </div>
                    <div class="summary-total">
                        <span>Total Belanja</span>
                        <span>Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-checkout">
                            Proses Pembayaran
                            <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                </div>
            @else
                <!-- Jika Keranjang Kosong -->
                <div class="empty-state">
                    <svg style="width: 64px; height: 64px; color: #d1d5db; margin: 0 auto 16px auto;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <p style="font-weight: 700; color: #374151; font-size: 1.25rem;">Keranjangmu masih kosong nih!</p>
                    <p style="margin-top: 8px;">Yuk, eksplorasi etalase dan temukan kerajinan kayu favoritmu.</p>
                    <a href="{{ url('/') }}" class="btn-shop">Lihat Katalog Produk</a>
                </div>
            @endif
        </div>
    </main>

</body>
</html>
