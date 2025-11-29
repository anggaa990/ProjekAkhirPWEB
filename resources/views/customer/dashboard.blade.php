<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Customer</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container { max-width: 1200px; margin: 0 auto; }
        .header {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .header h1 { color: #667eea; margin-bottom: 10px; }
        .header p { color: #666; }
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .card:hover { transform: translateY(-5px); }
        .card-icon { font-size: 48px; margin-bottom: 15px; }
        .card h3 { color: #333; margin-bottom: 10px; }
        .card p { color: #666; font-size: 14px; }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 15px;
            transition: background 0.3s;
        }
        .btn:hover { background: #5568d3; }
        .logout-btn {
            background: #e74c3c;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            float: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
            <h1>Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
            <p>Kelola reservasi dan pesanan Anda dengan mudah</p>
        </div>

        <div class="cards">
            <a href="{{ route('customer.reservations.create') }}" class="card">
                <div class="card-icon">📅</div>
                <h3>Buat Reservasi</h3>
                <p>Pesan meja dan menu sekaligus untuk pengalaman dining yang sempurna</p>
            </a>

            <a href="{{ route('customer.reservations.index') }}" class="card">
                <div class="card-icon">📋</div>
                <h3>Reservasi Saya</h3>
                <p>Lihat semua reservasi dan pesanan yang telah Anda buat</p>
            </a>

            <a href="{{ route('menu') }}" class="card">
                <div class="card-icon">🍽️</div>
                <h3>Lihat Menu</h3>
                <p>Jelajahi menu lezat kami sebelum membuat reservasi</p>
            </a>
        </div>
    </div>
</body>
</html>