<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('keranjang.index', compact('cart'));
    }

    public function tambah(Request $request)
    {
        $item = [
            'nama' => $request->nama,
            'harga' => $request->harga,
            'qty' => $request->qty,
        ];
        $cart = session()->get('cart', []);
        $cart[] = $item;
        session(['cart' => $cart]);

        return redirect('/keranjang')->with('success', 'Item ditambahkan ke keranjang!');
    }
    public function edit(Request $request, $index)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$index])) {
        $cart[$index]['qty'] = $request->qty;
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Jumlah pesanan diperbarui.');
    }

    return redirect()->back()->with('error', 'Item tidak ditemukan.');
}

public function hapus($index)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$index])) {
        unset($cart[$index]);
        session()->put('cart', array_values($cart)); // Reset index array
        return redirect()->back()->with('success', 'Item berhasil dihapus.');
    }

    return redirect()->back()->with('error', 'Item tidak ditemukan.');
}
}