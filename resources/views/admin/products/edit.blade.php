<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Produk - KayuKraft Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #FDFBF7; margin: 0; padding: 0; display: flex; min-height: 100vh; color: #1f2937; }
        
        /* SIDEBAR KONSISTEN */
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

        .content-body { padding: 32px; max-width: 900px; width: 100%; margin: 0 auto; }
        
        /* HEADER FORM */
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .page-title { font-size: 1.75rem; font-weight: 800; color: #2C4C3B; margin: 0; }
        .btn-back { color: #6b7280; text-decoration: none; font-weight: 700; font-size: 0.9rem; display: flex; align-items: center; gap: 8px; transition: color 0.3s; }
        .btn-back:hover { color: #8B5A2B; }

        /* FORM CONTAINER */
        .form-container { background: #ffffff; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; }
        .form-header { background-color: #2C4C3B; padding: 20px 24px; color: white; font-weight: 700; font-size: 1.1rem; border-bottom: 3px solid #EFC480; }
        
        .form-body { padding: 30px; }
        
        .form-group { margin-bottom: 24px; }
        .form-group label { display: block; font-size: 0.85rem; font-weight: 700; color: #374151; margin-bottom: 8px; }
        
        .form-control { width: 100%; padding: 14px 16px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.95rem; color: #1f2937; background-color: #f9fafb; transition: all 0.3s ease; outline: none; }
        .form-control:focus { border-color: #8B5A2B; background-color: #ffffff; box-shadow: 0 0 0 4px rgba(139, 90, 43, 0.1); }
        textarea.form-control { resize: vertical; min-height: 120px; }
        .image-help { font-size: 0.75rem; color: #6b7280; margin-top: 6px; display: block; }
        .current-image { width: 160px; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid #e5e7eb; background: #f3f4f6; display: block; margin-bottom: 12px; }
        .image-placeholder { width: 160px; height: 120px; border-radius: 8px; border: 1px dashed #cbd5e1; color: #6b7280; background: #f9fafb; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem; margin-bottom: 12px; }
        
        /* FORM ACTIONS */
        .form-actions { padding: 20px 30px; background-color: #f9fafb; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 12px; }
        .btn-cancel { padding: 12px 24px; border-radius: 8px; border: 1px solid #d1d5db; background-color: #ffffff; color: #4b5563; font-weight: 700; font-size: 0.95rem; cursor: pointer; text-decoration: none; transition: all 0.2s; }
        .btn-cancel:hover { background-color: #f3f4f6; color: #1f2937; }
        .btn-submit { padding: 12px 32px; border-radius: 8px; border: none; background-color: #8B5A2B; color: #ffffff; font-weight: 700; font-size: 0.95rem; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(139, 90, 43, 0.2); transition: all 0.2s; }
        .btn-submit:hover { background-color: #724a23; }

        .error-message { color: #dc2626; font-size: 0.8rem; font-weight: 600; margin-top: 6px; display: block; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-brand"><span>Rattan</span>Handmade</div>
        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
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

    <main class="main-content">
        <header class="navbar">
            <div class="breadcrumb">Sistem Utama / Kelola Produk / <span>Edit Produk</span></div>
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
            
            <div class="page-header">
                <h1 class="page-title">Edit Data Produk</h1>
                <a href="{{ route('admin.products.index') }}" class="btn-back">
                    <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar
                </a>
            </div>

            <div class="form-container">
                <div class="form-header">
                    Perbarui Spesifikasi: {{ $product->name }}
                </div>

                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <div class="form-body">
                        
                        <div class="form-group">
                            <label for="name">Nama Lengkap Produk <span style="color:#dc2626">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                            @error('name') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label for="category_id">Kategori Etalase</label>
                                <select id="category_id" name="category_id" class="form-control" required>
                                    <option value="" disabled>-- Pilih Kategori Utama --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="error-message">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group" style="margin-bottom: 0;">
                                <label for="stock">Stok Awal Tersedia <span style="color:#dc2626">*</span></label>
                                <input type="number" id="stock" name="stock" class="form-control" min="0" value="{{ old('stock', $product->stock) }}" required>
                                @error('stock') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group" style="margin-top: 24px;">
                            <label for="price">Harga Jual (Rp) <span style="color:#dc2626">*</span></label>
                            <input type="number" id="price" name="price" class="form-control" min="0" value="{{ old('price', $product->price) }}" required>
                            @error('price') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Gambar Produk</label>
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="current-image">
                            @else
                                <div class="image-placeholder">Belum ada gambar</div>
                            @endif
                            <input type="file" id="image" name="image" class="form-control" accept="image/png,image/jpeg,image/jpg,image/webp">
                            <span class="image-help">Kosongkan jika tidak ingin mengganti gambar. Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.</span>
                            @error('image') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi Singkat & Material</label>
                            <textarea id="description" name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                            @error('description') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.products.index') }}" class="btn-cancel">Batal</a>
                        <button type="submit" class="btn-submit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

        </div>
    </main>

</body>
</html>
