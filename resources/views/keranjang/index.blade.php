@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-3">Keranjang Pembelian</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
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
    @else
        <div class="alert alert-warning">Keranjang kamu masih kosong.</div>
    @endif

    <!-- Tambah Menu Lain -->
    <h5 class="mt-4 mb-3">Tambah Menu Lain</h5>
    <form action="{{ route('keranjang.tambah') }}" method="POST">
    @csrf
        <div class="col-md-6">
            <select name="nama" id="menuSelect" class="form-select" required onchange="updateHarga()">
                <option value="">-- Pilih Menu --</option>
                <option value="UDANG KEJU">UDANG KEJU</option>
                <option value="AIR MINERAL">AIR MINERAL</option>
                <option value="MIE GACOAN LEVEL 2">MIE GACOAN LEVEL 2</option>
                <option value="NASI GORENG">NASI GORENG</option>
                <option value="ES TEH MANIS">ES TEH MANIS</option>
                <option value="AYAM GEPREK">AYAM GEPREK</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="qty" class="form-control" placeholder="Qty" value="1" min="1" required>
        </div>
        <div class="col-md-2">
            <input type="number" name="harga" id="hargaInput" class="form-control" placeholder="Harga" readonly required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">Tambah</button>
        </div>
    </form>
</div>

<script>
    function updateHarga() {
        const menuHarga = {
            "UDANG KEJU": 9091,
            "AIR MINERAL": 4546,
            "MIE GACOAN LEVEL 2": 10000,
            "NASI GORENG": 12000,
            "ES TEH MANIS": 5000,
            "AYAM GEPREK": 13500
        };

        const menuSelect = document.getElementById('menuSelect');
        const hargaInput = document.getElementById('hargaInput');
        const selectedMenu = menuSelect.value;

        hargaInput.value = menuHarga[selectedMenu] || '';
    }
</script>

@if(count($cart) > 0)
    <!-- Tombol Kirim Pesanan -->
    <div class="text-end mt-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bayarModal">
            Kirim Pesanan
        </button>
        <!-- Modal -->
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
            @csrf
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
    </div>
@endif

<!-- Tambahkan data lain jika perlu -->
        <a href="/dashboard" class="btn btn-outline-success mt-3">
    &larr; Kembali ke Dashboard
</a>

@endsection