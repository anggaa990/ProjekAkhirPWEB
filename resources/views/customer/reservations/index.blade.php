<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Saya</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            padding: 20px;
        }
        .container { max-width: 1200px; margin: 0 auto; }
        .header {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }
        .btn-primary { background: #667eea; color: white; }
        .btn-primary:hover { background: #5568d3; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn-success { background: #27ae60; color: white; }
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .alert-success { background: #d4edda; color: #155724; border-left: 4px solid #28a745; }
        .reservation-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .reservation-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }
        .status-badge {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #d1ecf1; color: #0c5460; }
        .status-completed { background: #d4edda; color: #155724; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        .reservation-details { margin: 15px 0; }
        .detail-row { 
            display: flex;
            padding: 8px 0;
            border-bottom: 1px solid #f5f5f5;
        }
        .detail-label { 
            font-weight: 600;
            width: 150px;
            color: #666;
        }
        .detail-value { flex: 1; color: #333; }
        .order-items {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }
        .order-items h4 { margin-bottom: 10px; color: #667eea; }
        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .order-item:last-child { border-bottom: none; }
        .total-row {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 18px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 2px solid #667eea;
            color: #667eea;
        }
        .actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 10px;
        }
        .empty-state img { width: 200px; opacity: 0.5; }
        .empty-state h3 { margin: 20px 0 10px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📋 Reservasi Saya</h1>
            <div>
                <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">← Kembali</a>
                <a href="{{ route('customer.reservations.create') }}" class="btn btn-primary">+ Buat Reservasi Baru</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @forelse($reservations as $reservation)
            <div class="reservation-card">
                <div class="reservation-header">
                    <div>
                        <h3>Reservasi #{{ $reservation->id }}</h3>
                        <small style="color: #999;">Dibuat: {{ $reservation->created_at->format('d M Y, H:i') }}</small>
                    </div>
                    <span class="status-badge status-{{ $reservation->status }}">
                        {{ strtoupper($reservation->status) }}
                    </span>
                </div>

                <div class="reservation-details">
                    <div class="detail-row">
                        <span class="detail-label">📅 Tanggal</span>
                        <span class="detail-value">{{ \Carbon\Carbon::parse($reservation->date)->format('d F Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">🕐 Waktu</span>
                        <span class="detail-value">{{ $reservation->time }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">🪑 Meja</span>
                        <span class="detail-value">{{ $reservation->table->name }} (Kapasitas: {{ $reservation->table->capacity }} orang)</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">👥 Jumlah Tamu</span>
                        <span class="detail-value">{{ $reservation->people }} orang</span>
                    </div>
                    @if($reservation->notes)
                        <div class="detail-row">
                            <span class="detail-label">📝 Catatan</span>
                            <span class="detail-value">{{ $reservation->notes }}</span>
                        </div>
                    @endif
                </div>

                @if($reservation->order)
                    <div class="order-items">
                        <h4>🛒 Pesanan Menu</h4>
                        @foreach($reservation->order->items as $item)
                            <div class="order-item">
                                <span>{{ $item->menu->name }} × {{ $item->quantity }}</span>
                                <span>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                        <div class="total-row">
                            <span>Total:</span>
                            <span>Rp {{ number_format($reservation->order->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endif

                <div class="actions">
                    <a href="{{ route('customer.reservations.show', $reservation) }}" class="btn btn-primary">Lihat Detail</a>
                    
                    @if($reservation->status === 'completed' && !$reservation->review)
                        <a href="{{ route('customer.reservations.review', $reservation) }}" class="btn btn-success">⭐ Beri Rating</a>
                    @endif

                    @if($reservation->review)
                        <span class="status-badge status-completed">✓ Sudah Direview</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div style="font-size: 80px;">📅</div>
                <h3>Belum Ada Reservasi</h3>
                <p style="color: #999;">Mulai buat reservasi pertama Anda sekarang!</p>
                <a href="{{ route('customer.reservations.create') }}" class="btn btn-primary" style="margin-top: 20px;">Buat Reservasi</a>
            </div>
        @endforelse
    </div>
</body>
</html>
