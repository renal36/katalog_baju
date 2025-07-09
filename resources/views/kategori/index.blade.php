@extends('layout.template')
{{-- Menggunakan layout utama 'layout.template' sebagai template dasar halaman --}}

@section('title', 'Data Kategori')
{{-- Mengisi bagian title pada layout dengan teks 'Data Kategori' --}}

@section('content')
<h3>Daftar Kategori</h3>

{{-- Tombol untuk menuju halaman tambah kategori --}}
<a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

{{-- Menampilkan pesan sukses jika ada di session --}}
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Kategori</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    {{-- Looping data kategori yang dikirim dari controller --}}
    @forelse($data as $k)
      <tr>
        <td>{{ $loop->iteration }}</td> {{-- Nomor urut data --}}
        <td>{{ $k->nama_kategori }}</td> {{-- Menampilkan nama kategori --}}
        <td>
          {{-- Form untuk menghapus data kategori --}}
          <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE') {{-- Mengirim request dengan method DELETE --}}
            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
            {{-- Tombol hapus dengan konfirmasi --}}
          </form>
        </td>
      </tr>
    @empty
      {{-- Jika tidak ada data kategori --}}
      <tr>
        <td colspan="3">Belum ada data.</td>
      </tr>
    @endforelse
  </tbody>
</table>
@endsection
