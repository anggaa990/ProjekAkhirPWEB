<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori Menu - Restoranku</title>
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
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid rgba(197, 157, 95, 0.2);
        }

        .header-content h1 { 
            color: #c59d5f;
            font-size: 36px;
            margin-bottom: 8px;
            letter-spacing: 2px;
        }

        .header-content p {
            color: #999;
            font-size: 14px;
            font-family: 'Arial', sans-serif;
            letter-spacing: 1px;
        }

        /* Buttons */
        .btn { 
            padding: 14px 30px;
            border: none;
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

        .btn-primary { 
            background: #c59d5f;
            color: #000;
            border: 2px solid #c59d5f;
        }

        .btn-primary:hover { 
            background: transparent;
            color: #c59d5f;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(197, 157, 95, 0.3);
        }

        .btn-warning { 
            background: transparent;
            color: #f39c12;
            border: 2px solid #f39c12;
            padding: 8px 16px;
            font-size: 12px;
        }

        .btn-warning:hover {
            background: #f39c12;
            color: #000;
        }

        .btn-danger { 
            background: transparent;
            color: #e74c3c;
            border: 2px solid #e74c3c;
            padding: 8px 16px;
            font-size: 12px;
        }

        .btn-danger:hover {
            background: #e74c3c;
            color: #fff;
        }

        .btn-small { 
            margin-right: 8px;
        }
        
        /* Alert */
        .alert { 
            padding: 20px 25px;
            margin-bottom: 30px;
            border-radius: 0;
            border-left: 4px solid;
            background: rgba(26, 26, 26, 0.95);
            animation: slideInRight 0.5s ease;
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .alert-success { 
            border-left-color: #27ae60;
            color: #27ae60;
        }

        .alert i {
            margin-right: 10px;
            font-size: 18px;
        }
        
        /* Card */
        .card { 
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            overflow: hidden;
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
            padding: 20px;
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

        tbody td strong {
            color: #fff;
            font-size: 16px;
        }
        
        .category-img { 
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 3px solid rgba(197, 157, 95, 0.3);
            transition: all 0.3s;
        }

        .category-img:hover {
            border-color: #c59d5f;
            transform: scale(1.05);
        }

        .no-image { 
            width: 100px;
            height: 100px;
            background: rgba(197, 157, 95, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed rgba(197, 157, 95, 0.3);
            color: #999;
            font-family: 'Arial', sans-serif;
            font-size: 12px;
        }

        .menu-count {
            background: rgba(197, 157, 95, 0.2);
            color: #c59d5f;
            padding: 6px 14px;
            border: 1px solid rgba(197, 157, 95, 0.3);
            display: inline-block;
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 1px;
        }
        
        /* Empty State */
        .empty-state { 
            text-align: center;
            padding: 100px 20px;
            color: #999;
        }

        .empty-state-icon {
            font-size: 100px;
            color: rgba(197, 157, 95, 0.3);
            margin-bottom: 30px;
        }

        .empty-state h3 {
            color: #c59d5f;
            font-size: 28px;
            margin-bottom: 15px;
            letter-spacing: 2px;
        }

        .empty-state p {
            font-size: 16px;
            font-family: 'Arial', sans-serif;
            margin-bottom: 30px;
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

            .header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .header-content h1 {
                font-size: 28px;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 12px;
            }

            .category-img,
            .no-image {
                width: 60px;
                height: 60px;
            }

            .btn-small {
                display: block;
                margin-bottom: 8px;
                margin-right: 0;
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
            <div class="header-content">
                <h1><i class="fas fa-folder-open"></i> KELOLA KATEGORI MENU</h1>
                <p>Atur dan organisir kategori menu restoran Anda</p>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Tambah Kategori
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
        @endif

        <div class="card">
            @if($categories->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-tag"></i> Nama Kategori</th>
                        <th><i class="fas fa-align-left"></i> Deskripsi</th>
                        <th><i class="fas fa-list"></i> Jumlah Menu</th>
                        <th><i class="fas fa-cog"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td>{{ Str::limit($category->description, 80) }}</td>
                        <td>
                            <span class="menu-count">
                                <i class="fas fa-utensils"></i> {{ $category->menus->count() }} Menu
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-small">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Yakin ingin menghapus kategori ini?\n\nSemua menu dalam kategori ini akan terpengaruh.')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                <h3>BELUM ADA KATEGORI</h3>
                <p>Mulai tambahkan kategori menu seperti Junk Food, Seafood, Beverages, dll.</p>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Tambah Kategori Pertama
                </a>
            </div>
            @endif
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Restoranku. All rights reserved.</p>
    </footer>

    <script>
        // Add smooth fade-in for table rows
        document.addEventListener('DOMContentLoaded', () => {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    row.style.transition = 'all 0.5s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>