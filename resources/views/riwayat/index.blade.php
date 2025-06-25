@extends('layouts.app')

@section('title', 'Riwayat Pemesanan')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4 text-center text-danger">📝 Riwayat Pemesanan</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($riwayats->count())
    <table class="table table-bordered">
        <thead class="table-danger text-center">
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Metode</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riwayats as $index => $item)
            <tr class="text-center align-middle">
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_menu }}</td>
                <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                <td>{{ strtoupper($item->metode) }}</td>
                <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info text-center">Belum ada riwayat pemesanan.</div>
    @endif
</div>
@endsection
