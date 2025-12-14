<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; }
        
        nav { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 15px 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        nav .nav-content { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        nav .nav-links a { color: white; text-decoration: none; margin-right: 25px; font-weight: 500; }
        .logout-btn { background: rgba(255,255,255,0.2); color: white; border: 2px solid white; padding: 8px 20px; cursor: pointer; border-radius: 5px; }
        
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        
        .header { margin-bottom: 30px; }
        .header h1 { color: #2c3e50; }
        
        .card { background: white; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 20px; }
        .info-item { padding: 15px; background: #f8f9fa; border-radius: 8px; }
        .info-item strong { display: block; color: #7f8c8d; font-size: 13px; margin-bottom: 8px; text-transform: uppercase; }
        .info-item span { font-size: 18px; color: #2c3e50; font-weight: 600; }
        
        .badge { padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: 600; text-transform: uppercase; display: inline-block; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        
        .section-title { color: #2c3e50; font-size: 20px; margin: 30px 0 15px 0; padding-bottom: 10px; border-bottom: 2px solid #667eea; }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #2c3e50; font-weight: 600; }
        .form-select { width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 15px; }
        
        .btn { padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; text-decoration: none; display: inline-block; font-weight: 600; font-size: 14px; margin-right: 10px; transition: all 0.3s; }
        .btn-primary { background: #667eea; color: white; }
        .btn-primary:hover { background: #5568d3; }
        .btn-success { background: #27ae60; color: white; }
        .btn-success:hover { background: #229954; }
        .btn-secondary { background: #7f8c8d; color: white; }
        .btn-secondary:hover { background: #6c7a89; }
        
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 8px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        
        @media (max-width: 768px) {
            .info-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-content">
            <div class="nav-links">
                <a href="{{ route('employee.dashboard') }}">🏠 Dashboard</a>
                <a href="{{ route('employee.reservations.index') }}">📅 Reservasi</a>
                <a href="{{ route('employee.orders.index') }}">🛒 Pesanan</a>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="header">
            <h1>📋 Detail Reservasi #{{ $reservation->id }}</h1>
            <p style="color: #7f8c8d; margin-top: 5px;">Informasi lengkap reservasi pelanggan</p>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card">
            <h3 style="color: #2c3e50; margin-bottom: 20px;">Informasi Reservasi</h3>
            
            <div class="info-grid">
                <div class="info-item">
                    <strong>ID Reservasi</strong>
                    <span>#{{ $reservation->id }}</span>
                </div>
                
                <div class="info-item">
                    <strong>Status</strong>
                    <span>
                        @if($reservation->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($reservation->status == 'confirmed')
                            <span class="badge badge-success">Confirmed</span>
                        @elseif($reservation->status == 'completed')
                            <span class="badge badge-info">Completed</span>
                        @else
                            <span class="badge badge-danger">Cancelled</span>
                        @endif
                    </span>
                </div>
                
                <div class="info-item">
                    <strong>Nama Customer</strong>
                    <span>{{ $reservation->user ? $reservation->user->name : 'Guest' }}</span>
                </div>
                
                <div class="info-item">
                    <strong>Email</strong>
                    <span>{{ $reservation->user ? $reservation->user->email : '-' }}</span>
                </div>
                
                <div class="info-item">
                    <strong>Tanggal Reservasi</strong>
                    <span>{{ \Carbon\Carbon::parse($reservation->date)->format('d M Y') }}</span>
                </div>
                
                <div class="info-item">
                    <strong>Waktu</strong>
                    <span>{{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }} WIB</span>
                </div>
                
                <div class="info-item">
                    <strong>Jumlah Orang</strong>
                    <span>{{ $reservation->people }} orang</span>
                </div>
                
                <div class="info-item">
                    <strong>Meja</strong>
                    <span>{{ $reservation->table ? $reservation->table->name : 'Belum ditentukan' }}</span>
                </div>
            </div>

            @if($reservation->notes)
            <div style="margin-top: 20px; padding: 15px; background: #fff3cd; border-radius: 8px;">
                <strong style="color: #856404;">Catatan:</strong>
                <p style="color: #856404; margin-top: 5px;">{{ $reservation->notes }}</p>
            </div>
            @endif
        </div>

        {{-- ================= STATUS UPDATE ================= --}}
        @if($reservation->status != 'completed' && $reservation->status != 'cancelled')
        <div class="card">
            <h3 class="section-title">🔄 Ubah Status Reservasi</h3>

            <form action="{{ route('employee.reservations.updateStatus', $reservation->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Pilih Status Baru:</label>
                    <select name="status" class="form-select" required>
                        <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ $reservation->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">💾 Update Status</button>
            </form>
        </div>
        @endif

        {{-- ================= COMPLETE BUTTON ================= --}}
        @if($reservation->status == 'confirmed')
        <div class="card">
            <h3 class="section-title">✅ Selesaikan Reservasi</h3>
            <p style="color: #7f8c8d; margin-bottom: 15px;">Tandai reservasi ini sebagai selesai setelah customer datang dan makan.</p>
            
            <form action="{{ route('employee.reservations.complete', $reservation->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">
                    ✔ Tandai Reservasi Telah Selesai
                </button>
            </form>
        </div>
        @endif

        <a href="{{ route('employee.reservations.index') }}" class="btn btn-secondary">
            ← Kembali ke Daftar Reservasi
        </a>
    </div>
</body>
</html>