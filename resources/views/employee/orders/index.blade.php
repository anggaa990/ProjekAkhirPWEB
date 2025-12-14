<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Restoranku</title>
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
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid rgba(197, 157, 95, 0.2);
        }

        .header h1 { 
            color: #c59d5f;
            font-size: 36px;
            margin-bottom: 8px;
            letter-spacing: 2px;
        }

        .header p {
            color: #999;
            font-size: 14px;
            font-family: 'Arial', sans-serif;
            letter-spacing: 1px;
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
        
        /* Filter Tabs */
        .filter-tabs { 
            display: flex;
            gap: 12px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .tab { 
            padding: 14px 28px;
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            font-family: 'Arial', sans-serif;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #999;
        }

        .tab:hover { 
            border-color: #c59d5f;
            color: #c59d5f;
            transform: translateY(-2px);
        }

        .tab.active { 
            background: #c59d5f;
            color: #000;
            border-color: #c59d5f;
            box-shadow: 0 5px 20px rgba(197, 157, 95, 0.3);
        }

        .tab i {
            margin-right: 8px;
        }
        
        /* Orders Grid */
        .orders-grid { 
            display: grid;
            gap: 25px;
        }
        
        /* Order Card */
        .order-card { 
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            transition: all 0.4s;
        }

        .order-card:hover { 
            transform: translateY(-5px);
            border-color: #c59d5f;
            box-shadow: 0 15px 50px rgba(197, 157, 95, 0.3);
        }
        
        /* Order Header */
        .order-header { 
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(197, 157, 95, 0.2);
        }

        .order-id { 
            font-size: 24px;
            font-weight: bold;
            color: #c59d5f;
            font-family: 'Arial', sans-serif;
        }

        .order-time {
            color: #999;
            font-size: 13px;
            margin-top: 5px;
            font-family: 'Arial', sans-serif;
        }
        
        /* Badge */
        .badge { 
            padding: 8px 18px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid;
            font-family: 'Arial', sans-serif;
        }

        .badge-warning { 
            background: rgba(243, 156, 18, 0.2);
            color: #f39c12;
            border-color: rgba(243, 156, 18, 0.3);
        }

        .badge-info { 
            background: rgba(52, 152, 219, 0.2);
            color: #3498db;
            border-color: rgba(52, 152, 219, 0.3);
        }

        .badge-primary { 
            background: rgba(155, 89, 182, 0.2);
            color: #9b59b6;
            border-color: rgba(155, 89, 182, 0.3);
        }

        .badge-success { 
            background: rgba(39, 174, 96, 0.2);
            color: #27ae60;
            border-color: rgba(39, 174, 96, 0.3);
        }

        .badge-danger { 
            background: rgba(231, 76, 60, 0.2);
            color: #e74c3c;
            border-color: rgba(231, 76, 60, 0.3);
        }

        .badge i {
            margin-right: 5px;
        }
        
        /* Order Info */
        .order-info { 
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .info-item label { 
            display: block;
            color: #999;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 8px;
            font-family: 'Arial', sans-serif;
            letter-spacing: 1px;
        }

        .info-item label i {
            margin-right: 6px;
            color: #c59d5f;
        }

        .info-item .value { 
            color: #fff;
            font-size: 15px;
            font-weight: 500;
            font-family: 'Arial', sans-serif;
        }
        
        /* Order Items */
        .order-items { 
            background: rgba(17, 17, 17, 0.8);
            padding: 20px;
            border: 1px solid rgba(197, 157, 95, 0.2);
            margin-bottom: 20px;
        }

        .order-items h4 { 
            color: #c59d5f;
            margin-bottom: 15px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
        }

        .order-items h4 i {
            margin-right: 8px;
        }

        .item-list { 
            list-style: none;
        }

        .item-list li { 
            padding: 12px 0;
            border-bottom: 1px solid rgba(197, 157, 95, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-list li:last-child { 
            border-bottom: none;
        }

        .item-name { 
            color: #fff;
            font-weight: 500;
            font-family: 'Arial', sans-serif;
        }

        .item-qty { 
            color: #999;
            font-size: 14px;
            font-family: 'Arial', sans-serif;
        }
        
        /* Total Price */
        .total-price { 
            text-align: right;
            font-size: 24px;
            font-weight: bold;
            color: #c59d5f;
            margin-bottom: 20px;
            padding: 15px 0;
            border-top: 2px solid rgba(197, 157, 95, 0.3);
            border-bottom: 2px solid rgba(197, 157, 95, 0.3);
            font-family: 'Arial', sans-serif;
        }
        
        /* Status Actions */
        .status-actions { 
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn { 
            padding: 12px 24px;
            border: 2px solid;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
            text-decoration: none;
            display: inline-block;
        }

        .btn i {
            margin-right: 6px;
        }

        .btn:hover { 
            transform: translateY(-2px);
        }

        .btn-info { 
            background: transparent;
            color: #3498db;
            border-color: #3498db;
        }

        .btn-info:hover { 
            background: #3498db;
            color: #000;
        }

        .btn-warning { 
            background: transparent;
            color: #f39c12;
            border-color: #f39c12;
        }

        .btn-warning:hover { 
            background: #f39c12;
            color: #000;
        }

        .btn-success { 
            background: transparent;
            color: #27ae60;
            border-color: #27ae60;
        }

        .btn-success:hover { 
            background: #27ae60;
            color: #000;
        }

        .btn-danger { 
            background: transparent;
            color: #e74c3c;
            border-color: #e74c3c;
        }

        .btn-danger:hover { 
            background: #e74c3c;
            color: #fff;
        }

        .btn-primary { 
            background: transparent;
            color: #c59d5f;
            border-color: #c59d5f;
        }

        .btn-primary:hover { 
            background: #c59d5f;
            color: #000;
        }
        
        /* Empty State */
        .empty-state { 
            text-align: center;
            padding: 100px 20px;
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
        }

        .empty-state i {
            font-size: 100px;
            color: rgba(197, 157, 95, 0.3);
            margin-bottom: 25px;
        }

        .empty-state h3 {
            color: #c59d5f;
            font-size: 28px;
            margin-bottom: 12px;
            letter-spacing: 2px;
        }

        .empty-state p {
            color: #999;
            font-size: 16px;
            font-family: 'Arial', sans-serif;
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

            .header h1 {
                font-size: 28px;
            }

            .filter-tabs {
                gap: 8px;
            }

            .tab {
                padding: 10px 16px;
                font-size: 11px;
            }

            .order-card {
                padding: 20px;
            }

            .order-header {
                flex-direction: column;
                gap: 10px;
            }

            .order-info {
                grid-template-columns: 1fr;
            }

            .status-actions {
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
                <a href="{{ route('employee.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
                <a href="{{ route('employee.reservations.index') }}"><i class="fas fa-calendar-alt"></i> Reservasi</a>
                <a href="{{ route('employee.orders.index') }}" class="active"><i class="fas fa-shopping-cart"></i> Pesanan</a>
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
            <h1><i class="fas fa-shopping-cart"></i> KELOLA PESANAN</h1>
            <p>Update status pesanan dari pending hingga selesai</p>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
        @endif

        <div class="filter-tabs">
            <div class="tab active" onclick="filterOrders('all')">
                <i class="fas fa-list"></i> Semua
            </div>
            <div class="tab" onclick="filterOrders('pending')">
                <i class="fas fa-clock"></i> Pending
            </div>
            <div class="tab" onclick="filterOrders('cooking')">
                <i class="fas fa-fire"></i> Dimasak
            </div>
            <div class="tab" onclick="filterOrders('ready')">
                <i class="fas fa-check"></i> Siap
            </div>
            <div class="tab" onclick="filterOrders('completed')">
                <i class="fas fa-check-double"></i> Selesai
            </div>
        </div>

        <div class="orders-grid">
            @if($orders->count() > 0)
                @foreach($orders as $order)
                <div class="order-card" data-status="{{ $order->status }}">
                    <div class="order-header">
                        <div>
                            <div class="order-id"><i class="fas fa-receipt"></i> Pesanan #{{ $order->id }}</div>
                            <div class="order-time">{{ $order->created_at->diffForHumans() }}</div>
                        </div>
                        @if($order->status == 'pending')
                            <span class="badge badge-warning"><i class="fas fa-clock"></i> Pending</span>
                        @elseif($order->status == 'confirmed')
                            <span class="badge badge-info"><i class="fas fa-check"></i> Dikonfirmasi</span>
                        @elseif($order->status == 'cooking')
                            <span class="badge badge-primary"><i class="fas fa-fire"></i> Sedang Dimasak</span>
                        @elseif($order->status == 'ready')
                            <span class="badge badge-success"><i class="fas fa-bell"></i> Siap Disajikan</span>
                        @elseif($order->status == 'completed')
                            <span class="badge badge-success"><i class="fas fa-check-double"></i> Selesai</span>
                        @else
                            <span class="badge badge-danger"><i class="fas fa-times"></i> Dibatalkan</span>
                        @endif
                    </div>

                    <div class="order-info">
                        <div class="info-item">
                            <label><i class="fas fa-user"></i> Pelanggan</label>
                            <div class="value">
                                @if($order->user)
                                    {{ $order->user->name }}
                                @else
                                    Guest
                                @endif
                            </div>
                        </div>
                        <div class="info-item">
                            <label><i class="fas fa-calendar"></i> Tanggal</label>
                            <div class="value">{{ $order->created_at->format('d M Y, H:i') }}</div>
                        </div>
                        <div class="info-item">
                            <label><i class="fas fa-utensils"></i> Total Item</label>
                            <div class="value">{{ $order->items->sum('quantity') }} item</div>
                        </div>
                    </div>

                    <div class="order-items">
                        <h4><i class="fas fa-list-ul"></i> Daftar Pesanan:</h4>
                        <ul class="item-list">
                            @foreach($order->items as $item)
                            <li>
                                <span class="item-name">{{ $item->menu->name }}</span>
                                <span class="item-qty">x{{ $item->quantity }} - Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="total-price">
                        <i class="fas fa-coins"></i> Total: Rp {{ number_format($order->total, 0, ',', '.') }}
                    </div>

                    <div class="status-actions">
                        <a href="{{ route('employee.orders.show', $order->id) }}" class="btn btn-info">
                            <i class="fas fa-file-alt"></i> Detail
                        </a>
                        
                        @if($order->status == 'pending')
                            <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="status" value="confirmed">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check"></i> Konfirmasi
                                </button>
                            </form>
                        @endif

                        @if($order->status == 'confirmed')
                            <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="status" value="cooking">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-fire"></i> Mulai Masak
                                </button>
                            </form>
                        @endif

                        @if($order->status == 'cooking')
                            <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="status" value="ready">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-bell"></i> Siap Disajikan
                                </button>
                            </form>
                        @endif

                        @if($order->status == 'ready')
                            <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check-double"></i> Selesai
                                </button>
                            </form>
                        @endif

                        @if(in_array($order->status, ['pending', 'confirmed']))
                            <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                    <i class="fas fa-times"></i> Batalkan
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
            <div class="empty-state">
                <i class="fas fa-shopping-cart"></i>
                <h3>BELUM ADA PESANAN</h3>
                <p>Pesanan dari pelanggan akan muncul di sini</p>
            </div>
            @endif
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Restoranku. All rights reserved.</p>
    </footer>

    <script>
        function filterOrders(status) {
            // Update active tab
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            event.target.classList.add('active');

            // Filter cards
            document.querySelectorAll('.order-card').forEach(card => {
                if (status === 'all' || card.dataset.status === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Animation for order cards
        document.addEventListener('DOMContentLoaded', () => {
            const orderCards = document.querySelectorAll('.order-card');
            orderCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>