<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Role - Restoran</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            max-width: 1000px;
            width: 100%;
        }
        
        .header {
            text-align: center;
            margin-bottom: 50px;
            animation: fadeInDown 0.8s ease;
        }
        
        .header h1 {
            color: white;
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        
        .header p {
            color: rgba(255,255,255,0.9);
            font-size: 18px;
        }
        
        .role-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .role-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            animation: fadeInUp 0.8s ease;
        }
        
        .role-card:nth-child(1) { animation-delay: 0.1s; }
        .role-card:nth-child(2) { animation-delay: 0.2s; }
        .role-card:nth-child(3) { animation-delay: 0.3s; }
        
        .role-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            transition: height 0.3s ease;
        }
        
        .role-card.admin::before { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .role-card.employee::before { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .role-card.customer::before { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
        
        .role-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        
        .role-card:hover::before {
            height: 100%;
            opacity: 0.1;
        }
        
        .role-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            transition: all 0.3s ease;
        }
        
        .role-card.admin .role-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            box-shadow: 0 10px 25px rgba(245, 87, 108, 0.4);
        }
        
        .role-card.employee .role-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            box-shadow: 0 10px 25px rgba(79, 172, 254, 0.4);
        }
        
        .role-card.customer .role-icon {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            box-shadow: 0 10px 25px rgba(67, 233, 123, 0.4);
        }
        
        .role-card:hover .role-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        .role-card h2 {
            color: #2c3e50;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .role-card p {
            color: #7f8c8d;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        .role-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .role-card.admin .role-badge {
            background: rgba(245, 87, 108, 0.1);
            color: #f5576c;
        }
        
        .role-card.employee .role-badge {
            background: rgba(79, 172, 254, 0.1);
            color: #4facfe;
        }
        
        .role-card.customer .role-badge {
            background: rgba(67, 233, 123, 0.1);
            color: #43e97b;
        }
        
        .footer {
            text-align: center;
            margin-top: 40px;
            animation: fadeIn 1s ease 0.5s both;
        }
        
        .footer p {
            color: rgba(255,255,255,0.8);
            font-size: 14px;
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @media (max-width: 768px) {
            .header h1 { font-size: 32px; }
            .role-grid { grid-template-columns: 1fr; gap: 20px; }
            .role-card { padding: 30px 20px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🍽️ Selamat Datang</h1>
        </div>
        
        <div class="role-grid">
            <!-- Admin Card -->
            <a href="/login/admin" class="role-card admin">
                <div class="role-icon">👨‍💼</div>
                <h2>Admin</h2>
                <p>Saya disini sebagai Admin Pengelola</p>
                <span class="role-badge">Full Access</span>
            </a>
            
            <!-- Employee Card -->
            <a href="/login/employee" class="role-card employee">
                <div class="role-icon">👨‍🍳</div>
                <h2>Karyawan</h2>
                <p>Saya disini sebagai Karyawan Restoran</p>
                <span class="role-badge">Staff Access</span>
            </a>
            
            <!-- Customer Card -->
            <a href="/login/customer" class="role-card customer">
                <div class="role-icon">🙋‍♂️</div>
                <h2>Customer</h2>
                <p>Saya disini sebagai Pelanggan</p>
                <span class="role-badge">Guest Access</span>
            </a>
        </div>
        
        <div class="footer">
            <p>© 2025 Restoran System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>