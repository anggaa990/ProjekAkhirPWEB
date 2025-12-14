<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoranku - Bar & Restaurant</title>
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
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            z-index: 1000;
            border-bottom: 1px solid rgba(197, 157, 95, 0.2);
        }

        .logo {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .logo-text {
            font-size: 32px;
            font-weight: bold;
            color: #c59d5f;
            letter-spacing: 3px;
            font-family: 'Georgia', serif;
            margin-bottom: 8px;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .contact-item {
            font-size: 12px;
            color: #999;
            font-family: 'Arial', sans-serif;
            letter-spacing: 0.5px;
        }

        .contact-item a {
            color: #999;
            text-decoration: none;
            transition: color 0.3s;
        }

        .contact-item a:hover {
            color: #c59d5f;
        }

        /* Hamburger Menu */
        .hamburger {
            display: flex;
            flex-direction: column;
            gap: 6px;
            cursor: pointer;
            padding: 10px;
            z-index: 1001;
        }

        .hamburger span {
            width: 30px;
            height: 3px;
            background: #c59d5f;
            transition: all 0.3s;
            border-radius: 2px;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(8px, -8px);
        }

        /* Sidebar Menu */
        .nav-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 350px;
            height: 100vh;
            background: rgba(0, 0, 0, 0.98);
            backdrop-filter: blur(10px);
            padding: 80px 40px;
            transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            border-left: 1px solid rgba(197, 157, 95, 0.3);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .nav-menu.active {
            right: 0;
        }

        .menu-item {
            padding: 20px 25px;
            background: rgba(197, 157, 95, 0.1);
            border: 2px solid rgba(197, 157, 95, 0.3);
            border-radius: 8px;
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            display: block;
        }

        .menu-item:hover {
            background: #c59d5f;
            border-color: #c59d5f;
            transform: translateX(-10px);
        }

        .menu-item:hover .menu-icon {
            color: #000;
        }

        .menu-item:hover .menu-title,
        .menu-item:hover .menu-desc {
            color: #000;
        }

        .menu-icon {
            font-size: 32px;
            color: #c59d5f;
            margin-bottom: 10px;
            transition: all 0.3s;
        }

        .menu-title {
            font-size: 22px;
            color: #fff;
            font-weight: bold;
            margin-bottom: 8px;
            letter-spacing: 2px;
            transition: all 0.3s;
        }

        .menu-desc {
            font-size: 13px;
            color: #999;
            font-family: 'Arial', sans-serif;
            transition: all 0.3s;
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
            z-index: 999;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                        url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .hero-content {
            text-align: center;
            max-width: 900px;
            padding: 20px;
            animation: fadeInUp 1.2s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-subtitle {
            font-size: 16px;
            color: #c59d5f;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 20px;
            font-weight: 300;
        }

        .hero-title {
            font-size: 72px;
            font-weight: bold;
            margin-bottom: 30px;
            line-height: 1.2;
            color: #fff;
            text-shadow: 2px 2px 20px rgba(0, 0, 0, 0.8);
        }

        .hero-divider {
            width: 80px;
            height: 2px;
            background: #c59d5f;
            margin: 30px auto;
        }

        .hero-description {
            font-size: 18px;
            line-height: 1.8;
            color: #ccc;
            margin-bottom: 50px;
            font-family: 'Arial', sans-serif;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .btn {
            padding: 16px 40px;
            font-size: 15px;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: 2px solid #c59d5f;
            background: transparent;
            color: #c59d5f;
            cursor: pointer;
            transition: all 0.4s;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
        }

        .btn-primary {
            background: #c59d5f;
            color: #000;
        }

        .btn:hover {
            background: #c59d5f;
            color: #000;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(197, 157, 95, 0.4);
        }

        .btn-primary:hover {
            background: transparent;
            color: #c59d5f;
        }

        /* About Section */
        .about-section {
            padding: 120px 50px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
            background: #0a0a0a;
        }

        .about-image {
            position: relative;
            height: 600px;
        }

        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 8px solid #c59d5f;
        }

        .about-content {
            padding: 40px;
        }

        .section-subtitle {
            font-size: 14px;
            color: #c59d5f;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        .section-title {
            font-size: 48px;
            margin-bottom: 30px;
            color: #fff;
        }

        .about-text {
            font-size: 16px;
            line-height: 1.8;
            color: #999;
            margin-bottom: 20px;
            font-family: 'Arial', sans-serif;
        }

        /* Menu Showcase */
        .menu-showcase {
            padding: 120px 50px;
            background: #111;
        }

        .showcase-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .menu-item-card {
            position: relative;
            height: 400px;
            overflow: hidden;
            cursor: pointer;
        }

        .menu-item-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s;
        }

        .menu-item-card:hover img {
            transform: scale(1.1);
        }

        .menu-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 30px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
            transform: translateY(100%);
            transition: transform 0.4s;
        }

        .menu-item-card:hover .menu-overlay {
            transform: translateY(0);
        }

        .menu-overlay h4 {
            font-size: 24px;
            color: #c59d5f;
            margin-bottom: 10px;
        }

        .menu-overlay p {
            font-size: 14px;
            color: #ccc;
        }

        /* CTA Section */
        .cta-section {
            padding: 120px 50px;
            text-align: center;
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),
                        url('https://images.unsplash.com/photo-1550966871-3ed3cdb5ed0c?w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .cta-content h2 {
            font-size: 48px;
            margin-bottom: 20px;
            color: #fff;
        }

        .cta-content p {
            font-size: 18px;
            color: #ccc;
            margin-bottom: 40px;
        }

        /* Footer */
        footer {
            background: #000;
            padding: 40px 50px;
            text-align: center;
            border-top: 1px solid rgba(197, 157, 95, 0.2);
        }

        footer p {
            color: #666;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .about-section {
                grid-template-columns: 1fr;
            }

            .menu-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-title {
                font-size: 48px;
            }

            .nav-menu {
                width: 300px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 20px;
            }

            .logo-text {
                font-size: 24px;
            }

            .contact-info {
                display: none;
            }

            .hero-title {
                font-size: 36px;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .menu-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 32px;
            }

            .nav-menu {
                width: 280px;
            }
        }
    </style>
</head>
<body>
    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <div class="logo-text">RESTORANKU</div>
            <div class="contact-info">
                <div class="contact-item">📞 <a href="tel:085803681573">085803681573</a></div>
                <div class="contact-item">✉️ <a href="mailto:admin123@gmail.com">admin123@gmail.com</a></div>
            </div>
        </div>
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <!-- Sidebar Menu -->
    <div class="nav-menu" id="navMenu">
        <a href="{{ route('choose.role') }}" class="menu-item">
            <div class="menu-icon">🔐</div>
            <div class="menu-title">Login</div>
            <div class="menu-desc">Masuk ke akun Anda</div>
        </a>
        <a href="{{ route('customer.auth.choice') }}" class="menu-item">
            <div class="menu-icon">🛒</div>
            <div class="menu-title">Pesan</div>
            <div class="menu-desc">Pesan makanan sekarang</div>
        </a>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-subtitle">Selamat Datang di Restoranku</div>
            <h1 class="hero-title">Restoranku</h1>
            <div class="hero-divider"></div>
            <p class="hero-description">
                Rasakan pengalaman kuliner terbaik dalam suasana yang elegan.
                Para koki ahli kami menyajikan setiap hidangan dengan penuh dedikasi dan ketelitian,
                menggunakan bahan-bahan segar berkualitas tinggi untuk menciptakan cita rasa yang tak terlupakan.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('customer.auth.choice') }}" class="btn btn-primary">Pesan Sekarang</a>
                <a href="#menu" class="btn">Lihat Menu</a>
            </div>
        </div>
    </section>



    <!-- Menu Showcase -->
    <section class="menu-showcase" id="menu">
        <div class="showcase-header">
            <div class="section-subtitle">Spesial Kami</div>
            <h2 class="section-title">Hidangan Signature</h2>
        </div>
        <div class="menu-grid">
            <div class="menu-item-card">
                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&q=80" alt="Salad Segar">
                <div class="menu-overlay">
                    <h4>Salad Segar Taman</h4>
                    <p>Sayuran organik dengan vinaigrette khas</p>
                </div>
            </div>
            <div class="menu-item-card">
                <img src="https://images.unsplash.com/photo-1600891964092-4316c288032e?w=600&q=80" alt="Steak Panggang">
                <div class="menu-overlay">
                    <h4>Steak Daging Sapi Premium</h4>
                    <p>Dipanggang sempurna sesuai selera Anda</p>
                </div>
            </div>
            <div class="menu-item-card">
                <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=600&q=80" alt="Pizza Gourmet">
                <div class="menu-overlay">
                    <h4>Pizza Artisan</h4>
                    <p>Dipanggang kayu dengan topping premium</p>
                </div>
            </div>
            <div class="menu-item-card">
                <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600&q=80" alt="Pasta">
                <div class="menu-overlay">
                    <h4>Pasta Buatan Tangan</h4>
                    <p>Resep tradisional Italia</p>
                </div>
            </div>
            <div class="menu-item-card">
                <img src="https://images.unsplash.com/photo-1580476262798-bddd9f4b7369?w=600&q=80" alt="Dessert">
                <div class="menu-overlay">
                    <h4>Dessert Lezat</h4>
                    <p>Akhir yang manis sempurna</p>
                </div>
            </div>
            <div class="menu-item-card">
                <img src="https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?w=600&q=80" alt="Koktail">
                <div class="menu-overlay">
                    <h4>Koktail Signature</h4>
                    <p>Dibuat oleh mixologist ahli</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Siap untuk Pengalaman yang Tak Terlupakan?</h2>
            <p>Pesan sekarang dan nikmati keunggulan kuliner</p>
            <a href="{{ route('customer.auth.choice') }}" class="btn btn-primary">Pesan Sekarang</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Restoranku. All rights reserved.</p>
    </footer>

    <script>
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        const overlay = document.getElementById('overlay');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', () => {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>
</body>
</html>