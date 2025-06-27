@extends('layouts.app')

@section('title', 'Riwayat Pemesanan')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4 text-center text-danger">📝 Riwayat Pemesanan</h3>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Cek jika ada data riwayat --}}
    @if($riwayats->count())
        @foreach($riwayats as $transaksi)
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    Pesanan #{{ $transaksi->id }} - Metode: {{ strtoupper($transaksi->metode) }} - 
                    Tanggal: {{ $transaksi->created_at->format('d-m-Y H:i') }}
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered m-0">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksi->details as $index => $item)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->menu->nama ?? 'Menu dihapus' }}</td>
                                    <td>Rp{{ number_format($item->menu->harga ?? $item->harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>Rp{{ number_format(($item->menu->harga ?? $item->harga) * $item->qty, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Pesanan ini tidak memiliki item.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-info text-center">Belum ada riwayat pemesanan.</div>
    @endif
</div>
@endsection
