<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Kolom-kolom yang boleh diisi massal (mass assignment)
    protected $fillable = [
        'order_id',      // ID pesanan induk
        'produk_id',     // ID produk yang dipesan
        'nama_produk',   // Nama produk pada saat pemesanan (disimpan untuk riwayat)
        'harga_satuan',  // Harga satuan produk saat dipesan
        'jumlah',        // Jumlah produk yang dipesan
        'subtotal',      // Total harga (harga_satuan * jumlah)
    ];

    /**
     * Relasi many-to-one ke Order.
     * Satu item pesanan dimiliki oleh satu order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relasi many-to-one ke Produk.
     * Satu item pesanan mengacu ke satu produk.
     * 
     * Perhatikan model yang digunakan adalah 'Produks' (pastikan nama model benar).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produk()
    {
        return $this->belongsTo(Produks::class, 'produk_id');
    }
}
