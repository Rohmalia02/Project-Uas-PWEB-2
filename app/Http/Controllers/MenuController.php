<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    protected $fillable = ['name', 'price'];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
    //
    public function dashboard()
{
    $menus = Menu::all(); // Ambil dari database
    return view('dashboard', compact('menus'));
}
}
