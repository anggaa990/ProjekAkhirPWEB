<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; }
        
        nav { background: #2c3e50; padding: 15px 30px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        nav a { color: white; text-decoration: none; margin-right: 25px; font-weight: 500; }
        nav a:hover { color: #3498db; }
        .logout-btn { background: #e74c3c; color: white; border: none; padding: 8px 20px; cursor: pointer; border-radius: 5px; float: right; }
        
        .container { max-width: 1400px; margin: 30px auto; padding: 0 20px; }
        
        .header { margin-bottom: 30px; }
        .header h1 { color: #2c3e50; margin-bottom: 10px; }
        
        .filter-card { background: white; border-radius: 8px; padding: 20px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .filter-form { display: flex; gap: 15px; align-items: end; }
        .form-group { flex: 1; }
        .form-group label { display: block; margin-bottom: 5px; color: #2c3e50; font-weight: 500; font-size: 14px; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; }
        .btn { padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: 500; }
        .btn-primary { background: #3498db; color: white; }
        .btn-primary:hover { background: #2980b9; }
        
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .stat-card h3 { color: #7f8c8d; font-size: 14px; font-weight: 500; margin-bottom: 10px; }
        .stat-card .value { font-size: 32px; font-weight: bold; color: #2c3e50; }
        .stat-card.sales .value { color: #27ae60; }
        .stat-card.orders .value { color: #3498db; }
        
        .chart-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 30px; }
        .chart-card { background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .chart-card h2 { color: #2c3e50; margin-bottom: 20px; font-size: 18px; }
        
        .table-card { background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .table-card h2 { color: #2c3e50; margin-bottom: 20px; font-size: 18px; }
        
        table { width: 100%; border-collapse: collapse; }
        thead { background: #34495e; color: white; }
        th, td { padding: 12px; text-align: left; }
        tbody tr { border-bottom: 1px solid #ecf0f1; }
        tbody tr:hover { background: #f8f9fa; }
        
        .menu-name { font-weight: 600; color: #2c3e50; }
        .price { color: #27ae60; font-weight: 600; }
        
        @media (max-width: 768px) {
            .chart-grid { grid-template-columns: 1fr; }
            .filter-form { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>
<body>
    <nav>
        <a href="/admin/dashboard">Dashboard</a>
        <a href="/admin/categories">Kelola Kategori</a>
        <a href="/admin/menus">Kelola Menu</a>
        <a href="/admin/reports/sales">Laporan Penjualan</a>
        <form method="POST" action="/logout" style="display: inline;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </nav>

    <div class="container">
        <div class="header">
            <h1>📊 Laporan Penjualan</h1>
        </div>

        <!-- Filter Tanggal -->
        <div class="filter-card">
            <form method="GET" action="/admin/reports/sales" class="filter-form">
                <div class="form-group">
                    <label for="start_date">Tanggal Mulai</label>
                    <input type="date" id="start_date" name="start_date" value="{{ $startDate }}">
                </div>
                <div class="form-group">
                    <label for="end_date">Tanggal Akhir</label>
                    <input type="date" id="end_date" name="end_date" value="{{ $endDate }}">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>

        <!-- Statistik Cards -->
        <div class="stats-grid">
            <div class="stat-card sales">
                <h3>Total Penjualan</h3>
                <div class="value">Rp {{ number_format($totalSales, 0, ',', '.') }}</div>
            </div>
            <div class="stat-card orders">
                <h3>Total Pesanan</h3>
                <div class="value">{{ $totalOrders }}</div>
            </div>
            <div class="stat-card">
                <h3>Rata-rata per Pesanan</h3>
                <div class="value">Rp {{ $totalOrders > 0 ? number_format($totalSales / $totalOrders, 0, ',', '.') : 0 }}</div>
            </div>
        </div>

        <!-- Grafik -->
        <div class="chart-grid">
            <div class="chart-card">
                <h2>Penjualan Harian</h2>
                <canvas id="dailySalesChart"></canvas>
            </div>
            <div class="chart-card">
                <h2>Status Pesanan</h2>
                <canvas id="orderStatusChart"></canvas>
            </div>
        </div>

        <!-- Menu Terlaris -->
        <div class="table-card">
            <h2>🔥 Menu Terlaris</h2>
            @if($topMenus->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Peringkat</th>
                        <th>Nama Menu</th>
                        <th>Kategori</th>
                        <th>Terjual</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topMenus as $index => $item)
                    <tr>
                        <td><strong>#{{ $index + 1 }}</strong></td>
                        <td class="menu-name">{{ $item->menu->name }}</td>
                        <td>{{ $item->menu->category->name }}</td>
                        <td>{{ $item->total_quantity }} porsi</td>
                        <td class="price">Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p style="text-align: center; color: #7f8c8d; padding: 40px;">Belum ada data penjualan</p>
            @endif
        </div>
    </div>

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
                borderColor: '#3498db',
                backgroundColor: 'rgba(52, 152, 219, 0.1)',
                tension: 0.4,
                fill: true
            }]
        };

        const dailySalesChart = new Chart(document.getElementById('dailySalesChart'), {
            type: 'line',
            data: dailySalesData,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
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
                ]
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
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html>