<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Reservasi | Restoranku</title>
    <style>
        /* Variabel Warna Tema */
        :root {
            --primary-color: #c59d5f; /* Aksen Emas */
            --dark-bg: #0a0a0a;     /* Background Utama Gelap */
            --card-bg: #1e1e1e;     /* Background Card/Table Gelap */
            --text-light: #fff;     /* Warna Teks Utama */
            --text-secondary: #999; /* Warna Teks Sekunder */
            --border-color: rgba(197, 157, 95, 0.3); /* Garis Pembatas */
        }

        /* RESET & FONT */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Georgia', 'Times New Roman', serif; 
            background: var(--dark-bg); 
            color: var(--text-light); 
        }

        /* -------------------------
           NAVBAR (DASHBOARD)
        ------------------------- */
        nav { 
            background: #000; /* Lebih pekat dari body */
            padding: 15px 50px; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.5); 
            border-bottom: 1px solid var(--border-color);
        }
        nav .nav-content { 
            max-width: 1400px; 
            margin: 0 auto; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }
        nav .nav-links a { 
            color: var(--text-secondary); 
            text-decoration: none; 
            margin-right: 25px; 
            font-weight: 500; 
            transition: color 0.3s;
            letter-spacing: 1px;
        }
        nav .nav-links a:hover {
            color: var(--primary-color);
        }
        .logout-btn { 
            background: transparent; 
            color: var(--primary-color); 
            border: 1px solid var(--primary-color); 
            padding: 8px 20px; 
            cursor: pointer; 
            border-radius: 2px; 
            transition: all 0.3s;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
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
            margin: 50px auto; 
            padding: 0 50px; 
        }
        
        .header { margin-bottom: 40px; }
        .header h1 { 
            color: var(--primary-color); 
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 1.5px;
        }
        .header p {
            color: var(--text-secondary);
            margin-top: 5px;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }

        /* -------------------------
           TOMBOL
        ------------------------- */
        .btn { 
            padding: 10px 18px; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            text-decoration: none; 
            display: inline-block; 
            font-weight: 600; 
            font-size: 12px; 
            margin-right: 5px; 
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        .btn-success { background: #4caf50; color: white; } /* Hijau standard */
        .btn-danger { background: #f44336; color: white; } /* Merah standard */
        .btn-info { background: #2196f3; color: white; } /* Biru standard */
        .btn-warning { background: #ff9800; color: white; } /* Oranye standard */
        
        /* -------------------------
           ALERT
        ------------------------- */
        .alert { 
            padding: 15px; 
            margin-bottom: 20px; 
            border-radius: 4px; 
            font-family: 'Arial', sans-serif;
        }
        .alert-success { 
            background: rgba(76, 175, 80, 0.2); 
            color: #4caf50; 
            border: 1px solid #4caf50; 
        }
        
        /* -------------------------
           TABLE & CARD
        ------------------------- */
        .card { 
            background: var(--card-bg); 
            border-radius: 8px; 
            box-shadow: 0 5px 20px rgba(0,0,0,0.4); 
            overflow: hidden; 
            border: 1px solid var(--border-color);
        }
        
        table { width: 100%; border-collapse: collapse; }
        thead { 
            background: #252525; /* Header Table lebih gelap */
            color: var(--primary-color); 
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
        }
        th, td { 
            padding: 15px; 
            text-align: left; 
        }
        tbody tr { 
            border-bottom: 1px solid rgba(255,255,255,0.08); /* Garis tipis */
        }
        tbody tr:hover { 
            background: #2a2a2a; 
        }

        /* Teks dalam baris */
        td strong {
            color: var(--primary-color);
        }
        td small {
            color: var(--text-secondary);
            font-family: 'Arial', sans-serif;
            font-size: 11px;
        }

        /* -------------------------
           BADGES (STATUS)
        ------------------------- */
        .badge { 
            padding: 6px 12px; 
            border-radius: 15px; 
            font-size: 11px; 
            font-weight: 700; 
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-warning { background: #c59d5f; color: #000; border: 1px solid var(--primary-color); } /* Pending (Emas) */
        .badge-success { background: #27ae60; color: white; } /* Confirmed (Hijau) */
        .badge-info { background: #3498db; color: white; } /* Completed (Biru) */
        .badge-danger { background: #e74c3c; color: white; } /* Cancelled (Merah) */
        
        /* -------------------------
           EMPTY STATE
        ------------------------- */
        .empty-state { 
            text-align: center; 
            padding: 60px 20px; 
            color: var(--text-secondary); 
            font-family: 'Arial', sans-serif;
        }
        .empty-state h3 {
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        .action-group {
            display: flex;
            gap: 5px; /* Memberi jarak antar tombol */
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-content">
            {{-- LOGO RESTORANKU --}}
            <div style="font-size: 24px; font-weight: bold; color: var(--primary-color); letter-spacing: 2px;">
                RESTORANKU
            </div>
            
            {{-- NAVIGATION LINKS --}}
            <div class="nav-links">
                <a href="{{ route('employee.dashboard') }}">🏠 Dashboard</a>
                <a href="{{ route('employee.reservations.index') }}" style="color: var(--primary-color); border-bottom: 2px solid var(--primary-color);">📅 Reservasi</a>
                <a href="{{ route('employee.orders.index') }}">🛒 Pesanan</a>
            </div>

            {{-- LOGOUT FORM --}}
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="header">
            <h1>📅 Kelola Reservasi Pelanggan</h1>
            <p>Terima atau tolak permintaan reservasi dari pelanggan</p>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
                            {{ \Carbon\Carbon::parse($reservation->date)->format('d M Y') }}<br>
                            <small>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</small>
                        </td>
                        <td>{{ $reservation->people }} orang</td>
                        <td>
                            @if($reservation->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($reservation->status == 'confirmed')
                                <span class="badge badge-success">Confirmed</span>
                            @elseif($reservation->status == 'completed')
                                <span class="badge badge-info">Completed</span>
                            @else
                                <span class="badge badge-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('employee.reservations.show', $reservation->id) }}" class="btn btn-info">Detail</a>
                                
                                @if($reservation->status == 'pending')
                                    
                                    {{-- ✔ FORM TERIMA (POST) --}}
                                    <form method="POST" action="{{ route('employee.reservations.updateStatus', $reservation->id) }}" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="btn btn-success">✓ Terima</button>
                                    </form>

                                    {{-- ✖ FORM TOLAK (POST) --}}
                                    <form method="POST" action="{{ route('employee.reservations.updateStatus', $reservation->id) }}" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-danger">✗ Tolak</button>
                                    </form>

                                @elseif($reservation->status == 'confirmed')
                                    {{-- FORM SELESAI (POST) --}}
                                    <form method="POST" action="{{ route('employee.reservations.complete', $reservation->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">✓ Selesai</button>
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
                <h3>Belum Ada Reservasi Aktif</h3>
                <p>Reservasi dari pelanggan yang perlu diproses akan muncul di sini.</p>
            </div>
            @endif
        </div>
    </div>
</body>
</html>