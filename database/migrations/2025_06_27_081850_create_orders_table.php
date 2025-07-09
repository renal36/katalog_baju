<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration class anonim untuk membuat tabel 'orders'
return new class extends Migration
{
    /**
     * Fungsi 'up' menjalankan migrasi, yaitu membuat tabel 'orders'
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Kolom 'id' sebagai primary key dengan auto-increment
            $table->string('nama_pemesan'); // Kolom untuk menyimpan nama pemesan, tipe string
            $table->string('telepon'); // Kolom untuk nomor telepon pemesan, tipe string
            $table->text('alamat'); // Kolom untuk alamat pemesan, tipe text (bisa lebih panjang dari string)
            $table->decimal('total_harga', 12, 2); // Kolom total harga pesanan, tipe decimal dengan 12 digit total dan 2 digit desimal
            $table->string('status')->default('pending'); // Kolom status pesanan, default nilainya 'pending'
            $table->timestamps(); // Kolom 'created_at' dan 'updated_at' otomatis untuk mencatat waktu pembuatan dan update data
        });
    }
};
