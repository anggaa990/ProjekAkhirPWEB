<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; }
        
        nav { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 15px 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        nav .nav-content { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        nav .nav-links a { color: white; text-decoration: none; margin-right: 25px; font-weight: 500; }
        .logout-btn { background: rgba(255,255,255,0.2); color: white; border: 2px solid white; padding: 8px 20px; cursor: pointer; border-radius: 5px; }
        
        .container { max-width: 1400px; margin: 30px auto; padding: 0 20px; }
        
        .header { margin-bottom: 30px; }
        .header h1 { color: #2c3e50; }
        
        .filter-tabs { display: flex; gap: 10px; margin-bottom: 20px; }
        .tab { padding: 10px 20px; background: white; border: 2px solid #ddd; border-radius: 5px; cursor: pointer; font-weight: 500; transition: all 0.3s; }
        .tab:hover { border-color: #667eea; }
        .tab.active { background: #667eea; color: white; border-color: #667eea; }
        
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        
        .orders-grid { display: grid; gap: 20px; }
        
        .order-card { background: white; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: transform 0.3s; }
        .order-card:hover { transform: translateY(-2px); box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
        
        .order-header { display: flex; justify-content: space-between; align-items: start; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #ecf0f1; }
        .order-id { font-size: 20px; font-weight: bold; color: #2c3e50; }
        
        .badge { padding: 6px 14px; border-radius: 12px; font-size: 12px; font-weight: 600; text-transform: uppercase; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        .badge-primary { background: #cfe2ff; color: #084298; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        
        .order-info { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px; }
        .info-item { }
        .info-item label { display: block; color: #7f8c8d; font-size: 12px; font-weight: 600; text-transform: uppercase; margin-bottom: 5px; }
        .info-item .value { color: #2c3e50; font-size: 15px; font-weight: 500; }
        
        .order-items { background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 15px; }
        .order-items h4 { color: #2c3e50; margin-bottom: 10px; font-size: 14px; }
        .item-list { list-style: none; }
        .item-list li { padding: 8px 0; border-bottom: 1px solid #dee2e6; display: flex; justify-content: space-between; }
        .item-list li:last-child { border-bottom: none; }
        .item-name { color: #2c3e50; font-weight: 500; }
        .item-qty { color: #7f8c8d; font-size: 14px; }
        
        .total-price { text-align: right; font-size: 20px; font-weight: bold; color: #27ae60; margin-bottom: 15px; }
        
        .status-actions { display: flex; gap: 10px; flex-wrap: wrap; }
        .btn { padding: 10px 18px; border: none; border-radius: 5px; cursor: pointer; font-weight: 500; font-size: 13px; transition: all 0.3s; }
        .btn:hover { transform: translateY(-2px); }
        .btn-info { background: #3498db; color: white; }
        .btn-warning { background: #f39c12; color: white; }
        .btn-success { background: #27ae60; color: white; }
        .btn-danger { background: #e74c3c; color: white; }
        .btn-primary { background: #667eea; color: white; }
        
        .empty-state { text-align: center; padding: 60px 20px; color: #7f8c8d; background: white; border-radius: 12px; }
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
        <div class="header">
            <h1>🛒 Kelola Pesanan Pelanggan</h1>
            <p style="color: #7f8c8d; margin-top: 5px;">Update status pesanan dari pending hingga selesai</p>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="filter-tabs">
            <div class="tab active" onclick="filterOrders('all')">Semua</div>
            <div class="tab" onclick="filterOrders('pending')">Pending</div>
            <div class="tab" onclick="filterOrders('cooking')">Sedang Dimasak</div>
            <div class="tab" onclick="filterOrders('ready')">Siap Disajikan</div>
            <div class="tab" onclick="filterOrders('completed')">Selesai</div>
        </div>

        <div class="orders-grid">
            @if($orders->count() > 0)
                @foreach($orders as $order)
                <div class="order-card" data-status="{{ $order->status }}">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Pesanan #{{ $order->id }}</div>
                            <small style="color: #7f8c8d;">{{ $order->created_at->diffForHumans() }}</small>
                        </div>
                        @if($order->status == 'pending')
                            <span class="badge badge-warning">⏳ Pending</span>
                        @elseif($order->status == 'confirmed')
                            <span class="badge badge-info">✓ Dikonfirmasi</span>
                        @elseif($order->status == 'cooking')
                            <span class="badge badge-primary">👨‍🍳 Sedang Dimasak</span>
                        @elseif($order->status == 'ready')
                            <span class="badge badge-success">✓ Siap Disajikan</span>
                        @elseif($order->status == 'completed')
                            <span class="badge badge-success">✓ Selesai</span>
                        @else
                            <span class="badge badge-danger">✗ Dibatalkan</span>
                        @endif
                    </div>

                    <div class="order-info">
                        <div class="info-item">
                            <label>👤 Pelanggan</label>
                            <div class="value">
                                @if($order->user)
                                    {{ $order->user->name }}
                                @else
                                    Guest
                                @endif
                            </div>
                        </div>
                        <div class="info-item">
                            <label>📅 Tanggal</label>
                            <div class="value">{{ $order->created_at->format('d M Y, H:i') }}</div>
                        </div>
                        <div class="info-item">
                            <label>🍽️ Total Item</label>
                            <div class="value">{{ $order->items->sum('quantity') }} item</div>
                        </div>
                    </div>

                    <div class="order-items">
                        <h4>📋 Daftar Pesanan:</h4>
                        <ul class="item-list">
                            @foreach($order->items as $item)
                            <li>
                                <span class="item-name">{{ $item->menu->name }}</span>
                                <span class="item-qty">x{{ $item->quantity }} - Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="total-price">
                        Total: Rp {{ number_format($order->total, 0, ',', '.') }}
                    </div>

                    <div class="status-actions">
                        <a href="{{ route('employee.orders.show', $order->id) }}" class="btn btn-info">📄 Detail</a>
                        
                        @if($order->status == 'pending')
                            <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="status" value="confirmed">
                                <button type="submit" class="btn btn-primary">✓ Konfirmasi</button>
                            </form>
                        @endif

                        @if($order->status == 'confirmed')
                            <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="status" value="cooking">
                                <button type="submit" class="btn btn-warning">👨‍🍳 Mulai Masak</button>
                            </form>
                        @endif

                        @if($order->status == 'cooking')
                            <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="status" value="ready">
                                <button type="submit" class="btn btn-success">✓ Siap Disajikan</button>
                            </form>
                        @endif

                        @if($order->status == 'ready')
                            <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="btn btn-success">✓ Selesai</button>
                            </form>
                        @endif

                        @if(in_array($order->status, ['pending', 'confirmed']))
                            <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">✗ Batalkan</button>
                            </form>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
            <div class="empty-state">
                <h3>Belum Ada Pesanan</h3>
                <p>Pesanan dari pelanggan akan muncul di sini</p>
            </div>
            @endif
        </div>
    </div>

    <script>
        function filterOrders(status) {
            // Update active tab
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            event.target.classList.add('active');

            // Filter cards
            document.querySelectorAll('.order-card').forEach(card => {
                if (status === 'all' || card.dataset.status === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>