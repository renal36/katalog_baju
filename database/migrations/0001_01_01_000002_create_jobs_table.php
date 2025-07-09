<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi: membuat tabel-tabel antrian (jobs), batch jobs, dan failed jobs
     */
    public function up(): void
    {
        // Tabel 'jobs' menyimpan daftar job yang akan diproses oleh queue worker
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();                       // Primary key, auto increment
            $table->string('queue')->index();  // Nama queue tempat job berada, di-index untuk pencarian cepat
            $table->longText('payload');       // Data job yang di-serialize dan disimpan di sini
            $table->unsignedTinyInteger('attempts');   // Jumlah percobaan eksekusi job
            $table->unsignedInteger('reserved_at')->nullable(); // Waktu job dicadangkan (reserved) untuk proses, unix timestamp
            $table->unsignedInteger('available_at');   // Waktu job siap diproses (unix timestamp)
            $table->unsignedInteger('created_at');     // Waktu job dibuat (unix timestamp)
        });

        // Tabel 'job_batches' untuk mengelola batch job yang terdiri dari beberapa job
        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();    // ID batch, biasanya UUID/string unik
            $table->string('name');              // Nama batch job
            $table->integer('total_jobs');      // Total job dalam batch ini
            $table->integer('pending_jobs');    // Jumlah job yang belum selesai/diproses
            $table->integer('failed_jobs');     // Jumlah job yang gagal dalam batch ini
            $table->longText('failed_job_ids'); // Daftar ID job yang gagal (disimpan sebagai JSON/string)
            $table->mediumText('options')->nullable(); // Opsi tambahan untuk batch (serialized data)
            $table->integer('cancelled_at')->nullable(); // Waktu batch dibatalkan (unix timestamp), nullable
            $table->integer('created_at');           // Waktu batch dibuat (unix timestamp)
            $table->integer('finished_at')->nullable();  // Waktu batch selesai (nullable)
        });

        // Tabel 'failed_jobs' menyimpan informasi job yang gagal dieksekusi
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();                     // Primary key
            $table->string('uuid')->unique(); // UUID unik job yang gagal
            $table->text('connection');       // Nama koneksi queue (misal: database, redis, dll)
            $table->text('queue');            // Nama queue asal job
            $table->longText('payload');      // Data job yang gagal (serialized)
            $table->longText('exception');    // Pesan dan trace exception error saat gagal
            $table->timestamp('failed_at')->useCurrent(); // Waktu job gagal, default sekarang
        });
    }

    /**
     * Membalikkan migrasi: menghapus tabel jobs, job_batches, dan failed_jobs
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
