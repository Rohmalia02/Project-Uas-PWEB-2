<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['nama', 'kategori', 'harga', 'gambar'];

    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
