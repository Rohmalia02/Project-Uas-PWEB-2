<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Daftar field yang boleh diisi massal
    protected $fillable = [
        'nama',
        'kategori',
        'harga',
        'gambar'
    ];
}
