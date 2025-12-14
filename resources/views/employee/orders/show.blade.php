<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Variabel Warna Tema Dark & Gold */
        :root {
            --primary-color: #c59d5f; /* Aksen Emas */
            --dark-bg: #0a0a0a;     /* Background Utama Gelap */
            --card-bg: #1e1e1e;     /* Background Card/Table Gelap */
            --text-light: #fff;     /* Warna Teks Utama */
            --text-secondary: #999; /* Warna Teks Sekunder */
            --border-color: rgba(197, 157, 95, 0.3); /* Garis Pembatas Emas Transparan */
            --section-bg: #151515; /* Background section lebih gelap sedikit */
        }

        /* RESET & FONT */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Georgia', 'Times New Roman', serif; 
            background: var(--dark-bg); 
            color: var(--text-light); 
            min-height: 100vh;
        }

        /* Navigation */
        nav { 
            background: #000; 
            padding: 20px 50px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.7); 
            border-bottom: 1px solid rgba(197, 157, 95, 0.2);
        }
        nav a { 
            color: var(--text-secondary); 
            text-decoration: none; 
            margin-right: 30px; 
            font-weight: 600; 
            transition: color 0.3s;
            font-family: 'Arial', sans-serif;
            text-transform: uppercase;
            font-size: 13px;
        }
        nav a:hover { color: var(--primary-color); }
        nav i { margin-right: 5px; }
        
        /* Container */
        .container { 
            max-width: 1100px; 
            margin: 40px auto; 
            padding: 0 20px; 
        }
        
        /* Card */
        .card { 
            background: var(--card-bg); 
            border-radius: 0; /* Menggunakan sudut tajam */
            box-shadow: 0 5px 20px rgba(0,0,0,0.4); 
            padding: 40px; 
            margin-bottom: 30px; 
            border: 1px solid rgba(197, 157, 95, 0.1);
        }
        
        /* Header */
        .header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 30px; 
            padding-bottom: 20px; 
            border-bottom: 2px solid var(--border-color); /* Garis emas */
        }
        .header h1 { 
            color: var(--primary-color); 
            font-size: 32px;
            letter-spacing: 1px;
        }
        
        /* Badge */
        .badge { 
            padding: 8px 15px; 
            border-radius: 4px; 
            font-size: 11px; 
            font-weight: 700; 
            text-transform: uppercase; 
            font-family: 'Arial', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .badge-warning { background: var(--primary-color); color: #000; } /* Pending (Emas) */
        .badge-info { background: #3498db; color: white; } /* Confirmed (Biru) */
        .badge-primary { background: #2980b9; color: white; } /* Cooking (Biru gelap) */
        .badge-success { background: #2ecc71; color: white; } /* Ready/Completed (Hijau) */
        .badge-danger { background: #e74c3c; color: white; } /* Cancelled (Merah) */
        
        /* Detail Grid */
        .detail-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
            gap: 30px; 
            margin-bottom: 30px; 
        }
        .detail-item label { 
            display: block; 
            color: var(--primary-color); 
            font-size: 12px; 
            font-weight: 600; 
            text-transform: uppercase; 
            margin-bottom: 8px; 
            font-family: 'Arial', sans-serif;
            letter-spacing: 0.5px;
        }
        .detail-item .value { 
            color: var(--text-light); 
            font-size: 16px; 
            font-weight: 500; 
        }
        .detail-item small {
            font-size: 13px !important; 
            color: var(--text-secondary) !important;
            display: block;
            margin-top: 2px;
            font-family: 'Arial', sans-serif;
        }
        
        /* Items Section */
        .items-section { 
            background: var(--section-bg); 
            padding: 25px; 
            border-radius: 0; 
            margin-bottom: 30px; 
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .items-section h2 { 
            color: var(--primary-color); 
            margin-bottom: 25px; 
            font-size: 24px; 
            letter-spacing: 1px;
        }
        
        /* Item Table */
        .item-table { width: 100%; border-collapse: collapse; }
        .item-table th { 
            background: #252525; 
            padding: 15px 12px; 
            text-align: left; 
            color: var(--text-secondary); 
            font-weight: 600; 
            border-bottom: 2px solid var(--border-color); 
            font-size: 13px;
            text-transform: uppercase;
        }
        .item-table td { 
            padding: 15px 12px; 
            border-bottom: 1px solid rgba(255, 255, 255, 0.05); 
            color: var(--text-light);
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }
        .item-table tr:last-child td { border-bottom: none; }
        
        .item-table strong {
            color: var(--primary-color);
        }
        .item-table small {
            color: var(--text-secondary);
        }
        
        /* Total Section */
        .total-section { 
            text-align: right; 
            padding: 30px; 
            background: var(--card-bg); 
            border-radius: 0; 
            margin-bottom: 30px; 
            border: 1px solid var(--border-color);
        }
        .total-section .total-label { 
            color: var(--text-secondary); 
            font-size: 14px; 
            margin-bottom: 5px; 
            text-transform: uppercase;
            font-family: 'Arial', sans-serif;
        }
        .total-section .total-value { 
            color: #2ecc71; /* Hijau untuk Total */
            font-size: 36px; 
            font-weight: bold; 
            letter-spacing: 1px;
        }
        
        /* Status Timeline */
        .status-timeline { 
            background: var(--section-bg); 
            padding: 30px; 
            border-radius: 0; 
            margin-bottom: 30px; 
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .status-timeline h2 { 
            color: var(--primary-color); 
            margin-bottom: 25px; 
            font-size: 24px;
            letter-spacing: 1px;
        }
        .timeline { position: relative; padding-left: 30px; }
        /* Garis Vertikal Timeline */
        .timeline::before {
            content: '';
            position: absolute;
            left: 5px;
            top: 0;
            width: 2px;
            height: 100%;
            background: rgba(197, 157, 95, 0.2); /* Garis abu-emas */
        }
        .timeline-item { position: relative; padding-bottom: 30px; }
        .timeline-item:last-child { padding-bottom: 0; }
        /* Bullet point */
        .timeline-item::before { 
            content: ''; 
            position: absolute; 
            left: 0; 
            top: 4px; 
            width: 12px; 
            height: 12px; 
            border-radius: 50%; 
            background: #333; 
            border: 2px solid var(--text-secondary);
            z-index: 10;
        }
        .timeline-item.active::before { 
            background: var(--primary-color); 
            border-color: #000;
            box-shadow: 0 0 0 3px rgba(197, 157, 95, 0.5); /* Efek bercahaya */
        }
        .timeline-label { 
            font-weight: 600; 
            color: var(--text-light); 
            margin-bottom: 3px; 
        }
        .timeline-time { 
            font-size: 13px; 
            color: var(--text-secondary); 
            font-family: 'Arial', sans-serif;
        }
        
        /* Actions */
        .actions { display: flex; gap: 15px; flex-wrap: wrap; }
        .btn { 
            padding: 12px 24px; 
            border: 1px solid transparent; 
            border-radius: 0; 
            cursor: pointer; 
            font-weight: 600; 
            text-decoration: none; 
            display: inline-flex; 
            align-items: center;
            gap: 8px;
            transition: all 0.3s; 
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            font-family: 'Arial', sans-serif;
        }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
        .btn-primary { background: var(--primary-color); color: #000; border-color: var(--primary-color); } /* Konfirmasi (Emas) */
        .btn-primary:hover { background: #d6b382; }

        .btn-success { background: #27ae60; color: white; border-color: #27ae60; } /* Siap/Selesai (Hijau) */
        .btn-success:hover { background: #1e8449; }

        .btn-warning { background: #f39c12; color: #000; border-color: #f39c12; } /* Memasak (Oranye) */
        .btn-warning:hover { background: #d35400; color: white; }

        .btn-danger { background: #e74c3c; color: white; border-color: #e74c3c; } /* Batal (Merah) */
        .btn-danger:hover { background: #c0392b; }
        
        .btn-secondary { background: #333; color: var(--text-secondary); border-color: #333; } /* Kembali (Abu-abu gelap) */
        .btn-secondary:hover { background: #555; color: white; }
        
        /* Alert */
        .alert { padding: 18px; margin-bottom: 25px; border-radius: 0; border-left: 5px solid; font-family: 'Arial', sans-serif; }
        .alert-success { background: rgba(76, 175, 80, 0.2); color: #4caf50; border-color: #4caf50; }

        /* Responsive */
        @media (max-width: 768px) {
            .card {
                padding: 30px 20px;
            }
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            .detail-grid {
                grid-template-columns: 1fr;
            }
            .item-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            .total-section {
                padding: 20px;
            }
            .actions {
                flex-direction: column;
            }
            .btn {
                width: 100%;
                justify-content: center;
            }
            .timeline {
                padding-left: 20px;
            }
            .timeline::before {
                left: -10px;
            }
            .timeline-item::before {
                left: -15px;
            }
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('employee.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('employee.reservations.index') }}"><i class="fas fa-calendar-alt"></i> Reservasi</a>
        <a href="{{ route('employee.orders.index') }}"><i class="fas fa-shopping-cart"></i> Pesanan</a>
    </nav>

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        <div class="card">
            <div class="header">
                <h1><i class="fas fa-file-invoice"></i> DETAIL PESANAN #{{ $order->id }}</h1>
                @if($order->status == 'pending')
                    <span class="badge badge-warning"><i class="fas fa-clock"></i> PENDING</span>
                @elseif($order->status == 'confirmed')
                    <span class="badge badge-info"><i class="fas fa-check"></i> DIKONFIRMASI</span>
                @elseif($order->status == 'cooking')
                    <span class="badge badge-primary"><i class="fas fa-fire"></i> SEDANG DIMASAK</span>
                @elseif($order->status == 'ready')
                    <span class="badge badge-success"><i class="fas fa-bell"></i> SIAP DISAJIKAN</span>
                @elseif($order->status == 'completed')
                    <span class="badge badge-success"><i class="fas fa-check-double"></i> SELESAI</span>
                @else
                    <span class="badge badge-danger"><i class="fas fa-times"></i> DIBATALKAN</span>
                @endif
            </div>

            <div class="detail-grid">
                <div class="detail-item">
                    <label><i class="fas fa-user"></i> Pelanggan</label>
                    <div class="value">
                        @if($order->user)
                            {{ $order->user->name }}<br>
                            <small>{{ $order->user->email }}</small>
                        @else
                            Guest
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <label><i class="fas fa-calendar-alt"></i> Tanggal & Waktu</label>
                    <div class="value">{{ $order->created_at->format('d F Y, H:i') }} WIB</div>
                </div>

                @if($order->reservation)
                <div class="detail-item">
                    <label><i class="fas fa-chair"></i> Reservasi Meja</label>
                    <div class="value">
                        @if($order->reservation->table)
                            {{ $order->reservation->table->name }}
                        @else
                            -
                        @endif
                    </div>
                </div>
                @endif

                <div class="detail-item">
                    <label><i class="fas fa-utensils"></i> Total Item</label>
                    <div class="value">{{ $order->items->sum('quantity') }} item</div>
                </div>
            </div>
        </div>

        <div class="card items-section">
            <h2><i class="fas fa-list-alt"></i> DAFTAR PESANAN</h2>
            <div style="overflow-x: auto;">
                <table class="item-table">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div>
                                    <strong>{{ $item->menu->name }}</strong><br>
                                    <small>{{ $item->menu->category->name ?? 'Tanpa Kategori' }}</small>
                                </div>
                            </td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>x{{ $item->quantity }}</td>
                            <td><strong>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="total-section">
            <div class="total-label">TOTAL PEMBAYARAN</div>
            <div class="total-value">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
        </div>

        <div class="card status-timeline">
            <h2><i class="fas fa-chart-line"></i> STATUS TIMELINE</h2>
            <div class="timeline">
                {{-- Logika Blade untuk status timeline tidak diubah --}}
                <div class="timeline-item {{ in_array($order->status, ['pending', 'confirmed', 'cooking', 'ready', 'completed']) ? 'active' : '' }}">
                    <div class="timeline-label"><i class="fas fa-hand-point-right"></i> Pesanan Diterima</div>
                    <div class="timeline-time">{{ $order->created_at->format('d M Y, H:i') }}</div>
                </div>
                <div class="timeline-item {{ in_array($order->status, ['confirmed', 'cooking', 'ready', 'completed']) ? 'active' : '' }}">
                    <div class="timeline-label"><i class="fas fa-clipboard-check"></i> Dikonfirmasi</div>
                    <div class="timeline-time">{{ $order->status != 'pending' ? $order->updated_at->format('d M Y, H:i') : '-' }}</div>
                </div>
                <div class="timeline-item {{ in_array($order->status, ['cooking', 'ready', 'completed']) ? 'active' : '' }}">
                    <div class="timeline-label"><i class="fas fa-fire"></i> Sedang Dimasak</div>
                    <div class="timeline-time">{{ in_array($order->status, ['cooking', 'ready', 'completed']) ? $order->updated_at->format('d M Y, H:i') : '-' }}</div>
                </div>
                <div class="timeline-item {{ in_array($order->status, ['ready', 'completed']) ? 'active' : '' }}">
                    <div class="timeline-label"><i class="fas fa-concierge-bell"></i> Siap Disajikan</div>
                    <div class="timeline-time">{{ in_array($order->status, ['ready', 'completed']) ? $order->updated_at->format('d M Y, H:i') : '-' }}</div>
                </div>
                <div class="timeline-item {{ $order->status == 'completed' ? 'active' : '' }}">
                    <div class="timeline-label"><i class="fas fa-money-check-alt"></i> Selesai (Pembayaran)</div>
                    <div class="timeline-time">{{ $order->status == 'completed' ? $order->updated_at->format('d M Y, H:i') : '-' }}</div>
                </div>
                @if($order->status == 'cancelled')
                 <div class="timeline-item active" style="padding-bottom: 0;">
                    <div class="timeline-label" style="color: #e74c3c;"><i class="fas fa-ban"></i> Dibatalkan</div>
                    <div class="timeline-time">{{ $order->updated_at->format('d M Y, H:i') }}</div>
                </div>
                @endif
            </div>
        </div>

        <div class="card">
            <h2 style="margin-bottom: 25px; color: var(--primary-color);"><i class="fas fa-bolt"></i> UPDATE STATUS PESANAN</h2>
            <div class="actions">
                {{-- Logika Form Aksi Status tidak diubah --}}
                @if($order->status == 'pending')
                    <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                        @csrf
                        <input type="hidden" name="status" value="confirmed">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Konfirmasi Pesanan</button>
                    </form>
                @endif

                @if($order->status == 'confirmed')
                    <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                        @csrf
                        <input type="hidden" name="status" value="cooking">
                        <button type="submit" class="btn btn-warning"><i class="fas fa-fire"></i> Mulai Memasak</button>
                    </form>
                @endif

                @if($order->status == 'cooking')
                    <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                        @csrf
                        <input type="hidden" name="status" value="ready">
                        <button type="submit" class="btn btn-success"><i class="fas fa-concierge-bell"></i> Siap Disajikan</button>
                    </form>
                @endif

                @if($order->status == 'ready')
                    <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                        @csrf
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" class="btn btn-success"><i class="fas fa-check-double"></i> Tandai Selesai & Bayar</button>
                    </form>
                @endif

                {{-- Tombol Batal hanya muncul saat Pending atau Confirmed --}}
                @if(in_array($order->status, ['pending', 'confirmed']))
                    <form method="POST" action="{{ route('employee.orders.updateStatus', $order->id) }}" style="display: inline;">
                        @csrf
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')"><i class="fas fa-times-circle"></i> Batalkan Pesanan</button>
                    </form>
                @endif

                <a href="{{ route('employee.orders.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali ke Daftar</a>
            </div>
        </div>
    </div>
</body>
</html>