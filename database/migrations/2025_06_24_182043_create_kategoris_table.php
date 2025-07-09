<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration class anonim yang bertugas untuk membuat dan menghapus tabel 'kategoris'
return new class extends Migration
{
    /**
     * Fungsi 'up' digunakan untuk menjalankan migrasi, yaitu membuat tabel baru 'kategoris'
     */
    public function up()
    {
        // Membuat tabel 'kategoris' dengan kolom-kolom berikut:
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();               // Kolom 'id' sebagai primary key dengan auto-increment
            $table->string('nama_kategori');  // Kolom string untuk menyimpan nama kategori
            $table->timestamps();       // Kolom 'created_at' dan 'updated_at' otomatis untuk mencatat waktu dibuat dan diupdate
        });
    }

    /**
     * Fungsi 'down' digunakan untuk rollback migrasi, yaitu menghapus tabel 'kategoris'
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoris'); // Menghapus tabel 'kategoris' jika ada
    }
};
