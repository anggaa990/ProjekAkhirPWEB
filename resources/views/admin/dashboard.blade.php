<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Restoranku</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Georgia', 'Times New Roman', serif;
            background: #0a0a0a;
            color: #fff;
        }

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
        
        /* Navigation */
        nav { 
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px 50px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            border-bottom: 1px solid rgba(197, 157, 95, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav .nav-content { 
            max-width: 1400px; 
            margin: 0 auto; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }

        .nav-brand {
            color: #c59d5f;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        nav .nav-links a { 
            color: #999;
            text-decoration: none; 
            margin-right: 30px;
            font-size: 14px;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
            text-transform: uppercase;
            transition: color 0.3s;
            font-weight: 600;
        }

        nav .nav-links a:hover { 
            color: #c59d5f;
        }

        nav .nav-links a i {
            margin-right: 8px;
        }

        .logout-btn { 
            background: transparent;
            color: #c59d5f;
            border: 2px solid #c59d5f;
            padding: 10px 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: 'Arial', sans-serif;
            font-size: 13px;
        }

        .logout-btn:hover {
            background: #c59d5f;
            color: #000;
        }
        
        /* Container */
        .container { 
            max-width: 1400px; 
            margin: 0 auto; 
            padding: 40px 20px;
            position: relative;
            z-index: 1;
        }
        
        /* Welcome Section */
        .welcome-section { 
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 40px 45px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #c59d5f, #a07d4a, #c59d5f);
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .welcome-section h1 { 
            color: #c59d5f;
            font-size: 36px;
            margin-bottom: 12px;
            letter-spacing: 2px;
        }

        .welcome-section p { 
            color: #999;
            font-size: 16px;
            font-family: 'Arial', sans-serif;
            letter-spacing: 1px;
        }

        .welcome-section .user-info { 
            display: flex; 
            align-items: center; 
            gap: 20px; 
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid rgba(197, 157, 95, 0.2);
        }

        .welcome-section .avatar { 
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #c59d5f, #a07d4a);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-size: 28px;
            font-weight: bold;
            font-family: 'Arial', sans-serif;
            box-shadow: 0 5px 20px rgba(197, 157, 95, 0.4);
        }

        .welcome-section .user-details { flex: 1; }
        .welcome-section .user-details h3 { 
            color: #fff;
            font-size: 22px;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .welcome-section .user-details .badge { 
            background: rgba(197, 157, 95, 0.2);
            color: #c59d5f;
            padding: 6px 16px;
            border: 1px solid rgba(197, 157, 95, 0.3);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
        }
        
        /* Stats Grid */
        .stats-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); 
            gap: 25px; 
            margin-bottom: 40px; 
        }

        .stat-card { 
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 35px 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            transition: all 0.4s;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.6s ease backwards;
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }

        .stat-card:hover { 
            transform: translateY(-8px);
            border-color: #c59d5f;
            box-shadow: 0 15px 50px rgba(197, 157, 95, 0.3);
        }
        
        .stat-card .icon { 
            font-size: 48px;
            margin-bottom: 20px;
            display: block;
        }
        
        .stat-card h3 { 
            color: #999;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
        }

        .stat-card .value { 
            font-size: 42px;
            font-weight: bold;
            color: #c59d5f;
            margin-bottom: 12px;
            font-family: 'Arial', sans-serif;
        }

        .stat-card .change { 
            font-size: 13px;
            color: #999;
            font-family: 'Arial', sans-serif;
        }
        
        /* Quick Actions */
        .quick-actions { 
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 40px 45px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            animation: fadeInUp 0.6s ease 0.5s backwards;
        }

        .quick-actions h2 { 
            color: #c59d5f;
            margin-bottom: 30px;
            font-size: 28px;
            letter-spacing: 2px;
        }

        .quick-actions h2 i {
            margin-right: 12px;
        }

        .actions-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
            gap: 20px; 
        }

        .action-btn { 
            background: rgba(17, 17, 17, 0.8);
            border: 2px solid rgba(197, 157, 95, 0.3);
            color: white;
            padding: 28px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: all 0.4s;
        }

        .action-btn:hover { 
            transform: translateY(-5px);
            border-color: #c59d5f;
            background: rgba(197, 157, 95, 0.1);
            box-shadow: 0 10px 30px rgba(197, 157, 95, 0.3);
        }

        .action-btn .icon { 
            font-size: 36px;
            color: #c59d5f;
        }

        .action-btn .text { flex: 1; }
        .action-btn .text h3 { 
            font-size: 17px;
            margin-bottom: 8px;
            color: #fff;
            letter-spacing: 1px;
        }

        .action-btn .text p { 
            font-size: 13px;
            color: #999;
            font-family: 'Arial', sans-serif;
        }
        
        /* Rating Section */
        .rating-section { 
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 40px 45px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            animation: fadeInUp 0.6s ease 0.6s backwards;
        }

        .rating-section h2 { 
            color: #c59d5f;
            margin-bottom: 35px;
            font-size: 28px;
            letter-spacing: 2px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .rating-overview { 
            display: grid; 
            grid-template-columns: 300px 1fr; 
            gap: 40px; 
            margin-bottom: 40px;
            padding: 30px;
            background: rgba(17, 17, 17, 0.8);
            border: 1px solid rgba(197, 157, 95, 0.2);
        }
        
        .overall-rating { 
            text-align: center; 
            padding: 30px;
            background: rgba(26, 26, 26, 0.9);
            border: 2px solid rgba(197, 157, 95, 0.3);
        }

        .rating-number { 
            font-size: 72px;
            font-weight: 700;
            color: #c59d5f;
            line-height: 1;
            margin-bottom: 18px;
            font-family: 'Arial', sans-serif;
        }

        .stars { 
            font-size: 32px;
            color: #c59d5f;
            margin-bottom: 15px;
            letter-spacing: 4px;
        }

        .rating-text { 
            font-size: 14px;
            color: #999;
            font-weight: 600;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
        }
        
        .rating-bars { 
            display: flex; 
            flex-direction: column; 
            gap: 20px; 
            justify-content: center; 
        }

        .rating-bar { 
            display: flex; 
            align-items: center; 
            gap: 15px; 
        }

        .bar-label { 
            font-size: 15px;
            color: #c59d5f;
            font-weight: 600;
            min-width: 45px;
            font-family: 'Arial', sans-serif;
        }

        .bar-container { 
            flex: 1;
            height: 14px;
            background: rgba(197, 157, 95, 0.2);
            border: 1px solid rgba(197, 157, 95, 0.3);
            overflow: hidden;
        }

        .bar-fill { 
            height: 100%;
            background: linear-gradient(90deg, #c59d5f, #a07d4a);
            transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .bar-count { 
            font-size: 14px;
            color: #999;
            font-weight: 600;
            min-width: 80px;
            text-align: right;
            font-family: 'Arial', sans-serif;
        }
        
        .reviews-list { 
            display: grid; 
            gap: 20px; 
        }

        .reviews-list h3 {
            color: #c59d5f;
            margin-bottom: 20px;
            font-size: 20px;
            letter-spacing: 1px;
        }

        .review-card { 
            background: rgba(17, 17, 17, 0.8);
            padding: 25px;
            border: 1px solid rgba(197, 157, 95, 0.3);
            transition: all 0.3s;
        }

        .review-card:hover { 
            border-color: #c59d5f;
            background: rgba(197, 157, 95, 0.05);
            transform: translateX(10px);
        }
        
        .review-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 15px; 
        }

        .reviewer-info { 
            display: flex; 
            align-items: center; 
            gap: 15px; 
        }

        .reviewer-avatar { 
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #c59d5f, #a07d4a);
            color: #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 20px;
            font-family: 'Arial', sans-serif;
        }

        .reviewer-details h4 { 
            color: #fff;
            font-size: 16px;
            margin-bottom: 6px;
            font-weight: 600;
            font-family: 'Arial', sans-serif;
        }

        .review-stars { 
            color: #c59d5f;
            font-size: 16px;
            letter-spacing: 2px;
        }

        .review-date { 
            font-size: 13px;
            color: #666;
            font-family: 'Arial', sans-serif;
        }

        .review-text { 
            color: #999;
            font-size: 14px;
            line-height: 1.7;
            font-family: 'Arial', sans-serif;
        }
        
        .no-reviews { 
            text-align: center;
            padding: 80px 40px;
            color: #999;
        }

        .no-reviews-icon { 
            font-size: 80px;
            margin-bottom: 25px;
            opacity: 0.3;
            color: #c59d5f;
        }

        .no-reviews h3 {
            color: #c59d5f;
            margin-bottom: 12px;
            font-size: 24px;
        }
        
        /* Recent Activity */
        .recent-activity { 
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 40px 45px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            animation: fadeInUp 0.6s ease 0.7s backwards;
        }

        .recent-activity h2 { 
            color: #c59d5f;
            margin-bottom: 30px;
            font-size: 28px;
            letter-spacing: 2px;
        }

        .recent-activity h2 i {
            margin-right: 12px;
        }

        .activity-list { 
            list-style: none; 
        }

        .activity-item { 
            padding: 20px 0;
            border-bottom: 1px solid rgba(197, 157, 95, 0.2);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .activity-item:last-child { 
            border-bottom: none; 
        }

        .activity-icon { 
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: bold;
        }

        .activity-icon.success { 
            background: rgba(74, 222, 128, 0.2);
            color: #4ade80;
            border: 1px solid rgba(74, 222, 128, 0.3);
        }

        .activity-icon.warning { 
            background: rgba(251, 191, 36, 0.2);
            color: #fbbf24;
            border: 1px solid rgba(251, 191, 36, 0.3);
        }

        .activity-icon.info { 
            background: rgba(59, 130, 246, 0.2);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .activity-content { 
            flex: 1; 
        }

        .activity-content h4 { 
            color: #fff;
            font-size: 15px;
            margin-bottom: 6px;
            font-family: 'Arial', sans-serif;
        }

        .activity-content p { 
            color: #999;
            font-size: 13px;
            font-family: 'Arial', sans-serif;
        }

        .activity-time { 
            color: #666;
            font-size: 12px;
            font-family: 'Arial', sans-serif;
        }
        
        @media (max-width: 1024px) {
            .rating-overview { 
                grid-template-columns: 1fr; 
            }
        }

        @media (max-width: 768px) {
            nav {
                padding: 15px 20px;
            }

            nav .nav-content { 
                flex-direction: column; 
                gap: 15px; 
            }

            nav .nav-links {
                display: flex;
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            nav .nav-links a {
                margin: 0;
            }

            .container {
                padding: 20px 15px;
            }

            .welcome-section {
                padding: 30px 25px;
            }

            .welcome-section h1 {
                font-size: 28px;
            }

            .stats-grid { 
                grid-template-columns: 1fr; 
            }

            .actions-grid { 
                grid-template-columns: 1fr; 
            }

            .rating-overview { 
                grid-template-columns: 1fr; 
                gap: 20px; 
            }
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <nav>
        <div class="nav-content">
            <div class="nav-brand">
                <i class="fas fa-utensils"></i> RESTORANKU
            </div>
            <div class="nav-links">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
                <a href="{{ route('admin.categories.index') }}"><i class="fas fa-folder"></i> Kategori</a>
                <a href="{{ route('admin.menus.index') }}"><i class="fas fa-utensils"></i> Menu</a>
                <a href="{{ route('admin.reports.sales') }}"><i class="fas fa-chart-line"></i> Laporan</a>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1><i class="fas fa-hand-sparkles"></i> Selamat Datang Kembali!</h1>
            <p>Berikut ringkasan sistem restoran Anda hari ini</p>
            <div class="user-info">
                <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div class="user-details">
                    <h3>{{ Auth::user()->name }}</h3>
                    <span class="badge">{{ strtoupper(Auth::user()->role) }}</span>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="icon"><i class="fas fa-folder-open"></i></div>
                <h3>Total Kategori</h3>
                <div class="value">{{ \App\Models\Category::count() }}</div>
                <div class="change">Kategori menu aktif</div>
            </div>
            
            <div class="stat-card">
                <div class="icon"><i class="fas fa-utensils"></i></div>
                <h3>Total Menu</h3>
                <div class="value">{{ \App\Models\Menu::count() }}</div>
                <div class="change">{{ \App\Models\Menu::where('is_available', true)->count() }} tersedia</div>
            </div>
            
            <div class="stat-card">
                <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                <h3>Pesanan Hari Ini</h3>
                <div class="value">{{ \App\Models\Order::whereDate('created_at', today())->count() }}</div>
                <div class="change">{{ \App\Models\Order::where('status', 'pending')->count() }} menunggu</div>
            </div>
            
            <div class="stat-card">
                <div class="icon"><i class="fas fa-coins"></i></div>
                <h3>Pendapatan Hari Ini</h3>
                <div class="value">Rp {{ number_format(\App\Models\Order::whereDate('created_at', today())->where('status', 'completed')->sum('total'), 0, ',', '.') }}</div>
                <div class="change">Pesanan selesai</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h2><i class="fas fa-bolt"></i> AKSI CEPAT</h2>
            <div class="actions-grid">
                <a href="{{ route('admin.categories.create') }}" class="action-btn">
                    <div class="icon"><i class="fas fa-plus-circle"></i></div>
                    <div class="text">
                        <h3>Tambah Kategori</h3>
                        <p>Buat kategori menu baru</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.menus.create') }}" class="action-btn">
                    <div class="icon"><i class="fas fa-plus-square"></i></div>
                    <div class="text">
                        <h3>Tambah Menu</h3>
                        <p>Tambahkan menu makanan</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.reports.sales') }}" class="action-btn">
                    <div class="icon"><i class="fas fa-chart-bar"></i></div>
                    <div class="text">
                        <h3>Lihat Laporan</h3>
                        <p>Analisis penjualan</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.menus.index') }}" class="action-btn">
                    <div class="icon"><i class="fas fa-cog"></i></div>
                    <div class="text">
                        <h3>Kelola Menu</h3>
                        <p>Edit & hapus menu</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Rating & Reviews Section -->
        <div class="rating-section">
            <h2><i class="fas fa-star"></i> RATING & ULASAN CUSTOMER</h2>
            
            @php
                $reviews = \App\Models\Review::with('user')->get();
                $totalReviews = $reviews->count();
                $averageRating = $totalReviews > 0 ? $reviews->avg('rating') : 0;
                $ratingDistribution = \App\Models\Review::select('rating', \DB::raw('count(*) as count'))
                    ->groupBy('rating')
                    ->pluck('count', 'rating')
                    ->toArray();
                $recentReviews = \App\Models\Review::with('user')->orderBy('created_at', 'desc')->take(5)->get();
            @endphp
            
            @if($totalReviews > 0)
            <div class="rating-overview">
                <div class="overall-rating">
                    <div class="rating-number">{{ number_format($averageRating, 1) }}</div>
                    <div class="stars">
                        @php
                            $fullStars = floor($averageRating);
                            $hasHalfStar = ($averageRating - $fullStars) >= 0.5;
                        @endphp
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $fullStars)
                                ★
                            @elseif($i == $fullStars + 1 && $hasHalfStar)
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    <div class="rating-text">dari {{ $totalReviews }} ulasan</div>
                </div>
                
                <div class="rating-bars">
                    @foreach([5, 4, 3, 2, 1] as $star)
                        @php
                            $count = $ratingDistribution[$star] ?? 0;
                            $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                        @endphp
                        <div class="rating-bar">
                            <span class="bar-label">{{ $star }} ★</span>
                            <div class="bar-container">
                                <div class="bar-fill" style="width: {{ $percentage }}%"></div>
                            </div>
                            <span class="bar-count">{{ $count }} ulasan</span>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="reviews-list">
                <h3>Ulasan Terbaru</h3>
                @foreach($recentReviews as $review)
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">{{ strtoupper(substr($review->user->name, 0, 1)) }}</div>
                            <div class="reviewer-details">
                                <h4>{{ $review->user->name }}</h4>
                                <div class="review-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        {{ $i <= $review->rating ? '★' : '☆' }}
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <span class="review-date">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                    <div class="review-text">{{ $review->comment }}</div>
                </div>
                @endforeach
            </div>
            @else
            <div class="no-reviews">
                <div class="no-reviews-icon"><i class="fas fa-comment-slash"></i></div>
                <h3>Belum Ada Ulasan</h3>
                <p>Ulasan customer akan muncul di sini</p>
            </div>
            @endif
        </div>

        <!-- Recent Activity -->
        <div class="recent-activity">
            <h2><i class="fas fa-history"></i> AKTIVITAS TERBARU</h2>
            <ul class="activity-list">
                @php
                    $recentOrders = \App\Models\Order::with('user')->orderBy('created_at', 'desc')->take(5)->get();
                @endphp
                
                @forelse($recentOrders as $order)
                <li class="activity-item">
                    <div class="activity-icon {{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Pesanan #{{ $order->id }} - {{ $order->user->name }}</h4>
                        <p>
                            Status: 
                            @if($order->status == 'pending')
                                Menunggu Konfirmasi
                            @elseif($order->status == 'preparing')
                                Sedang Diproses
                            @elseif($order->status == 'ready')
                                Siap Diambil
                            @elseif($order->status == 'completed')
                                Selesai
                            @else
                                Dibatalkan
                            @endif
                            | Total: Rp {{ number_format($order->total, 0, ',', '.') }}
                        </p>
                    </div>
                    <span class="activity-time">{{ $order->created_at->diffForHumans() }}</span>
                </li>
                @empty
                <li class="activity-item" style="justify-content: center; border: none; padding: 40px;">
                    <div style="text-align: center; color: #999;">
                        <i class="fas fa-inbox" style="font-size: 48px; opacity: 0.3; margin-bottom: 15px; display: block;"></i>
                        <p>Belum ada aktivitas</p>
                    </div>
                </li>
                @endforelse
            </ul>
        </div>
    </div>

    <footer style="background: rgba(0, 0, 0, 0.95); padding: 30px 50px; text-align: center; border-top: 1px solid rgba(197, 157, 95, 0.2); margin-top: 40px;">
        <p style="color: #666; font-size: 14px; font-family: 'Arial', sans-serif;">&copy; 2024 Restoranku. All rights reserved.</p>
    </footer>

    <script>
        // Animate bars on load
        window.addEventListener('load', () => {
            const bars = document.querySelectorAll('.bar-fill');
            bars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 100);
            });
        });
    </script>
</body>
</html>