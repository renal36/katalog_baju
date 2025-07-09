<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar semua produk beserta kategori terkait.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua produk dengan relasi kategori (eager loading)
        $data = Produk::with('kategori')->get();

        // Tampilkan view produk.index dengan data produk
        return view('produk.index', compact('data'));
    }

    /**
     * Menampilkan form untuk menambah produk baru.
     * Mengambil semua kategori untuk dropdown select.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Ambil semua kategori
        $kategori = Kategori::all();

        // Tampilkan view form produk dengan data kategori
        return view('produk.form', compact('kategori'));
    }

    /**
     * Menyimpan data produk baru ke database.
     * Melakukan validasi, proses upload gambar, dan format harga.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'nama_produk' => 'required',
            'kategori_id' => 'required',
            'harga'       => 'required',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Ambil semua data request
        $data = $request->all();

        // Hapus titik dari harga, misal '125.000' jadi '125000'
        $data['harga'] = str_replace('.', '', $data['harga']);

        // Jika ada file gambar, simpan file dan masukkan path ke data
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        // Simpan data produk ke database
        Produk::create($data);

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk ditambah');
    }

    /**
     * Menampilkan form edit produk tertentu.
     * Mengambil produk dan kategori untuk form.
     * 
     * @param Produk $produk - produk yang akan diedit (route-model binding)
     * @return \Illuminate\View\View
     */
    public function edit(Produk $produk)
    {
        // Ambil semua kategori untuk select option
        $kategori = Kategori::all();

        // Tampilkan form edit produk dengan data produk dan kategori
        return view('produk.form', compact('produk', 'kategori'));
    }

    /**
     * Memperbarui data produk yang sudah ada.
     * Validasi input, proses upload gambar jika ada, dan update database.
     * 
     * @param Request $request
     * @param Produk $produk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Produk $produk)
    {
        // Validasi data yang masuk
        $data = $request->validate([
            'nama_produk' => 'required',
            'kategori_id' => 'required',
            'harga'       => 'required',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Format harga, hilangkan titik
        $data['harga'] = str_replace('.', '', $data['harga']);

        // Jika ada file gambar baru, upload dan simpan path
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        // Update produk dengan data yang sudah divalidasi
        $produk->update($data);

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk di-update');
    }

    /**
     * Menghapus produk dari database.
     * 
     * @param Produk $produk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Produk $produk)
    {
        // Hapus produk dari DB
        $produk->delete();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Produk dihapus');
    }
}
