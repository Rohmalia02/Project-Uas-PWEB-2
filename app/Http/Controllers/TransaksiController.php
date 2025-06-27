<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function kirim(Request $request)
{
    $request->validate([
        'metode' => 'required|in:cash,qris',
    ]);

    $cart = session()->get('cart', []);
    if (empty($cart)) {
        return redirect()->route('keranjang.index')->with('error', 'Keranjang kosong.');
    }

    $total = collect($cart)->sum(fn($item) => $item['harga'] * $item['qty']);

    $transaksi = Transaksi::create([
        'user_id' => Auth::id(),
        'metode' => $request->metode,
        'total' => $total
    ]);

    foreach ($cart as $item) {
        TransaksiDetail::create([
            'transaksi_id' => $transaksi->id,
            'menu_id' => $item['menu_id'], // ✅ gunakan data dari cart
            'qty' => $item['qty'],
            'harga' => $item['harga'],
        ]);
    }

    session()->forget('cart');

    return redirect()->route('riwayat')->with('success', 'Pesanan berhasil dikirim.');
}
}