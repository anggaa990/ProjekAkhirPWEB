<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Customer - Restoranku</title>
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
            padding: 40px 20px;
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
        
        .container { 
            max-width: 1200px; 
            margin: 0 auto; 
            position: relative;
            z-index: 1;
        }
        
        .header {
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 50px 45px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
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
        
        .header::before {
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
        
        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .welcome-text h1 { 
            color: #c59d5f;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }
        
        .welcome-text p { 
            color: #999;
            font-size: 16px;
            font-family: 'Arial', sans-serif;
            letter-spacing: 1px;
        }
        
        .logout-btn {
            background: transparent;
            border: 2px solid #c59d5f;
            color: #c59d5f;
            padding: 14px 30px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
            text-transform: uppercase;
        }
        
        .logout-btn:hover { 
            background: #c59d5f;
            color: #000;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(197, 157, 95, 0.4);
        }
        
        .stats-bar {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-top: 35px;
        }
        
        .stat-item {
            background: rgba(17, 17, 17, 0.8);
            border: 1px solid rgba(197, 157, 95, 0.3);
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            border-color: #c59d5f;
            background: rgba(197, 157, 95, 0.1);
            transform: translateY(-5px);
        }
        
        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #c59d5f;
            margin-bottom: 8px;
            font-family: 'Arial', sans-serif;
        }
        
        .stat-label {
            font-size: 13px;
            color: #999;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: 'Arial', sans-serif;
        }
        
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .card {
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 45px 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            transition: all 0.4s ease;
            text-decoration: none;
            color: inherit;
            display: block;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s ease backwards;
        }
        
        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(197, 157, 95, 0.1), transparent);
            transition: left 0.5s;
        }

        .card:hover::before {
            left: 100%;
        }
        
        .card:hover { 
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(197, 157, 95, 0.3);
            border-color: #c59d5f;
        }
        
        .card-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }
        
        .card-icon { 
            font-size: 64px; 
            margin-bottom: 25px;
            display: inline-block;
            transition: transform 0.4s ease;
        }
        
        .card:hover .card-icon {
            transform: scale(1.15) rotateY(360deg);
        }
        
        .card h3 { 
            color: #fff;
            margin-bottom: 15px;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
        }
        
        .card p { 
            color: #999;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 25px;
            font-family: 'Arial', sans-serif;
        }
        
        .card-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 30px;
            background: #c59d5f;
            color: #000;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
        }
        
        .card:hover .card-btn {
            background: transparent;
            color: #c59d5f;
            box-shadow: inset 0 0 0 2px #c59d5f;
        }
        
        .reviews-section {
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 45px 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            margin-top: 40px;
            animation: fadeInUp 0.8s ease 0.4s backwards;
            position: relative;
            overflow: hidden;
        }

        .reviews-section::before {
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
        
        .reviews-section h3 {
            color: #c59d5f;
            margin-bottom: 35px;
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 2px;
            text-align: center;
        }
        
        .rating-summary {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 50px;
            margin-bottom: 40px;
        }
        
        .overall-rating {
            text-align: center;
            padding: 35px;
            background: rgba(17, 17, 17, 0.8);
            border: 2px solid rgba(197, 157, 95, 0.3);
        }
        
        .rating-number {
            font-size: 64px;
            font-weight: bold;
            color: #c59d5f;
            line-height: 1;
            margin-bottom: 15px;
            font-family: 'Arial', sans-serif;
        }
        
        .stars {
            font-size: 28px;
            color: #c59d5f;
            margin-bottom: 12px;
            letter-spacing: 3px;
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
            gap: 18px;
            justify-content: center;
        }
        
        .rating-bar {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .bar-label {
            font-size: 14px;
            color: #c59d5f;
            font-weight: 600;
            min-width: 40px;
            font-family: 'Arial', sans-serif;
        }
        
        .bar-container {
            flex: 1;
            height: 12px;
            background: rgba(197, 157, 95, 0.2);
            border: 1px solid rgba(197, 157, 95, 0.3);
            overflow: hidden;
        }
        
        .bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #c59d5f, #a07d4a);
            transition: width 1s ease;
        }
        
        .bar-count {
            font-size: 14px;
            color: #999;
            font-weight: 600;
            min-width: 40px;
            text-align: right;
            font-family: 'Arial', sans-serif;
        }
        
        .recent-reviews {
            display: grid;
            gap: 25px;
        }
        
        .review-item {
            background: rgba(17, 17, 17, 0.8);
            padding: 30px;
            border: 1px solid rgba(197, 157, 95, 0.3);
            transition: all 0.3s ease;
        }
        
        .review-item:hover {
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
            font-weight: bold;
            font-size: 20px;
            font-family: 'Arial', sans-serif;
        }
        
        .reviewer-name {
            font-weight: 600;
            color: #fff;
            font-size: 16px;
            margin-bottom: 5px;
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
            padding: 60px 40px;
            color: #999;
        }
        
        .no-reviews-icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.3;
            color: #c59d5f;
        }

        .no-reviews p {
            font-size: 16px;
            font-family: 'Arial', sans-serif;
        }
        
        @media (max-width: 1024px) {
            .rating-summary { 
                grid-template-columns: 1fr; 
                gap: 30px; 
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 20px 15px;
            }

            .header { 
                padding: 35px 25px; 
            }
            
            .header-top { 
                flex-direction: column; 
                align-items: flex-start; 
                gap: 20px; 
            }
            
            .logout-btn { 
                width: 100%;
            }
            
            .welcome-text h1 { 
                font-size: 28px; 
            }
            
            .cards { 
                grid-template-columns: 1fr; 
                gap: 25px; 
            }
            
            .card { 
                padding: 35px 25px; 
            }

            .reviews-section {
                padding: 35px 25px;
            }

            .rating-summary {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <div class="container">
        <div class="header">
            <div class="header-top">
                <div class="welcome-text">
                    <h1><i class="fas fa-home"></i> Dashboard</h1>
                    <p>Selamat Datang, {{ auth()->user()->name }}!</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
            
            <div class="stats-bar">
                <div class="stat-item">
                    <div class="stat-number">{{ $totalReservations }}</div>
                    <div class="stat-label">Total Reservasi</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $activeReservations }}</div>
                    <div class="stat-label">Aktif</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $completedReservations }}</div>
                    <div class="stat-label">Selesai</div>
                </div>
            </div>
        </div>

        <div class="cards">
            <a href="{{ route('customer.reservations.create') }}" class="card">
                <div class="card-content">
                    <div class="card-icon"><i class="fas fa-calendar-plus"></i></div>
                    <h3>BUAT RESERVASI</h3>
                    <p>Pesan meja dan menu sekaligus untuk pengalaman dining yang sempurna</p>
                    <span class="card-btn">
                        Buat Sekarang <i class="fas fa-arrow-right"></i>
                    </span>
                </div>
            </a>

            <a href="{{ route('customer.reservations.index') }}" class="card">
                <div class="card-content">
                    <div class="card-icon"><i class="fas fa-list-alt"></i></div>
                    <h3>RESERVASI SAYA</h3>
                    <p>Lihat semua reservasi dan pesanan yang telah Anda buat</p>
                    <span class="card-btn">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </span>
                </div>
            </a>

            <a href="{{ route('menu') }}" class="card">
                <div class="card-content">
                    <div class="card-icon"><i class="fas fa-utensils"></i></div>
                    <h3>LIHAT MENU</h3>
                    <p>Jelajahi menu lezat kami sebelum membuat reservasi</p>
                    <span class="card-btn">
                        Jelajahi Menu <i class="fas fa-arrow-right"></i>
                    </span>
                </div>
            </a>
        </div>

        <div class="reviews-section">
            <h3><i class="fas fa-star"></i> RATING & ULASAN</h3>
            
            @if($totalReviews > 0)
            <div class="rating-summary">
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
                            <span class="bar-count">{{ $count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="recent-reviews">
                @foreach($recentReviews as $review)
                <div class="review-item">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <span class="reviewer-avatar">{{ strtoupper(substr($review->user->name, 0, 1)) }}</span>
                            <div>
                                <div class="reviewer-name">{{ $review->user->name }}</div>
                                <div class="review-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        {{ $i <= $review->rating ? '★' : '☆' }}
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <span class="review-date">{{ $review->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="review-text">{{ $review->comment }}</p>
                </div>
                @endforeach
            </div>
            @else
            <div class="no-reviews">
                <div class="no-reviews-icon"><i class="fas fa-star"></i></div>
                <p>Belum ada ulasan. Jadilah yang pertama memberikan ulasan!</p>
            </div>
            @endif
        </div>
    </div>
</body>
</html>