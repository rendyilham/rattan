<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Kayu - Kerajinan Tangan KayuKraft</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; padding: 0; }
        html { overflow-y: scroll; }
        body { background-color: #FDFBF7; color: #1f2937; line-height: 1.6; min-height: 100vh; display: flex; flex-direction: column; }
        
        /* NAVBAR */
        .navbar { background-color: #2C4C3B; padding: 16px 5%; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-brand { text-decoration: none; font-size: 1.5rem; font-weight: 800; color: white; letter-spacing: 1px; display: flex; align-items: center; }
        .nav-brand span { color: #EFC480; }
        .nav-menu { display: flex; align-items: center; gap: 24px; }
        .nav-link { color: #e2e8f0; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: color 0.3s; display: flex; align-items: center; gap: 6px; }
        .nav-link:hover, .nav-link.active { color: #EFC480; }
        .nav-link svg { width: 18px; height: 18px; }
        
        /* AUTH BUTTONS */
        .btn-login { color: #ffffff; font-weight: 600; text-decoration: none; font-size: 0.9rem; transition: color 0.3s; }
        .btn-login:hover { color: #EFC480; }
        .btn-register { background-color: #EFC480; color: #2C4C3B; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 800; font-size: 0.9rem; transition: background 0.3s; }
        .btn-register:hover { background-color: #d9b170; }
        
        .user-info { display: flex; align-items: center; gap: 16px; padding-left: 24px; border-left: 1px solid rgba(255,255,255,0.2); }
        .user-name { font-size: 0.85rem; color: white; font-weight: 700; text-align: right; line-height: 1.2; }
        .user-name span { display: block; font-size: 0.7rem; color: #cbd5e1; font-weight: 500; }
        .btn-logout { background-color: #ef4444; color: white; border: none; padding: 8px 16px; border-radius: 6px; font-weight: 700; font-size: 0.85rem; cursor: pointer; transition: background 0.3s; }
        .btn-logout:hover { background-color: #dc2626; }

        /* HERO SECTION */
        .hero { background-color: #2C4C3B; color: white; padding: 80px 5%; text-align: center; position: relative; overflow: hidden; }
        .hero::before { content: ''; position: absolute; top: -50px; left: -50px; width: 200px; height: 200px; background-color: #EFC480; opacity: 0.1; border-radius: 50%; }
        .hero::after { content: ''; position: absolute; bottom: -50px; right: -50px; width: 300px; height: 300px; background-color: #8B5A2B; opacity: 0.2; border-radius: 50%; }
        .hero-content { position: relative; z-index: 10; max-width: 800px; margin: 0 auto; }
        .hero h1 { font-size: 3rem; font-weight: 800; margin-bottom: 16px; color: #FDFBF7; line-height: 1.2; }
        .hero h1 span { color: #EFC480; }
        .hero p { font-size: 1.1rem; color: #cbd5e1; margin-bottom: 32px; font-weight: 400; }
        .btn-explore { background-color: #8B5A2B; color: white; padding: 14px 32px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 1rem; transition: background 0.3s; display: inline-block; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-explore:hover { background-color: #724a23; }

        /* ALERTS */
        .alert { padding: 12px 5%; text-align: center; font-weight: 700; font-size: 0.9rem; }
        .alert-success { background-color: #dcfce7; color: #16a34a; }
        .alert-error { background-color: #fef2f2; color: #dc2626; }

        /* CATALOG SECTION - DIPERBAIKI */
        .catalog { padding: 60px 5%; max-width: 1400px; width: 100%; margin: 0 auto; flex: 1; }
        .section-title { font-size: 2rem; font-weight: 800; color: #2C4C3B; margin-bottom: 40px; text-align: center; position: relative; padding-bottom: 16px; }
        .section-title::after { content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 80px; height: 4px; background-color: #EFC480; border-radius: 2px; }

        /* GRID PRODUK - DIPERBAIKI */
        .product-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 32px; width: 100%; }
        .product-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; transition: transform 0.3s, box-shadow 0.3s; display: flex; flex-direction: column; width: 100%; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-color: #EFC480; }
        
        .product-img { width: 100%; height: 220px; object-fit: cover; display: block; background-color: #f3f4f6; }
        .product-img-placeholder { height: 220px; background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; color: #9ca3af; font-weight: 800; font-size: 1.5rem; letter-spacing: 2px; }
        .product-content { padding: 24px; flex: 1; display: flex; flex-direction: column; }
        
        .product-category { font-size: 0.75rem; font-weight: 800; color: #8B5A2B; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
        .product-name { font-size: 1.25rem; font-weight: 700; color: #2C4C3B; margin-bottom: 8px; }
        .product-desc { font-size: 0.9rem; color: #6b7280; margin-bottom: 24px; flex: 1; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        
        .product-footer { display: flex; justify-content: space-between; align-items: center; margin-top: auto; padding-top: 16px; border-top: 1px solid #f3f4f6; }
        .product-price { font-size: 1.25rem; font-weight: 800; color: #2C4C3B; }
        
        .btn-add-cart { background-color: #EFC480; color: #2C4C3B; border: none; padding: 10px 16px; border-radius: 6px; font-weight: 800; font-size: 0.9rem; cursor: pointer; transition: background 0.3s; display: flex; align-items: center; gap: 6px; }
        .btn-add-cart:hover { background-color: #d9b170; }
        .btn-login-buy { background-color: #f3f4f6; color: #4b5563; text-decoration: none; padding: 10px 16px; border-radius: 6px; font-weight: 700; font-size: 0.85rem; transition: background 0.3s; }
        .btn-login-buy:hover { background-color: #e5e7eb; }

        .empty-state { grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: #6b7280; font-size: 1.1rem; background: white; border-radius: 12px; border: 1px dashed #cbd5e1; }

        @media (max-width: 768px) {
            .navbar { flex-direction: column; gap: 16px; padding: 16px; }
            .nav-menu { flex-wrap: wrap; justify-content: center; }
            .user-info { border-left: none; padding-left: 0; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.2); width: 100%; justify-content: space-between; }
            .hero h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR KAYUKRAFT (SMART NAVIGATION) -->
    <nav class="navbar">
        <a href="{{ url('/') }}" class="nav-brand">
            <span>KAYU</span>KRAFT
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

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <header class="hero">
        <div class="hero-content">
            <h1>Seni Kayu Premium untuk <span>Hunian Modern</span></h1>
            <p>Eksplorasi koleksi kerajinan dan furnitur dari bahan kayu pilihan terbaik. Dirancang khusus untuk memberikan kehangatan dan keanggunan di setiap sudut ruangan Anda.</p>
            <a href="#katalog" class="btn-explore">Eksplorasi Etalase ↓</a>
        </div>
    </header>

    <main id="katalog" class="catalog">
        <h2 class="section-title">Koleksi Terbaru Kami</h2>
        
        <div class="product-grid">
            @forelse($products as $product)
                <div class="product-card">
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="product-img">
                    @else
                        <div class="product-img-placeholder">
                            KAYUKRAFT
                        </div>
                    @endif
                    <div class="product-content">
                        <div class="product-category">{{ $product->category->name ?? 'Kategori Umum' }}</div>
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-desc">{{ $product->description }}</p>
                        
                        <div class="product-footer">
                            <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            
                            @auth
                                <form action="{{ route('cart.store') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-add-cart">
                                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                        Keranjang
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn-login-buy">Login untuk Beli</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    Belum ada produk yang tersedia di etalase saat ini.
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>
