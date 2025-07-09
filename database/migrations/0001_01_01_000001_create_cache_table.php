<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi: membuat tabel cache dan cache_locks
     */
    public function up(): void
    {
        // Membuat tabel 'cache' untuk menyimpan data cache key-value
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();   // Primary key berupa string unik sebagai identifier cache
            $table->mediumText('value');        // Nilai cache disimpan sebagai teks medium (cukup besar)
            $table->integer('expiration');      // Waktu kedaluwarsa cache dalam format timestamp (unix time)
        });

        // Membuat tabel 'cache_locks' untuk mengelola kunci (lock) pada cache agar menghindari race condition
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();   // Primary key kunci cache
            $table->string('owner');             // Pemilik kunci (misal proses atau thread yang memegang lock)
            $table->integer('expiration');      // Waktu kedaluwarsa lock (unix timestamp)
        });
    }

    /**
     * Membalikkan migrasi: menghapus tabel yang dibuat
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');       // Hapus tabel cache
        Schema::dropIfExists('cache_locks'); // Hapus tabel cache_locks
    }
};

