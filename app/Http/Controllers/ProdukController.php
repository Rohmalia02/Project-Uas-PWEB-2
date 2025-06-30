<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'kategori' => 'required|in:makanan,minuman',
        'harga' => 'required|numeric|min:0',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
    ]);

    $gambarPath = null;
    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('produk', 'public');
    }

    Produk::create([
        'nama' => $request->nama,
        'kategori' => $request->kategori,
        'harga' => $request->harga,
        'gambar' => $gambarPath,
    ]);

    return redirect()->route('dashboard')->with('success', 'Produk berhasil ditambahkan!');
}
 public function index()
    {
        $model = new ProdukModel();
        $data['produk'] = $model->findAll();

        return view('produk/index', $data);
    }
}