<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard - Restoranku</title>
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
        
        .container { 
            max-width: 1400px; 
            margin: 0 auto; 
            padding: 40px 20px;
            position: relative;
            z-index: 1;
        }
        
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

        .welcome-section .user-details h3 { 
            color: #fff;
            font-size: 22px;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .welcome-section .badge { 
            background: rgba(197, 157, 95, 0.2);
            color: #c59d5f;
            padding: 6px 16px;
            border: 1px solid rgba(197, 157, 95, 0.3);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
        }
        
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
            font-family: 'Arial', sans-serif;
        }
        
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
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
            gap: 25px; 
        }

        .action-btn { 
            background: rgba(17, 17, 17, 0.8);
            border: 2px solid rgba(197, 157, 95, 0.3);
            color: white;
            padding: 30px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.4s;
        }

        .action-btn:hover { 
            transform: translateY(-5px);
            border-color: #c59d5f;
            background: rgba(197, 157, 95, 0.1);
            box-shadow: 0 10px 30px rgba(197, 157, 95, 0.3);
        }

        .action-btn .icon { 
            font-size: 40px;
        }

        .action-btn .text h3 { 
            font-size: 18px;
            margin-bottom: 8px;
            color: #c59d5f;
            letter-spacing: 1px;
        }

        .action-btn .text p { 
            font-size: 13px;
            color: #999;
            font-family: 'Arial', sans-serif;
        }
        
        .tables-overview { 
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 40px 45px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            animation: fadeInUp 0.6s ease 0.6s backwards;
        }

        .tables-overview h2 { 
            color: #c59d5f;
            margin-bottom: 30px;
            font-size: 28px;
            letter-spacing: 2px;
        }

        .tables-overview h2 i {
            margin-right: 12px;
        }

        .tables-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); 
            gap: 20px; 
        }

        .table-item { 
            padding: 25px 20px;
            text-align: center;
            border: 2px solid;
            transition: all 0.3s;
        }

        .table-item.available { 
            background: rgba(74, 222, 128, 0.1);
            border-color: rgba(74, 222, 128, 0.3);
        }

        .table-item.reserved { 
            background: rgba(251, 191, 36, 0.1);
            border-color: rgba(251, 191, 36, 0.3);
        }

        .table-item.occupied { 
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.3);
        }

        .table-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }

        .table-item h4 { 
            color: #fff;
            margin-bottom: 8px;
            font-size: 18px;
            letter-spacing: 1px;
        }

        .table-item p { 
            font-size: 13px;
            color: #999;
            margin-bottom: 5px;
            font-family: 'Arial', sans-serif;
        }

        .table-item .status {
            font-weight: 600;
            margin-top: 10px;
            padding: 5px 10px;
            display: inline-block;
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: 'Arial', sans-serif;
        }

        .table-item.available .status {
            color: #4ade80;
        }

        .table-item.reserved .status {
            color: #fbbf24;
        }

        .table-item.occupied .status {
            color: #ef4444;
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

            .tables-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
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
                <a href="{{ route('employee.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
                <a href="{{ route('employee.reservations.index') }}"><i class="fas fa-calendar-check"></i> Reservasi</a>
                <a href="{{ route('employee.orders.index') }}"><i class="fas fa-shopping-cart"></i> Pesanan</a>
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
        <div class="welcome-section">
            <h1><i class="fas fa-hand-sparkles"></i> Selamat Datang Kembali!</h1>
            <p>Dashboard Karyawan Restoran</p>
            <div class="user-info">
                <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div class="user-details">
                    <h3>{{ Auth::user()->name }}</h3>
                    <span class="badge">{{ strtoupper(Auth::user()->role) }}</span>
                </div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="icon"><i class="fas fa-calendar-day"></i></div>
                <h3>Reservasi Hari Ini</h3>
                <div class="value">{{ \App\Models\Reservation::whereDate('date', today())->count() }}</div>
            </div>
            
            <div class="stat-card">
                <div class="icon"><i class="fas fa-clock"></i></div>
                <h3>Reservasi Pending</h3>
                <div class="value">{{ \App\Models\Reservation::where('status', 'pending')->count() }}</div>
            </div>
            
            <div class="stat-card">
                <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                <h3>Pesanan Aktif</h3>
                <div class="value">{{ \App\Models\Order::whereIn('status', ['pending', 'confirmed', 'cooking'])->count() }}</div>
            </div>
            
            <div class="stat-card">
                <div class="icon"><i class="fas fa-chair"></i></div>
                <h3>Meja Tersedia</h3>
                <div class="value">{{ \App\Models\RestaurantTable::where('status', 'available')->count() }}</div>
            </div>
        </div>

        <div class="quick-actions">
            <h2><i class="fas fa-bolt"></i> AKSI CEPAT</h2>
            <div class="actions-grid">
                <a href="{{ route('employee.reservations.index') }}" class="action-btn">
                    <div class="icon"><i class="fas fa-clipboard-list"></i></div>
                    <div class="text">
                        <h3>Kelola Reservasi</h3>
                        <p>Terima/tolak reservasi pelanggan</p>
                    </div>
                </a>
                
                <a href="{{ route('employee.orders.index') }}" class="action-btn">
                    <div class="icon"><i class="fas fa-concierge-bell"></i></div>
                    <div class="text">
                        <h3>Kelola Pesanan</h3>
                        <p>Update status pesanan</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="tables-overview">
            <h2><i class="fas fa-th"></i> STATUS MEJA RESTORAN</h2>
            <div class="tables-grid">
                @foreach(\App\Models\RestaurantTable::all() as $table)
                <div class="table-item {{ $table->status }}">
                    <h4>{{ $table->name }}</h4>
                    <p><i class="fas fa-users"></i> {{ $table->capacity }} orang</p>
                    <div class="status">{{ ucfirst($table->status) }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>