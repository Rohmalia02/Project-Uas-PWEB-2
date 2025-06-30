@extends('layouts.app')

@section('title', 'Makanan')

@section('content')

<!-- Banner dengan Teks Selamat Datang -->
<div class="position-relative">
    <img src="{{ asset('img/HIMA.jpg') }}" class="img-fluid w-100" alt="Banner Kantin" style="height: 300px; object-fit: cover;">

    <div class="position-absolute top-50 start-50 translate-middle text-center text-white px-3">
        <h3 class="fw-bold shadow-text">Kantin HIMA-SI!</h3>
        <p class="mb-0 shadow-text">Periode 2025<br>Silakan pilih makananmu!</p>
    </div>
</div>

<!-- Daftar Menu Makanan -->
<div class="container mt-4">
    <div class="row g-3">
        @php
            $makanan = [
                ['img' => 'mie-lidi-manis.webp', 'nama' => 'Mie lidi Matcha', 'harga' => 10000],
                ['img' => 'mie-lidi-manis.webp', 'nama' => 'Mie lidi Coklat', 'harga' => 10000],
                ['img' => 'mie-lidi-pedas.webp', 'nama' => 'Mie lidi Pedas', 'harga' => 10000],
                ['img' => 'pangsit-pedas.webp', 'nama' => 'Pangsit Pedas', 'harga' => 10000],
                ['img' => 'makroni_pedas.jpg', 'nama' => 'Makroni Pedas', 'harga' => 10000],
                ['img' => 'makroni-asin.jpg', 'nama' => 'Makaroni Asin', 'harga' => 10000],
                ['img' => 'pilus.jpg', 'nama' => 'Pilus', 'harga' => 1000],
                ['img' => 'bengbeng.jpg', 'nama' => 'Beng-Beng', 'harga' => 2000],
                ['img' => 'sosis.jpg', 'nama' => 'Sosis', 'harga' => 1000],
                ['img' => 'permen.jpg', 'nama' => 'Permen', 'harga' => 1500],
                 ['img' => 'Ciki.jpg', 'nama' => 'Ciki Random', 'harga' => 2000],
            ];
        @endphp

        @foreach ($makanan as $menu)
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card h-100">
                <img src="{{ asset('img/' . $menu['img']) }}" class="card-img-top" alt="{{ $menu['nama'] }}" style="height: 160px; object-fit: cover;">
                <div class="card-body text-center">
                    <h6 class="card-title">{{ $menu['nama'] }}</h6>
                    <p class="text-muted mb-0">{{ $menu['harga'] }}</p>
                </div>
                <form action="{{ route('keranjang.tambah') }}" method="POST">
                    @csrf
                    <input type="hidden" name="nama" value="{{ $menu['nama'] }}">
                    <input type="hidden" name="harga" value="{{ str_replace(['Rp', '.'], '', $menu['harga']) }}">
                    <input type="number" name="qty" value="1" min="1" class="form-control my-2">
                    <button type="submit" class="btn btn-success w-100">+ Keranjang</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection