<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Customer - Restoranku</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: #0a0a0a;
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
            overflow-x: hidden;
        }

        /* Background with parallax effect */
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.85)),
                        url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            z-index: -1;
        }

        .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
        }

        .register-card {
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 50px 45px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 0.8s ease;
            position: relative;
            overflow: hidden;
        }

        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #c59d5f, #a07d4a, #c59d5f);
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }
            100% {
                background-position: 200% 0;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .register-title {
            font-size: 32px;
            font-weight: bold;
            color: #c59d5f;
            letter-spacing: 3px;
            margin-bottom: 10px;
        }

        .register-subtitle {
            font-size: 14px;
            color: #999;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
        }

        .divider {
            width: 60px;
            height: 2px;
            background: #c59d5f;
            margin: 15px auto 0;
        }

        /* Alert */
        .alert {
            padding: 15px 20px;
            background: rgba(220, 53, 69, 0.15);
            border: 1px solid rgba(220, 53, 69, 0.3);
            border-radius: 0;
            color: #ff6b6b;
            margin-bottom: 25px;
            font-size: 14px;
            font-family: 'Arial', sans-serif;
            animation: slideDown 0.3s ease;
            position: relative;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert i {
            margin-right: 8px;
        }

        /* Form */
        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-size: 13px;
            color: #c59d5f;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 10px;
            display: block;
            font-family: 'Arial', sans-serif;
            font-weight: 600;
        }

        .form-label i {
            margin-right: 6px;
        }

        .form-label .text-muted {
            color: #666 !important;
            text-transform: none;
            font-size: 12px;
            font-weight: normal;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(197, 157, 95, 0.3);
            color: #fff;
            font-size: 15px;
            transition: all 0.3s;
            font-family: 'Arial', sans-serif;
            outline: none;
        }

        .form-input::placeholder {
            color: #666;
        }

        .form-input:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #c59d5f;
            box-shadow: 0 0 20px rgba(197, 157, 95, 0.2);
        }

        .form-input.is-invalid {
            border-color: rgba(220, 53, 69, 0.5);
        }

        .invalid-feedback {
            color: #ff6b6b;
            font-size: 13px;
            margin-top: 8px;
            font-family: 'Arial', sans-serif;
        }

        /* Button */
        .btn-register {
            width: 100%;
            padding: 18px;
            font-size: 16px;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: 2px solid #c59d5f;
            background: #c59d5f;
            color: #000;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            font-family: 'Arial', sans-serif;
            position: relative;
            overflow: hidden;
            margin-top: 10px;
        }

        .btn-register i {
            margin-right: 10px;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-register:hover::before {
            width: 500px;
            height: 500px;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(197, 157, 95, 0.4);
        }

        .btn-register:active {
            transform: translateY(-1px);
        }

        /* Separator */
        .separator {
            width: 100%;
            height: 1px;
            background: rgba(197, 157, 95, 0.2);
            margin: 35px 0;
        }

        /* Links */
        .text-center {
            text-align: center;
        }

        .login-link {
            color: #999;
            font-size: 14px;
            font-family: 'Arial', sans-serif;
            margin-bottom: 15px;
        }

        .login-link a {
            color: #c59d5f;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .login-link a:hover {
            color: #d4ad6f;
            text-decoration: underline;
        }

        .back-link {
            margin-top: 20px;
        }

        .back-link a {
            color: #999;
            text-decoration: none;
            font-size: 14px;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-link a:hover {
            color: #c59d5f;
            transform: translateX(-5px);
        }

        .back-link a i {
            transition: transform 0.3s;
        }

        .back-link a:hover i {
            transform: translateX(-3px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .register-card {
                padding: 40px 30px;
            }

            .register-title {
                font-size: 28px;
            }

            .form-input {
                padding: 14px 18px;
            }

            .btn-register {
                padding: 16px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <div class="container">
        <div class="register-card">
            <!-- Header -->
            <div class="register-header">
                <h3 class="register-title">REGISTRASI</h3>
                <div class="divider"></div>
                <p class="register-subtitle">Customer</p>
            </div>

            <!-- Alert -->
            @if(session('error'))
                <div class="alert">
                    <i class="fas fa-exclamation-circle"></i>{{ session('error') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('register.process') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user"></i>Nama Lengkap
                    </label>
                    <input type="text" 
                           class="form-input @error('name') is-invalid @enderror" 
                           name="name" 
                           value="{{ old('name') }}" 
                           placeholder="Masukkan nama lengkap"
                           required 
                           autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-envelope"></i>Email
                    </label>
                    <input type="email" 
                           class="form-input @error('email') is-invalid @enderror" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="contoh@email.com"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-phone"></i>No. Telepon <span class="text-muted">(Opsional)</span>
                    </label>
                    <input type="text" 
                           class="form-input @error('phone') is-invalid @enderror" 
                           name="phone" 
                           value="{{ old('phone') }}" 
                           placeholder="08xxxxxxxxxx">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-lock"></i>Password
                    </label>
                    <input type="password" 
                           class="form-input @error('password') is-invalid @enderror" 
                           name="password" 
                           placeholder="Minimal 8 karakter"
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-lock"></i>Konfirmasi Password
                    </label>
                    <input type="password" 
                           class="form-input" 
                           name="password_confirmation" 
                           placeholder="Ulangi password"
                           required>
                </div>

                <button type="submit" class="btn-register">
                    <i class="fas fa-user-check"></i>Daftar Sekarang
                </button>
            </form>

            <div class="separator"></div>

            <!-- Login Link -->
            <div class="text-center login-link">
                Sudah punya akun? 
                <a href="{{ route('login.role', 'customer') }}">Login di sini</a>
            </div>

            <!-- Back Link -->
            <div class="text-center back-link">
                <a href="{{ route('landing') }}">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>