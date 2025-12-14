<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Restaurant - Restoranku</title>
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
            overflow-x: hidden;
        }

        /* Background */
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

        /* Navbar */
        .navbar {
            position: sticky;
            top: 0;
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(197, 157, 95, 0.2);
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 28px;
            font-weight: bold;
            color: #c59d5f;
            text-decoration: none;
            letter-spacing: 2px;
        }

        .navbar-brand i {
            margin-right: 10px;
        }

        .navbar-menu {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-link {
            color: #999;
            text-decoration: none;
            font-size: 14px;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
            transition: color 0.3s;
            text-transform: uppercase;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #c59d5f;
        }

        .nav-link.btn-logout {
            background: transparent;
            border: 2px solid #c59d5f;
            color: #c59d5f;
            padding: 8px 20px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .nav-link.btn-logout:hover {
            background: #c59d5f;
            color: #000;
        }

        /* Hero Section */
        .hero-section {
            padding: 100px 50px 80px;
            text-align: center;
            animation: fadeInUp 0.8s ease;
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

        .hero-section h1 {
            font-size: 48px;
            color: #c59d5f;
            margin-bottom: 15px;
            letter-spacing: 3px;
            font-weight: bold;
        }

        .hero-section p {
            font-size: 18px;
            color: #999;
            margin-bottom: 40px;
            font-family: 'Arial', sans-serif;
            letter-spacing: 1px;
        }

        /* Search Box */
        .search-box {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 18px 60px 18px 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(197, 157, 95, 0.3);
            color: #fff;
            font-size: 16px;
            font-family: 'Arial', sans-serif;
            outline: none;
            transition: all 0.3s;
        }

        .search-input::placeholder {
            color: #666;
        }

        .search-input:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #c59d5f;
            box-shadow: 0 0 20px rgba(197, 157, 95, 0.2);
        }

        .search-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #c59d5f;
            font-size: 20px;
            pointer-events: none;
        }

        /* Filter Section */
        .filter-section {
            padding: 40px 50px;
            background: rgba(17, 17, 17, 0.8);
            border-top: 1px solid rgba(197, 157, 95, 0.2);
            border-bottom: 1px solid rgba(197, 157, 95, 0.2);
        }

        .filter-title {
            text-align: center;
            color: #c59d5f;
            font-size: 18px;
            margin-bottom: 20px;
            letter-spacing: 2px;
            font-weight: 600;
            font-family: 'Arial', sans-serif;
            text-transform: uppercase;
        }

        .filter-chips {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .filter-chip {
            padding: 12px 25px;
            background: transparent;
            border: 2px solid rgba(197, 157, 95, 0.3);
            color: #999;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            font-family: 'Arial', sans-serif;
            letter-spacing: 1px;
        }

        .filter-chip:hover,
        .filter-chip.active {
            background: #c59d5f;
            color: #000;
            border-color: #c59d5f;
            transform: translateY(-3px);
        }

        .filter-chip i {
            margin-right: 8px;
        }

        /* Menu Grid */
        .menu-section {
            padding: 80px 50px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 35px;
        }

        .menu-card {
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            transition: all 0.4s ease;
            overflow: hidden;
            animation: fadeInUp 0.6s ease backwards;
        }

        .menu-card:nth-child(1) { animation-delay: 0.1s; }
        .menu-card:nth-child(2) { animation-delay: 0.2s; }
        .menu-card:nth-child(3) { animation-delay: 0.3s; }
        .menu-card:nth-child(4) { animation-delay: 0.4s; }
        .menu-card:nth-child(5) { animation-delay: 0.5s; }
        .menu-card:nth-child(6) { animation-delay: 0.6s; }

        .menu-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(197, 157, 95, 0.3);
            border-color: #c59d5f;
        }

        .menu-image {
            height: 250px;
            width: 100%;
            object-fit: cover;
            background: linear-gradient(135deg, #c59d5f, #a07d4a);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-size: 48px;
        }

        .menu-body {
            padding: 25px;
        }

        .menu-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }

        .menu-title {
            font-size: 22px;
            color: #fff;
            font-weight: bold;
            letter-spacing: 1px;
            flex: 1;
        }

        .category-badge {
            background: rgba(197, 157, 95, 0.2);
            color: #c59d5f;
            padding: 6px 14px;
            font-size: 12px;
            border: 1px solid rgba(197, 157, 95, 0.3);
            font-family: 'Arial', sans-serif;
            letter-spacing: 1px;
            margin-left: 10px;
        }

        .menu-description {
            color: #999;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
            font-family: 'Arial', sans-serif;
        }

        .menu-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .price-tag {
            background: linear-gradient(135deg, #c59d5f, #a07d4a);
            color: #000;
            padding: 10px 20px;
            font-weight: bold;
            font-size: 18px;
            font-family: 'Arial', sans-serif;
        }

        .stock-badge {
            padding: 6px 14px;
            font-size: 12px;
            font-family: 'Arial', sans-serif;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .badge-available {
            background: rgba(40, 167, 69, 0.2);
            color: #4ade80;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .badge-unavailable {
            background: rgba(220, 53, 69, 0.2);
            color: #f87171;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        .order-btn {
            width: 100%;
            padding: 14px;
            background: #c59d5f;
            color: #000;
            border: 2px solid #c59d5f;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            font-family: 'Arial', sans-serif;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s;
        }

        .order-btn:hover {
            background: transparent;
            color: #c59d5f;
        }

        .order-btn:disabled {
            background: #333;
            color: #666;
            border-color: #333;
            cursor: not-allowed;
        }

        .order-btn:disabled:hover {
            background: #333;
            color: #666;
        }

        .order-btn i {
            margin-right: 8px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 100px 50px;
            display: none;
        }

        .empty-state.show {
            display: block;
        }

        .empty-icon {
            font-size: 64px;
            color: #c59d5f;
            margin-bottom: 25px;
            opacity: 0.3;
        }

        .empty-title {
            font-size: 28px;
            color: #999;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        .empty-text {
            font-size: 16px;
            color: #666;
            font-family: 'Arial', sans-serif;
        }

        /* Footer */
        footer {
            background: #000;
            padding: 40px 50px;
            text-align: center;
            border-top: 1px solid rgba(197, 157, 95, 0.2);
            margin-top: 60px;
        }

        footer p {
            color: #666;
            font-size: 14px;
            font-family: 'Arial', sans-serif;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
                flex-direction: column;
                gap: 15px;
            }

            .navbar-menu {
                flex-direction: column;
                gap: 15px;
            }

            .hero-section {
                padding: 60px 20px 50px;
            }

            .hero-section h1 {
                font-size: 32px;
            }

            .filter-section {
                padding: 30px 20px;
            }

            .menu-section {
                padding: 50px 20px;
            }

            .menu-grid {
                grid-template-columns: 1fr;
            }

            footer {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ route('landing') }}" class="navbar-brand">
            <i class="fas fa-utensils"></i>RESTORANKU
        </a>
        <div class="navbar-menu">
            <a href="{{ route('landing') }}" class="nav-link">Home</a>
            <a href="{{ route('menu') }}" class="nav-link active">Menu</a>
            @auth
                @if(auth()->user()->role === 'customer')
                    <a href="{{ route('customer.dashboard') }}" class="nav-link">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link btn-logout">Logout</button>
                    </form>
                @endif
            @else
                <a href="{{ route('customer.auth.choice') }}" class="nav-link">Login / Register</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <h1><i class="fas fa-utensils"></i> MENU KAMI</h1>
        <p>Jelajahi berbagai hidangan lezat yang kami tawarkan</p>
        
        <!-- Search Box -->
        <div class="search-box">
            <input type="text" class="search-input" id="searchMenu" placeholder="Cari menu favorit Anda...">
            <i class="fas fa-search search-icon"></i>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="filter-section">
        <div class="filter-title"><i class="fas fa-filter"></i> Filter Kategori</div>
        <div class="filter-chips" id="categoryFilters">
            <button class="filter-chip active" data-category="all">
                <i class="fas fa-th"></i>Semua
            </button>
            @foreach($categories as $category)
            <button class="filter-chip" data-category="{{ $category->id }}">
                <i class="fas fa-utensils"></i>{{ $category->name }}
            </button>
            @endforeach
        </div>
    </section>

    <!-- Menu Items -->
    <section class="menu-section">
        @if($menus->count() > 0)
        <div class="menu-grid" id="menuContainer">
            @foreach($menus as $menu)
            <div class="menu-card menu-item" data-category="{{ $menu->category_id }}" data-name="{{ strtolower($menu->name) }}" data-description="{{ strtolower($menu->description ?? '') }}">
                @if($menu->image)
                    <img src="{{ $menu->image }}" class="menu-image" alt="{{ $menu->name }}" style="width: 100%; height: 250px; object-fit: cover; display: block;">
                @else
                    <div class="menu-image">
                        <i class="fas fa-utensils"></i>
                    </div>
                @endif
                
                <div class="menu-body">
                    <div class="menu-header">
                        <h3 class="menu-title">{{ $menu->name }}</h3>
                        <span class="category-badge">{{ $menu->category->name }}</span>
                    </div>
                    
                    @if($menu->description)
                    <p class="menu-description">{{ Str::limit($menu->description, 80) }}</p>
                    @endif
                    
                    <div class="menu-footer">
                        <span class="price-tag">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                        @if($menu->is_available)
                            <span class="stock-badge badge-available">Tersedia</span>
                        @else
                            <span class="stock-badge badge-unavailable">Habis</span>
                        @endif
                    </div>
                    
                    @if($menu->is_available)
                    <button class="order-btn" onclick="orderMenu('{{ $menu->name }}')">
                        <i class="fas fa-shopping-cart"></i>Pesan Sekarang
                    </button>
                    @else
                    <button class="order-btn" disabled>
                        <i class="fas fa-times-circle"></i>Tidak Tersedia
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state show">
            <div class="empty-icon"><i class="fas fa-utensils"></i></div>
            <h2 class="empty-title">Belum Ada Menu</h2>
            <p class="empty-text">Menu akan segera ditambahkan</p>
        </div>
        @endif

        <!-- Empty State for Search/Filter -->
        <div id="emptyState" class="empty-state">
            <div class="empty-icon"><i class="fas fa-search"></i></div>
            <h2 class="empty-title">Menu Tidak Ditemukan</h2>
            <p class="empty-text">Coba kata kunci lain atau pilih kategori berbeda</p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Restoranku. All rights reserved.</p>
    </footer>

    <script>
        // Filter by category
        document.querySelectorAll('.filter-chip').forEach(chip => {
            chip.addEventListener('click', function() {
                document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                
                const category = this.dataset.category;
                const menuItems = document.querySelectorAll('.menu-item');
                let visibleCount = 0;
                
                menuItems.forEach(item => {
                    if (category === 'all' || item.dataset.category === category) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                const emptyState = document.getElementById('emptyState');
                const menuContainer = document.getElementById('menuContainer');
                
                if (visibleCount === 0) {
                    if (menuContainer) menuContainer.style.display = 'none';
                    emptyState.classList.add('show');
                } else {
                    if (menuContainer) menuContainer.style.display = 'grid';
                    emptyState.classList.remove('show');
                }
            });
        });

        // Search functionality
        document.getElementById('searchMenu').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const menuItems = document.querySelectorAll('.menu-item');
            let visibleCount = 0;
            
            menuItems.forEach(item => {
                const name = item.dataset.name;
                const description = item.dataset.description;
                
                if (name.includes(searchTerm) || description.includes(searchTerm)) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            const emptyState = document.getElementById('emptyState');
            const menuContainer = document.getElementById('menuContainer');
            
            if (visibleCount === 0) {
                if (menuContainer) menuContainer.style.display = 'none';
                emptyState.classList.add('show');
            } else {
                if (menuContainer) menuContainer.style.display = 'grid';
                emptyState.classList.remove('show');
            }
        });

        // Order menu function
        function orderMenu(menuName) {
            @auth
                @if(auth()->user()->role === 'customer')
                    window.location.href = "{{ route('customer.reservations.create') }}";
                @else
                    alert('Silakan login sebagai customer untuk melakukan pemesanan');
                    window.location.href = "{{ route('customer.auth.choice') }}";
                @endif
            @else
                alert('Silakan login terlebih dahulu untuk melakukan pemesanan');
                window.location.href = "{{ route('customer.auth.choice') }}";
            @endauth
        }
    </script>
</body>
</html>