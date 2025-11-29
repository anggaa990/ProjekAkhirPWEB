<!-- ============================================ -->
<!-- VIEW: customer/reservations/show.blade.php -->
<!-- ============================================ -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi #{{ $reservation->id }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            padding: 20px;
        }
        .container { max-width: 800px; margin: 0 auto; }
        .header {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .status-badge {
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
        }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #d1ecf1; color: #0c5460; }
        .status-completed { background: #d4edda; color: #155724; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        .detail-row {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-label {
            font-weight: 600;
            width: 180px;
            color: #666;
        }
        .detail-value {
            flex: 1;
            color: #333;
        }
        .section-title {
            color: #667eea;
            font-size: 20px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }
        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .order-item:last-child { border-bottom: none; }
        .total-row {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 20px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #667eea;
            color: #667eea;
        }
        .review-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #ffc107;
        }
        .stars {
            color: #ffc107;
            font-size: 24px;
            margin: 10px 0;
        }
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            font-size: 15px;
        }
        .btn-primary { background: #667eea; color: white; }
        .btn-primary:hover { background: #5568d3; }
        .btn-success { background: #27ae60; color: white; }
        .btn-secondary { background: #95a5a6; color: white; }
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .alert-success { background: #d4edda; color: #155724; border-left: 4px solid #28a745; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Detail Reservasi #{{ $reservation->id }}</h1>
            <a href="{{ route('customer.reservations.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 class="section-title" style="margin: 0; border: none;">📋 Informasi Reservasi</h2>
                <span class="status-badge status-{{ $reservation->status }}">
                    {{ strtoupper($reservation->status) }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">📅 Tanggal Reservasi</span>
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
            <div class="detail-row">
                <span class="detail-label">📅 Dibuat Pada</span>
                <span class="detail-value">{{ $reservation->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>

        @if($reservation->order)
            <div class="card">
                <h2 class="section-title">🛒 Detail Pesanan</h2>
                
                @foreach($reservation->order->items as $item)
                    <div class="order-item">
                        <div>
                            <strong>{{ $item->menu->name }}</strong>
                            <div style="color: #999; font-size: 14px;">
                                Rp {{ number_format($item->price, 0, ',', '.') }} × {{ $item->quantity }}
                            </div>
                        </div>
                        <div style="font-weight: 600;">
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
                <h2 class="section-title">⭐ Review Anda</h2>
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
                    <p style="color: #666; margin-top: 10px;">
                        {{ $reservation->review->comment ?? 'Tidak ada komentar' }}
                    </p>
                    <small style="color: #999; display: block; margin-top: 10px;">
                        Ditulis pada: {{ $reservation->review->created_at->format('d M Y, H:i') }}
                    </small>
                </div>
            </div>
        @elseif($reservation->status === 'completed')
            <div class="card" style="text-align: center; padding: 40px;">
                <div style="font-size: 60px; margin-bottom: 15px;">⭐</div>
                <h3 style="color: #333; margin-bottom: 10px;">Bagaimana Pengalaman Anda?</h3>
                <p style="color: #666; margin-bottom: 25px;">
                    Berikan rating dan review untuk membantu kami meningkatkan layanan!
                </p>
                <a href="{{ route('customer.reservations.review', $reservation) }}" class="btn btn-success">
                    Tulis Review Sekarang
                </a>
            </div>
        @endif
    </div>
</body>
</html>

<!-- ============================================ -->
<!-- VIEW: customer/reviews/create.blade.php -->
<!-- ============================================ -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Review - Reservasi #{{ $reservation->id }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container { max-width: 600px; margin: 0 auto; }
        .card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #667eea;
            margin-bottom: 10px;
        }
        .header p {
            color: #666;
        }
        .rating-container {
            text-align: center;
            margin: 30px 0;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        .rating-label {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }
        .stars-input {
            display: flex;
            justify-content: center;
            gap: 10px;
            font-size: 50px;
            cursor: pointer;
        }
        .stars-input .star {
            color: #ddd;
            transition: color 0.2s;
            cursor: pointer;
        }
        .stars-input .star:hover,
        .stars-input .star.active {
            color: #ffc107;
        }
        .rating-text {
            margin-top: 15px;
            font-size: 16px;
            color: #666;
            font-weight: 600;
        }
        .form-group {
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #333;
        }
        textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
            resize: vertical;
            min-height: 120px;
        }
        textarea:focus {
            outline: none;
            border-color: #667eea;
        }
        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background: #667eea;
            color: white;
        }
        .btn-primary:hover {
            background: #5568d3;
        }
        .btn-secondary {
            background: #95a5a6;
            color: white;
        }
        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        input[type="radio"] {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>⭐ Beri Review</h1>
                <p>Reservasi #{{ $reservation->id }} • {{ \Carbon\Carbon::parse($reservation->date)->format('d M Y') }}</p>
            </div>

            @if($errors->any())
                <div class="alert alert-error">
                    <strong>Terjadi kesalahan:</strong>
                    <ul style="margin-top: 10px; margin-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <form action="{{ route('customer.reviews.store', $reservation) }}" method="POST">
                @csrf

                <div class="rating-container">
                    <div class="rating-label">Bagaimana pengalaman Anda?</div>
                    <div class="stars-input" id="starsInput">
                        <span class="star" data-value="1">★</span>
                        <span class="star" data-value="2">★</span>
                        <span class="star" data-value="3">★</span>
                        <span class="star" data-value="4">★</span>
                        <span class="star" data-value="5">★</span>
                    </div>
                    <div class="rating-text" id="ratingText">Pilih rating Anda</div>
                    <input type="hidden" name="rating" id="ratingValue" required>
                </div>

                <div class="form-group">
                    <label for="comment">💬 Ceritakan Pengalaman Anda (Opsional)</label>
                    <textarea name="comment" id="comment" 
                              placeholder="Bagikan pendapat Anda tentang makanan, layanan, atau suasana restoran...">{{ old('comment') }}</textarea>
                </div>

                <div class="form-actions">
                    <a href="{{ route('customer.reservations.show', $reservation) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">✓ Kirim Review</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const stars = document.querySelectorAll('.star');
        const ratingValue = document.getElementById('ratingValue');
        const ratingText = document.getElementById('ratingText');
        
        const ratingTexts = {
            1: '😞 Sangat Buruk',
            2: '😕 Kurang Memuaskan',
            3: '😐 Cukup Baik',
            4: '😊 Memuaskan',
            5: '🤩 Sangat Memuaskan!'
        };

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.dataset.value;
                ratingValue.value = value;
                ratingText.textContent = ratingTexts[value];
                
                stars.forEach(s => {
                    if (s.dataset.value <= value) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });

            star.addEventListener('mouseenter', function() {
                const value = this.dataset.value;
                stars.forEach(s => {
                    if (s.dataset.value <= value) {
                        s.style.color = '#ffc107';
                    } else {
                        s.style.color = '#ddd';
                    }
                });
            });
        });

        document.getElementById('starsInput').addEventListener('mouseleave', function() {
            const currentValue = ratingValue.value;
            stars.forEach(s => {
                if (currentValue && s.dataset.value <= currentValue) {
                    s.style.color = '#ffc107';
                } else {
                    s.style.color = '#ddd';
                }
            });
        });
    </script>
</body>
</html>