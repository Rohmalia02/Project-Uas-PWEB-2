<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index() {
    $produkDariDatabase = Produk::all(); // Ambil semua data dari tabel produks
    return view('dashboard', compact('produkDariDatabase'));
}
}