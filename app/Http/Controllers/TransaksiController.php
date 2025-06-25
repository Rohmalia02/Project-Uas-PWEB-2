<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Keranjang;
use App\Models\Riwayat;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function riwayat()
    {
        $riwayat = Riwayat::where('user_id', auth()->id())->latest()->get();
        return view('riwayat.index', compact('riwayat'));
    }

    public function kirim(Request $request)
    {
        $request->validate([
            'metode' => 'required'
        ]);

        $keranjangs = Keranjang::where('user_id', Auth::id())->get();

        if ($keranjangs->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        foreach ($keranjang as $item) {
            Riwayat::create([
                'user_id' => Auth::id(),
                'nama_menu' => $item->nama,
                'harga' => $item->harga,
                'qty' => $item->qty,
                'total' => $item->harga * $item->qty,
                'metode' => $request->metode
            ]);
        }

        Keranjang::where('user_id', Auth::id())->delete();

        return redirect()->route('riwayat')->with('success', 'Pembayaran berhasil dan riwayat telah disimpan.');
    }
}