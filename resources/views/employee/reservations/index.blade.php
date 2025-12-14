<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Reservasi</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; }
        
        nav { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 15px 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        nav .nav-content { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        nav .nav-links a { color: white; text-decoration: none; margin-right: 25px; font-weight: 500; }
        .logout-btn { background: rgba(255,255,255,0.2); color: white; border: 2px solid white; padding: 8px 20px; cursor: pointer; border-radius: 5px; }
        
        .container { max-width: 1400px; margin: 30px auto; padding: 0 20px; }
        
        .header { margin-bottom: 30px; }
        .header h1 { color: #2c3e50; }
        
        .btn { padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; font-weight: 500; font-size: 13px; margin-right: 5px; }
        .btn-success { background: #27ae60; color: white; }
        .btn-danger { background: #e74c3c; color: white; }
        .btn-info { background: #3498db; color: white; }
        .btn-warning { background: #f39c12; color: white; }
        
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        
        .card { background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden; }
        
        table { width: 100%; border-collapse: collapse; }
        thead { background: #34495e; color: white; }
        th, td { padding: 15px; text-align: left; }
        tbody tr { border-bottom: 1px solid #ecf0f1; }
        tbody tr:hover { background: #f8f9fa; }
        
        .badge { padding: 6px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; text-transform: uppercase; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        
        .empty-state { text-align: center; padding: 60px 20px; color: #7f8c8d; }
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
            <h1>📅 Kelola Reservasi Pelanggan</h1>
            <p style="color: #7f8c8d; margin-top: 5px;">Terima atau tolak permintaan reservasi dari pelanggan</p>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card">
            @if($reservations->count() > 0)
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
                                <em>Guest</em>
                            @endif
                        </td>
                        <td>
                            @if($reservation->table)
                                <strong>{{ $reservation->table->name }}</strong><br>
                                <small>Kapasitas: {{ $reservation->table->capacity }} orang</small>
                            @else
                                -
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
                                <form method="POST" action="{{ route('employee.reservations.complete', $reservation->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">✓ Selesai</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <h3>Belum Ada Reservasi</h3>
                <p>Reservasi dari pelanggan akan muncul di sini</p>
            </div>
            @endif
        </div>
    </div>
</body>
</html>