<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $fillable = ['transaksi_id', 'menu_id', 'qty', 'harga'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
