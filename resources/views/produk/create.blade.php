@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container">
    <h4 class="mb-4">Tambah Produk Baru</h4>

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Produk</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required min="0">
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Upload Gambar (opsional)</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan Produk</button>
    </form>
</div>
@endsection
<div>
    <!-- An unexamined life is not worth living. - Socrates -->
</div>
