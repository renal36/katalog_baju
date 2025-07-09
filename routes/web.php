<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AuthController;

/* ========== Landing Page ========== */
Route::view('/', 'home');

/* ========== Katalog Produk (user) ========== */
Route::get('/katalog', [HomeController::class, 'index'])->name('katalog');

/* ========== Produk & Kategori (admin) ========== */
Route::resource('produk',   ProdukController::class);                    // full CRUD
Route::resource('kategori', KategoriController::class)->except(['show','edit']);

/* ========== Pemesanan Langsung (tanpa keranjang) ========== */
Route::get('/pesan/{id}',  [PesananController::class, 'pesan'])->name('pesan');
Route::post('/checkout',   [PesananController::class, 'checkout'])->name('checkout.store');

/* ========== Keranjang Belanja ========== */
Route::prefix('keranjang')->name('keranjang.')->group(function () {
    Route::get('/',                 [KeranjangController::class, 'index'])->name('index');
    Route::get('/tambah/{id}',      [KeranjangController::class, 'tambah'])->name('tambah');
    Route::post('/update/{id}',     [KeranjangController::class, 'update'])->name('update');
    Route::post('/hapus/{id}',      [KeranjangController::class, 'hapus'])->name('hapus');
    Route::get('/checkout',         [KeranjangController::class, 'checkout'])->name('checkout');
    
    // Tambahkan route POST untuk proses checkout keranjang
    Route::post('/checkout',        [KeranjangController::class, 'checkout'])->name('checkout.post');
});

/* ========== Riwayat Pesanan ========== */
Route::get('/riwayat-pesanan', [PesananController::class, 'riwayatUser'])->name('riwayat.pesanan'); // USER
Route::get('/orders',          [PesananController::class, 'riwayat'])->name('orders.index');        // ADMIN

/* --------- Admin: edit & update pesanan --------- */
Route::get('/orders/{order}/edit', [PesananController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{order}',      [PesananController::class, 'update'])->name('orders.update');

Route::get('/login',  [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// routes/web.php
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/developer', function () {
    return view('developer');
});
