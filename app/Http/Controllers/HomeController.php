<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Order; // <-- tambahkan model Order

class HomeController extends Controller
{
    /**
     * Tampilkan daftar produk + filter, serta status pesanan terakhir (jika ada di session).
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // ===== 1. Query Produk  =====
        $query = Produk::with('kategori');

        if ($request->filled('cari')) {
            $query->where('nama_produk', 'like', '%' . $request->cari . '%');
        }

        if ($request->filled('kategori')) {
            $kategori = strtolower($request->kategori);
            $query->whereHas('kategori', function ($q) use ($kategori) {
                $q->whereRaw('LOWER(nama_kategori) = ?', [$kategori]);
            });
        }

        $produk = $query->latest()->get();

        // ===== 2. Ambil Pesanan Terakhir dari Session =====
        $pesananTerakhir = null;
        if (session()->has('last_order_id')) {
            $pesananTerakhir = Order::with('items')
                                ->find(session('last_order_id'));
        }

        // ===== 3. Kirim ke View =====
        return view('katalog', compact('produk', 'pesananTerakhir'));
    }
}