<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

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
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->only(['nama', 'kategori', 'harga']);

    // Handle upload gambar jika ada
    if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar')->store('produk', 'public');
        $data['gambar'] = $gambar;
    }

    Menu::create($data); // ⛳️ Model harus sesuai dengan database produk/menu

    return redirect()->route('dashboard')->with('success', 'Produk berhasil ditambahkan!');
}
}