<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Field mana saja yang bisa diisi secara massal (mass assignment)
    protected $fillable = [
        'nama_pemesan',   // Nama orang yang memesan
        'telepon',        // Nomor telepon pemesan
        'alamat',         // Alamat pengiriman atau alamat pemesan
        'total_harga',    // Total harga seluruh pesanan
        'status',         // Status pesanan (misal: pending, diproses, selesai)
        'keterangan',    
    ];

    /**
     * Relasi one-to-many ke OrderItem.
     * Satu order memiliki banyak item detail pesanan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
