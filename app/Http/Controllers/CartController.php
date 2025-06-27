<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('keranjang.index');
    }

    public function tambah(Request $request)
{
    $request->validate([
        'menu_id' => 'required|numeric',
        'menu_nama' => 'required|string',
        'menu_harga' => 'required|numeric',
        'qty' => 'required|numeric|min:1',
    ]);

    $cart = session()->get('cart', []);
    $cart[] = [
        'menu_id' => $request->menu_id,
        'nama' => $request->menu_nama,
        'harga' => $request->menu_harga,
        'qty' => $request->qty,
    ];

    session()->put('cart', $cart);

    return redirect()->route('keranjang.index')->with('success', 'Item berhasil ditambahkan.');
}

    public function edit(Request $request, $index)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1',
        ]);

        $cart = session()->get('cart', []);
        if (isset($cart[$index])) {
            $cart[$index]['qty'] = $request->qty;
            session()->put('cart', $cart);
        }

        return redirect()->route('keranjang.index')->with('success', 'Jumlah berhasil diperbarui.');
    }

    public function hapus($index)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$index])) {
            unset($cart[$index]);
            session()->put('cart', array_values($cart));
        }

        return redirect()->route('keranjang.index')->with('success', 'Item dihapus dari keranjang.');
    }
}
