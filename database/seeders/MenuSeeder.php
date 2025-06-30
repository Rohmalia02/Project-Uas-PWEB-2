<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            ['nama' => 'Mie lidi Matcha', 'harga' => 10000],
            ['nama' => 'Mie lidi Coklat', 'harga' => 10000],
            ['nama' => 'Mie lidi Pedas', 'harga' => 10000],
            ['nama' => 'Pangsit Pedas', 'harga' => 10000],
            ['nama' => 'Makroni Pedas', 'harga' => 10000],
            ['nama' => 'Makaroni Asin', 'harga' => 10000],
            ['nama' => 'Pilus', 'harga' => 1000],
            ['nama' => 'Beng-Beng', 'harga' => 2000],
            ['nama' => 'Sosis', 'harga' => 1000],
            ['nama' => 'Permen', 'harga' => 1500],
            ['nama' => 'Teh Kotak', 'harga' => 5000],
            ['nama' => 'Air Mineral', 'harga' => 3500],
            ['nama' => 'Susu', 'harga' => 5000],
            ['nama' => 'Nutrisari', 'harga' => 3500],
        ]);
        //
    }
}
