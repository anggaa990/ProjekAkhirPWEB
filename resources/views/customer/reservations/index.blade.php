<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Saya - Restoranku</title>
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
            padding: 40px 20px;
            min-height: 100vh;
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
            padding: 40px 45px;
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .header h1 {
            color: #c59d5f;
            font-size: 32px;
            letter-spacing: 2px;
        }

        .header h1 i {
            margin-right: 15px;
        }

        .header-actions {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 14px 28px;
            border: 2px solid;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            font-size: 14px;
            font-family: 'Arial', sans-serif;
            letter-spacing: 1px;
            font-weight: 600;
            text-transform: uppercase;
            cursor: pointer;
        }

        .btn-primary { 
            background: #c59d5f; 
            color: #000;
            border-color: #c59d5f;
        }

        .btn-primary:hover { 
            background: transparent; 
            color: #c59d5f;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(197, 157, 95, 0.4);
        }

        .btn-secondary { 
            background: transparent; 
            color: #999;
            border-color: #666;
        }

        .btn-secondary:hover { 
            border-color: #c59d5f;
            color: #c59d5f;
        }

        .btn-success { 
            background: transparent;
            color: #4ade80; 
            border-color: #4ade80;
        }

        .btn-success:hover {
            background: #4ade80;
            color: #000;
        }

        .alert {
            padding: 20px 25px;
            margin-bottom: 30px;
            border-left: 4px solid #4ade80;
            background: rgba(74, 222, 128, 0.15);
            border: 1px solid rgba(74, 222, 128, 0.3);
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success { 
            color: #4ade80;
            font-family: 'Arial', sans-serif;
            font-size: 15px;
        }

        .reservation-card {
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 35px 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.6s ease backwards;
        }

        .reservation-card:nth-child(1) { animation-delay: 0.1s; }
        .reservation-card:nth-child(2) { animation-delay: 0.2s; }
        .reservation-card:nth-child(3) { animation-delay: 0.3s; }

        .reservation-card:hover {
            border-color: #c59d5f;
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(197, 157, 95, 0.3);
        }

        .reservation-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(197, 157, 95, 0.2);
        }

        .reservation-header h3 {
            color: #c59d5f;
            font-size: 24px;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .reservation-header small {
            color: #666;
            font-size: 13px;
            font-family: 'Arial', sans-serif;
        }

        .status-badge {
            padding: 8px 18px;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
            text-transform: uppercase;
        }

        .status-pending { 
            background: rgba(251, 191, 36, 0.2); 
            color: #fbbf24;
            border: 1px solid rgba(251, 191, 36, 0.3);
        }

        .status-confirmed { 
            background: rgba(59, 130, 246, 0.2); 
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .status-completed { 
            background: rgba(74, 222, 128, 0.2); 
            color: #4ade80;
            border: 1px solid rgba(74, 222, 128, 0.3);
        }

        .status-cancelled { 
            background: rgba(239, 68, 68, 0.2); 
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .reservation-details { 
            margin: 25px 0; 
        }

        .detail-row { 
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid rgba(197, 157, 95, 0.1);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label { 
            font-weight: 600;
            width: 180px;
            color: #c59d5f;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }

        .detail-value { 
            flex: 1; 
            color: #ccc;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }

        .order-items {
            background: rgba(17, 17, 17, 0.8);
            border: 1px solid rgba(197, 157, 95, 0.3);
            padding: 25px;
            margin-top: 25px;
        }

        .order-items h4 { 
            margin-bottom: 20px; 
            color: #c59d5f;
            font-size: 18px;
            letter-spacing: 1px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(197, 157, 95, 0.2);
            color: #ccc;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }

        .order-item:last-child { 
            border-bottom: none; 
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 20px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #c59d5f;
            color: #c59d5f;
            font-family: 'Arial', sans-serif;
        }

        .actions {
            display: flex;
            gap: 15px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .reviewed-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: rgba(74, 222, 128, 0.2);
            color: #4ade80;
            border: 1px solid rgba(74, 222, 128, 0.3);
            font-size: 13px;
            font-family: 'Arial', sans-serif;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .empty-state {
            text-align: center;
            padding: 100px 40px;
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            animation: fadeInUp 0.8s ease;
        }

        .empty-icon {
            font-size: 80px;
            color: #c59d5f;
            margin-bottom: 25px;
            opacity: 0.3;
        }

        .empty-state h3 { 
            margin: 20px 0 15px; 
            color: #c59d5f;
            font-size: 28px;
            letter-spacing: 2px;
        }

        .empty-state p {
            color: #999;
            font-size: 16px;
            margin-bottom: 30px;
            font-family: 'Arial', sans-serif;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 20px 15px;
            }

            .header {
                flex-direction: column;
                gap: 20px;
                padding: 30px 25px;
            }

            .header h1 {
                font-size: 26px;
            }

            .header-actions {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
                text-align: center;
            }

            .reservation-card {
                padding: 25px 20px;
            }

            .reservation-header {
                flex-direction: column;
                gap: 15px;
            }

            .detail-row {
                flex-direction: column;
                gap: 5px;
            }

            .detail-label {
                width: 100%;
            }

            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <div class="container">
        <div class="header">
            <h1><i class="fas fa-list-alt"></i> RESERVASI SAYA</h1>
            <div class="header-actions">
                <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('customer.reservations.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Buat Reservasi
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @forelse($reservations as $reservation)
            <div class="reservation-card">
                <div class="reservation-header">
                    <div>
                        <h3>Reservasi #{{ $reservation->id }}</h3>
                        <small>Dibuat: {{ $reservation->created_at->format('d M Y, H:i') }}</small>
                    </div>
                    <span class="status-badge status-{{ $reservation->status }}">
                        {{ strtoupper($reservation->status) }}
                    </span>
                </div>

                <div class="reservation-details">
                    <div class="detail-row">
                        <span class="detail-label"><i class="fas fa-calendar"></i> Tanggal</span>
                        <span class="detail-value">{{ \Carbon\Carbon::parse($reservation->date)->format('d F Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label"><i class="fas fa-clock"></i> Waktu</span>
                        <span class="detail-value">{{ $reservation->time }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label"><i class="fas fa-chair"></i> Meja</span>
                        <span class="detail-value">{{ $reservation->table->name }} (Kapasitas: {{ $reservation->table->capacity }} orang)</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label"><i class="fas fa-users"></i> Jumlah Tamu</span>
                        <span class="detail-value">{{ $reservation->people }} orang</span>
                    </div>
                    @if($reservation->notes)
                        <div class="detail-row">
                            <span class="detail-label"><i class="fas fa-sticky-note"></i> Catatan</span>
                            <span class="detail-value">{{ $reservation->notes }}</span>
                        </div>
                    @endif
                </div>

                @if($reservation->order)
                    <div class="order-items">
                        <h4><i class="fas fa-shopping-cart"></i> Pesanan Menu</h4>
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
                    <a href="{{ route('customer.reservations.show', $reservation) }}" class="btn btn-primary">
                        <i class="fas fa-eye"></i> Lihat Detail
                    </a>
                    
                    @if($reservation->status === 'completed' && !$reservation->review)
                        <a href="{{ route('customer.reservations.review', $reservation) }}" class="btn btn-success">
                            <i class="fas fa-star"></i> Beri Rating
                        </a>
                    @endif

                    @if($reservation->review)
                        <span class="reviewed-badge">
                            <i class="fas fa-check-circle"></i> Sudah Direview
                        </span>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-calendar-times"></i></div>
                <h3>Belum Ada Reservasi</h3>
                <p>Mulai buat reservasi pertama Anda sekarang!</p>
                <a href="{{ route('customer.reservations.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Buat Reservasi
                </a>
            </div>
        @endforelse
    </div>
</body>
</html>