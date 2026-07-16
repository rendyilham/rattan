<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Berhasil - KayuKraft</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">

    <!-- Navbar Minimalis -->
    <nav style="background-color: #273353; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center h-16 items-center">
                <a href="{{ url('/') }}" style="font-weight: bold; font-size: 1.5rem; letter-spacing: 0.05em; color: white; text-decoration: none;">
                    <span style="color: #EFC480;">KAYU</span>KRAFT
                </a>
            </div>
        </div>
    </nav>

    <!-- Konten Konfirmasi -->
    <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl w-full bg-white p-8 rounded-lg shadow-sm border border-gray-200 text-center">
            
            <div style="width: 64px; height: 64px; background-color: #dcfce7; color: #16a34a; border-radius: 9999px; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px auto;">
                <svg style="width: 32px; height: 32px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </div>

            <h2 style="font-size: 1.5rem; font-weight: 800; color: #273353; margin-bottom: 8px;">Pesanan Berhasil Dibuat!</h2>
            <p style="color: #4b5563; margin-bottom: 24px; font-size: 0.875rem;">Terima kasih, pesanan Anda telah masuk ke sistem kami dengan status <span style="font-weight: bold; color: #273353;">Menunggu Pembayaran</span>.</p>

            <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 24px; margin-bottom: 32px;">
                <p style="font-size: 0.75rem; color: #6b7280; font-weight: bold; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 4px;">Nomor Pesanan</p>
                <p style="font-size: 1.5rem; font-weight: 900; color: #273353; margin-bottom: 16px; margin-top: 0;">{{ $transaction->order_id }}</p>
                
                <p style="font-size: 0.75rem; color: #6b7280; font-weight: bold; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 4px;">Total Pembayaran</p>
                <p style="font-size: 1.25rem; font-weight: bold; color: #EFC480; margin-top: 0;">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
            </div>

            <!-- Area Tombol Aksi yang Dirapikan (KODE KEBAL) -->
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <!-- Tombol WA -->
                <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20konfirmasi%20pembayaran%20untuk%20pesanan:%20{{ $transaction->order_id }}" 
                   target="_blank" 
                   style="display: flex; justify-content: center; align-items: center; width: 100%; background-color: #22c55e; color: white; font-weight: bold; padding: 12px; border-radius: 6px; text-decoration: none; box-sizing: border-box;">
                   <!-- Ikon WhatsApp -->
                   <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                   Konfirmasi via WhatsApp
                </a>
                
                <!-- Tombol Navigasi -->
                <div style="display: flex; gap: 16px; width: 100%;">
                    <a href="{{ url('/dashboard') }}" style="flex: 1; text-align: center; padding: 12px; background-color: white; color: #273353; font-weight: bold; border: 2px solid #273353; border-radius: 6px; text-decoration: none; box-sizing: border-box;">Lihat Riwayat</a>
                    <a href="{{ url('/') }}" style="flex: 1; text-align: center; padding: 12px; background-color: #273353; color: #EFC480; font-weight: bold; border-radius: 6px; text-decoration: none; box-sizing: border-box;">Kembali ke Katalog</a>
                </div>
            </div>

        </div>
    </div>

</body>
</html>