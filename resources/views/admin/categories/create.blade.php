<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; }
        
        nav { background: #2c3e50; padding: 15px 30px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        nav a { color: white; text-decoration: none; margin-right: 25px; font-weight: 500; }
        nav a:hover { color: #3498db; }
        
        .container { max-width: 800px; margin: 30px auto; padding: 0 20px; }
        
        .card { background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: 30px; }
        .card h1 { color: #2c3e50; margin-bottom: 30px; }
        
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 8px; color: #2c3e50; font-weight: 500; }
        .form-group input[type="text"],
        .form-group textarea,
        .form-group input[type="file"] { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; }
        .form-group textarea { resize: vertical; min-height: 100px; font-family: inherit; }
        
        .error { color: #e74c3c; font-size: 13px; margin-top: 5px; }
        
        .btn { padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; font-weight: 500; margin-right: 10px; }
        .btn-primary { background: #3498db; color: white; }
        .btn-primary:hover { background: #2980b9; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn-secondary:hover { background: #7f8c8d; }
        
        .image-preview { margin-top: 15px; max-width: 300px; display: none; }
        .image-preview img { width: 100%; border-radius: 5px; border: 2px solid #ddd; }
    </style>
</head>
<body>
    <nav>
        <a href="/admin/dashboard">Dashboard</a>
        <a href="/admin/categories">Kelola Kategori</a>
        <a href="/admin/menus">Kelola Menu</a>
        <a href="/admin/reports/sales">Laporan Penjualan</a>
    </nav>

    <div class="container">
        <div class="card">
            <h1>Tambah Kategori Baru</h1>

            <form action="/admin/categories" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="name">Nama Kategori *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Junk Food, Seafood, Minuman" required>
                    @error('name')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" placeholder="Deskripsi kategori (opsional)">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Gambar Kategori</label>
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                    <div class="image-preview" id="imagePreview">
                        <img id="preview" src="" alt="Preview">
                    </div>
                    @error('image')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                    <a href="/admin/categories" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('preview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>