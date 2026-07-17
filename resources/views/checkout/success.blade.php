<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Berhasil - KayuKraft</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; padding: 0; }
        html { overflow-y: scroll; }
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

        /* KONTEN SUCCESS */
        .success-wrapper { flex: 1; display: flex; align-items: center; justify-content: center; padding: 60px 20px; }
        .success-card { background: white; width: 100%; max-width: 540px; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05); border: 1px solid #e5e7eb; padding: 40px; text-align: center; }
        
        .icon-circle { width: 80px; height: 80px; background-color: #dcfce7; color: #16a34a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px auto; }
        .icon-circle svg { width: 40px; height: 40px; }
        
        .success-title { font-size: 1.75rem; font-weight: 800; color: #2C4C3B; margin-bottom: 12px; }
        .success-desc { color: #6b7280; font-size: 0.95rem; margin-bottom: 32px; }
        .success-desc strong { color: #1f2937; }

        /* ORDER DETAILS BOX */
        .order-details { background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; margin-bottom: 32px; }
        .detail-group { margin-bottom: 16px; }
        .detail-group:last-child { margin-bottom: 0; padding-top: 16px; border-top: 2px dashed #e5e7eb; }
        .detail-label { font-size: 0.8rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .detail-value { font-size: 1.25rem; font-weight: 800; color: #2C4C3B; }
        .detail-value.total { color: #8B5A2B; font-size: 1.5rem; }

        /* BANK INFO */
        .bank-info { background-color: #fffbeb; border: 1px solid #fde68a; color: #92400e; padding: 16px; border-radius: 8px; font-size: 0.9rem; margin-bottom: 32px; }
        .bank-info strong { display: block; font-size: 1rem; color: #b45309; margin-bottom: 4px; }

        /* BUTTONS */
        .btn-wa { display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; background-color: #25D366; color: white; padding: 14px; border-radius: 8px; font-weight: 800; font-size: 1rem; text-decoration: none; transition: background 0.3s; margin-bottom: 16px; box-shadow: 0 4px 6px -1px rgba(37, 211, 102, 0.2); }
        .btn-wa:hover { background-color: #20bd5a; }
        
        .action-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .btn-outline { background-color: white; color: #4b5563; border: 1px solid #d1d5db; padding: 12px; border-radius: 8px; font-weight: 700; text-decoration: none; transition: all 0.2s; }
        .btn-outline:hover { background-color: #f9fafb; color: #1f2937; }
        
        .btn-primary { background-color: #2C4C3B; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 700; text-decoration: none; transition: background 0.3s; }
        .btn-primary:hover { background-color: #1a2f24; }

        @media (max-width: 768px) {
            .navbar { flex-direction: column; gap: 16px; padding: 16px; }
            .nav-menu { flex-wrap: wrap; justify-content: center; }
            .user-info { border-left: none; padding-left: 0; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.2); width: 100%; justify-content: space-between; }
            .action-row { grid-template-columns: 1fr; }
            .success-card { padding: 30px 20px; }
        }
    </style>
</head>
<body>

    <!-- SMART NAVBAR -->
    <nav class="navbar">
        <a href="{{ url('/') }}" class="nav-brand">
            <span>KAYU</span>KRAFT
        </a>
        
        <div class="nav-menu">
            <a href="{{ url('/') }}" class="nav-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Katalog
            </a>
            <!-- Tidak ada menu aktif di halaman sukses, karena ini adalah halaman transisi -->
            <a href="{{ route('cart.index') }}" class="nav-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Keranjang
            </a>
            <a href="{{ url('/dashboard') }}" class="nav-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                Riwayat Pemesanan
            </a>
            
            <div class="user-info">
                <div class="user-name">
                    <span>Pelanggan,</span>
                    {{ Auth::user()->name }}
                </div>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- KONTEN SUCCESS -->
    <main class="success-wrapper">
        <div class="success-card">
            
            <div class="icon-circle">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </div>

            <h1 class="success-title">Pesanan Berhasil Dibuat!</h1>
            <p class="success-desc">Terima kasih, pesanan Anda telah masuk ke sistem kami dengan status <strong>Menunggu Pembayaran</strong>.</p>

            <div class="order-details">
                <div class="detail-group">
                    <div class="detail-label">Nomor Pesanan</div>
                    <div class="detail-value">{{ $transaction->order_id }}</div> <!-- Sesuaikan variabel dari controller -->
                </div>
                <div class="detail-group">
                    <div class="detail-label">Total Pembayaran</div>
                    <div class="detail-value total">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="bank-info">
                <strong>Bank BCA - 1234 567 890</strong>
                Atas Nama: KayuKraft Indonesia
            </div>

            <!-- Tombol Konfirmasi WhatsApp (Otomatis isi pesan) -->
            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20KayuKraft,%20saya%20ingin%20konfirmasi%20pembayaran%20untuk%20pesanan%20%23{{ $transaction->order_id }}%20sebesar%20Rp{{ number_format($transaction->total_price, 0, '', '') }}." target="_blank" class="btn-wa">
                <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 21.082h-.006c-1.637 0-3.243-.44-4.654-1.272l-.334-.2-3.46.907.925-3.374-.219-.348c-.913-1.455-1.396-3.136-1.396-4.856 0-5.043 4.104-9.146 9.148-9.146 2.443 0 4.741.952 6.468 2.68 1.727 1.727 2.678 4.025 2.678 6.469 0 5.044-4.105 9.14-9.148 9.14m0-10.892c-.347-.775-.713-.79-1.042-.805-.265-.012-.569-.012-.873-.012-.304 0-.798.114-1.216.568-.418.455-1.595 1.558-1.595 3.797 0 2.239 1.634 4.404 1.862 4.707.228.304 3.212 4.9 7.778 6.818 1.089.457 1.939.73 2.6.934 1.09.333 2.083.286 2.871.173.882-.126 2.716-1.11 3.096-2.183.38-.1072.38-1.99.266-2.183-.114-.192-.418-.306-.874-.534-.456-.228-2.716-1.341-3.134-1.494-.418-.152-.722-.228-1.026.228-.304.456-1.19 1.494-1.457 1.798-.266.304-.532.342-.988.114-.456-.228-1.937-.714-3.69-2.277-1.365-1.216-2.287-2.717-2.553-3.173-.266-.456-.028-.702.201-.93.205-.204.456-.532.684-.798.228-.266.304-.456.456-.76.152-.304.076-.57-.038-.798-.114-.228-1.026-2.474-1.405-3.386"/></svg>
                Konfirmasi via WhatsApp
            </a>

            <div class="action-row">
                <a href="{{ url('/dashboard') }}" class="btn-outline">Lihat Riwayat Pemesanan</a>
                <a href="{{ url('/') }}" class="btn-primary">Kembali ke Katalog</a>
            </div>

        </div>
    </main>

</body>
</html>