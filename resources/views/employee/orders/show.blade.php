<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; }
        
        nav { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 15px 30px; }
        nav a { color: white; text-decoration: none; margin-right: 25px; font-weight: 500; }
        
        .container { max-width: 1000px; margin: 30px auto; padding: 0 20px; }
        
        .card { background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: 40px; margin-bottom: 20px; }
        
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #ecf0f1; }
        .header h1 { color: #2c3e50; }
        
        .badge { padding: 8px 16px; border-radius: 12px; font-size: 13px; font-weight: 600; text-transform: uppercase; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        .badge-primary { background: #cfe2ff; color: #084298; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        
        .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px; }
        .detail-item label { display: block; color: #7f8c8d; font-size: 13px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px; }
        .detail-item .value { color: #2c3e50; font-size: 18px; font-weight: 500; }
        
        .items-section { background: #f8f9fa; padding: 25px; border-radius: 10px; margin-bottom: 30px; }
        .items-section h2 { color: #2c3e50; margin-bottom: 20px; font-size: 20px; }
        
        .item-table { width: 100%; border-collapse: collapse; }
        .item-table th { background: white; padding: 12px; text-align: left; color: #2c3e50; font-weight: 600; border-bottom: 2px solid #dee2e6; }
        .item-table td { padding: 15px 12px; border-bottom: 1px solid #dee2e6; }
        .item-table tr:last-child td { border-bottom: none; }
        .item-img { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
        .no-img { width: 60px; height: 60px; background: #ecf0f1; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #7f8c8d; }
        
        .total-section { text-align: right; padding: 20px; background: #fff; border-radius: 10px; margin-bottom: 30px; }
        .total-section .total-label { color: #7f8c8d; font-size: 14px; margin-bottom: 5px; }
        .total-section .total-value { color: #27ae60; font-size: 32px; font-weight: bold; }
        
        .status-timeline { background: #f8f9fa; padding: 25px; border-radius: 10px; margin-bottom: 30px; }
        .status-timeline h2 { color: #2c3e50; margin-bottom: 20px; font-size: 20px; }
        .timeline { position: relative; padding-left: 30px; }
        .timeline-item { position: relative; padding-bottom: 30px; }
        .timeline-item:last-child { padding-bottom: 0; }
        .timeline-item::before { content: ''; position: absolute; left: -23px; top: 5px; width: 12px; height: 12px; border-radius: 50%; background: #ddd; }
        .timeline-item.active::before { background: #27ae60; }
        .timeline-item::after { content: ''; position: absolute; left: -18px; top: 17px; width: 2px; height: calc(100% - 12px); background: #ddd; }
        .timeline-item:last-child::after { display: none; }
        .timeline-label { font-weight: 600; color: #2c3e50; margin-bottom: 3px; }
        .timeline-time { font-size: 13px; color: #7f8c8d; }
        
        .actions { display: flex; gap: 15px; flex-wrap: wrap; }
        .btn { padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; text-decoration: none; display: inline-block; transition: all 0.3s; }
        .btn:hover { transform: translateY(-2px); }
        .btn-primary { background: #667eea; color: white; }
        .btn-success { background: #27ae60; color: white; }
        .btn-warning { background: #f39c12; color: white; }
        .btn-danger { background: #e74c3c; color: white; }
        .btn-secondary { background: #95a5a6; color: white; }
        
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('employee.dashboard') }}">🏠 Dashboard</a>
        <a href="{{ route('employee.reservations.index') }}">📅 Reservasi</a>
        <a href="{{ route('employee.orders.index') }}">🛒 Pesanan</a>
    </nav>

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card">
            <div class="header">
                <h1>Detail Pesanan #{{ $order->id }}</h1>
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

            <div class="detail-grid">
                <div class="detail-item">
                    <label>👤 Pelanggan</label>
                    <div class="value">
                        @if($order->user)
                            {{ $order->user->name }}<br>
                            <small style="font-size: 14px; color: #7f8c8d;">{{ $order->user->email }}</small>
                        @else
                            Guest
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <label>📅 Tanggal & Waktu</label>
                    <div class="value">{{ $order->created_at->format('d F Y, H:i') }} WIB</div>
                </div>

                @if($order->reservation)
                <div class="detail-item">
                    <label>🪑 Reservasi</label>
                    <div class="value">
                        @if($order->reservation->table)
                            {{ $order->reservation->table->name }}
                        @else
                            -
                        @endif
                    </div>
                </div>
                @endif

                <div class="detail-item">
                    <label>🍽️ Total Item</label>
                    <div class="value">{{ $order->items->sum('quantity') }} item</div>
                </div>
            </div>
        </div>

        <div class="card items-section">
            <h2>📋 Daftar Pesanan</h2>
            <table class="item-table">
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                @if($item->menu->image)
                                    <img src="/storage/{{ $item->menu->image }}" alt="{{ $item->menu->name }}" class="item-img">
                                @else
                                    <div class="no-img">No Image</div>
                                @endif
                                <div>
                                    <strong>{{ $item->menu->name }}</strong><br>
                                    <small style="color: #7f8c8d;">{{ $item->menu->category->name }}</small>
                                </div>
                            </div>
                        </td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>x{{ $item->quantity }}</td>
                        <td><strong>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="total-section">
            <div class="total-label">Total Pembayaran</div>
            <div class="total-value">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
        </div>

        <div class="card status-timeline">
            <h2>📊 Status Timeline</h2>
            <div class="timeline">
                <div class="timeline-item {{ in_array($order->status, ['pending', 'confirmed', 'cooking', 'ready', 'completed']) ? 'active' : '' }}">
                    <div class="timeline-label">⏳ Pesanan Diterima</div>
                    <div class="timeline-time">{{ $order->created_at->format('d M Y, H:i') }}</div>
                </div>
                <div class="timeline-item {{ in_array($order->status, ['confirmed', 'cooking', 'ready', 'completed']) ? 'active' : '' }}">
                    <div class="timeline-label">✓ Dikonfirmasi</div>
                    <div class="timeline-time">{{ $order->status != 'pending' ? $order->updated_at->format('d M Y, H:i') : '-' }}</div>
                </div>
                <div class="timeline-item {{ in_array($order->status, ['cooking', 'ready', 'completed']) ? 'active' : '' }}">
                    <div class="timeline-label">👨‍🍳 Sedang Dimasak</div>
                    <div class="timeline-time">{{ in_array($order->status, ['cooking', 'ready', 'completed']) ? $order->updated_at->format('d M Y, H:i') : '-' }}</div>
                </div>
                <div class="timeline-item {{ in_array($order->status, ['ready', 'completed']) ? 'active' : '' }}">
                    <div class="timeline-label">✓ Siap Disajikan</div>
                    <div class="timeline-time">{{ in_array($order->status, ['ready', 'completed']) ? $order->updated_at->format('d M Y, H:i') : '-' }}</div>
                </div>
                <div class="timeline-item {{ $order->status == 'completed' ? 'active' : '' }}">
                    <div class="timeline-label">✓ Selesai</div>
                    <div class="timeline-time">{{ $order->status == 'completed' ? $order->updated_at->format('d M Y, H:i') : '-' }}</div>
                </div>
            </div>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 20px; color: #2c3e50;">⚡ Update Status Pesanan</h2>
            <div class="actions">
                @if($order->status == 'pending')
                    <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                        @csrf
                        <input type="hidden" name="status" value="confirmed">
                        <button type="submit" class="btn btn-primary">✓ Konfirmasi Pesanan</button>
                    </form>
                @endif

                @if($order->status == 'confirmed')
                    <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                        @csrf
                        <input type="hidden" name="status" value="cooking">
                        <button type="submit" class="btn btn-warning">👨‍🍳 Mulai Memasak</button>
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
                        <button type="submit" class="btn btn-success">✓ Tandai Selesai (Stok akan dikurangi)</button>
                    </form>
                @endif

                @if(in_array($order->status, ['pending', 'confirmed']))
                    <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                        @csrf
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">✗ Batalkan Pesanan</button>
                    </form>
                @endif

                <a href="{{ route('employee.orders.index') }}" class="btn btn-secondary">← Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>