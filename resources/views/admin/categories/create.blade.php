<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - Restoranku</title>
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
        
        /* Container */
        .container { 
            max-width: 900px; 
            margin: 0 auto; 
            padding: 40px 20px;
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Card */
        .card { 
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 50px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            position: relative;
            overflow: hidden;
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

        .card h1 { 
            color: #c59d5f;
            margin-bottom: 12px;
            font-size: 36px;
            letter-spacing: 2px;
        }

        .card-subtitle {
            color: #999;
            margin-bottom: 40px;
            font-size: 14px;
            font-family: 'Arial', sans-serif;
            letter-spacing: 1px;
            padding-bottom: 30px;
            border-bottom: 1px solid rgba(197, 157, 95, 0.2);
        }
        
        /* Form */
        .form-group { 
            margin-bottom: 30px; 
        }

        .form-group label { 
            display: block;
            margin-bottom: 12px;
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

        .required {
            color: #e74c3c;
            margin-left: 4px;
        }

        .form-group input[type="text"],
        .form-group textarea { 
            width: 100%;
            padding: 16px 20px;
            border: 2px solid rgba(197, 157, 95, 0.3);
            background: rgba(17, 17, 17, 0.8);
            color: #fff;
            font-size: 15px;
            font-family: 'Arial', sans-serif;
            transition: all 0.3s;
        }

        .form-group input[type="text"]:focus,
        .form-group textarea:focus { 
            outline: none;
            border-color: #c59d5f;
            background: rgba(17, 17, 17, 0.95);
            box-shadow: 0 0 20px rgba(197, 157, 95, 0.2);
        }

        .form-group input[type="text"]::placeholder,
        .form-group textarea::placeholder {
            color: #666;
        }

        .form-group textarea { 
            resize: vertical;
            min-height: 120px;
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
        }

        .form-hint {
            color: #999;
            font-size: 13px;
            margin-top: 8px;
            font-family: 'Arial', sans-serif;
            font-style: italic;
        }
        
        .error { 
            color: #e74c3c;
            font-size: 13px;
            margin-top: 8px;
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .error i {
            font-size: 14px;
        }
        
        /* Buttons */
        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid rgba(197, 157, 95, 0.2);
        }

        .btn { 
            padding: 16px 35px;
            border: 2px solid;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: all 0.3s;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: 'Arial', sans-serif;
            font-size: 13px;
        }

        .btn i {
            margin-right: 8px;
        }

        .btn-primary { 
            background: #c59d5f;
            color: #000;
            border-color: #c59d5f;
        }

        .btn-primary:hover { 
            background: transparent;
            color: #c59d5f;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(197, 157, 95, 0.3);
        }

        .btn-secondary { 
            background: transparent;
            color: #999;
            border-color: #666;
        }

        .btn-secondary:hover { 
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            border-color: #999;
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

            .card {
                padding: 30px 25px;
            }

            .card h1 {
                font-size: 28px;
            }

            .btn-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
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
                <a href="{{ route('admin.categories.index') }}" class="active"><i class="fas fa-folder"></i> Kategori</a>
                <a href="{{ route('admin.menus.index') }}"><i class="fas fa-utensils"></i> Menu</a>
                <a href="{{ route('admin.reports.sales') }}"><i class="fas fa-chart-line"></i> Laporan</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <h1><i class="fas fa-plus-circle"></i> TAMBAH KATEGORI BARU</h1>
            <p class="card-subtitle">Buat kategori menu untuk mengorganisir produk restoran Anda</p>

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">
                        <i class="fas fa-tag"></i> Nama Kategori
                        <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}" 
                        placeholder="Contoh: Junk Food, Seafood, Minuman, Dessert"
                        required
                        autofocus
                    >
                    @error('name')
                    <div class="error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-hint">
                        <i class="fas fa-info-circle"></i> Masukkan nama kategori yang jelas dan mudah dipahami
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">
                        <i class="fas fa-align-left"></i> Deskripsi
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        placeholder="Deskripsi singkat tentang kategori ini (opsional)"
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <div class="error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-hint">
                        <i class="fas fa-info-circle"></i> Tambahkan deskripsi untuk memberikan informasi lebih detail (opsional)
                    </div>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Kategori
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Restoranku. All rights reserved.</p>
    </footer>

    <script>
        // Add smooth animation for form inputs
        document.addEventListener('DOMContentLoaded', () => {
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach((group, index) => {
                group.style.opacity = '0';
                group.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    group.style.transition = 'all 0.5s ease';
                    group.style.opacity = '1';
                    group.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Auto-resize textarea
        const textarea = document.querySelector('textarea');
        if (textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        }
    </script>
</body>
</html>