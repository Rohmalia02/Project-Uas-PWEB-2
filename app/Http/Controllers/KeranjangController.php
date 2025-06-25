<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    // Tampilkan isi keranjang
    public function index()
    {
        $cart = Keranjang::where('user_id', Auth::id())->get();
        return view('keranjang.index', compact('cart'));
    }

    // Tambah item ke keranjang
    public function tambah(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|numeric',
            'qty' => 'required|integer|min:1',
        ]);

        // Simpan ke database
        Keranjang::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'harga' => $request->harga,
            'qty' => $request->qty,
        ]);

        return redirect()->back()->with('success', 'Item berhasil ditambahkan ke keranjang.');
    }

    // Update jumlah item di keranjang
    public function edit(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $item = Keranjang::where('id', $id)->where('user_id', Auth::id())->first();
        if ($item) {
            $item->update(['qty' => $request->qty]);
            return redirect()->back()->with('success', 'Jumlah berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Item tidak ditemukan.');
    }

    // Hapus item dari keranjang
    public function hapus($id)
    {
        $item = Keranjang::where('id', $id)->where('user_id', Auth::id())->first();
        if ($item) {
            $item->delete();
            return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
        }

        return redirect()->back()->with('error', 'Item tidak ditemukan.');
    }
}
