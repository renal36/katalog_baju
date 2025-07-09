@extends('layout.template')
@section('title', 'Katalog Produk')
@section('content')

<!-- ===== Background foto & lapisan gelap ===== -->
<div class="katalog-bg"></div>
<div class="bg-overlay"></div>

<!-- ===== Grid biru interaktif ===== -->
<div class="grid-overlay"></div>

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: #f4f4f4;
  scroll-behavior: smooth;
}
.katalog-bg {
  position: fixed; inset: 0;
  background: url("{{ asset('images/foto.jpg') }}") center/cover no-repeat fixed;
  filter: brightness(.45); z-index: -3;
}
.bg-overlay {
  position: fixed; inset: 0;
  background: rgba(0, 0, 0, .35); z-index: -2;
}
.grid-overlay {
  --x: 0px; --y: 0px;
  position: fixed; inset: 0;
  pointer-events: none; z-index: -1;
  background:
    repeating-linear-gradient(to right, rgba(0,123,255,.15) 0, rgba(0,123,255,.15) 1px, transparent 1px 90px),
    repeating-linear-gradient(to bottom, rgba(0,123,255,.15) 0, rgba(0,123,255,.15) 1px, transparent 1px 90px);
  background-position: var(--x) var(--y);
  transition: background-position .15s ease;
  animation: gridFloat 25s linear infinite;
}
@keyframes gridFloat {
  from { background-position: 0 0; }
  to { background-position: 900px 600px; }
}
.grid-overlay.pulse {
  animation: pulseGrid .4s cubic-bezier(.4, 0, .2, 1);
}
@keyframes pulseGrid {
  0% { opacity: 1; filter: blur(0); }
  50% { opacity: .4; filter: blur(1px); }
  100% { opacity: 1; filter: blur(0); }
}
.section-title {
  font-size: 2.4rem; font-weight: 700; color: #fff;
  text-align: center; margin-bottom: 28px;
  text-shadow: 2px 2px 8px rgba(245, 242, 242, 0.85);
  animation: fadeDown 1s ease;
}
@keyframes fadeDown {
  0% { opacity: 0; transform: translateY(-20px); }
  100% { opacity: 1; transform: translateY(0); }
}
.filter-box {
  background: rgba(255,255,255,.1); border-radius: 18px; padding: 28px; margin-bottom: 38px;
  backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,.25);
  box-shadow: 0 8px 18px rgba(0,0,0,.25);
}
.filter-box label {
  color: #fff; font-weight: 600;
}
.filter-box input, .filter-box select {
  background: transparent; border: 1px solid rgba(255,255,255,.45); color: #fff;
}
.card {
  border: none; border-radius: 20px; overflow: hidden; background: #fff; transition: .35s; height: 100%;
}
.card:hover {
  transform: scale(1.04);
  box-shadow: 0 12px 30px rgba(0,123,255,.25);
  outline: 3px solid #007bff; outline-offset: -6px;
}
.card-img-top {
  height: 200px; object-fit: cover;
}
.katalog-title {
  font-weight: 600; font-size: 1.08rem; margin-bottom: 4px; color: #333;
}
.katalog-price {
  color: #007bff; font-weight: 600; font-size: .95rem;
}
.btn-kembali {
  background: #ffc107; color: #212529; padding: 10px 26px; border-radius: 50px; font-weight: 600;
  box-shadow: 0 4px 10px rgba(0,0,0,.25); transition: .3s; text-decoration: none;
}
.btn-kembali:hover {
  background: #e0a800; color: #fff; transform: translateY(-2px);
}

/* Tombol keranjang & riwayat yang serasi dengan input */
.btn-grid {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 38px;
  border: 1px solid rgba(255,255,255,0.45);
  border-radius: 6px;
  background: transparent;
  color: #fff;
  font-weight: 600;
  font-size: 0.85rem;
  cursor: pointer;
  transition: background-color 0.3s ease, border-color 0.3s ease;
  text-decoration: none;
  position: relative;
  user-select: none;
  padding: 2px 8px;
  width: 100%;
  max-width: 140px;
}
.btn-grid i {
  font-size: 1.3rem;
  margin-bottom: 2px;
  line-height: 1;
  filter: drop-shadow(0 1px 1px rgba(0,0,0,0.3));
  transition: filter 0.3s ease;
}
.btn-grid:hover {
  background-color: rgba(255,255,255,0.15);
  border-color: rgba(255,255,255,0.8);
}
.btn-grid:hover i {
  filter: drop-shadow(0 2px 3px rgba(255,255,255,0.9));
}

/* Badge keranjang kecil & cocok */
.badge-keranjang {
  position: absolute;
  top: -6px;
  right: -6px;
  font-size: 0.7rem;
  padding: 0.15em 0.4em;
  background: #ffc107;
  color: #212529;
  font-weight: 700;
  border-radius: 12px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.25);
  user-select: none;
}

