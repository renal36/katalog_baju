<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produks;
use App\Models\Order;
use App\Models\OrderItem;

class PesananController extends Controller
{
    /* ---------- FORM PEMESANAN SATU PRODUK ---------- */
    public function pesan($id)
    {
        $produk = Produks::findOrFail($id);
        return view('pesanan.pesan', compact('produk'));
    }

    /* ---------- PROSES CHECKOUT ---------- */
    public function checkout(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'qty'       => 'required|integer|min:1',
            'nama'      => 'required|string|max:100',
            'telepon'   => 'required|string|max:20',
            'alamat'    => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $produk = Produks::findOrFail($request->produk_id);
            $qty    = $request->qty;
            $total  = $produk->harga * $qty;

            /* Order utama */
            $order = Order::create([
                'nama_pemesan' => $request->nama,
                'telepon'      => $request->telepon,
                'alamat'       => $request->alamat,
                'total_harga'  => $total,
                'status'       => 'pending',
            ]);

            /* Detail item */
            OrderItem::create([
                'order_id'     => $order->id,
                'produk_id'    => $produk->id,
                'nama_produk'  => $produk->nama_produk,
                'harga_satuan' => $produk->harga,
                'jumlah'       => $qty,
                'subtotal'     => $total,
            ]);

            /* Simpan ke session */
            $request->session()->put('nama_pemesan', $request->nama);
            $request->session()->put('last_order_id', $order->id);

            DB::commit();

            // Alihkan ke halaman pembayaran manual (dengan QR DANA)
            return view('pesanan.sukses', compact('order'));


        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error','Terjadi kesalahan saat memproses pesanan.');
        }
    }

    /* ---------- RIWAYAT ADMIN ---------- */
    public function riwayat()
    {
        $orders = Order::with('items.produk')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    /* ---------- RIWAYAT USER ---------- */
    public function riwayatUser(Request $request)
    {
        $namaPemesan = $request->session()->get('nama_pemesan');

        $orders = Order::with('items')
                    ->when($namaPemesan, fn($q) => $q->where('nama_pemesan',$namaPemesan))
                    ->latest()
                    ->get();

        return view('riwayat.index', compact('orders'));
    }

    /* =====================================================
       ==========  FUNGSI ADMIN: EDIT & UPDATE  =============
       ===================================================== */

    /** Tampilkan form edit status + keterangan */
    public function edit($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    /** Simpan perubahan status + keterangan */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status'     => 'required|in:pending,diproses,dikirim,selesai,batal',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status'      => $request->status,
            'keterangan'  => $request->keterangan,
        ]);

        return redirect()->route('orders.index')
                         ->with('success','Pesanan berhasil diperbarui!');
    }
}
