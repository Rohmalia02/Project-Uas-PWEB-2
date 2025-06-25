<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\KeranjangController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/menu/makanan', fn() => view('menu.makanan'));
Route::get('/menu/minuman', fn() => view('menu.minuman'));

Route::get('/keranjang', [CartController::class, 'index']);
Route::post('/keranjang/tambah', [CartController::class, 'tambah'])->name('keranjang.tambah');
Route::put('/keranjang/edit/{index}', [CartController::class, 'edit'])->name('keranjang.edit');
Route::delete('/keranjang/hapus/{index}', [CartController::class, 'hapus'])->name('keranjang.hapus');
Route::post('/transaksi/kirim', [TransaksiController::class, 'kirim'])->name('transaksi.kirim');

Route::get('/riwayat', [TransaksiController::class, 'riwayat'])->name('riwayat');
Route::get('/riwayat', [TransaksiController::class, 'riwayat'])->name('riwayat')->middleware('auth');
Route::post('/transaksi/kirim', [TransaksiController::class, 'kirim'])->name('transaksi.kirim');

Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::put('/keranjang/edit/{id}', [KeranjangController::class, 'edit'])->name('keranjang.edit');
    Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
});


Route::get('/akun', [AkunController::class, 'index'])->name('akun');