@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- Banner -->
<div class="position-relative">
    <img src="{{ asset('img/HIMA.jpg') }}" class="img-fluid w-100" alt="Banner Kantin" style="height: 300px; object-fit: cover;">
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white px-3">
        <h3 class="fw-bold shadow-text">Kantin HIMA-SI!</h3>
        <p class="mb-0 shadow-text">Periode 2025<br>Silakan pilih kategori di bawah ini.</p>
    </div>
</div>

@php
    $userName = 'Pengguna';
    if (isset($user)) {
        if (is_object($user)) {
            $userName = $user->nama ?? 'Pengguna';
        } elseif (is_array($user)) {
            $userName = $user['nama'] ?? 'Pengguna';
        }
    }
@endphp

<!-- Kategori Menu -->
<div class="container mt-4">
    <h4 class="text-center mb-4">Pilih Kategori Menu</h4>
    <div class="row justify-content-center">
        @php
            $categories = [
                ['label' => '🍛 Makanan', 'url' => 'menu/makanan', 'color' => '#e74c3c'],
                ['label' => '🍵 Minuman', 'url' => 'menu/minuman', 'color' => '#3498db'],
            ];
        @endphp

        @foreach ($categories as $cat)
            <div class="col-6 col-md-4 col-lg-3 mb-3">
                <a href="{{ url($cat['url']) }}" class="text-decoration-none">
                    <div class="card text-center shadow-sm {{ Request::is($cat['url']) ? 'border-danger' : '' }}">
                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color: {{ $cat['color'] }}">{{ $cat['label'] }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<!-- Menu Spesial -->
<div class="container mt-5">
    <h5 class="mb-3">Menu Spesial</h5>
    <div class="row g-3">
        @php
            $menus = [
                ['img' => 'mie-lidi-manis.webp', 'nama' => 'Mie lidi Matcha', 'harga' => 9091],
                ['img' => 'mie-lidi-manis.webp', 'nama' => 'Mie lidi Coklat', 'harga' => 9091],
                ['img' => 'mie-lidi-pedas.webp', 'nama' => 'Mie lidi Pedas', 'harga' => 9091],
                ['img' => 'pangsit-pedas.webp', 'nama' => 'Pangsit Pedas', 'harga' => 4546],
                ['img' => 'makroni-pedas.webp', 'nama' => 'Makroni Pedas', 'harga' => 10000],
                ['img' => 'makaroni-a.jpg', 'nama' => 'Makaroni Asin', 'harga' => 12000],
                ['img' => 'makaroni-p.jpg', 'nama' => 'Makaroni Pedas', 'harga' => 5000],
                ['img' => 'bengbeng.jpg', 'nama' => 'Beng-Beng', 'harga' => 13500],
                ['img' => 'sosis.jpg', 'nama' => 'Sosis', 'harga' => 13500],
                ['img' => 'permen.jpg', 'nama' => 'Permen', 'harga' => 13500],
                ['img' => 'teh-kotak.jpg', 'nama' => 'Teh Kotak', 'harga' => 13500],
                ['img' => 'air-mineral.png', 'nama' => 'Air Mineral', 'harga' => 13500],
            ];
        @endphp

        @foreach($menus as $menu)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('img/' . $menu['img']) }}" class="card-img-top" alt="{{ $menu['nama'] }}" style="height: 150px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h6 class="fw-bold">{{ $menu['nama'] }}</h6>
                        <p class="mb-1">Harga: Rp{{ number_format($menu['harga'], 0, ',', '.') }}</p>
<form action="{{ route('keranjang.tambah') }}" method="POST">
    @csrf
    <input type="hidden" name="menu_nama" value="{{ $menu['nama'] }}">
    <input type="hidden" name="menu_harga" value="{{ $menu['harga'] }}">
    <input type="hidden" name="qty" value="1">
    <input type="hidden" name="menu_id" value="{{ $loop->iteration }}"> {{-- opsional --}}
    <button type="submit" class="btn btn-sm btn-success">Tambah ke Keranjang</button>
</form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection