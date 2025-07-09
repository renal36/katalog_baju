@extends('layout.template')
@section('title', isset($produk) ? 'Edit Produk' : 'Tambah Produk')

@section('content')
<form action="{{ isset($produk) ? route('produk.update', $produk->id) : route('produk.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  @if(isset($produk))
    @method('PUT')
  @endif

  <div class="form-group">
    <label>Nama Produk</label>
    <input name="nama_produk" class="form-control" required
           value="{{ old('nama_produk', $produk->nama_produk ?? '') }}">
  </div>

  <div class="form-group">
    <label>Kategori</label>
    <select name="kategori_id" class="form-control" required>
      <option value="">-- pilih kategori --</option>
      @foreach($kategori as $k)
        <option value="{{ $k->id }}" 
          {{ old('kategori_id', $produk->kategori_id ?? '') == $k->id ? 'selected' : '' }}>
          {{ $k->nama_kategori }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label>Harga</label>
    <input type="text" name="harga" class="form-control" required
           value="{{ old('harga', isset($produk) ? number_format($produk->harga, 0, ',', '.') : '') }}">
  </div>

  <div class="form-group">
    <label>Stok</label>
    <input type="number" name="stok" class="form-control" required
           value="{{ old('stok', $produk->stok ?? '') }}">
  </div>

  <div class="form-group">
    <label>Gambar</label>
    <input type="file" name="gambar" class="form-control-file">

    @if(isset($produk) && $produk->gambar)
      <div class="mt-2">
        <img src="{{ asset('storage/' . $produk->gambar) }}" width="100" alt="Gambar produk">
      </div>
    @endif
  </div>

  <button class="btn btn-success">{{ isset($produk) ? 'Update' : 'Simpan' }}</button>
  <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
