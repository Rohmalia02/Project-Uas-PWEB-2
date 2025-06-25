<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;

class Transaksi extends Model
{
    public function riwayat()
{
    $riwayat = Transaksi::with('details')->latest()->get();
    return view('riwayat', compact('riwayat'));
}
    //
}
