<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori Menu</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; }
        
        nav { background: #2c3e50; padding: 15px 30px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        nav a { color: white; text-decoration: none; margin-right: 25px; font-weight: 500; }
        nav a:hover { color: #3498db; }
        .logout-btn { background: #e74c3c; color: white; border: none; padding: 8px 20px; cursor: pointer; border-radius: 5px; float: right; }
        
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header h1 { color: #2c3e50; }
        .btn { padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; font-weight: 500; }
        .btn-primary { background: #3498db; color: white; }
        .btn-primary:hover { background: #2980b9; }
        .btn-success { background: #27ae60; color: white; }
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
        
        .category-img { width: 80px; height: 80px; object-fit: cover; border-radius: 5px; }
        .no-image { width: 80px; height: 80px; background: #ecf0f1; display: flex; align-items: center; justify-content: center; border-radius: 5px; color: #7f8c8d; }
        
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
            <h1>Kelola Kategori Menu</h1>
            <a href="/admin/categories/create" class="btn btn-primary">+ Tambah Kategori</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card">
            @if($categories->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Menu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>
                            @if($category->image)
                            <img src="/storage/{{ $category->image }}" alt="{{ $category->name }}" class="category-img">
                            @else
                            <div class="no-image">No Image</div>
                            @endif
                        </td>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td>{{ Str::limit($category->description, 50) }}</td>
                        <td>{{ $category->menus->count() }} menu</td>
                        <td>
                            <a href="/admin/categories/{{ $category->id }}/edit" class="btn btn-warning btn-small">Edit</a>
                            <form method="POST" action="/admin/categories/{{ $category->id }}" style="display: inline;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3>Belum Ada Kategori</h3>
                <p>Mulai tambahkan kategori menu seperti Junk Food, Seafood, dll.</p>
            </div>
            @endif
        </div>
    </div>
</body>
</html>