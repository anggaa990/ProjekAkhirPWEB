<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoranku - Pesan Makanan Favorit Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Navbar Styling */
        .navbar {
            background: rgba(0, 0, 0, 0.85) !important;
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            box-shadow: 0 2px 15px rgba(0,0,0,0.3);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
            color: #ff6b6b !important;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .btn-login {
            background: #ff6b6b;
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        }

        .btn-login:hover {
            background: #ff5252;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.5);
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* Background Image with Overlay */
        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: -2;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(255,107,107,0.3) 100%);
            z-index: -1;
        }

        /* Hero Content */
        .hero-content {
            text-align: center;
            color: white;
            z-index: 1;
            padding: 20px;
            animation: fadeInUp 1s ease-out;
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

        .hero-content h1 {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-shadow: 3px 3px 10px rgba(0,0,0,0.5);
            line-height: 1.2;
        }

        .hero-content .subtitle {
            font-size: 1.8rem;
            margin-bottom: 2.5rem;
            color: #ffd700;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
            font-weight: 500;
        }

        .btn-order {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff5252 100%);
            color: white;
            border: none;
            padding: 18px 50px;
            border-radius: 50px;
            font-size: 1.3rem;
            font-weight: bold;
            transition: all 0.3s;
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.4);
            text-decoration: none;
            display: inline-block;
        }

        .btn-order:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 40px rgba(255, 107, 107, 0.6);
            color: white;
        }

        /* Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        /* Features Section */
        .features {
            position: absolute;
            bottom: 50px;
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 50px;
            z-index: 1;
        }

        .feature-item {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            transition: all 0.3s;
        }

        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .feature-item i {
            font-size: 2rem;
            color: #ff6b6b;
            margin-bottom: 10px;
        }

        .feature-item h5 {
            color: #333;
            font-weight: bold;
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content .subtitle {
                font-size: 1.3rem;
            }

            .btn-order {
                padding: 15px 35px;
                font-size: 1.1rem;
            }

            .features {
                flex-direction: column;
                gap: 20px;
                bottom: 20px;
                padding: 0 20px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('landing') }}">🍽️ Restoranku</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ route('choose.role') }}" class="btn btn-login">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
    <!-- Background Image -->
    <div class="hero-background"></div>
    <div class="hero-overlay"></div>

    <!-- Hero Content -->
    <div class="hero-content">
        <h1 class="floating">Selamat Datang di Restoranku</h1>
        <p class="subtitle">Mau Pesan Apa Hari Ini? 😋</p>
        <a href="{{ route('login.role', 'customer') }}" class="btn-order">
            🛒 Pesan Sekarang
        </a>
    </div>

    <!-- Features -->
    <div class="features d-none d-md-flex">
        <div class="feature-item">
            <div style="font-size: 2rem;">⚡</div>
            <h5>Cepat & Mudah</h5>
        </div>
        <div class="feature-item">
            <div style="font-size: 2rem;">🍽️</div>
            <h5>Menu Lezat</h5>
        </div>
        <div class="feature-item">
            <div style="font-size: 2rem;">⭐</div>
            <h5>Pelayanan Terbaik</h5>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>