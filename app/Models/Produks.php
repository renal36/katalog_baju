<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produks extends Model
{
    use HasFactory;

    /** @var string  */
    protected $table = 'produks';

    protected $fillable = [
        'nama_produk',
        'kategori_id',
        'harga',
        'stok',
        'gambar',
    ];

    /**
     * Setiap produk milik satu kategori.
     * withDefault() mencegah error ketika kategori_id = NULL.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id')
                    ->withDefault([
                        // properti default yang ingin ditampilkan ketika NULL
                        'nama_kategori' => 'Tanpa Kategori',
                    ]);
    }
}
