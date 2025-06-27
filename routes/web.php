<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProdukController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard'); // ✅ Diberi nama

Route::get('/menu/makanan', fn() => view('menu.makanan'));
Route::get('/menu/minuman', fn() => view('menu.minuman'));

Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/tambah', [CartController::class, 'tambah'])->name('keranjang.tambah');
Route::put('/keranjang/{index}', [CartController::class, 'edit'])->name('keranjang.edit');
Route::delete('/keranjang/{index}', [CartController::class, 'hapus'])->name('keranjang.hapus');

Route::post('/transaksi/kirim', [TransaksiController::class, 'kirim'])->name('transaksi.kirim');

Route::get('/riwayat', [TransaksiController::class, 'riwayat'])->name('riwayat')->middleware('auth');

Route::get('/produk/tambah', [ProdukController::class, 'create'])->name('produk.create')->middleware('auth');
Route::post('/produk/tambah', [ProdukController::class, 'store'])->name('produk.store')->middleware('auth');

Route::get('/akun', [AkunController::class, 'index'])->name('akun');

Route::middleware(['auth'])->group(function () {
    Route::post('/checkout', [TransaksiController::class, 'checkout'])->name('checkout');
});
