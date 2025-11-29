<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Reservasi</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container { max-width: 900px; margin: 0 auto; }
        .card {
            background: white;
            border-radius: 15px;
            padding: 35px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        .header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #667eea;
        }
        .header h1 { color: #667eea; margin-bottom: 5px; }
        .header p { color: #666; }
        .form-group {
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        input[type="date"],
        input[type="time"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: border 0.3s;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
        }
        textarea { resize: vertical; min-height: 80px; }
        
        .menu-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin-top: 30px;
        }
        .menu-section h3 {
            color: #667eea;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        .menu-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s;
        }
        .menu-item:hover {
            border-color: #667eea;
            transform: translateY(-2px);
        }
        .menu-item.selected {
            border-color: #667eea;
            background: #f0f4ff;
        }
        .menu-item h4 {
            color: #333;
            margin-bottom: 5px;
            font-size: 16px;
        }
        .menu-item .price {
            color: #667eea;
            font-weight: bold;
            font-size: 18px;
            margin: 8px 0;
        }
        .menu-item .stock {
            color: #999;
            font-size: 13px;
            margin-bottom: 10px;
        }
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }
        .quantity-control button {
            width: 35px;
            height: 35px;
            border: none;
            background: #667eea;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            transition: background 0.3s;
        }
        .quantity-control button:hover {
            background: #5568d3;
        }
        .quantity-control input {
            width: 60px;
            text-align: center;
            padding: 8px;
        }
        
        .selected-items {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .selected-items h4 {
            color: #667eea;
            margin-bottom: 15px;
        }
        .selected-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .selected-item:last-child {
            border-bottom: none;
        }
        .total-section {
            background: #667eea;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .total-section h3 {
            font-size: 24px;
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
            transform: translateY(-2px);
        }
        .btn-secondary {
            background: #95a5a6;
            color: white;
        }
        .form-actions {
            display: flex;
            gap: 15px;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>📅 Buat Reservasi</h1>
                <p>Pesan meja dan menu favorit Anda sekaligus!</p>
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

            <form action="{{ route('customer.reservations.store') }}" method="POST" id="reservationForm">
                @csrf

                <div class="form-group">
                    <label for="table_id">🪑 Pilih Meja</label>
                    <select name="table_id" id="table_id" required>
                        <option value="">-- Pilih Meja --</option>
                        @foreach($tables as $table)
                            <option value="{{ $table->id }}" {{ old('table_id') == $table->id ? 'selected' : '' }}>
                                {{ $table->name }} (Kapasitas: {{ $table->capacity }} orang)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">📅 Tanggal Reservasi</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}" 
                           min="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label for="time">🕐 Waktu</label>
                    <input type="time" name="time" id="time" value="{{ old('time') }}" required>
                </div>

                <div class="form-group">
                    <label for="people">👥 Jumlah Tamu</label>
                    <input type="number" name="people" id="people" value="{{ old('people', 2) }}" 
                           min="1" max="20" required>
                </div>

                <div class="form-group">
                    <label for="notes">📝 Catatan</label>
                    <textarea name="notes" id="notes" placeholder="Contoh: Alergi makanan, permintaan khusus, dll.">{{ old('notes') }}</textarea>
                </div>

                <div class="menu-section">
                    <h3>
                        <span>🍽️</span>
                        <span>Pilih Menu </span>
                    </h3>

                    <div class="menu-grid">
                        @foreach($menus as $menu)
                            <div class="menu-item" data-menu-id="{{ $menu->id }}" 
                                 data-price="{{ $menu->price }}" data-stock="{{ $menu->stock }}">
                                <h4>{{ $menu->name }}</h4>
                                <div class="price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
                                <div class="stock">Stok: {{ $menu->stock }}</div>
                                
                                <div class="quantity-control" style="display: none;">
                                    <button type="button" class="qty-minus">-</button>
                                    <input type="number" class="qty-input" value="1" min="1" max="{{ $menu->stock }}" readonly>
                                    <button type="button" class="qty-plus">+</button>
                                </div>
                                <button type="button" class="btn btn-primary add-menu" style="width: 100%; margin-top: 10px;">
                                    Tambah
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <div class="selected-items" id="selectedItems" style="display: none;">
                        <h4>Menu yang Dipilih:</h4>
                        <div id="itemsList"></div>
                        <div class="total-section">
                            <h3>Total Pesanan:</h3>
                            <h3 id="totalPrice">Rp 0</h3>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('customer.reservations.index') }}" class="btn btn-secondary">← Batal</a>
                    <button type="submit" class="btn btn-primary">✓ Buat Reservasi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const selectedMenus = {};
        let total = 0;

        document.querySelectorAll('.menu-item').forEach(item => {
            const addBtn = item.querySelector('.add-menu');
            const qtyControl = item.querySelector('.quantity-control');
            const qtyInput = item.querySelector('.qty-input');
            const plusBtn = item.querySelector('.qty-plus');
            const minusBtn = item.querySelector('.qty-minus');
            
            const menuId = item.dataset.menuId;
            const price = parseFloat(item.dataset.price);
            const stock = parseInt(item.dataset.stock);
            const menuName = item.querySelector('h4').textContent;

            addBtn.addEventListener('click', () => {
                if (!selectedMenus[menuId]) {
                    selectedMenus[menuId] = {
                        name: menuName,
                        price: price,
                        quantity: 1,
                        stock: stock
                    };
                    
                    item.classList.add('selected');
                    addBtn.textContent = 'Hapus';
                    addBtn.style.background = '#e74c3c';
                    qtyControl.style.display = 'flex';
                } else {
                    delete selectedMenus[menuId];
                    item.classList.remove('selected');
                    addBtn.textContent = 'Tambah';
                    addBtn.style.background = '#667eea';
                    qtyControl.style.display = 'none';
                    qtyInput.value = 1;
                }
                updateSelectedItems();
            });

            plusBtn.addEventListener('click', () => {
                if (selectedMenus[menuId] && selectedMenus[menuId].quantity < stock) {
                    selectedMenus[menuId].quantity++;
                    qtyInput.value = selectedMenus[menuId].quantity;
                    updateSelectedItems();
                }
            });

            minusBtn.addEventListener('click', () => {
                if (selectedMenus[menuId] && selectedMenus[menuId].quantity > 1) {
                    selectedMenus[menuId].quantity--;
                    qtyInput.value = selectedMenus[menuId].quantity;
                    updateSelectedItems();
                }
            });
        });

        function updateSelectedItems() {
            const itemsList = document.getElementById('itemsList');
            const selectedSection = document.getElementById('selectedItems');
            const form = document.getElementById('reservationForm');
            
            // Hapus input menu yang lama
            form.querySelectorAll('input[name^="menu_items"]').forEach(el => el.remove());
            
            itemsList.innerHTML = '';
            total = 0;
            
            if (Object.keys(selectedMenus).length === 0) {
                selectedSection.style.display = 'none';
                return;
            }
            
            selectedSection.style.display = 'block';
            
            Object.keys(selectedMenus).forEach((menuId, index) => {
                const menu = selectedMenus[menuId];
                const subtotal = menu.price * menu.quantity;
                total += subtotal;
                
                itemsList.innerHTML += `
                    <div class="selected-item">
                        <span>${menu.name} × ${menu.quantity}</span>
                        <span style="font-weight: bold;">Rp ${subtotal.toLocaleString('id-ID')}</span>
                    </div>
                `;
                
                // Tambah hidden input untuk form
                const menuIdInput = document.createElement('input');
                menuIdInput.type = 'hidden';
                menuIdInput.name = `menu_items[${index}][menu_id]`;
                menuIdInput.value = menuId;
                form.appendChild(menuIdInput);
                
                const qtyInput = document.createElement('input');
                qtyInput.type = 'hidden';
                qtyInput.name = `menu_items[${index}][quantity]`;
                qtyInput.value = menu.quantity;
                form.appendChild(qtyInput);
            });
            
            document.getElementById('totalPrice').textContent = 
                `Rp ${total.toLocaleString('id-ID')}`;
        }
    </script>
</body>
</html>