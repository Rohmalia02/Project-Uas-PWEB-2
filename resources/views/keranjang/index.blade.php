@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-3">Keranjang Pembelian</h4>

    {{-- Notifikasi berhasil --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Ambil data dari session --}}
    @php $cart = session('cart', []); @endphp

    @if(!empty($cart) && count($cart) > 0)
        <table class="table">
            <thead class="table-success">
                <tr>
                    <th>Nama</th>
                    <th>Harga Satuan</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach($cart as $index => $item)
                    @php
                        $total = $item['harga'] * $item['qty'];
                        $grandTotal += $total;
                    @endphp
                    <tr>
                        <td>{{ $item['nama'] }}</td>
                        <td>Rp{{ number_format($item['harga'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('keranjang.edit', $index) }}" method="POST" class="d-flex">
                                @csrf
                                @method('PUT')
                                <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" class="form-control me-2" style="width: 80px;">
                                <button type="submit" class="btn btn-sm btn-warning">Update</button>
                            </form>
                        </td>
                        <td>Rp{{ number_format($total, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('keranjang.hapus', $index) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr class="fw-bold">
                    <td colspan="3">Grand Total</td>
                    <td colspan="2">Rp{{ number_format($grandTotal, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Tombol Kirim Pesanan -->
        <div class="text-end mt-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bayarModal">Kirim Pesanan</button>
        </div>

        <!-- Modal Pembayaran -->
        <div class="modal fade" id="bayarModal" tabindex="-1" aria-labelledby="bayarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="bayarModalLabel">Pilih Metode Pembayaran</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Total yang harus dibayar: <strong>Rp{{ number_format($grandTotal, 0, ',', '.') }}</strong></p>
                       <form action="{{ route('transaksi.kirim') }}" method="POST">
    @csrf {{-- Token CSRF WAJIB --}}
    <div class="mb-3">
        <label for="metode" class="form-label">Metode Pembayaran</label>
        <select name="metode" id="metode" class="form-select" required>
            <option value="">-- Pilih Metode --</option>
            <option value="cash">Bayar Langsung</option>
            <option value="qris">Bayar dengan QRIS</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success w-100">Konfirmasi Pembayaran</button>
</form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning">Keranjang kamu masih kosong.</div>
    @endif

    <!-- Tambah Menu -->
    <h5 class="mt-4 mb-3">Tambah Menu Lain</h5>
    <form action="{{ route('keranjang.tambah') }}" method="POST" class="row g-2">
        @csrf
        <div class="col-md-6">
            <select name="menu_nama" id="menuSelect" class="form-select" required onchange="updateHargaDanId()">
                <option value="">-- Pilih Menu --</option>
                <option value="UDANG KEJU" data-id="1" data-harga="9091">UDANG KEJU</option>
                <option value="AIR MINERAL" data-id="2" data-harga="4546">AIR MINERAL</option>
                <option value="MIE GACOAN LEVEL 2" data-id="3" data-harga="10000">MIE GACOAN LEVEL 2</option>
                <option value="NASI GORENG" data-id="4" data-harga="12000">NASI GORENG</option>
                <option value="ES TEH MANIS" data-id="5" data-harga="5000">ES TEH MANIS</option>
                <option value="AYAM GEPREK" data-id="6" data-harga="13500">AYAM GEPREK</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="qty" class="form-control" placeholder="Qty" value="1" min="1" required>
        </div>
        <div class="col-md-2">
            <input type="number" name="menu_harga" id="hargaInput" class="form-control" placeholder="Harga" readonly required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">Tambah</button>
        </div>
        <!-- Input hidden menu_id -->
        <input type="hidden" name="menu_id" id="menuIdInput" required>
    </form>

    <a href="{{ route('dashboard') }}" class="btn btn-outline-success mt-4">&larr; Kembali ke Dashboard</a>
</div>

<script>
    function updateHargaDanId() {
        const select = document.getElementById('menuSelect');
        const selected = select.options[select.selectedIndex];
        const harga = selected.getAttribute('data-harga');
        const id = selected.getAttribute('data-id');

        document.getElementById('hargaInput').value = harga || '';
        document.getElementById('menuIdInput').value = id || '';
    }
</script>
@endsection
