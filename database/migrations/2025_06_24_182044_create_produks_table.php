<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration class anonim untuk membuat dan menghapus tabel 'produks'
return new class extends Migration
{
    /**
     * Fungsi 'up' menjalankan migrasi, yaitu membuat tabel 'produks' dengan kolom-kolom tertentu
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id(); // Membuat kolom 'id' sebagai primary key dengan auto-increment
            $table->string('nama_produk'); // Kolom untuk nama produk, tipe string
            $table->unsignedBigInteger('kategori_id'); // Kolom foreign key yang merujuk ke tabel 'kategoris', tipe unsigned big integer
            $table->decimal('harga', 10, 2); // Kolom harga produk dengan tipe decimal (max 10 digit, 2 digit desimal)
            $table->integer('stok'); // Kolom stok produk, tipe integer
            $table->string('gambar')->nullable(); // Kolom untuk nama file gambar produk, bisa null (optional)
            $table->timestamps(); // Kolom otomatis 'created_at' dan 'updated_at'

            // Mendefinisikan foreign key 'kategori_id' yang mengacu ke kolom 'id' di tabel 'kategoris'
            // onDelete('cascade') berarti jika data kategori dihapus, produk terkait juga akan terhapus otomatis
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Fungsi 'down' rollback migrasi dengan menghapus tabel 'produks' jika ada
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
