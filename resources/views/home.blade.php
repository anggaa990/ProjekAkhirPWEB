<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant App</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">RestaurantApp</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                
                <ul class="navbar-nav ms-auto">

                    <!-- Login Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                            Login
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">

                            <li><a class="dropdown-item" href="/login/admin">Login sebagai Admin</a></li>
                            <li><a class="dropdown-item" href="/login/employee">Login sebagai Karyawan</a></li>
                            <li><a class="dropdown-item" href="/login/customer">Login sebagai Customer</a></li>

                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>



    <!-- HERO / LANDING SECTION -->
    <section class="py-5 text-center">
        <div class="container">
            <h1 class="fw-bold display-5 mb-3">Selamat Datang di Sistem Reservasi Restoran</h1>
            <p class="lead text-muted mb-4">
                Pesan meja, pilih menu favorit kamu, dan nikmati pengalaman makan terbaik.
            </p>

            <a href="#features" class="btn btn-primary btn-lg px-4">Lihat Fitur</a>
            <a href="/menu" class="btn btn-outline-dark btn-lg px-4 ms-2">Lihat Menu</a>
        </div>
    </section>



    <!-- FITUR -->
    <section id="features" class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">Fitur Utama</h2>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <h5 class="fw-bold">Reservasi Meja</h5>
                            <p class="text-muted">Customer dapat memilih tanggal, waktu, dan jumlah orang.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <h5 class="fw-bold">Pesan Menu</h5>
                            <p class="text-muted">Pilih makanan & minuman langsung saat melakukan reservasi.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <h5 class="fw-bold">Manajemen Restaurant</h5>
                            <p class="text-muted">Admin & karyawan mengelola menu, meja, pesanan, dan laporan.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
