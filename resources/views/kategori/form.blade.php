@extends('layout.template') 
{{-- Menggunakan layout utama bernama 'layout.template' sebagai template dasar halaman ini --}}

@section('title', 'Tambah Kategori') 
{{-- Mengisi bagian title pada layout dengan teks 'Tambah Kategori' --}}

@section('content')
{{-- Mengisi bagian content pada layout dengan form tambah kategori --}}
<h3>Form Tambah Kategori</h3>

<form action="{{ route('kategori.store') }}" method="POST">
  @csrf 
  {{-- Token CSRF untuk mencegah serangan CSRF, wajib ada pada form POST di Laravel --}}
  
  <div class="form-group">
    <label>Nama Kategori</label>
    <input name="nama_kategori" class="form-control" required>
    {{-- Input untuk memasukkan nama kategori, wajib diisi (required) --}}
  </div>
  
  <button class="btn btn-success">Simpan</button>
  {{-- Tombol submit untuk mengirim form --}}
  
  <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
  {{-- Tombol/link untuk kembali ke halaman daftar kategori --}}
</form>
@endsection
