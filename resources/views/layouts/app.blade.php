<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ✅ Tambahkan ini untuk token CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Kantin HIMA-SI')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: rgba(255, 255, 255, 0.95);
            font-family: 'Poppins', sans-serif;
        }

        footer {
            background-color: rgb(235, 77, 85);
            color: white;
            padding: 1rem;
            text-align: center;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .category-tab {
            display: flex;
            overflow-x: auto;
            border-bottom: 2px solid #eee;
        }

        .category-tab .nav-link {
            white-space: nowrap;
            padding: 0.75rem 1rem;
        }

        .menu-card img {
            height: 120px;
            object-fit: cover;
        }

        .menu-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .welcome-text {
            background: #d1e7dd;
            padding: 1rem;
            border-radius: 10px;
            margin-top: 20px;
        }

        .shadow-text {
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.8);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger px-4">
        <a class="navbar-brand d-flex align-items-center" href="/dashboard">
            <img src="{{ asset('img/official_logo_si-kyute-removebg-preview.png') }}" alt="Logo" style="height: 40px; width: 40px;" class="me-2">
            Kantin HIMA-SI
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/dashboard">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="/keranjang">Keranjang</a></li>
                <li class="nav-item"><a class="nav-link" href="/riwayat">Riwayat Pemesanan</a></li>
                <li class="nav-item"><a class="nav-link" href="/produk/tambah">Tambah Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="/akun">Akun</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-link nav-link text-white" style="text-decoration: none;">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Konten -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} Kantin HIMA-SI. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>