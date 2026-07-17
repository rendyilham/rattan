<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - KayuKraft</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { 
            background-color: #FDFBF7; 
            margin: 0; 
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            padding: 20px;
            background-image: radial-gradient(#EFC480 0.5px, transparent 0.5px), radial-gradient(#EFC480 0.5px, #FDFBF7 0.5px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
        }

        .register-card {
            background: #ffffff;
            width: 100%;
            max-width: 480px; /* Sedikit lebih lebar dari form login karena field lebih banyak */
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        .card-header {
            background-color: #2C4C3B;
            padding: 30px 20px;
            text-align: center;
            border-bottom: 4px solid #8B5A2B;
        }

        .brand-logo {
            font-size: 1.75rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 1px;
            text-decoration: none;
        }

        .brand-logo span { color: #EFC480; }
        
        .header-subtitle {
            color: #cbd5e1;
            font-size: 0.9rem;
            margin-top: 8px;
            font-weight: 500;
        }

        .card-body { padding: 40px 30px; }

        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.95rem;
            color: #1f2937;
            background-color: #f9fafb;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: #8B5A2B;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(139, 90, 43, 0.1);
        }

        .btn-submit {
            width: 100%;
            background-color: #8B5A2B;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
            box-shadow: 0 4px 6px -1px rgba(139, 90, 43, 0.2);
            margin-top: 10px;
        }

        .btn-submit:hover { background-color: #724a23; }

        .card-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #f3f4f6;
        }

        .login-link {
            font-size: 0.9rem;
            color: #6b7280;
        }

        .login-link a {
            color: #2C4C3B;
            font-weight: 800;
            text-decoration: none;
        }

        .login-link a:hover { text-decoration: underline; }

        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 16px;
            font-size: 0.8rem;
            color: #9ca3af;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .back-home:hover { color: #8B5A2B; }

        /* Error Box */
        .error-alert {
            background-color: #fef2f2;
            border: 1px solid #fee2e2;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .error-alert ul { margin: 0; padding-left: 20px; }
    </style>
</head>
<body>

    <div class="register-card">
        <div class="card-header">
            <a href="{{ url('/') }}" class="brand-logo">
                <span>KAYU</span>KRAFT
            </a>
            <div class="header-subtitle">Bergabunglah dan mulai perjalanan belanja Anda</div>
        </div>

        <div class="card-body">
            
            <!-- Notifikasi Error Form -->
            @if ($errors->any())
                <div class="error-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Ketik nama Anda" required autofocus autocomplete="name">
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="email@contoh.com" required autocomplete="username">
                </div>

                <!-- Grid untuk Password agar sejajar -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required autocomplete="new-password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Sandi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi sandi" required autocomplete="new-password">
                    </div>
                </div>

                <button type="submit" class="btn-submit">Daftar Akun Sekarang</button>
            </form>

            <div class="card-footer">
                <div class="login-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
                <a href="{{ url('/') }}" class="back-home">
                    <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Katalog
                </a>
            </div>
        </div>
    </div>

</body>
</html>