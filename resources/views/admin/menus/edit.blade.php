<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
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
        .form-group input[type="number"],
        .form-group select,
        .form-group textarea,
        .form-group input[type="file"] { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; }
        .form-group textarea { resize: vertical; min-height: 100px; font-family: inherit; }
        
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        
        .checkbox-group { display: flex; align-items: center; }
        .checkbox-group input[type="checkbox"] { width: auto; margin-right: 10px; }
        
        .error { color: #e74c3c; font-size: 13px; margin-top: 5px; }
        
        .btn { padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; font-weight: 500; margin-right: 10px; }
        .btn-primary { background: #3498db; color: white; }
        .btn-primary:hover { background: #2980b9; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn-secondary:hover { background: #7f8c8d; }
        
        .current-image { margin-top: 10px; max-width: 300px; }
        .current-image img { width: 100%; border-radius: 5px; border: 2px solid #ddd; }
        .current-image p { margin-top: 5px; color: #7f8c8d; font-size: 13px; }
        
        .image-preview { margin-top: 15px; max-width: 300px; display: none; }
        .image-preview img { width: 100%; border-radius: 5px; border: 2px solid #27ae60; }
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
            <h1>Edit Menu</h1>

            <form action="/admin/menus/{{ $menu->id }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="category_id">Kategori *</label>
                    <select id="category_id" name="category_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $menu->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Nama Menu *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $menu->name) }}" required>
                    @error('name')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description">{{ old('description', $menu->description) }}</textarea>
                    @error('description')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Harga (Rp) *</label>
                        <input type="number" id="price" name="price" value="{{ old('price', $menu->price) }}" min="0" step="0.01" required>
                        @error('price')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stock">Stok *</label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock', $menu->stock) }}" min="0" required>
                        @error('stock')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="image">Gambar Menu</label>
                    
                    @if($menu->image)
                    <div class="current-image">
                        <img src="/storage/{{ $menu->image }}" alt="{{ $menu->name }}">
                        <p>Gambar saat ini</p>
                    </div>
                    @endif
                    
                    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                    <div class="image-preview" id="imagePreview">
                        <img id="preview" src="" alt="Preview">
                        <p style="margin-top: 5px; color: #27ae60; font-size: 13px;">Gambar baru</p>
                    </div>
                    @error('image')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" id="is_available" name="is_available" value="1" {{ old('is_available', $menu->is_available) ? 'checked' : '' }}>
                        <label for="is_available" style="margin-bottom: 0;">Menu Tersedia</label>
                    </div>
                </div>

                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-primary">Update Menu</button>
                    <a href="/admin/menus" class="btn btn-secondary">Batal</a>
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