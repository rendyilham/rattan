<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Eksekutif - RattanHandmade</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #FDFBF7; margin: 0; padding: 0; display: flex; min-height: 100vh; color: #1f2937; }
        
        /* SIDEBAR */
        .sidebar { width: 260px; background-color: #2C4C3B; color: #ffffff; display: flex; flex-direction: column; position: fixed; top: 0; bottom: 0; left: 0; z-index: 50; box-shadow: 4px 0 10px rgba(0,0,0,0.05); }
        .sidebar-brand { padding: 24px; font-size: 1.35rem; font-weight: 800; letter-spacing: 1px; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .sidebar-brand span { color: #EFC480; }
        .sidebar-menu { padding: 24px 16px; flex: 1; display: flex; flex-direction: column; gap: 8px; }
        .menu-item { display: flex; align-items: center; padding: 12px 16px; color: #cbd5e1; text-decoration: none; font-weight: 600; font-size: 0.9rem; border-radius: 8px; transition: all 0.2s ease; }
        .menu-item:hover, .menu-item.active { background-color: rgba(255, 255, 255, 0.08); color: #EFC480; }
        .menu-item svg { margin-right: 12px; width: 20px; height: 20px; }
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
        .page-title { font-size: 1.75rem; font-weight: 800; color: #2C4C3B; margin: 0 0 24px 0; }

        /* MENGGUNAKAN FLEXBOX SUPER STABIL */
        .stats-wrapper { display: flex; gap: 24px; margin-bottom: 32px; flex-wrap: wrap; }
        .stat-card { flex: 1; min-width: 280px; background: #ffffff; border-radius: 12px; padding: 24px; border: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
        .stat-label { font-size: 0.75rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 6px 0; }
        .stat-value { font-size: 1.5rem; font-weight: 800; color: #2C4C3B; margin: 0; }
        .stat-icon { width: 48px; height: 48px; border-radius: 10px; color: white; display: flex; align-items: center; justify-content: center; }
        .stat-icon svg { width: 24px; height: 24px; }

        .panels-wrapper { display: flex; gap: 24px; flex-wrap: wrap; }
        .panel-box { background: #ffffff; border-radius: 12px; border: 1px solid #e5e7eb; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.02); display: flex; flex-direction: column; }
        
        /* Mengatur rasio grafik dan tabel (2:1) */
        .panel-chart { flex: 2; min-width: 400px; }
        .panel-table { flex: 1; min-width: 300px; }
        
        .panel-header { padding: 20px 24px; border-bottom: 1px solid #e5e7eb; font-weight: 700; color: #2C4C3B; font-size: 1rem; background: #fff; }
        .panel-content { padding: 24px; flex: 1; }

        /* TABLE */
        .custom-table { width: 100%; border-collapse: collapse; text-align: left; }
        .custom-table th { background-color: #f9fafb; padding: 14px 18px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #4b5563; border-bottom: 1px solid #e5e7eb; }
        .custom-table td { padding: 16px 18px; font-size: 0.85rem; border-bottom: 1px solid #f3f4f6; }
        .badge-status { display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .stats-wrapper, .panels-wrapper { flex-direction: column; }
            .stat-card, .panel-chart, .panel-table { min-width: 100%; }
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-brand"><span>Rattan</span>Handmade</div>
        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item active">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" class="menu-item">
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
            <div class="breadcrumb">Sistem Utama / <span>Dashboard</span></div>
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
            <h1 class="page-title">Ringkasan Eksekutif</h1>

            <div class="stats-wrapper">
                <div class="stat-card">
                    <div>
                        <p class="stat-label">Total Pendapatan</p>
                        <p class="stat-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                    </div>
                    <div class="stat-icon" style="background-color: #2C4C3B;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

                <div class="stat-card">
                    <div>
                        <p class="stat-label">Volume Transaksi</p>
                        <p class="stat-value">{{ $totalTransaksi }} Pesanan</p>
                    </div>
                    <div class="stat-icon" style="background-color: #8B5A2B;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                </div>

                <div class="stat-card">
                    <div>
                        <p class="stat-label">Stok Global Etalase</p>
                        <p class="stat-value">{{ $totalStok }} Item</p>
                    </div>
                    <div class="stat-icon" style="background-color: #6b7280;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                </div>
            </div>

            <div class="panels-wrapper">
                
                <div class="panel-box panel-chart">
                    <div class="panel-header">Tren Grafis Penjualan Terkini</div>
                    <div class="panel-content">
                        <canvas id="salesChart" style="max-height: 300px; width: 100%;"></canvas>
                    </div>
                </div>

                <div class="panel-box panel-table">
                    <div class="panel-header">Aktivitas Transaksi Terbaru</div>
                    <div class="panel-content" style="padding: 0; overflow-x: auto;">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nilai</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksiTerbaru as $trx)
                                <tr>
                                    <td style="font-weight: 700; color: #2C4C3B;">#{{ $trx->order_id }}</td>
                                    <td style="font-weight: 600;">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $c = 'background-color:#f3f4f6; color:#4b5563;';
                                            if($trx->status == 'Menunggu Pembayaran') $c = 'background-color:#fef3c7; color:#d97706;';
                                            if($trx->status == 'Pembayaran Dikonfirmasi') $c = 'background-color:#dbeafe; color:#2563eb;';
                                            if($trx->status == 'Selesai') $c = 'background-color:#dcfce7; color:#16a34a;';
                                        @endphp
                                        <span class="badge-status" style="{{ $c }}">{{ $trx->status }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" style="text-align: center; color: #9ca3af; padding: 24px;">Belum ada aktivitas.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Performa Omset Bulanan',
                    data: [1200000, 1900000, 3000000, 5000000, 4200000, 6500000, {{ $totalPendapatan }}],
                    borderColor: '#8B5A2B',
                    backgroundColor: 'rgba(139, 90, 43, 0.05)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
</body>
</html>