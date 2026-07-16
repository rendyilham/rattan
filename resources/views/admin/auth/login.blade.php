<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Portal - RattanHandmade</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        body {
            background-color: #FDFBF7;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            max-width: 900px;
            width: 100%;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            display: flex;
            overflow: hidden;
            border: 1px solid #f0f0f0;
        }
        .side-branding {
            width: 50%;
            background-color: #2C4C3B;
            padding: 50px;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        .side-branding h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0 0 10px 0;
            letter-spacing: 1px;
        }
        .side-branding h2 span {
            color: #EFC480;
        }
        .side-branding p {
            color: #cbd5e1;
            font-size: 1.1rem;
            margin: 0 0 40px 0;
        }
        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .feature-icon {
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 8px;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #EFC480;
        }
        .form-section {
            width: 50%;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-header h3 {
            font-size: 1.85rem;
            color: #2C4C3B;
            margin: 0 0 8px 0;
            font-weight: 700;
        }
        .form-header p {
            color: #6b7280;
            font-size: 0.9rem;
            margin: 0 0 30px 0;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #4b5563;
            margin-bottom: 8px;
        }
        .input-field {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f9fafb;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            color: #1f2937;
        }
        .input-field:focus {
            outline: none;
            border-color: #8B5A2B;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(139, 90, 43, 0.15);
        }
        .remember-me {
            display: flex;
            align-items: center;
            margin: 25px 0;
            cursor: pointer;
            font-size: 0.9rem;
            color: #4b5563;
        }
        .remember-me input {
            margin-right: 8px;
            accent-color: #8B5A2B;
            width: 16px;
            height: 16px;
        }
        .btn-submit {
            width: 100%;
            background-color: #8B5A2B;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 6px -1px rgba(139, 90, 43, 0.2);
        }
        .btn-submit:hover {
            background-color: #724a23;
        }
        .btn-back {
            text-align: center;
            margin-top: 30px;
            border-top: 1px solid #f3f4f6;
            padding-top: 20px;
        }
        .btn-back a {
            color: #9ca3af;
            font-size: 0.875rem;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .btn-back a:hover {
            color: #8B5A2B;
        }
        .error-box {
            background-color: #fef2f2;
            border: 1px solid #ffeeee;
            color: #dc2626;
            padding: 15px;
            border-radius: 8px;
            font-size: 0.875rem;
            margin-bottom: 25px;
        }
        .error-box ul {
            margin: 0;
            padding-left: 20px;
            font-weight: 600;
        }

        /* Responsif untuk Tablet & Mobile */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            .side-branding, .form-section {
                width: 100%;
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        
        <div class="side-branding">
            <h2><span>Rattan</span>Handmade</h2>
            <p>Portal Manajemen Sistem Terpadu</p>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <svg style="width:24px;height:24px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span style="font-weight:500; font-size:0.9rem;">Keamanan Akses Terenkripsi</span>
            </div>
            
            <div class="feature-item">
                <div class="feature-icon">
                    <svg style="width:24px;height:24px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <span style="font-weight:500; font-size:0.9rem;">Pemantauan Transaksi Real-time</span>
            </div>
        </div>

        <div class="form-section">
            <div class="form-header">
                <h3>Akses Admin</h3>
                <p>Silakan masuk menggunakan kredensial internal Anda.</p>
            </div>

            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="input-group">
                    <label for="email">Alamat Email Internal</label>
                    <input type="email" name="email" id="email" required autofocus class="input-field" placeholder="admin@kayukraft.com" value="{{ old('email') }}">
                </div>

                <div class="input-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" name="password" id="password" required class="input-field" placeholder="••••••••">
                </div>

                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    Ingat Sesi Saya
                </label>

                <button type="submit" class="btn-submit">
                    Masuk ke Dashboard
                    <svg style="width:20px;height:20px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>
            
            <div class="btn-back">
                <a href="{{ url('/') }}">
                    ← Kembali ke Halaman Publik
                </a>
            </div>
        </div>

    </div>

</body>
</html>