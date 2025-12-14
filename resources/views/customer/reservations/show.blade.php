<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi #{{ $reservation->id }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Georgia', 'Times New Roman', serif;
            background: #0a0a0a;
            color: #fff;
            padding: 40px 20px;
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

        .container { 
            max-width: 900px; 
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .header {
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 35px 40px;
            margin-bottom: 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
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
            font-size: 28px;
            letter-spacing: 2px;
        }

        .btn {
            padding: 12px 28px;
            border: 2px solid;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            font-size: 14px;
            font-family: 'Arial', sans-serif;
            letter-spacing: 1px;
            font-weight: 600;
            text-transform: uppercase;
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
            background: #4ade80;
            color: #000; 
            border-color: #4ade80;
        }

        .btn-success:hover {
            background: transparent;
            color: #4ade80;
        }

        .alert {
            padding: 20px 25px;
            margin-bottom: 30px;
            border-left: 4px solid #4ade80;
            background: rgba(74, 222, 128, 0.15);
            border: 1px solid rgba(74, 222, 128, 0.3);
            animation: slideDown 0.5s ease;
            color: #4ade80;
            font-family: 'Arial', sans-serif;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.6s ease backwards;
        }

        .card:nth-child(2) { animation-delay: 0.1s; }
        .card:nth-child(3) { animation-delay: 0.2s; }
        .card:nth-child(4) { animation-delay: 0.3s; }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(197, 157, 95, 0.3);
        }

        .section-title {
            color: #c59d5f;
            font-size: 24px;
            letter-spacing: 2px;
            margin: 0;
        }

        .section-title i {
            margin-right: 12px;
        }

        .status-badge {
            padding: 10px 22px;
            font-size: 13px;
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

        .detail-row {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid rgba(197, 157, 95, 0.1);
        }

        .detail-row:last-child { border-bottom: none; }

        .detail-label {
            font-weight: 600;
            width: 220px;
            color: #c59d5f;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }

        .detail-label i {
            margin-right: 10px;
        }

        .detail-value {
            flex: 1;
            color: #ccc;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid rgba(197, 157, 95, 0.2);
        }

        .order-item:last-child { border-bottom: none; }

        .order-item-name {
            color: #fff;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .order-item-detail {
            color: #999;
            font-size: 13px;
            font-family: 'Arial', sans-serif;
        }

        .order-item-price {
            font-weight: 600;
            color: #c59d5f;
            font-family: 'Arial', sans-serif;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 22px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #c59d5f;
            color: #c59d5f;
            font-family: 'Arial', sans-serif;
        }

        .review-card {
            background: rgba(17, 17, 17, 0.8);
            border: 1px solid rgba(197, 157, 95, 0.3);
            padding: 30px;
            border-radius: 0;
        }

        .stars {
            color: #c59d5f;
            font-size: 32px;
            margin: 15px 0;
            letter-spacing: 5px;
        }

        .review-text {
            color: #999;
            line-height: 1.7;
            margin: 15px 0;
            font-family: 'Arial', sans-serif;
        }

        .review-date {
            color: #666;
            font-size: 13px;
            font-family: 'Arial', sans-serif;
        }

        .cta-card {
            text-align: center;
            padding: 60px 40px;
        }

        .cta-icon {
            font-size: 70px;
            color: #c59d5f;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .cta-card h3 {
            color: #c59d5f;
            margin-bottom: 15px;
            font-size: 26px;
            letter-spacing: 2px;
        }

        .cta-card p {
            color: #999;
            margin-bottom: 30px;
            font-family: 'Arial', sans-serif;
        }

        @media (max-width: 768px) {
            body { padding: 20px 15px; }
            .header { 
                flex-direction: column; 
                gap: 20px; 
                padding: 25px 20px; 
            }
            .header h1 { font-size: 22px; }
            .card { padding: 25px 20px; }
            .detail-row { flex-direction: column; gap: 8px; }
            .detail-label { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <div class="container">
        <div class="header">
            <h1><i class="fas fa-file-alt"></i> Detail Reservasi #{{ $reservation->id }}</h1>
            <a href="{{ route('customer.reservations.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        @if(session('success'))
            <div class="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h2 class="section-title">
                    <i class="fas fa-info-circle"></i> Informasi Reservasi
                </h2>
                <span class="status-badge status-{{ $reservation->status }}">
                    {{ strtoupper($reservation->status) }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-calendar"></i> Tanggal Reservasi</span>
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
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-calendar-plus"></i> Dibuat Pada</span>
                <span class="detail-value">{{ $reservation->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>

        @if($reservation->order)
            <div class="card">
                <h2 class="section-title" style="margin-bottom: 30px;">
                    <i class="fas fa-shopping-cart"></i> Detail Pesanan
                </h2>
                
                @foreach($reservation->order->items as $item)
                    <div class="order-item">
                        <div>
                            <div class="order-item-name">{{ $item->menu->name }}</div>
                            <div class="order-item-detail">
                                Rp {{ number_format($item->price, 0, ',', '.') }} × {{ $item->quantity }}
                            </div>
                        </div>
                        <div class="order-item-price">
                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach

                <div class="total-row">
                    <span>Total Pembayaran:</span>
                    <span>Rp {{ number_format($reservation->order->total, 0, ',', '.') }}</span>
                </div>
            </div>
        @endif

        @if($reservation->review)
            <div class="card">
                <h2 class="section-title" style="margin-bottom: 30px;">
                    <i class="fas fa-star"></i> Review Anda
                </h2>
                <div class="review-card">
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $reservation->review->rating)
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    <p class="review-text">
                        {{ $reservation->review->comment ?? 'Tidak ada komentar' }}
                    </p>
                    <small class="review-date">
                        Ditulis pada: {{ $reservation->review->created_at->format('d M Y, H:i') }}
                    </small>
                </div>
            </div>
        @elseif($reservation->status === 'completed')
            <div class="card cta-card">
                <div class="cta-icon"><i class="fas fa-star"></i></div>
                <h3>Bagaimana Pengalaman Anda?</h3>
                <p>Berikan rating dan review untuk membantu kami meningkatkan layanan!</p>
                <a href="{{ route('customer.reservations.review', $reservation) }}" class="btn btn-success">
                    <i class="fas fa-edit"></i> Tulis Review Sekarang
                </a>
            </div>
        @endif
    </div>
</body>
</html>