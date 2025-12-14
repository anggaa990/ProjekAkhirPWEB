<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Reservasi | Restoranku</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Variabel Warna Tema */
        :root {
            --primary-color: #c59d5f; /* Aksen Emas */
            --dark-bg: #0a0a0a;     /* Background Utama Gelap */
            --card-bg: #1e1e1e;     /* Background Card/Table Gelap */
            --text-light: #fff;     /* Warna Teks Utama */
            --text-secondary: #999; /* Warna Teks Sekunder */
            --border-color: rgba(197, 157, 95, 0.3); /* Garis Pembatas Emas Transparan */
        }

        /* RESET & FONT */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Georgia', 'Times New Roman', serif; 
            background: var(--dark-bg); 
            color: var(--text-light); 
            min-height: 100vh;
        }

        /* -------------------------
            NAVBAR (DASHBOARD)
        ------------------------- */
        nav { 
            background: #000; /* Lebih pekat dari body */
            padding: 20px 50px; /* Padding lebih besar */
            box-shadow: 0 4px 15px rgba(0,0,0,0.7); 
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
            color: var(--primary-color);
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
        }
        nav .nav-links a { 
            color: var(--text-secondary); 
            text-decoration: none; 
            margin-right: 30px; 
            font-weight: 600; 
            transition: color 0.3s;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
            text-transform: uppercase;
            font-size: 13px;
        }
        nav .nav-links a:hover {
            color: var(--primary-color);
        }
        /* Style untuk link yang sedang aktif */
        nav .nav-links a.active-link {
            color: var(--primary-color) !important; 
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 5px;
        }
        .logout-btn { 
            background: transparent; 
            color: var(--primary-color); 
            border: 2px solid var(--primary-color); 
            padding: 10px 25px; /* Padding lebih besar */
            cursor: pointer; 
            border-radius: 0; /* Menghapus border-radius kecil */
            transition: all 0.3s;
            font-family: 'Arial', sans-serif;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .logout-btn:hover {
            background: var(--primary-color);
            color: #000;
        }

        /* -------------------------
            CONTAINER & HEADER
        ------------------------- */
        .container { 
            max-width: 1400px; 
            margin: 40px auto; /* Margin disesuaikan */
            padding: 0 50px; 
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .header { margin-bottom: 30px; border-bottom: 2px solid rgba(197, 157, 95, 0.1); padding-bottom: 15px;}
        .header h1 { 
            color: var(--primary-color); 
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 2px;
        }
        .header p {
            color: var(--text-secondary);
            margin-top: 8px;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }

        /* -------------------------
            TOMBOL
        ------------------------- */
        .btn { 
            padding: 8px 16px; /* Padding disesuaikan */
            border: 1px solid; 
            border-radius: 0; /* Tanpa border radius */
            cursor: pointer; 
            text-decoration: none; 
            display: inline-flex; /* Untuk menengahkan ikon */
            align-items: center;
            font-weight: 600; 
            font-size: 11px; /* Ukuran lebih kecil */
            margin-right: 5px; 
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            font-family: 'Arial', sans-serif;
        }
        .btn i { margin-right: 5px; }
        .btn:hover {
            opacity: 1;
            transform: translateY(-2px); /* Efek hover yang lebih elegan */
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        /* Tombol Aksi */
        .btn-success { background: #27ae60; color: white; border-color: #27ae60; } /* Terima */
        .btn-success:hover { background: #1e8449; }
        
        .btn-danger { background: #e74c3c; color: white; border-color: #e74c3c; } /* Tolak */
        .btn-danger:hover { background: #c0392b; }
        
        .btn-info { background: transparent; color: #3498db; border-color: #3498db; } /* Detail */
        .btn-info:hover { background: #3498db; color: #000; }
        
        .btn-warning { background: var(--primary-color); color: #000; border-color: var(--primary-color); } /* Selesai (Emas) */
        .btn-warning:hover { background: #a8814d; border-color: #a8814d; }
        
        /* -------------------------
            ALERT
        ------------------------- */
        .alert { 
            padding: 18px; 
            margin-bottom: 25px; 
            border-radius: 0; 
            font-family: 'Arial', sans-serif;
        }
        .alert-success { 
            background: rgba(76, 175, 80, 0.2); 
            color: #4caf50; 
            border: 1px solid #4caf50; 
            border-left: 5px solid #4caf50;
        }
        
        /* -------------------------
            TABLE & CARD
        ------------------------- */
        .card { 
            background: var(--card-bg); 
            border-radius: 0; 
            box-shadow: 0 8px 25px rgba(0,0,0,0.7); 
            overflow: hidden; 
            border: 1px solid rgba(197, 157, 95, 0.1);
        }
        
        table { width: 100%; border-collapse: collapse; }
        thead { 
            background: #252525; 
            color: var(--primary-color); 
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
        }
        th, td { 
            padding: 18px 15px; /* Padding lebih besar */
            text-align: left; 
        }
        tbody tr { 
            border-bottom: 1px solid rgba(255,255,255,0.05); 
        }
        tbody tr:last-child {
            border-bottom: none;
        }
        tbody tr:hover { 
            background: #2a2a2a; 
        }

        /* Teks dalam baris */
        td {
            color: var(--text-light);
            font-size: 14px;
        }
        td strong {
            color: var(--primary-color);
            font-weight: 700;
        }
        td small {
            color: var(--text-secondary);
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            display: block;
            margin-top: 2px;
        }

        /* -------------------------
            BADGES (STATUS)
        ------------------------- */
        .badge { 
            padding: 8px 15px; 
            border-radius: 4px; /* Sudut lebih persegi */
            font-size: 11px; 
            font-weight: 700; 
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: 'Arial', sans-serif;
        }
        .badge i { margin-right: 5px; }

        /* Pending (Emas) */
        .badge-warning { 
            background: rgba(197, 157, 95, 0.2); 
            color: var(--primary-color); 
            border: 1px solid var(--primary-color); 
        } 
        /* Confirmed (Hijau) */
        .badge-success { 
            background: #27ae60; 
            color: white; 
        } 
        /* Completed (Biru/Info) */
        .badge-info { 
            background: #3498db; 
            color: white; 
        } 
        /* Cancelled (Merah) */
        .badge-danger { 
            background: #e74c3c; 
            color: white; 
        } 
        
        /* -------------------------
            EMPTY STATE
        ------------------------- */
        .empty-state { 
            text-align: center; 
            padding: 80px 20px; 
            color: var(--text-secondary); 
            font-family: 'Arial', sans-serif;
            border: 1px dashed var(--border-color);
            background: #151515;
            border-radius: 4px;
        }
        .empty-state h3 {
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 24px;
        }
        .action-group {
            display: flex;
            gap: 10px; /* Jarak antar tombol diperbesar */
            flex-wrap: wrap; /* Pastikan tombol tetap responsif */
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .container {
                padding: 0 20px;
            }
            nav {
                padding: 15px 20px;
            }
            /* Table Responsive */
            .card {
                overflow-x: auto;
            }
            table {
                min-width: 800px; /* Lebar minimum agar tidak terlalu sempit */
            }
        }
        @media (max-width: 768px) {
            nav .nav-content {
                flex-direction: column;
                gap: 15px;
            }
            nav .nav-links {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }
            nav .nav-links a {
                margin: 0 10px;
            }
            .header h1 {
                font-size: 28px;
            }
            .action-group {
                flex-direction: column;
                gap: 5px;
            }
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-content">
            <div class="nav-brand">
                <i class="fas fa-utensils"></i> RESTORANKU
            </div>
            
            <div class="nav-links">
                <a href="{{ route('employee.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
                <a href="{{ route('employee.reservations.index') }}" class="active-link"><i class="fas fa-calendar-alt"></i> Reservasi</a>
                <a href="{{ route('employee.orders.index') }}"><i class="fas fa-shopping-cart"></i> Pesanan</a>
            </div>

            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> LOGOUT
                </button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="header">
            <h1><i class="fas fa-calendar-check"></i> KELOLA RESERVASI PELANGGAN</h1>
            <p>Terima atau tolak permintaan reservasi dari pelanggan.</p>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        <div class="card">
            {{-- Menggunakan @isset untuk memastikan variabel ada dan tidak null --}}
            @if(isset($reservations) && $reservations->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pelanggan</th>
                        <th>Meja</th>
                        <th>Tanggal & Waktu</th>
                        <th>Jumlah Orang</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                    <tr>
                        <td><strong>#{{ $reservation->id }}</strong></td>
                        <td>
                            @if($reservation->user)
                                {{ $reservation->user->name }}<br>
                                <small>{{ $reservation->user->email }}</small>
                            @else
                                <small><em>(Guest)</em></small>
                            @endif
                        </td>
                        <td>
                            @if($reservation->table)
                                <strong>{{ $reservation->table->name }}</strong><br>
                                <small>Kapasitas: {{ $reservation->table->capacity }} orang</small>
                            @else
                                <small>-</small>
                            @endif
                        </td>
                        <td>
                            <strong>{{ \Carbon\Carbon::parse($reservation->date)->format('d M Y') }}</strong><br>
                            <small>Pukul: {{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</small>
                        </td>
                        <td>{{ $reservation->people }} orang</td>
                        <td>
                            @if($reservation->status == 'pending')
                                <span class="badge badge-warning"><i class="fas fa-clock"></i> Pending</span>
                            @elseif($reservation->status == 'confirmed')
                                <span class="badge badge-success"><i class="fas fa-check"></i> Confirmed</span>
                            @elseif($reservation->status == 'completed')
                                <span class="badge badge-info"><i class="fas fa-check-double"></i> Completed</span>
                            @else
                                <span class="badge badge-danger"><i class="fas fa-times"></i> Cancelled</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('employee.reservations.show', $reservation->id) }}" class="btn btn-info"><i class="fas fa-eye"></i> Detail</a>
                                
                                @if($reservation->status == 'pending')
                                    
                                    {{-- ✔ FORM TERIMA (POST) --}}
                                    <form method="POST" action="{{ route('employee.reservations.updateStatus', $reservation->id) }}" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Terima</button>
                                    </form>

                                    {{-- ✖ FORM TOLAK (POST) --}}
                                    <form method="POST" action="{{ route('employee.reservations.updateStatus', $reservation->id) }}" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menolak reservasi ini?')"><i class="fas fa-times"></i> Tolak</button>
                                    </form>

                                @elseif($reservation->status == 'confirmed')
                                    {{-- FORM SELESAI (POST) --}}
                                    <form method="POST" action="{{ route('employee.reservations.complete', $reservation->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning" onclick="return confirm('Set reservasi ini sebagai Selesai?')"><i class="fas fa-clipboard-check"></i> Selesai</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <i class="fas fa-calendar-times" style="font-size: 60px; color: var(--border-color);"></i>
                <h3>BELUM ADA RESERVASI AKTIF</h3>
                <p>Reservasi dari pelanggan yang perlu diproses akan muncul di sini.</p>
            </div>
            @endif
        </div>
    </div>
</body>
</html>