@extends('layout.template')
{{-- Menggunakan layout utama 'layout.template' sebagai dasar halaman --}}

@section('title', 'Keranjang Belanja')
{{-- Mengisi judul halaman dengan 'Keranjang Belanja' --}}

@push('styles')
{{-- Menyisipkan style dan link eksternal ke section styles di layout --}}
<!-- Font & Icon -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    body, .keranjang-section {
        font-family: 'Montserrat', sans-serif;
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        background-attachment: fixed;
        min-height: 100vh;
        padding: 40px 15px;
    }

    .card-glass {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        max-width: 1000px;
        margin: auto;
        color: #f1f1f1;
        box-shadow: 0 15px 45px rgba(0,0,0,0.4);
        animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h2 {
        text-align: center;
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #fff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1.5rem;
    }

    thead {
        background: rgba(255, 255, 255, 0.1);
    }

    th, td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    tbody tr:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    .total-text {
        font-weight: bold;
        color: #00ffc6;
    }

    .btn-elegant {
        background: linear-gradient(135deg,#ff416c 0%,#ff4b2b 100%);
        color: #fff;
        font-weight: 600;
        padding: 10px 26px;
        border-radius: 32px;
        font-size: 0.95rem;
        margin: 6px;
        transition: all 0.3s ease;
    }
    .btn-elegant:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.3);
    }

    .btn-back {
        background: transparent;
        color: #ffd369;
        border: 1px solid #ffd369;
        padding: 10px 24px;
        border-radius: 32px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin: 6px;
    }
    .btn-back:hover {
        background: #ffd369;
        color: #111;
        transform: translateY(-3px);
    }

    .alert {
        border-radius: 10px;
        padding: 1rem;
        text-align: center;
    }
    .alert-info {
        background: rgba(255,255,255,0.08);
        color: #fff;
    }
    .alert-success {
        background: #28a745;
        color: #fff;
    }

    @media (max-width: 768px) {
        th, td { font-size: 0.9rem; }
        .btn-elegant, .btn-back { width: 100%; margin-top: 8px; }
    }
</style>
@endpush

@section('content')
<div class="keranjang-section">
    <div class="card-glass">
        <h2><i class="fas fa-shopping-cart"></i> Keranjang Belanja</h2>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('cart') && count(session('cart')) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('cart') as $id => $item)
                        <tr>
                            <td>{{ $item['nama'] }}</td>
                            <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                            <td>{{ $item['qty'] }}</td>
                            <td class="total-text">Rp {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('keranjang.hapus', $id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-elegant" onclick="return confirm('Hapus produk ini dari keranjang?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-center d-flex flex-wrap justify-content-center">
                <a href="{{ route('katalog') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali Belanja
                </a>

                {{-- Tombol Checkout Manual (Form) --}}
                <form action="{{ route('keranjang.checkout') }}" method="POST" style="display: inline-block;">
                    @csrf
                    <input type="hidden" name="nama" value="{{ session('nama_pemesan') ?? 'Pembeli' }}">
                    <input type="hidden" name="telepon" value="081234567890">
                    <input type="hidden" name="alamat" value="Alamat Pembeli">
                    <button type="submit" class="btn btn-elegant">
                        <i class="fas fa-check-circle"></i> Checkout Sekarang
                    </button>
                </form>
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Keranjang kamu masih kosong.
            </div>
            <div class="text-center">
                <a href="{{ route('katalog') }}" class="btn btn-elegant">
                    <i class="fas fa-search"></i> Jelajahi Produk
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
