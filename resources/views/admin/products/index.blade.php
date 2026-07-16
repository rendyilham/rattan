<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Produk - KayuKraft Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #FDFBF7; margin: 0; padding: 0; display: flex; min-height: 100vh; color: #1f2937; }
        
        /* SIDEBAR (Sama persis dengan Dashboard) */
        .sidebar { width: 260px; background-color: #2C4C3B; color: #ffffff; display: flex; flex-direction: column; position: fixed; top: 0; bottom: 0; left: 0; z-index: 50; box-shadow: 4px 0 10px rgba(0,0,0,0.05); }
        .sidebar-brand { padding: 24px; font-size: 1.35rem; font-weight: 800; letter-spacing: 1px; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .sidebar-brand span { color: #EFC480; }
        .sidebar-menu { padding: 24px 16px; flex: 1; display: flex; flex-direction: column; gap: 8px; }
        .menu-item { display: flex; align-items: center; padding: 12px 16px; color: #cbd5e1; text-decoration: none; font-weight: 600; font-size: 0.9rem; border-radius: 8px; transition: all 0.2s ease; }
        .menu-item:hover, .menu-item.active { background-color: rgba(255, 255, 255, 0.08); color: #EFC480; }
        .menu-item svg { margin-right: 12px; width: 20px; height: 20px; flex-shrink: 0; }
        .sidebar-footer { padding: 20px 16px; border-top: 1px solid rgba(255,255,255,0.08); }
        .btn-logout { width: 100%; background-color: rgba(220, 38, 38, 0.1); color: #ef4444; border: 1px solid rgba(220, 38, 38, 0.2); padding: 10px; border-radius: 6px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.2s ease; }
        .btn-logout:hover { background-color: #dc2626; color: white; }

        /* MAIN CONTENT */
        .main-content { margin-left: 260px; flex: 1; display: flex; flex-direction: column; min-width: 0; }
        .navbar { height: 70px; background-color: #ffffff; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: space-between; padding: 0 32px; position: sticky; top: 0; z-index: 40; }
        .breadcrumb { font-size: 0.875rem; color: #6b7280; font-weight: 500; }
        .breadcrumb span { color: #2C4C3B; font-weight: 700; }
        .admin-profile { display: flex; align-items: center; gap: 12px; }
        .profile-name { font-size: 0.875rem; font-weight: 700; color: #2C4C3B; text-align: right; }
        .profile-role { font-size: 0.75rem; color: #8B5A2B; font-weight: 600; text-align: right; }

        .content-body { padding: 32px; max-width: 1400px; width: 100%; margin: 0 auto; }
        
        /* HEADER KELOLA PRODUK */
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .page-title { font-size: 1.75rem; font-weight: 800; color: #2C4C3B; margin: 0; }
        .btn-add { background-color: #8B5A2B; color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; gap: 8px; transition: background 0.3s; border: none; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(139, 90, 43, 0.2); }
        .btn-add:hover { background-color: #724a23; }

        /* TABEL PRODUK MODERN */
        .table-container { background: #ffffff; border-radius: 12px; border: 1px solid #e5e7eb; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
        .custom-table { width: 100%; border-collapse: collapse; text-align: left; }
        .custom-table th { background-color: #f9fafb; padding: 16px 24px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: #4b5563; border-bottom: 1px solid #e5e7eb; letter-spacing: 0.5px; }
        .custom-table td { padding: 16px 24px; font-size: 0.95rem; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
        
        .product-name { font-weight: 700; color: #2C4C3B; margin-bottom: 4px; }
        .product-category { font-size: 0.75rem; background: #e5e7eb; color: #4b5563; padding: 4px 10px; border-radius: 20px; font-weight: 700; }
        .product-price { font-weight: 700; color: #8B5A2B; }
        
        .stock-badge { font-weight: 800; padding: 6px 12px; border-radius: 6px; display: inline-block; text-align: center; min-width: 40px; }
        .stock-good { background-color: #dcfce7; color: #16a34a; }
        .stock-low { background-color: #fef2f2; color: #dc2626; }

        /* TOMBOL AKSI */
        .action-buttons { display: flex; gap: 10px; align-items: center; }
        .btn-edit { color: #d97706; background: #fef3c7; padding: 8px 12px; border-radius: 6px; text-decoration: none; font-weight: 700; font-size: 0.8rem; transition: all 0.2s; }
        .btn-edit:hover { background: #d97706; color: white; }
        
        .btn-delete { color: #dc2626; background: #fef2f2; padding: 8px 12px; border-radius: 6px; border: none; font-weight: 700; font-size: 0.8rem; cursor: pointer; transition: all 0.2s; }
        .btn-delete:hover { background: #dc2626; color: white; }

        /* PESAN SUKSES */
        .alert-success { background-color: #dcfce7; border: 1px solid #bbf7d0; color: #16a34a; padding: 16px; border-radius: 8px; margin-bottom: 24px; font-weight: 700; display: flex; align-items: center; gap: 10px; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand"><span>Rattan</span>Handmade</div>
        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            <!-- Menu Kelola Produk Menyala (Active) -->
            <a href="{{ route('admin.products.index') }}" class="menu-item active">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Kelola Produk
            </a>
            <a href="{{ route('admin.orders.index') }}" class="menu-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                Kelola Pesanan
            </a>
        </nav>
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('admin.logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg style="width: 20px; height: 20px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN KONTEN -->
    <main class="main-content">
        <header class="navbar">
            <div class="breadcrumb">Sistem Utama / <span>Kelola Produk</span></div>
            <div class="admin-profile">
                <div>
                    <div class="profile-name">{{ Auth::guard('admin')->user()->name }}</div>
                    <div class="profile-role">Super Administrator</div>
                </div>
                <div style="width: 40px; height: 40px; background-color: #8B5A2B; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800;">
                    AD
                </div>
            </div>
        </header>

        <div class="content-body">
            
            @if(session('success'))
                <div class="alert-success">
                    <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="page-header">
                <h1 class="page-title">Daftar Etalase Produk</h1>
                <a href="{{ route('admin.products.create') }}" class="btn-add">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Produk Baru
                </a>
            </div>

            <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Info Produk</th>
                            <th>Kategori</th>
                            <th>Harga Jual</th>
                            <th style="text-align: center;">Ketersediaan Stok</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>
                                <div class="product-name">{{ $product->name }}</div>
                            </td>
                            <td>
                                <span class="product-category">{{ $product->category->name ?? 'Tanpa Kategori' }}</span>
                            </td>
                            <td class="product-price">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td style="text-align: center;">
                                <span class="stock-badge {{ $product->stock > 5 ? 'stock-good' : 'stock-low' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons" style="justify-content: flex-end;">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-edit">Edit</a>
                                    
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini secara permanen?');" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: #6b7280; font-weight: 500;">
                                Belum ada produk di etalase. Klik "Tambah Produk Baru" untuk mulai.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </main>

</body>
</html>