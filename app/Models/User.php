<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // Trait HasFactory untuk factory pembuatan data dummy (testing/seeding)
    // Trait Notifiable untuk fitur notifikasi Laravel (email, broadcast, dsb)
    use HasFactory, Notifiable;

    /**
     * Atribut yang boleh diisi secara massal (mass assignment)
     * 
     * @var list<string>
     */
    protected $fillable = [
        'name',      // Nama user
        'email',     // Email user
        'password',  // Password user
    ];

    /**
     * Atribut yang harus disembunyikan saat serialisasi (misal saat diubah jadi JSON)
     * 
     * @var list<string>
     */
    protected $hidden = [
        'password',       // Sembunyikan password agar tidak terlihat di API atau dump data
        'remember_token', // Token "ingat saya"
    ];

    /**
     * Mendefinisikan casting tipe data untuk atribut tertentu.
     * 
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Mengubah kolom ini ke objek datetime
            'password' => 'hashed',            // Otomatis hash password saat di-set
        ];
    }
}
