<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar semua kategori yang ada di database.
     * 
     * @return \Illuminate\View\View - menampilkan view kategori.index dengan data kategori
     */
    public function index()
    {
        // Mengambil semua data kategori dari tabel kategori
        $data = Kategori::all();

        // Mengirim data kategori ke view 'kategori.index'
        return view('kategori.index', compact('data'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     * 
     * @return \Illuminate\View\View - menampilkan view form kategori
     */
    public function create()
    {
        // Tampilkan halaman form input kategori baru
        return view('kategori.form');
    }

    /**
     * Menyimpan data kategori baru ke dalam database.
     * 
     * @param Request $request - data input dari user
     * @return \Illuminate\Http\RedirectResponse - redirect ke halaman daftar kategori dengan pesan sukses
     */
    public function store(Request $request)
    {
        // Validasi input, pastikan nama_kategori wajib diisi
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        // Simpan data kategori baru ke database dengan mass assignment
        // (Pastikan model Kategori sudah mengatur fillable)
        Kategori::create($request->all());

        // Redirect ke route kategori.index dan kirim pesan sukses
        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Menghapus kategori berdasarkan ID yang diberikan.
     * 
     * @param int $id - ID kategori yang ingin dihapus
     * @return \Illuminate\Http\RedirectResponse - kembali ke halaman sebelumnya dengan pesan sukses
     */
    public function destroy($id)
    {
        // Cari kategori berdasarkan ID, jika tidak ditemukan akan otomatis error 404
        $kategori = Kategori::findOrFail($id);

        // Hapus data kategori tersebut dari database
        $kategori->delete();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Kategori berhasil dihapus');
    }
}
