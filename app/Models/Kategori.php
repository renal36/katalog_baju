<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    // Menentukan atribut mana yang boleh diisi secara massal (mass assignment)
    protected $fillable = ['nama_kategori'];

    /**
     * Relasi one-to-many ke model Produk.
     * 
     * Artinya satu kategori bisa memiliki banyak produk.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
