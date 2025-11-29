<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; }
        
        nav { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 15px 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        nav .nav-content { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        nav .nav-links a { color: white; text-decoration: none; margin-right: 25px; font-weight: 500; transition: opacity 0.3s; }
        nav .nav-links a:hover { opacity: 0.8; }
        .logout-btn { background: rgba(255,255,255,0.2); color: white; border: 2px solid white; padding: 8px 20px; cursor: pointer; border-radius: 5px; font-weight: 500; }
        
        .container { max-width: 1400px; margin: 30px auto; padding: 0 20px; }
        
        .welcome-section { background: white; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .welcome-section h1 { color: #2c3e50; font-size: 32px; margin-bottom: 10px; }
        .welcome-section p { color: #7f8c8d; font-size: 16px; }
        .welcome-section .user-info { display: flex; align-items: center; gap: 15px; margin-top: 15px; }
        .welcome-section .avatar { width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: bold; }
        .welcome-section .user-details h3 { color: #2c3e50; font-size: 20px; margin-bottom: 5px; }
        .welcome-section .badge { background: #667eea; color: white; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500; }
        
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); transition: transform 0.3s; position: relative; overflow: hidden; }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-card .icon { font-size: 36px; margin-bottom: 15px; }
        .stat-card h3 { color: #7f8c8d; font-size: 14px; font-weight: 500; margin-bottom: 10px; text-transform: uppercase; }
        .stat-card .value { font-size: 36px; font-weight: bold; color: #2c3e50; }
        
        .quick-actions { background: white; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .quick-actions h2 { color: #2c3e50; margin-bottom: 20px; font-size: 24px; }
        .actions-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; }
        .action-btn { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 10px; text-decoration: none; display: flex; align-items: center; gap: 15px; transition: transform 0.3s; }
        .action-btn:hover { transform: translateY(-3px); }
        .action-btn .icon { font-size: 28px; }
        .action-btn .text h3 { font-size: 16px; margin-bottom: 5px; }
        .action-btn .text p { font-size: 12px; opacity: 0.9; }
        
        .tables-overview { background: white; border-radius: 12px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .tables-overview h2 { color: #2c3e50; margin-bottom: 20px; font-size: 24px; }
        .tables-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 15px; }
        .table-item { padding: 20px; border-radius: 10px; text-align: center; border: 2px solid #ecf0f1; transition: all 0.3s; }
        .table-item.available { background: #d4edda; border-color: #27ae60; }
        .table-item.reserved { background: #fff3cd; border-color: #f39c12; }
        .table-item.occupied { background: #f8d7da; border-color: #e74c3c; }
        .table-item h4 { color: #2c3e50; margin-bottom: 5px; }
        .table-item p { font-size: 12px; color: #7f8c8d; }
    </style>
</head>
<body>
    <nav>
        <div class="nav-content">
            <div class="nav-links">
                <a href="{{ route('employee.dashboard') }}">🏠 Dashboard</a>
                <a href="{{ route('employee.reservations.index') }}">📅 Reservasi</a>
                <a href="{{ route('employee.orders.index') }}">🛒 Pesanan</a>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="welcome-section">
            <h1>Selamat Datang Kembali! 👋</h1>
            <p>Dashboard karyawan restoran</p>
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
                <div class="icon">📅</div>
                <h3>Reservasi Hari Ini</h3>
                <div class="value">{{ \App\Models\Reservation::whereDate('date', today())->count() }}</div>
            </div>
            
            <div class="stat-card">
                <div class="icon">⏳</div>
                <h3>Reservasi Pending</h3>
                <div class="value">{{ \App\Models\Reservation::where('status', 'pending')->count() }}</div>
            </div>
            
            <div class="stat-card">
                <div class="icon">🛒</div>
                <h3>Pesanan Aktif</h3>
                <div class="value">{{ \App\Models\Order::whereIn('status', ['pending', 'confirmed', 'cooking'])->count() }}</div>
            </div>
            
            <div class="stat-card">
                <div class="icon">🪑</div>
                <h3>Meja Tersedia</h3>
                <div class="value">{{ \App\Models\RestaurantTable::where('status', 'available')->count() }}</div>
            </div>
        </div>

        <div class="quick-actions">
            <h2>⚡ Aksi Cepat</h2>
            <div class="actions-grid">
                <a href="{{ route('employee.reservations.index') }}" class="action-btn">
                    <div class="icon">📋</div>
                    <div class="text">
                        <h3>Kelola Reservasi</h3>
                        <p>Terima/tolak reservasi pelanggan</p>
                    </div>
                </a>
                
                <a href="{{ route('employee.orders.index') }}" class="action-btn">
                    <div class="icon">🍽️</div>
                    <div class="text">
                        <h3>Kelola Pesanan</h3>
                        <p>Update status pesanan</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="tables-overview">
            <h2>🪑 Status Meja Restoran</h2>
            <div class="tables-grid">
                @foreach(\App\Models\RestaurantTable::all() as $table)
                <div class="table-item {{ $table->status }}">
                    <h4>{{ $table->name }}</h4>
                    <p>{{ $table->capacity }} orang</p>
                    <p><strong>{{ ucfirst($table->status) }}</strong></p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>