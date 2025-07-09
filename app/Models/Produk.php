<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks'; // tetap gunakan nama tabel jamak

    protected $fillable = [
        'nama_produk',
        'kategori_id',
        'harga',
        'stok',
        'gambar',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id')
                    ->withDefault([
                        'nama_kategori' => 'Tanpa Kategori',
                    ]);
    }
}
