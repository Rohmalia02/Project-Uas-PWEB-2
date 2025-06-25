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
                ['img' => 'mie-lidi-manis.webp', 'nama' => 'Mie Lidi Matcha', 'harga' => 'Rp9.091'],
                ['img' => 'mie-lidi-manis.webp', 'nama' => 'Mie Lidi Coklat', 'harga' => 'Rp9.091'],
                ['img' => 'mie-lidi-pedas.webp', 'nama' => 'Mie Lidi Pedas', 'harga' => 'Rp9.091'],
                ['img' => 'pangsit-pedas.webp', 'nama' => 'Pangsit Pedas', 'harga' => 'Rp4.546'],
                ['img' => 'makaroni-pedas.webp', 'nama' => 'Makroni Pedas', 'harga' => 'Rp10.000'],
                ['img' => 'makaroni-a.jpg', 'nama' => 'Makaroni Asin', 'harga' => 'Rp12.000'],
                ['img' => 'makaroni-p.jpg', 'nama' => 'Makaroni Pedas', 'harga' => 'Rp5.000'],
                ['img' => 'sosis.jpg', 'nama' => 'Sosis', 'harga' => 'Rp13.500'],
                ['img' => 'bengbeng.jpg', 'nama' => 'Beng-Beng', 'harga' => 'Rp13.500'],
                ['img' => 'permen.jpg', 'nama' => 'Permen', 'harga' => 'Rp13.500'],
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