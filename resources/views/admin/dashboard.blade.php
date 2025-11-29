<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Restoran</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; }
        
        /* Navigation */
        nav { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 15px 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        nav .nav-content { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        nav .nav-links a { color: white; text-decoration: none; margin-right: 25px; font-weight: 500; transition: opacity 0.3s; }
        nav .nav-links a:hover { opacity: 0.8; }
        .logout-btn { background: rgba(255,255,255,0.2); color: white; border: 2px solid white; padding: 8px 20px; cursor: pointer; border-radius: 5px; font-weight: 500; transition: all 0.3s; }
        .logout-btn:hover { background: white; color: #667eea; }
        
        /* Container */
        .container { max-width: 1400px; margin: 30px auto; padding: 0 20px; }
        
        /* Header */
        .welcome-section { background: white; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .welcome-section h1 { color: #2c3e50; font-size: 32px; margin-bottom: 10px; }
        .welcome-section p { color: #7f8c8d; font-size: 16px; }
        .welcome-section .user-info { display: flex; align-items: center; gap: 15px; margin-top: 15px; }
        .welcome-section .avatar { width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: bold; }
        .welcome-section .user-details { flex: 1; }
        .welcome-section .user-details h3 { color: #2c3e50; font-size: 20px; margin-bottom: 5px; }
        .welcome-section .user-details .badge { background: #667eea; color: white; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500; }
        
        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); transition: transform 0.3s, box-shadow 0.3s; position: relative; overflow: hidden; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.12); }
        .stat-card::before { content: ''; position: absolute; top: 0; right: 0; width: 100px; height: 100px; opacity: 0.1; border-radius: 50%; }
        .stat-card.categories::before { background: #3498db; }
        .stat-card.menus::before { background: #e67e22; }
        .stat-card.orders::before { background: #27ae60; }
        .stat-card.revenue::before { background: #9b59b6; }
        
        .stat-card .icon { font-size: 36px; margin-bottom: 15px; }
        .stat-card.categories .icon { color: #3498db; }
        .stat-card.menus .icon { color: #e67e22; }
        .stat-card.orders .icon { color: #27ae60; }
        .stat-card.revenue .icon { color: #9b59b6; }
        
        .stat-card h3 { color: #7f8c8d; font-size: 14px; font-weight: 500; margin-bottom: 10px; text-transform: uppercase; }
        .stat-card .value { font-size: 36px; font-weight: bold; color: #2c3e50; margin-bottom: 10px; }
        .stat-card .change { font-size: 14px; color: #27ae60; }
        .stat-card .change.negative { color: #e74c3c; }
        
        /* Quick Actions */
        .quick-actions { background: white; border-radius: 12px; padding: 30px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .quick-actions h2 { color: #2c3e50; margin-bottom: 20px; font-size: 24px; }
        .actions-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; }
        .action-btn { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 10px; text-decoration: none; display: flex; align-items: center; gap: 15px; transition: transform 0.3s, box-shadow 0.3s; }
        .action-btn:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4); }
        .action-btn .icon { font-size: 28px; }
        .action-btn .text { flex: 1; }
        .action-btn .text h3 { font-size: 16px; margin-bottom: 5px; }
        .action-btn .text p { font-size: 12px; opacity: 0.9; }
        
        /* Recent Activity */
        .recent-activity { background: white; border-radius: 12px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .recent-activity h2 { color: #2c3e50; margin-bottom: 20px; font-size: 24px; }
        .activity-list { list-style: none; }
        .activity-item { padding: 15px 0; border-bottom: 1px solid #ecf0f1; display: flex; align-items: center; gap: 15px; }
        .activity-item:last-child { border-bottom: none; }
        .activity-icon { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .activity-icon.success { background: #d4edda; color: #27ae60; }
        .activity-icon.warning { background: #fff3cd; color: #f39c12; }
        .activity-icon.info { background: #d1ecf1; color: #3498db; }
        .activity-content { flex: 1; }
        .activity-content h4 { color: #2c3e50; font-size: 14px; margin-bottom: 5px; }
        .activity-content p { color: #7f8c8d; font-size: 12px; }
        .activity-time { color: #95a5a6; font-size: 12px; }
        
        @media (max-width: 768px) {
            nav .nav-content { flex-direction: column; gap: 15px; }
            .stats-grid { grid-template-columns: 1fr; }
            .actions-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-content">
            <div class="nav-links">
                <a href="{{ route('admin.dashboard') }}">🏠 Dashboard</a>
                <a href="{{ route('admin.categories.index') }}">📁 Kategori</a>
                <a href="{{ route('admin.menus.index') }}">🍔 Menu</a>
                <a href="{{ route('admin.reports.sales') }}">📊 Laporan</a>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1>Selamat Datang Kembali! 👋</h1>
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
            <div class="stat-card categories">
                <div class="icon">📁</div>
                <h3>Total Kategori</h3>
                <div class="value">{{ \App\Models\Category::count() }}</div>
                <div class="change">Kategori menu aktif</div>
            </div>
            
            <div class="stat-card menus">
                <div class="icon">🍔</div>
                <h3>Total Menu</h3>
                <div class="value">{{ \App\Models\Menu::count() }}</div>
                <div class="change">{{ \App\Models\Menu::where('is_available', true)->count() }} tersedia</div>
            </div>
            
            <div class="stat-card orders">
                <div class="icon">🛒</div>
                <h3>Pesanan Hari Ini</h3>
                <div class="value">{{ \App\Models\Order::whereDate('created_at', today())->count() }}</div>
                <div class="change">{{ \App\Models\Order::where('status', 'pending')->count() }} menunggu</div>
            </div>
            
            <div class="stat-card revenue">
                <div class="icon">💰</div>
                <h3>Pendapatan Hari Ini</h3>
                <div class="value">Rp {{ number_format(\App\Models\Order::whereDate('created_at', today())->where('status', 'completed')->sum('total'), 0, ',', '.') }}</div>
                <div class="change">Pesanan selesai</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h2>⚡ Aksi Cepat</h2>
            <div class="actions-grid">
                <a href="{{ route('admin.categories.create') }}" class="action-btn">
                    <div class="icon">➕</div>
                    <div class="text">
                        <h3>Tambah Kategori</h3>
                        <p>Buat kategori menu baru</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.menus.create') }}" class="action-btn">
                    <div class="icon">🍽️</div>
                    <div class="text">
                        <h3>Tambah Menu</h3>
                        <p>Tambahkan menu makanan</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.reports.sales') }}" class="action-btn">
                    <div class="icon">📈</div>
                    <div class="text">
                        <h3>Lihat Laporan</h3>
                        <p>Analisis penjualan</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.menus.index') }}" class="action-btn">
                    <div class="icon">⚙️</div>
                    <div class="text">
                        <h3>Kelola Menu</h3>
                        <p>Edit & hapus menu</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="recent-activity">
            <h2>📋 Aktivitas Terbaru</h2>
            <ul class="activity-list">
                @php
                $recentOrders = \App\Models\Order::with('user')->latest()->take(5)->get();
                @endphp
                
                @forelse($recentOrders as $order)
                <li class="activity-item">
                    <div class="activity-icon {{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                        {{ $order->status == 'completed' ? '✓' : ($order->status == 'pending' ? '⏱' : '🔄') }}
                    </div>
                    <div class="activity-content">
                        <h4>Pesanan #{{ $order->id }} - {{ ucfirst($order->status) }}</h4>
                        <p>{{ $order->user ? $order->user->name : 'Guest' }} - Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                    </div>
                    <div class="activity-time">{{ $order->created_at->diffForHumans() }}</div>
                </li>
                @empty
                <li style="text-align: center; padding: 40px; color: #7f8c8d;">
                    <p>Belum ada aktivitas terbaru</p>
                </li>
                @endforelse
            </ul>
        </div>
    </div>
</body>
</html>