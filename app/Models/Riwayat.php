<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Riwayat extends Model
{
    protected $fillable = ['user_id', 'nama_menu', 'harga', 'qty', 'total', 'metode'];
}

