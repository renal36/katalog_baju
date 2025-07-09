@extends('layout.template')
@section('title', 'Pesan Produk')

@push('styles')
<!-- Font & Icon -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    /* ---------- Global ---------- */
    html, body, .wrapper, .content-wrapper {
        height: 100%;
        margin: 0;
        font-family: 'Montserrat', sans-serif;
        background: linear-gradient(135deg, #141e30 0%, #243b55 100%); /* dark blue-grey */
        background-attachment: fixed;
        color: #e1e1e1;
    }

    a, a:hover { color:#ffd369; }

    /* ---------- Container ---------- */
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 100px);
        padding: 30px 15px;
    }

    /* ---------- Card ---------- */
    .card-glass {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.09);
        backdrop-filter: blur(18px);
        border-radius: 20px;
        padding: 2.8rem;
        box-shadow: 0 18px 38px rgba(0,0,0,0.5);
        width: 100%;
        max-width: 680px;
        animation: fadeIn 0.8s ease-out;
    }
    @keyframes fadeIn { from{opacity:0;transform:translateY(40px);} to{opacity:1;transform:translateY(0);} }

    /* ---------- Header ---------- */
    h2.section-header{
        text-align:center;
        font-size:2.1rem;
        font-weight:700;
        margin-bottom:2.2rem;
        color:#ffffff;
        letter-spacing:1px;
    }

    /* ---------- Form ---------- */
    .form-group label{
        font-weight:600;
        margin-bottom:.35rem;
        color:#dcdcdc;
    }
    .form-control{
        background:rgba(255,255,255,0.1);
        border:1px solid rgba(255,255,255,0.1);
        color:#fff;
        border-radius:12px;
        padding:11px 15px;
        transition:.25s all;
    }
    .form-control:focus{
        background:rgba(255,255,255,0.18);
        border-color:#ffd369;
        box-shadow:0 0 0 3px rgba(255, 211, 105, .25);
    }
    ::placeholder{color:#bbb;}

    /* ---------- Buttons ---------- */
    .btn-elegant{
        background:linear-gradient(135deg,#ff416c 0%,#ff4b2b 100%);
        color:#fff;
        font-weight:600;
        padding:13px 28px;
        border-radius:32px;
        border:none;
        font-size:1rem;
        transition:.25s transform, .25s box-shadow;
    }
    .btn-elegant i{margin-right:6px;}
    .btn-elegant:hover{
        transform:translateY(-2px) scale(1.03);
        box-shadow:0 8px 22px rgba(0,0,0,.4);
    }

    .btn-back{
        background:transparent;
        color:#ffd369;
        padding:11px 26px;
        border:1px solid #ffd369;
        border-radius:32px;
        margin-left:14px;
        font-weight:600;
        transition:.25s all;
    }
    .btn-back:hover{
        background:#ffd369;
        color:#1b1b1b;
        transform:translateY(-2px);
    }

    /* ---------- Info Box ---------- */
    .info{
        text-align:center;
        font-size:1.05rem;
        margin-bottom:1.7rem;
        color:#f1f1f1;
        background:rgba(255,255,255,0.08);
        padding:14px 20px;
        border-radius:14px;
    }
    .info i{color:#ffd369;}

    /* ---------- Alerts ---------- */
    .alert{border-radius:10px;}

    /* ---------- Responsive ---------- */
    @media (max-width:768px){
        .card-glass{padding:1.8rem;}
        .btn-elegant,.btn-back{width:100%;margin:6px 0 0;}
        .btn-back{margin-left:0;}
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="w-100">
        <h2 class="section-header"><i class="fas fa-clipboard-list"></i> Form Pemesanan</h2>

        @if(session('success'))
            <div class="alert alert-success text-center"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger text-center"><i class="fas fa-exclamation-triangle"></i> {{ session('error') }}</div>
        @endif

        <div class="card card-glass mx-auto">
            <div class="info">
                <strong>{{ $produk->nama_produk }}</strong><br>
                <i class="fas fa-tag"></i> Kategori: {{ $produk->kategori->nama_kategori ?? '-' }} |
                <i class="fas fa-money-bill-wave"></i> Rp {{ number_format($produk->harga,0,',','.') }}
            </div>

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">

                <div class="form-group">
                    <label for="qty"><i class="fas fa-sort-numeric-up-alt"></i> Jumlah</label>
                    <input type="number" name="qty" id="qty" class="form-control" min="1" required>
                </div>

                <div class="form-group mt-3">
                    <label for="nama"><i class="fas fa-user"></i> Nama Pemesan</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label for="telepon"><i class="fas fa-phone"></i> Nomor Telepon</label>
                    <input type="text" name="telepon" id="telepon" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label for="alamat"><i class="fas fa-map-marker-alt"></i> Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control" required></textarea>
                </div>

                <div class="text-center mt-4 d-flex flex-wrap justify-content-center">
                    <button type="submit" class="btn btn-elegant">
                        <i class="fas fa-paper-plane"></i> Pesan Sekarang
                    </button>
                    <a href="{{ route('katalog') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