/* Container tombol supaya rata tengah dan responsif */
.btn-grid-container {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
@endpush

@push('scripts')
<script>
(() => {
  const grid = document.querySelector('.grid-overlay');
  let ticking = false;

  function updatePos(e){
    const {clientX:x, clientY:y} = (e.touches ? e.touches[0] : e);
    grid.style.setProperty('--x', -x/12+'px');
    grid.style.setProperty('--y', -y/12+'px');
    ticking = false;
  }
  function onMove(e){
    if (!ticking) {
      requestAnimationFrame(() => updatePos(e));
      ticking = true;
    }
  }
  window.addEventListener('mousemove', onMove, { passive: true });
  window.addEventListener('touchmove', onMove, { passive: true });

  window.addEventListener('click', () => {
    grid.classList.add('pulse');
    setTimeout(() => grid.classList.remove('pulse'), 400);
  });
})();
</script>
@endpush

@php
$cart = session('cart', []);
$cartCount = array_sum(array_column($cart, 'qty'));
@endphp

<div class="container py-4">
  <h2 class="section-title">🛒 Katalog Produk Terbaik Kami</h2>

  <!-- Video banner saja -->
  <div style="max-width:1200px; margin:0 auto 2rem; border-radius:16px; overflow:hidden; height:320px; position:relative;">
    <video 
      style="width:100%; height:100%; object-fit:cover; display:block;" 
      autoplay muted loop playsinline
      preload="metadata"
    >
      <source src="{{ asset('videos/banner-katalog.mp4') }}" type="video/mp4">
      Browser Anda tidak mendukung video ini.
    </video>
  </div>

  @if(!empty($pesananTerakhir))
  <div class="alert alert-{{ $pesananTerakhir->status == 'selesai' ? 'success' : 'warning' }} text-center mb-4">
    <strong>Status Pesanan Terakhirmu:</strong>
    {{ ucfirst($pesananTerakhir->status) }} – Total: Rp {{ number_format($pesananTerakhir->total_harga, 0, ',', '.') }}
    <a href="{{ route('riwayat.pesanan') }}" class="btn btn-sm btn-outline-light ml-2">Lihat Riwayat</a>
  </div>
  @endif

  <form method="GET" action="{{ route('katalog') }}">
    <div class="row align-items-end">
      <div class="col-md-4 mb-3">
        <label for="cari">🔍 Nama Produk</label>
        <input type="text" name="cari" id="cari" class="form-control" placeholder="Contoh: Baju koko anak" value="{{ request('cari') }}">
      </div>
      <div class="col-md-3 mb-3">
        <label for="kategori">📁 Kategori</label>
        <select name="kategori" id="kategori" class="form-control">
          <option value="">-- Semua Kategori --</option>
          @php $categories = ['anak-anak', 'pria', 'wanita']; @endphp
          @foreach($categories as $kat)
          <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
            {{ ucfirst(str_replace('-', ' ', $kat)) }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2 mb-3">
        <button type="submit" class="btn btn-warning w-100">🔍 Cari</button>
      </div>
      <div class="col-md-1 mb-3 btn-grid-container position-relative">
        <a href="{{ route('keranjang.index') }}" class="btn-grid position-relative" aria-label="Keranjang Belanja">
          <i class="fas fa-shopping-basket"></i>
          @if($cartCount > 0)
            <span class="badge-keranjang">{{ $cartCount }}</span>
          @endif
          <small>Keranjang</small>
        </a>
      </div>
      <div class="col-md-2 mb-3 btn-grid-container">
        <a href="{{ route('riwayat.pesanan') }}" class="btn-grid" aria-label="Riwayat Pesanan">
          <i class="fas fa-receipt"></i>
          <small>Riwayat</small>
        </a>
      </div>
    </div>
  </form>

  <div class="row">
    @forelse($produk as $item)
    <div class="col-xl-3 col-lg-4 col-md-6 mb-5 d-flex">
      <div class="card w-100" data-toggle="modal" data-target="#produkModal{{ $item->id }}" style="cursor:pointer;">
        <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://via.placeholder.com/300x200?text=No+Image' }}" class="card-img-top" alt="{{ $item->nama_produk }}">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <div class="katalog-title">{{ $item->nama_produk }}</div>
            <small class="text-muted">{{ ucfirst($item->kategori->nama_kategori) }}</small>
          </div>
          <div class="katalog-price mt-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="produkModal{{ $item->id }}" tabindex="-1" aria-labelledby="produkModalLabel{{ $item->id }}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="produkModalLabel{{ $item->id }}">{{ $item->nama_produk }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
          </div>
          <div class="modal-body">
            <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://via.placeholder.com/500x300?text=No+Image' }}" class="img-fluid rounded mb-3" alt="{{ $item->nama_produk }}">
            <p><strong>Kategori:</strong> {{ ucfirst($item->kategori->nama_kategori) }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
            @if($item->deskripsi)
            <p class="text-dark"><strong>Deskripsi:</strong><br>{{ $item->deskripsi }}</p>
            @endif
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <a href="{{ route('keranjang.tambah', $item->id) }}" class="btn btn-outline-primary"><i class="fas fa-cart-plus"></i> Tambah</a>
            <a href="{{ route('pesan', $item->id) }}" class="btn btn-success">🛍️ Pesan</a>
          </div>
        </div>
      </div>
    </div>
    @empty
    <div class="col-12 text-center text-light"><p>Tidak ditemukan produk sesuai pencarianmu.</p></div>
    @endforelse
  </div>

  <div class="text-center mt-5">
    <a href="{{ url('/') }}" class="btn-kembali">
      <i class="fas fa-arrow-left mr-2"></i> Kembali ke Halaman Awal
    </a>
  </div>
</div>
@endsection
