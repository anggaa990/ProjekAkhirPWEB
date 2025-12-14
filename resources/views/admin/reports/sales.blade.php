<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Restoranku</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        nav .nav-links a:hover,
        nav .nav-links a.active { 
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
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Header */
        .header { 
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid rgba(197, 157, 95, 0.2);
        }

        .header h1 { 
            color: #c59d5f;
            font-size: 36px;
            margin-bottom: 8px;
            letter-spacing: 2px;
        }

        .header p {
            color: #999;
            font-size: 14px;
            font-family: 'Arial', sans-serif;
            letter-spacing: 1px;
        }
        
        /* Filter Card */
        .filter-card { 
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        .filter-form { 
            display: flex;
            gap: 20px;
            align-items: end;
        }

        .form-group { 
            flex: 1;
        }

        .form-group label { 
            display: block;
            margin-bottom: 10px;
            color: #c59d5f;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
        }

        .form-group label i {
            margin-right: 8px;
        }

        .form-group input { 
            width: 100%;
            padding: 14px 18px;
            border: 2px solid rgba(197, 157, 95, 0.3);
            background: rgba(17, 17, 17, 0.8);
            color: #fff;
            font-size: 14px;
            font-family: 'Arial', sans-serif;
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #c59d5f;
            box-shadow: 0 0 15px rgba(197, 157, 95, 0.2);
        }

        .btn { 
            padding: 14px 30px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: 'Arial', sans-serif;
            font-size: 13px;
            transition: all 0.3s;
        }

        .btn-primary { 
            background: #c59d5f;
            color: #000;
        }

        .btn-primary:hover { 
            background: transparent;
            color: #c59d5f;
            border: 2px solid #c59d5f;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(197, 157, 95, 0.3);
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
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #c59d5f;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: #c59d5f;
            box-shadow: 0 15px 50px rgba(197, 157, 95, 0.3);
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
            font-size: 38px;
            font-weight: bold;
            color: #c59d5f;
            font-family: 'Arial', sans-serif;
        }

        .stat-card .icon {
            font-size: 48px;
            color: rgba(197, 157, 95, 0.3);
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }
        
        /* Chart Grid */
        .chart-grid { 
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 40px;
        }

        .chart-card { 
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        .chart-card h2 { 
            color: #c59d5f;
            margin-bottom: 25px;
            font-size: 20px;
            letter-spacing: 2px;
            font-family: 'Georgia', serif;
        }

        .chart-card h2 i {
            margin-right: 10px;
        }
        
        /* Table Card */
        .table-card { 
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        .table-card h2 { 
            color: #c59d5f;
            margin-bottom: 25px;
            font-size: 24px;
            letter-spacing: 2px;
        }

        .table-card h2 i {
            margin-right: 10px;
        }
        
        /* Table */
        table { 
            width: 100%;
            border-collapse: collapse;
        }

        thead { 
            background: rgba(197, 157, 95, 0.2);
            border-bottom: 2px solid rgba(197, 157, 95, 0.3);
        }

        thead th {
            color: #c59d5f;
            font-size: 13px;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: 'Arial', sans-serif;
            font-weight: 700;
        }

        th, td { 
            padding: 18px;
            text-align: left;
        }

        tbody tr { 
            border-bottom: 1px solid rgba(197, 157, 95, 0.1);
            transition: all 0.3s;
        }

        tbody tr:hover { 
            background: rgba(197, 157, 95, 0.05);
            transform: translateX(5px);
        }

        tbody td {
            color: #ccc;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }
        
        .menu-name { 
            font-weight: 600;
            color: #fff;
            font-size: 15px;
        }

        .price { 
            color: #c59d5f;
            font-weight: 600;
            font-size: 15px;
        }

        .rank-badge {
            background: #c59d5f;
            color: #000;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 14px;
            display: inline-block;
        }

        .quantity-badge {
            background: rgba(197, 157, 95, 0.2);
            color: #c59d5f;
            padding: 6px 14px;
            border: 1px solid rgba(197, 157, 95, 0.3);
            font-weight: 600;
            font-size: 13px;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #999;
        }

        .empty-state i {
            font-size: 80px;
            color: rgba(197, 157, 95, 0.3);
            margin-bottom: 20px;
        }

        .empty-state h3 {
            color: #c59d5f;
            font-size: 22px;
            margin-bottom: 10px;
        }

        /* Footer */
        footer {
            background: rgba(0, 0, 0, 0.95);
            padding: 30px 50px;
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
        @media (max-width: 1024px) {
            .chart-grid { 
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

            .header h1 {
                font-size: 28px;
            }

            .filter-form { 
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 12px 8px;
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
                <a href="{{ route('admin.reports.sales') }}" class="active"><i class="fas fa-chart-line"></i> Laporan</a>
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
        <div class="header">
            <h1><i class="fas fa-chart-line"></i> LAPORAN PENJUALAN</h1>
            <p>Analisis dan statistik penjualan restoran Anda</p>
        </div>

        <!-- Filter Tanggal -->
        <div class="filter-card">
            <form method="GET" action="{{ route('admin.reports.sales') }}" class="filter-form">
                <div class="form-group">
                    <label for="start_date">
                        <i class="fas fa-calendar-alt"></i> Tanggal Mulai
                    </label>
                    <input type="date" id="start_date" name="start_date" value="{{ $startDate }}">
                </div>
                <div class="form-group">
                    <label for="end_date">
                        <i class="fas fa-calendar-check"></i> Tanggal Akhir
                    </label>
                    <input type="date" id="end_date" name="end_date" value="{{ $endDate }}">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Filter Data
                </button>
            </form>
        </div>

        <!-- Statistik Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3><i class="fas fa-money-bill-wave"></i> Total Penjualan</h3>
                <div class="value">Rp {{ number_format($totalSales, 0, ',', '.') }}</div>
                <i class="fas fa-coins icon"></i>
            </div>
            <div class="stat-card">
                <h3><i class="fas fa-shopping-cart"></i> Total Pesanan</h3>
                <div class="value">{{ $totalOrders }}</div>
                <i class="fas fa-shopping-bag icon"></i>
            </div>
            <div class="stat-card">
                <h3><i class="fas fa-chart-bar"></i> Rata-rata per Pesanan</h3>
                <div class="value">Rp {{ $totalOrders > 0 ? number_format($totalSales / $totalOrders, 0, ',', '.') : 0 }}</div>
                <i class="fas fa-calculator icon"></i>
            </div>
        </div>

        <!-- Grafik -->
        <div class="chart-grid">
            <div class="chart-card">
                <h2><i class="fas fa-chart-area"></i> PENJUALAN HARIAN</h2>
                <canvas id="dailySalesChart"></canvas>
            </div>
            <div class="chart-card">
                <h2><i class="fas fa-chart-pie"></i> STATUS PESANAN</h2>
                <canvas id="orderStatusChart"></canvas>
            </div>
        </div>

        <!-- Menu Terlaris -->
        <div class="table-card">
            <h2><i class="fas fa-fire"></i> MENU TERLARIS</h2>
            @if($topMenus->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-trophy"></i> Rank</th>
                        <th><i class="fas fa-utensils"></i> Nama Menu</th>
                        <th><i class="fas fa-folder"></i> Kategori</th>
                        <th><i class="fas fa-box"></i> Terjual</th>
                        <th><i class="fas fa-coins"></i> Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topMenus as $index => $item)
                    <tr>
                        <td><span class="rank-badge">#{{ $index + 1 }}</span></td>
                        <td class="menu-name">{{ $item->menu->name }}</td>
                        <td>{{ $item->menu->category->name }}</td>
                        <td><span class="quantity-badge">{{ $item->total_quantity }} porsi</span></td>
                        <td class="price">Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <i class="fas fa-chart-line"></i>
                <h3>Belum Ada Data Penjualan</h3>
                <p>Data penjualan akan muncul setelah ada transaksi</p>
            </div>
            @endif
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Restoranku. All rights reserved.</p>
    </footer>

    <script>
        // Data untuk grafik penjualan harian
        const dailySalesData = {
            labels: [
                @foreach($dailySales as $sale)
                '{{ date("d/m", strtotime($sale->date)) }}',
                @endforeach
            ],
            datasets: [{
                label: 'Penjualan (Rp)',
                data: [
                    @foreach($dailySales as $sale)
                    {{ $sale->total }},
                    @endforeach
                ],
                borderColor: '#c59d5f',
                backgroundColor: 'rgba(197, 157, 95, 0.2)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#c59d5f',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        };

        const dailySalesChart = new Chart(document.getElementById('dailySalesChart'), {
            type: 'line',
            data: dailySalesData,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(26, 26, 26, 0.9)',
                        titleColor: '#c59d5f',
                        bodyColor: '#fff',
                        borderColor: '#c59d5f',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#999',
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        },
                        grid: {
                            color: 'rgba(197, 157, 95, 0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#999'
                        },
                        grid: {
                            color: 'rgba(197, 157, 95, 0.1)'
                        }
                    }
                }
            }
        });

        // Data untuk grafik status pesanan
        const orderStatusData = {
            labels: [
                @foreach($ordersByStatus as $status)
                '{{ ucfirst($status->status) }}',
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach($ordersByStatus as $status)
                    {{ $status->count }},
                    @endforeach
                ],
                backgroundColor: [
                    '#f39c12',
                    '#3498db',
                    '#e67e22',
                    '#27ae60',
                    '#95a5a6',
                    '#e74c3c'
                ],
                borderColor: '#1a1a1a',
                borderWidth: 3
            }]
        };

        const orderStatusChart = new Chart(document.getElementById('orderStatusChart'), {
            type: 'doughnut',
            data: orderStatusData,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#999',
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(26, 26, 26, 0.9)',
                        titleColor: '#c59d5f',
                        bodyColor: '#fff',
                        borderColor: '#c59d5f',
                        borderWidth: 1,
                        padding: 12
                    }
                }
            }
        });

        // Animation for stats cards
        document.addEventListener('DOMContentLoaded', () => {
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 150);
            });
        });
    </script>
</body>
</html>