<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
