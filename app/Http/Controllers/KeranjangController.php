<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produks;    // Model produk
use App\Models\Order;      // Model order
use App\Models\OrderItem;  // Model item order (detail pesanan)

class KeranjangController extends Controller
{
    /* ───────────── KERANJANG ───────────── */

    /**
     * Menampilkan halaman keranjang belanja,
     * mengambil data keranjang dari session.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data cart dari session, jika tidak ada inisialisasi dengan array kosong
        $cart = session('cart', []);

        // Tampilkan view keranjang dan kirim data cart
        return view('keranjang.index', compact('cart'));
    }

    /**
     * Menambahkan produk ke keranjang berdasarkan ID produk.
     * Jika produk sudah ada di keranjang, jumlah (qty) ditambah 1.
     * 
     * @param int $id - ID produk yang akan ditambahkan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tambah($id)
    {
        // Cari produk berdasarkan id, jika tidak ada maka 404
        $produk = Produks::findOrFail($id);

        // Ambil cart dari session, default array kosong
        $cart = session('cart', []);

        // Simpan produk ke cart dengan struktur:
        // key: id produk
        // value: array ['nama', 'harga', 'qty']
        $cart[$id]['nama']  = $produk->nama_produk;
        $cart[$id]['harga'] = $produk->harga;
        $cart[$id]['qty']   = ($cart[$id]['qty'] ?? 0) + 1; // jika sudah ada tambah 1, jika belum 1

        // Simpan kembali cart ke session
        session(['cart' => $cart]);

        // Redirect ke halaman keranjang dengan pesan sukses
        return redirect()->route('keranjang.index')
                         ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Update jumlah produk dalam keranjang,
     * bisa untuk menambah atau mengurangi qty produk.
     * Jika qty kurang dari 1 maka produk dihapus dari keranjang.
     * 
     * @param Request $r - request berisi tipe update ('inc' atau 'dec')
     * @param int $id - ID produk yang akan diupdate qty-nya
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $r, $id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            // Tambah atau kurang qty berdasarkan tipe 'inc' atau lainnya
            $cart[$id]['qty'] += $r->type === 'inc' ? 1 : -1;

            // Jika qty kurang dari 1, hapus produk dari keranjang
            if ($cart[$id]['qty'] < 1) {
                unset($cart[$id]);
            }

            // Simpan kembali cart ke session
            session(['cart' => $cart]);
        }

        // Kembali ke halaman sebelumnya
        return back();
    }

    /**
     * Menghapus produk dari keranjang berdasarkan ID produk.
     * 
     * @param int $id - ID produk yang akan dihapus
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hapus($id)
    {
        $cart = session('cart', []);

        // Hapus produk dengan key ID dari cart
        unset($cart[$id]);

        // Simpan kembali cart ke session
        session(['cart' => $cart]);

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    /* ───────────── CHECKOUT ───────────── */

    /**
     * Proses checkout untuk menyimpan order dan order items ke database,
     * serta mengosongkan keranjang session.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function checkout(Request $request)
    {
        // Ambil cart dari session
        $cart = session('cart', []);

        // Jika keranjang kosong, redirect ke katalog dengan pesan error
        if (empty($cart)) {
            return redirect()->route('katalog')->with('error', 'Keranjang masih kosong!');
        }

        // Hitung total harga seluruh produk di keranjang
        $total = collect($cart)->sum(fn($i) => $i['harga'] * $i['qty']);

        /* ========= SIMPAN ORDER ========= */
        $order = Order::create([
            'nama_pemesan' => 'Guest',          // bisa diganti dengan data user/form input
            'telepon'      => '-',              // placeholder, bisa diisi dari form
            'alamat'       => '-',              // placeholder, bisa diisi dari form
            'total_harga'  => $total,
            'status'       => 'diproses',      // status awal order
        ]);

        /* ========= SIMPAN ORDER ITEM ========= */
        foreach ($cart as $produkId => $i) {
            OrderItem::create([
                'order_id'     => $order->id,
                'produk_id'    => $produkId,
                'nama_produk'  => $i['nama'],
                'harga_satuan' => $i['harga'],
                'jumlah'       => $i['qty'],
                'subtotal'     => $i['harga'] * $i['qty'],
            ]);
        }

        /* KOSONGKAN KERANJANG */
        session()->forget('cart');

        /* =========================== */
        /* TAMPILKAN HALAMAN QR DANA   */
        /* =========================== */
        // Contoh: kirim data order ke view 'pesanan.qr-dana' yang berisi QR code pembayaran
        return view('pesanan.sukses', compact('order')); // ✅ BENAR

    }
}
