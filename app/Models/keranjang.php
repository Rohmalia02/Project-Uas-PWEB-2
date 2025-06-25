<?php
// app/Models/Keranjang.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjangs'; // <- kasih nama tabel yang sesuai di database
    protected $fillable = ['user_id', 'nama', 'harga', 'qty'];
}


