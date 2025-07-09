<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Membuat kelas migrasi anonim yang akan membuat tabel 'order_items'
return new class extends Migration
{
    /**
     * Run the migrations.
     * Fungsi ini dijalankan saat migrasi dijalankan dengan perintah `php artisan migrate`.
     * Fungsi ini bertugas untuk membuat tabel 'order_items' di database.
     */
   public function up()
   {
       // Membuat tabel 'order_items' dengan kolom-kolom berikut:
       Schema::create('order_items', function (Blueprint $table) {
           $table->id(); // Membuat kolom 'id' sebagai primary key dan auto increment
           
           // Membuat kolom foreign key 'order_id' yang mereferensi kolom 'id' di tabel 'orders'
           // Jika data di tabel 'orders' dihapus, maka data terkait di 'order_items' akan dihapus juga (cascade delete)
           $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
           
           // Membuat kolom foreign key 'produk_id' yang mereferensi kolom 'id' di tabel 'produks'
           // Jika data di tabel 'produks' dihapus, maka data terkait di 'order_items' akan dihapus juga (cascade delete)
           $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
           
           $table->string('nama_produk'); // Menyimpan nama produk (string)
           $table->decimal('harga_satuan', 12, 2); // Menyimpan harga satuan produk dengan presisi 12 digit dan 2 digit di belakang koma
           $table->integer('jumlah'); // Menyimpan jumlah produk yang dipesan
           $table->decimal('subtotal', 12, 2); // Menyimpan subtotal (harga_satuan * jumlah) dengan presisi yang sama
           
           $table->timestamps(); // Membuat kolom 'created_at' dan 'updated_at' untuk menyimpan waktu pembuatan dan update data
       });
   }
};
