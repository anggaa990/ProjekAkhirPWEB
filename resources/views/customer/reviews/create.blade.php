<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Review - Reservasi #{{ $reservation->id }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Georgia', 'Times New Roman', serif;
            background: #0a0a0a;
            color: #fff;
            min-height: 100vh;
            padding: 40px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
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
            max-width: 650px; 
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .card {
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 50px 45px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card::before {
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

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            color: #c59d5f;
            margin-bottom: 12px;
            font-size: 32px;
            letter-spacing: 2px;
        }

        .header h1 i {
            margin-right: 12px;
        }

        .header p {
            color: #999;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .alert {
            padding: 20px 25px;
            margin-bottom: 30px;
            border-left: 4px solid #ef4444;
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #ef4444;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }

        .alert ul {
            margin-top: 10px;
            margin-left: 20px;
        }

        .rating-container {
            text-align: center;
            margin: 40px 0;
            padding: 40px 30px;
            background: rgba(17, 17, 17, 0.8);
            border: 1px solid rgba(197, 157, 95, 0.3);
        }

        .rating-label {
            font-size: 20px;
            font-weight: 600;
            color: #c59d5f;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        .stars-input {
            display: flex;
            justify-content: center;
            gap: 15px;
            font-size: 60px;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .stars-input .star {
            color: #333;
            transition: all 0.2s;
            cursor: pointer;
        }

        .stars-input .star:hover,
        .stars-input .star.active {
            color: #c59d5f;
            transform: scale(1.1);
        }

        .rating-text {
            margin-top: 20px;
            font-size: 18px;
            color: #c59d5f;
            font-weight: 600;
            font-family: 'Arial', sans-serif;
            min-height: 30px;
        }

        .form-group {
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 12px;
            font-weight: 600;
            color: #c59d5f;
            font-size: 14px;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: 'Arial', sans-serif;
        }

        label i {
            margin-right: 8px;
        }

        textarea {
            width: 100%;
            padding: 18px 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(197, 157, 95, 0.3);
            color: #fff;
            font-size: 15px;
            font-family: 'Arial', sans-serif;
            resize: vertical;
            min-height: 150px;
            outline: none;
            transition: all 0.3s;
        }

        textarea::placeholder {
            color: #666;
        }

        textarea:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #c59d5f;
            box-shadow: 0 0 20px rgba(197, 157, 95, 0.2);
        }

        .btn {
            padding: 16px 35px;
            border: 2px solid;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: 'Arial', sans-serif;
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

        .form-actions {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 40px;
        }

        input[type="radio"] {
            display: none;
        }

        @media (max-width: 768px) {
            body { padding: 20px 15px; }
            .card { padding: 35px 25px; }
            .header h1 { font-size: 26px; }
            .stars-input { font-size: 50px; gap: 10px; }
            .form-actions { flex-direction: column; }
            .btn { width: 100%; text-align: center; }
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <div class="container">
        <div class="card">
            <div class="header">
                <h1><i class="fas fa-star"></i> BERI REVIEW</h1>
                <p>Reservasi #{{ $reservation->id }} • {{ \Carbon\Carbon::parse($reservation->date)->format('d M Y') }}</p>
            </div>

            @if($errors->any())
                <div class="alert">
                    <strong><i class="fas fa-exclamation-triangle"></i> Terjadi kesalahan:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error'))
                <div class="alert">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                </div>
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
                    <label for="comment">
                        <i class="fas fa-comment"></i> Ceritakan Pengalaman Anda (Opsional)
                    </label>
                    <textarea name="comment" id="comment" 
                              placeholder="Bagikan pendapat Anda tentang makanan, layanan, atau suasana restoran...">{{ old('comment') }}</textarea>
                </div>

                <div class="form-actions">
                    <a href="{{ route('customer.reservations.show', $reservation) }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim Review
                    </button>
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
                        s.style.color = '#c59d5f';
                    } else {
                        s.style.color = '#333';
                    }
                });
            });
        });

        document.getElementById('starsInput').addEventListener('mouseleave', function() {
            const currentValue = ratingValue.value;
            stars.forEach(s => {
                if (currentValue && s.dataset.value <= currentValue) {
                    s.style.color = '#c59d5f';
                } else {
                    s.style.color = '#333';
                }
            });
        });
    </script>
</body>
</html>