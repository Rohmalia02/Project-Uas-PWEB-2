<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // Simpan transaksi
    public function kirim(Request $request)
    {
        $request->validate([
            'metode' => 'required|in:cash,qris,tunai',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang kosong.');
        }

        $total = collect($cart)->sum(function ($item) {
            return $item['harga'] * $item['qty'];
        });

        // Simpan ke tabel transaksi
        $transaksi = Transaksi::create([
            'user_id' => Auth::id(),
            'metode' => $request->metode,
            'total' => $total
        ]);

        // Simpan detail transaksi
        foreach ($cart as $item) {
            $menu = Menu::find($item['menu_id']); // Validasi menu

            if (!$menu) {
                continue; // Skip item yang tidak valid
            }

            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'menu_id' => $menu->id,
                'qty' => $item['qty'],
                'harga' => $menu->harga,
            ]);
        }

        session()->forget('cart');

        return redirect()->route('riwayat')->with('success', 'Pesanan berhasil dikirim.');
    }

    // Tampilkan riwayat
    public function riwayat()
    {
        $transaksis = Transaksi::with('details.menu')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('transaksi.riwayat', compact('transaksis'));
    }
}
