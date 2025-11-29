<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; }
        
        nav { background: #2c3e50; padding: 15px 30px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        nav a { color: white; text-decoration: none; margin-right: 25px; font-weight: 500; }
        nav a:hover { color: #3498db; }
        .logout-btn { background: #e74c3c; color: white; border: none; padding: 8px 20px; cursor: pointer; border-radius: 5px; float: right; }
        
        .container { max-width: 1400px; margin: 30px auto; padding: 0 20px; }
        
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header h1 { color: #2c3e50; }
        .btn { padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; font-weight: 500; }
        .btn-primary { background: #3498db; color: white; }
        .btn-primary:hover { background: #2980b9; }
        .btn-warning { background: #f39c12; color: white; }
        .btn-danger { background: #e74c3c; color: white; }
        .btn-small { padding: 6px 12px; font-size: 14px; margin-right: 5px; }
        
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        
        .card { background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden; }
        
        table { width: 100%; border-collapse: collapse; }
        thead { background: #34495e; color: white; }
        th, td { padding: 15px; text-align: left; }
        tbody tr { border-bottom: 1px solid #ecf0f1; }
        tbody tr:hover { background: #f8f9fa; }
        
        .menu-img { width: 80px; height: 80px; object-fit: cover; border-radius: 5px; }
        .no-image { width: 80px; height: 80px; background: #ecf0f1; display: flex; align-items: center; justify-content: center; border-radius: 5px; color: #7f8c8d; font-size: 12px; }
        
        .badge { padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        
        .price { color: #27ae60; font-weight: bold; font-size: 16px; }
        
        .empty-state { text-align: center; padding: 60px 20px; color: #7f8c8d; }
        .empty-state svg { width: 100px; height: 100px; margin-bottom: 20px; }
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
            <h1>Kelola Menu Makanan</h1>
            <a href="/admin/menus/create" class="btn btn-primary">+ Tambah Menu</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card">
            @if($menus->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Menu</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                    <tr>
                        <td>
                            @if($menu->image)
                            <img src="/storage/{{ $menu->image }}" alt="{{ $menu->name }}" class="menu-img">
                            @else
                            <div class="no-image">No Image</div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $menu->name }}</strong><br>
                            <small style="color: #7f8c8d;">{{ Str::limit($menu->description, 40) }}</small>
                        </td>
                        <td>{{ $menu->category->name }}</td>
                        <td class="price">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                        <td>{{ $menu->stock }}</td>
                        <td>
                            @if($menu->is_available)
                            <span class="badge badge-success">Tersedia</span>
                            @else
                            <span class="badge badge-danger">Tidak Tersedia</span>
                            @endif
                        </td>
                        <td>
                            <a href="/admin/menus/{{ $menu->id }}/edit" class="btn btn-warning btn-small">Edit</a>
                            <form method="POST" action="/admin/menus/{{ $menu->id }}" style="display: inline;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Yakin ingin menghapus menu ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <h3>Belum Ada Menu</h3>
                <p>Mulai tambahkan menu makanan seperti Nasi Goreng, Burger, dll.</p>
            </div>
            @endif
        </div>
    </div>
</body>
</html>