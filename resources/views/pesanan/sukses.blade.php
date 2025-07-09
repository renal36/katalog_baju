@extends('layout.template')
@section('title','Pembayaran DANA')

@push('styles')
<!-- Font & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .pay-card {
    background: rgba(255, 255, 255, 0.07);
    backdrop-filter: blur(14px);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 24px;
    padding: 40px 28px;
    text-align: center;
    max-width: 480px;
    width: 100%;
    color: #fff;
    box-shadow: 0 14px 40px rgba(0, 0, 0, 0.4);
    animation: fade .6s ease;
  }

  @keyframes fade {
    from {opacity: 0; transform: translateY(30px);}
    to {opacity: 1; transform: translateY(0);}
  }

  h2 {
    color: #00ffae;
    font-weight: 700;
    font-size: 1.8rem;
  }

  h3 {
    color: #ffd369;
    font-size: 1.5rem;
    margin-bottom: 14px;
  }

  .total {
    font-size: 2rem;
    color: #ff5e78;
    font-weight: 700;
    margin: 10px 0 20px;
  }

  img.qr {
    width: 220px;
    border-radius: 16px;
    margin: 20px auto;
    box-shadow: 0 6px 16px rgba(0,0,0,0.2);
  }

  .btn-wa {
    background: #25d366;
    color: #fff;
    font-weight: 600;
    border: none;
    border-radius: 50px;
    padding: 12px 28px;
    margin-top: 16px;
    box-shadow: 0 6px 14px rgba(0,0,0,0.3);
    transition: 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .btn-wa:hover {
    transform: translateY(-2px);
    opacity: 0.9;
  }

  .btn-riwayat {
    background: transparent;
    border: 1px solid #ccc;
    color: #fff;
    padding: 10px 24px;
    border-radius: 50px;
    font-weight: 500;
    margin-top: 20px;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
  }

  .btn-riwayat:hover {
    background: #ccc;
    color: #111;
  }

  .highlight {
    color: #ffd369;
    font-weight: 600;
  }

  hr {
    border-color: rgba(255,255,255,0.1);
    margin: 20px 0;
  }
</style>
@endpush

@section('content')
<div class="pay-card">

  <h2><i class="fas fa-check-circle"></i> Pesanan Berhasil Dibuat!</h2>

  <p class="mt-3">Silakan lakukan pembayaran ke DANA berikut:</p>

  <div class="total">Rp {{ number_format($order->total_harga,0,',','.') }}</div>

  <hr>

  <p>Scan <span class="highlight">QR DANA</span> di bawah ini:</p>
  <img src="{{ asset('qrcode/danaorang.jpg') }}" alt="QR DANA" class="qr">

  <p class="mt-2">Atau transfer ke:</p>
  <h3>081‑1111‑12333</h3>
  <p><span class="highlight">xxxx</span></p>

  <p class="mt-4">Setelah transfer, kirim bukti pembayaran ke admin:</p>

  <a href="https://wa.me/01234567889" target="_blank" class="btn-wa">
    <i class="fab fa-whatsapp"></i> Kirim via WhatsApp
  </a>

  <br>
  <a href="{{ route('riwayat.pesanan') }}" class="btn-riwayat">Lihat Riwayat Pesanan</a>

</div>
@endsection
