<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi: buat tabel-tabel di database
     */
    public function up(): void
    {
        // Membuat tabel 'users' untuk menyimpan data pengguna
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // kolom primary key auto-increment 'id'
            $table->string('name'); // kolom nama pengguna
            $table->string('email')->unique(); // kolom email unik
            $table->timestamp('email_verified_at')->nullable(); // waktu verifikasi email (nullable)
            $table->string('password'); // kolom password hashed
            $table->rememberToken(); // kolom token untuk fitur "remember me"
            $table->timestamps(); // kolom created_at dan updated_at otomatis
        });

        // Membuat tabel 'password_reset_tokens' untuk menyimpan token reset password
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // email sebagai primary key unik
            $table->string('token'); // token reset password
            $table->timestamp('created_at')->nullable(); // waktu pembuatan token
        });

        // Membuat tabel 'sessions' untuk menyimpan sesi login user
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // id sesi sebagai primary key (biasanya random string)
            $table->foreignId('user_id')->nullable()->index(); // foreign key ke tabel users, nullable karena sesi bisa tanpa user login
            $table->string('ip_address', 45)->nullable(); // alamat IP user (maks 45 karakter, cukup untuk IPv6)
            $table->text('user_agent')->nullable(); // user agent browser/device
            $table->longText('payload'); // data sesi yang diserialisasi
            $table->integer('last_activity')->index(); // timestamp aktivitas terakhir (unix timestamp)
        });
    }

    /**
     * Balikkan migrasi: hapus tabel yang sudah dibuat
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // hapus tabel users jika ada
        Schema::dropIfExists('password_reset_tokens'); // hapus tabel password_reset_tokens
        Schema::dropIfExists('sessions'); // hapus tabel sessions
    }
};

