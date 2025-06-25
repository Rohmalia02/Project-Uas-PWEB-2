@extends('layouts.app')

@section('title', 'Minuman')

@section('content')

<!-- Banner dengan Teks Selamat Datang -->
<div class="position-relative">
    <img src="{{ asset('img/HIMA.jpg') }}" class="img-fluid w-100" alt="Banner Kantin" style="height: 300px; object-fit: cover;">

    <div class="position-absolute top-50 start-50 translate-middle text-center text-white px-3">
        <h3 class="fw-bold shadow-text">Kantin HIMA-SI!</h3>
        <p class="mb-0 shadow-text">Periode 2025<br>Silakan pilih minumanmu!</p>
    </div>
</div>

<!-- Daftar Minuman -->
<div class="container mt-4">
    <div class="row g-3">
        @php
            $minuman = [
                ['img' => 'teh-kotak.jpg', 'nama' => 'Teh Kotak', 'harga' => 'Rp8.000'],
                ['img' => 'air-mineral.png', 'nama' => 'Air Mineral', 'harga' => 'Rp5.000'],
                ['img' => 'nutrisari.jpg', 'nama' => 'Nutrisari', 'harga' => 'Rp6.000'],
                ['img' => 'susu-ultra.jpg', 'nama' => 'Susu Ultra', 'harga' => 'Rp7.000'],
                ['img' => 'kopi-susu.jpg', 'nama' => 'Kopi Susu', 'harga' => 'Rp10.000'],
            ];
        @endphp

        @foreach($minuman as $menu)
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card menu-card h-100">
                <img src="{{ asset('img/makanan/' . $menu['img']) }}" class="card-img-top" alt="{{ $menu['nama'] }}" style="height:160px; object-fit:cover;">
                <div class="card-body text-center">
                    <h6 class="card-title">{{ $menu['nama'] }}</h6>
                    <p class="text-muted mb-0">{{ $menu['harga'] }}</p>
                </div>
                <form action="{{ route('keranjang.tambah') }}" method="POST" class="p-2">
                    @csrf
                    <input type="hidden" name="nama" value="{{ $menu['nama'] }}">
                    <input type="hidden" name="harga" value="{{ str_replace(['Rp', '.'], '', $menu['harga']) }}">
                    <input type="number" name="qty" value="1" min="1" class="form-control mb-2">
                    <button type="submit" class="btn btn-success w-100">+ Keranjang</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection