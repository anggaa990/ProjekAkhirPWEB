<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Reservasi - Restoranku</title>
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
            padding: 40px 20px;
        }

        /* Background */
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
            max-width: 1100px; 
            margin: 0 auto; 
            position: relative;
            z-index: 1;
        }
        
        .card {
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 50px 45px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
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
            margin-bottom: 40px;
            text-align: center;
        }
        
        .header h1 { 
            color: #c59d5f; 
            font-size: 36px;
            letter-spacing: 3px;
            margin-bottom: 10px;
        }
        
        .header p { 
            color: #999; 
            font-size: 15px;
            font-family: 'Arial', sans-serif;
            letter-spacing: 1px;
        }

        .divider {
            width: 80px;
            height: 2px;
            background: #c59d5f;
            margin: 20px auto;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            font-size: 13px;
            color: #c59d5f;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: 'Arial', sans-serif;
            font-weight: 600;
        }

        label i {
            margin-right: 8px;
        }
        
        input[type="date"],
        input[type="time"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(197, 157, 95, 0.3);
            color: #fff;
            font-size: 15px;
            transition: all 0.3s;
            font-family: 'Arial', sans-serif;
            outline: none;
        }
        
        input:focus, select:focus, textarea:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #c59d5f;
            box-shadow: 0 0 20px rgba(197, 157, 95, 0.2);
        }

        input[readonly] {
            background: rgba(255, 255, 255, 0.02);
            cursor: not-allowed;
            opacity: 0.8;
        }

        select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23c59d5f' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 20px center;
            padding-right: 45px;
        }

        select option {
            background: #1a1a1a;
            color: #fff;
        }

        textarea { 
            resize: vertical; 
            min-height: 100px;
        }

        textarea::placeholder {
            color: #666;
        }

        .form-hint {
            color: #999;
            font-size: 12px;
            margin-top: 8px;
            display: block;
            font-family: 'Arial', sans-serif;
            font-style: italic;
        }

        .form-hint i {
            margin-right: 6px;
            color: #c59d5f;
        }
        
        .menu-section {
            background: rgba(17, 17, 17, 0.8);
            padding: 35px;
            border: 1px solid rgba(197, 157, 95, 0.2);
            margin-top: 40px;
        }
        
        .menu-section h3 {
            color: #c59d5f;
            margin-bottom: 30px;
            font-size: 24px;
            letter-spacing: 2px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .menu-section h3 i {
            font-size: 28px;
        }
        
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .menu-item {
            background: rgba(26, 26, 26, 0.9);
            padding: 20px;
            border: 2px solid rgba(197, 157, 95, 0.3);
            transition: all 0.3s;
            position: relative;
        }
        
        .menu-item:hover {
            border-color: #c59d5f;
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(197, 157, 95, 0.3);
        }
        
        .menu-item.selected {
            border-color: #c59d5f;
            background: rgba(197, 157, 95, 0.15);
        }
        
        .menu-item h4 {
            color: #fff;
            margin-bottom: 10px;
            font-size: 18px;
            letter-spacing: 1px;
        }
        
        .menu-item .price {
            color: #c59d5f;
            font-weight: bold;
            font-size: 20px;
            margin: 10px 0;
            font-family: 'Arial', sans-serif;
        }
        
        .menu-item .stock {
            color: #999;
            font-size: 13px;
            margin-bottom: 15px;
            font-family: 'Arial', sans-serif;
        }
        
        .quantity-control {
            display: none;
            align-items: center;
            gap: 12px;
            margin-top: 15px;
            justify-content: center;
        }
        
        .quantity-control button {
            width: 40px;
            height: 40px;
            border: 2px solid #c59d5f;
            background: transparent;
            color: #c59d5f;
            cursor: pointer;
            font-size: 20px;
            transition: all 0.3s;
            font-weight: bold;
        }
        
        .quantity-control button:hover {
            background: #c59d5f;
            color: #000;
        }
        
        .quantity-control input {
            width: 70px;
            text-align: center;
            padding: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(197, 157, 95, 0.3);
            color: #fff;
        }
        
        .selected-items {
            background: rgba(26, 26, 26, 0.9);
            padding: 30px;
            border: 2px solid rgba(197, 157, 95, 0.3);
            margin-top: 30px;
            display: none;
        }
        
        .selected-items h4 {
            color: #c59d5f;
            margin-bottom: 20px;
            font-size: 20px;
            letter-spacing: 2px;
        }
        
        .selected-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid rgba(197, 157, 95, 0.2);
            font-family: 'Arial', sans-serif;
            color: #ccc;
        }
        
        .selected-item:last-child {
            border-bottom: none;
        }
        
        .total-section {
            background: rgba(197, 157, 95, 0.2);
            border: 2px solid #c59d5f;
            color: #fff;
            padding: 25px 30px;
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .total-section h3 {
            font-size: 22px;
            letter-spacing: 1px;
            color: #c59d5f;
        }
        
        .btn {
            padding: 16px 35px;
            border: 2px solid #c59d5f;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
        }
        
        .btn-primary {
            background: #c59d5f;
            color: #000;
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

        .add-menu {
            width: 100%;
            margin-top: 15px;
            padding: 12px;
            font-size: 14px;
        }
        
        .form-actions {
            display: flex;
            gap: 20px;
            margin-top: 40px;
            justify-content: center;
        }
        
        .alert {
            padding: 20px 25px;
            margin-bottom: 30px;
            border-left: 4px solid #dc3545;
            background: rgba(220, 53, 69, 0.15);
            border: 1px solid rgba(220, 53, 69, 0.3);
        }
        
        .alert-error {
            color: #ff6b6b;
        }

        .alert strong {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .alert ul {
            margin-left: 20px;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 28px;
            }

            .menu-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <div class="container">
        <div class="card">
            <div class="header">
                <h1><i class="fas fa-calendar-check"></i> BUAT RESERVASI</h1>
                <div class="divider"></div>
                <p>Pesan meja dan menu favorit Anda sekaligus!</p>
            </div>

            @if($errors->any())
                <div class="alert alert-error">
                    <strong><i class="fas fa-exclamation-triangle"></i> Terjadi kesalahan:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customer.reservations.store') }}" method="POST" id="reservationForm">
                @csrf

                <div class="form-group">
                    <label for="table_id"><i class="fas fa-chair"></i> Pilih Meja</label>
                    <select name="table_id" id="table_id" required>
                        <option value="">-- Pilih Meja --</option>
                        @foreach($tables as $table)
                            <option value="{{ $table->id }}" data-capacity="{{ $table->capacity }}" {{ old('table_id') == $table->id ? 'selected' : '' }}>
                                {{ $table->name }} (Kapasitas: {{ $table->capacity }} orang)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="date"><i class="fas fa-calendar"></i> Tanggal Reservasi</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}" 
                           min="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label for="time"><i class="fas fa-clock"></i> Waktu</label>
                    <input type="time" name="time" id="time" value="{{ old('time') }}" required>
                </div>

                <div class="form-group">
                    <label for="people"><i class="fas fa-users"></i> Jumlah Tamu</label>
                    <input type="number" name="people" id="people" value="{{ old('people', '') }}" 
                           min="1" max="20" required readonly>
                    <small class="form-hint">
                        <i class="fas fa-info-circle"></i> Jumlah tamu otomatis terisi sesuai kapasitas meja yang dipilih
                    </small>
                </div>

                <div class="form-group">
                    <label for="notes"><i class="fas fa-sticky-note"></i> Catatan</label>
                    <textarea name="notes" id="notes" placeholder="Contoh: Alergi makanan, permintaan khusus, dll.">{{ old('notes') }}</textarea>
                </div>

                <div class="menu-section">
                    <h3>
                        <i class="fas fa-utensils"></i>
                        <span>Pilih Menu</span>
                    </h3>

                    <div class="menu-grid">
                        @foreach($menus as $menu)
                            <div class="menu-item" data-menu-id="{{ $menu->id }}" 
                                 data-price="{{ $menu->price }}" data-stock="{{ $menu->stock }}">
                                <h4>{{ $menu->name }}</h4>
                                <div class="price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
                                <div class="stock">Stok: {{ $menu->stock }}</div>
                                
                                <div class="quantity-control">
                                    <button type="button" class="qty-minus">-</button>
                                    <input type="number" class="qty-input" value="1" min="1" max="{{ $menu->stock }}" readonly>
                                    <button type="button" class="qty-plus">+</button>
                                </div>
                                <button type="button" class="btn btn-primary add-menu">
                                    Tambah
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <div class="selected-items" id="selectedItems">
                        <h4><i class="fas fa-list-check"></i> Menu yang Dipilih:</h4>
                        <div id="itemsList"></div>
                        <div class="total-section">
                            <h3>Total Pesanan:</h3>
                            <h3 id="totalPrice">Rp 0</h3>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('customer.reservations.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Buat Reservasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const selectedMenus = {};
        let total = 0;

        // ===== AUTO-FILL JUMLAH TAMU BERDASARKAN MEJA YANG DIPILIH =====
        const tableSelect = document.getElementById('table_id');
        const peopleInput = document.getElementById('people');

        tableSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const capacity = selectedOption.getAttribute('data-capacity');
            
            if (capacity) {
                peopleInput.value = capacity;
                peopleInput.max = capacity;
            } else {
                peopleInput.value = '';
            }
        });

        // Set initial value if table is already selected (for old input)
        if (tableSelect.value) {
            const selectedOption = tableSelect.options[tableSelect.selectedIndex];
            const capacity = selectedOption.getAttribute('data-capacity');
            if (capacity) {
                peopleInput.value = capacity;
                peopleInput.max = capacity;
            }
        }

        // ===== MENU SELECTION LOGIC =====
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
                    addBtn.style.background = '#dc3545';
                    addBtn.style.borderColor = '#dc3545';
                    qtyControl.style.display = 'flex';
                } else {
                    delete selectedMenus[menuId];
                    item.classList.remove('selected');
                    addBtn.textContent = 'Tambah';
                    addBtn.style.background = '#c59d5f';
                    addBtn.style.borderColor = '#c59d5f';
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
                        <span style="font-weight: bold; color: #c59d5f;">Rp ${subtotal.toLocaleString('id-ID')}</span>
                    </div>
                `;
                
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