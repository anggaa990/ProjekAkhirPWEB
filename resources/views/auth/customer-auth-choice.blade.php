<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer - Login atau Register</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* Background with parallax effect */
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
            max-width: 500px;
            width: 100%;
            padding: 20px;
        }

        .auth-box {
            background: rgba(26, 26, 26, 0.95);
            border: 2px solid rgba(197, 157, 95, 0.3);
            border-radius: 0;
            padding: 60px 50px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 0.8s ease;
            position: relative;
            overflow: hidden;
        }

        .auth-box::before {
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
            0% {
                background-position: -200% 0;
            }
            100% {
                background-position: 200% 0;
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

        .icon-wrapper {
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #c59d5f, #a07d4a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            color: #000;
            box-shadow: 0 10px 30px rgba(197, 157, 95, 0.4);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .auth-title {
            font-size: 32px;
            font-weight: bold;
            color: #c59d5f;
            letter-spacing: 3px;
            margin-bottom: 10px;
            text-align: center;
        }

        .auth-subtitle {
            font-size: 14px;
            color: #999;
            letter-spacing: 1px;
            text-align: center;
            margin-bottom: 40px;
            font-family: 'Arial', sans-serif;
        }

        .divider {
            width: 60px;
            height: 2px;
            background: #c59d5f;
            margin: 20px auto 40px;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 40px;
        }

        .btn-auth {
            padding: 18px 40px;
            font-size: 16px;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: 2px solid #c59d5f;
            background: transparent;
            color: #c59d5f;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-family: 'Arial', sans-serif;
            position: relative;
            overflow: hidden;
        }

        .btn-auth::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: #c59d5f;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
            z-index: -1;
        }

        .btn-auth:hover::before {
            width: 400px;
            height: 400px;
        }

        .btn-auth:hover {
            color: #000;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(197, 157, 95, 0.4);
        }

        .btn-auth i {
            margin-right: 12px;
            font-size: 18px;
        }

        .btn-primary {
            background: #c59d5f;
            color: #000;
        }

        .btn-primary:hover {
            background: transparent;
            color: #c59d5f;
        }

        .separator {
            width: 100%;
            height: 1px;
            background: rgba(197, 157, 95, 0.2);
            margin: 30px 0;
            position: relative;
        }

        .separator::before {
            content: 'atau';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(26, 26, 26, 0.95);
            padding: 0 15px;
            color: #666;
            font-size: 12px;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
        }

        .back-link {
            text-align: center;
            margin-top: 30px;
        }

        .back-link a {
            color: #999;
            text-decoration: none;
            font-size: 14px;
            letter-spacing: 1px;
            font-family: 'Arial', sans-serif;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-link a:hover {
            color: #c59d5f;
            transform: translateX(-5px);
        }

        .back-link a i {
            transition: transform 0.3s;
        }

        .back-link a:hover i {
            transform: translateX(-3px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .auth-box {
                padding: 40px 30px;
            }

            .auth-title {
                font-size: 28px;
            }

            .icon-wrapper {
                width: 80px;
                height: 80px;
                font-size: 40px;
            }

            .btn-auth {
                padding: 16px 30px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <div class="container">
        <div class="auth-box">
            <!-- Icon -->
            <div class="icon-wrapper">
                <i class="fas fa-user-circle"></i>
            </div>

            <!-- Title -->
            <h2 class="auth-title">CUSTOMER</h2>
            <div class="divider"></div>
            <p class="auth-subtitle">Pilih untuk melanjutkan</p>

            <!-- Buttons -->
            <div class="btn-group">
                <a href="{{ route('login.role', 'customer') }}" class="btn-auth btn-primary">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </a>

                <div class="separator"></div>

                <a href="{{ route('register') }}" class="btn-auth">
                    <i class="fas fa-user-plus"></i>
                    Register
                </a>
            </div>

            <!-- Back Link -->
            <div class="back-link">
                <a href="{{ route('choose.role') }}">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>