<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // ambil data user yang sedang login
        return view('akun.index', compact('user'));
    }
}