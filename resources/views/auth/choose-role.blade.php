<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Role - Restoranku</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 80px;
            animation: fadeInDown 1s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-text {
            font-size: 48px;
            font-weight: bold;
            color: #c59d5f;
            letter-spacing: 4px;
            margin-bottom: 15px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        .subtitle {
            font-size: 18px;
            color: #999;
            letter-spacing: 2px;
            font-family: 'Arial', sans-serif;
        }

        .divider {
            width: 80px;
            height: 2px;
            background: #c59d5f;
            margin: 20px auto;
        }

        /* Role Cards Grid */
        .role-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            margin-bottom: 60px;
            animation: fadeInUp 1s ease 0.3s both;
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

        .role-card {
            background: rgba(26, 26, 26, 0.9);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 50px 30px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            text-decoration: none;
            display: block;
            position: relative;
            overflow: hidden;
        }

        .role-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(197, 157, 95, 0.1), transparent);
            transition: left 0.5s;
        }

        .role-card:hover::before {
            left: 100%;
        }

        .role-card:hover {
            transform: translateY(-15px);
            border-color: #c59d5f;
            box-shadow: 0 20px 50px rgba(197, 157, 95, 0.3);
            background: rgba(197, 157, 95, 0.15);
        }

        .icon-circle {
            width: 100px;
            height: 100px;
            margin: 0 auto 25px;
            background: linear-gradient(135deg, #c59d5f, #a07d4a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 45px;
            color: #000;
            transition: all 0.4s;
            box-shadow: 0 10px 30px rgba(197, 157, 95, 0.4);
        }

        .role-card:hover .icon-circle {
            transform: scale(1.1) rotateY(360deg);
            box-shadow: 0 15px 40px rgba(197, 157, 95, 0.6);
        }

        .role-title {
            font-size: 28px;
            font-weight: bold;
            color: #fff;
            margin-bottom: 15px;
            letter-spacing: 2px;
            transition: color 0.3s;
        }

        .role-card:hover .role-title {
            color: #c59d5f;
        }

        .role-description {
            font-size: 15px;
            color: #999;
            line-height: 1.6;
            margin-bottom: 30px;
            font-family: 'Arial', sans-serif;
            transition: color 0.3s;
        }

        .role-card:hover .role-description {
            color: #bbb;
        }

        .role-btn {
            padding: 15px 35px;
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: 2px solid #c59d5f;
            background: transparent;
            color: #c59d5f;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            font-family: 'Arial', sans-serif;
        }

        .role-card:hover .role-btn {
            background: #c59d5f;
            color: #000;
            transform: scale(1.05);
        }

        /* Back Button */
        .back-section {
            text-align: center;
            animation: fadeIn 1s ease 0.6s both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .back-btn {
            padding: 16px 40px;
            font-size: 15px;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: 2px solid rgba(197, 157, 95, 0.5);
            background: transparent;
            color: #999;
            cursor: pointer;
            transition: all 0.4s;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            font-family: 'Arial', sans-serif;
        }

        .back-btn:hover {
            background: rgba(197, 157, 95, 0.1);
            border-color: #c59d5f;
            color: #c59d5f;
            transform: translateX(-5px);
        }

        .back-btn i {
            margin-right: 10px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .role-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .logo-text {
                font-size: 36px;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 60px 15px;
            }

            .logo-text {
                font-size: 32px;
            }

            .subtitle {
                font-size: 16px;
            }

            .role-title {
                font-size: 24px;
            }

            .icon-circle {
                width: 80px;
                height: 80px;
                font-size: 35px;
            }
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 class="logo-text">RESTORANKU</h1>
            <div class="divider"></div>
            <p class="subtitle">Silakan pilih role Anda untuk melanjutkan</p>
        </div>

        <!-- Role Cards -->
        <div class="role-grid">
            <!-- Admin Card -->
            <a href="{{ route('login.role', 'admin') }}" class="role-card">
                <div class="icon-circle">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h3 class="role-title">Admin</h3>
                <p class="role-description">
                    Kelola sistem, kategori, menu, dan laporan
                </p>
                <button class="role-btn">Login sebagai Admin</button>
            </a>

            <!-- Employee Card -->
            <a href="{{ route('login.role', 'employee') }}" class="role-card">
                <div class="icon-circle">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3 class="role-title">Employee</h3>
                <p class="role-description">
                    Kelola pesanan dan reservasi pelanggan
                </p>
                <button class="role-btn">Login sebagai Employee</button>
            </a>

            <!-- Customer Card -->
            <a href="{{ route('customer.auth.choice') }}" class="role-card">
                <div class="icon-circle">
                    <i class="fas fa-user"></i>
                </div>
                <h3 class="role-title">Customer</h3>
                <p class="role-description">
                    Pesan menu dan buat reservasi
                </p>
                <button class="role-btn">Login / Register</button>
            </a>
        </div>

        <!-- Back Button -->
        <div class="back-section">
            <a href="{{ route('landing') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>