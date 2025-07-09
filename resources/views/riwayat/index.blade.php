@extends('layout.template')
@section('title','Riwayat Pesanan')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
<style>
  body {
    font-family: 'Montserrat', sans-serif;
    background: linear-gradient(to right, #e0eafc, #cfdef3);
    color: #212529;
    min-height: 100vh;
  }

  .riwayat-card {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 32px;
    box-shadow: 0 8px 28px rgba(0,0,0,0.2);
    animation: slideIn .6s ease;
    color: #212529;
  }

  @keyframes slideIn {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .table {
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    color: #212529;
  }

  .table th {
    background-color: #007bff;
    color: #fff;
    text-transform: uppercase;
    font-size: 0.85rem;
  }

  .table td {
    text-align: center;
    vertical-align: middle;
    padding: 12px;
  }

  .table tbody tr:hover {
    background-color: #f1f7ff;
  }

  .badge-status {
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 0.85rem;
    font-weight: 600;
  }

  .badge-pending {
    background-color: #ffc107;
    color: #212529;
  }

  .badge-success {
    background-color: #28a745;
    color: #fff;
  }

  .badge-danger {
    background-color: #dc3545;
    color: #fff;
  }

  .btn-katalog {
    background: #ffc107;
    color: #212529;
    font-weight: bold;
    padding: 10px 24px;
    border-radius: 50px;
    border: none;
    text-decoration: none;
    box-shadow: 0 6px 16px rgba(0,0,0,.2);
    transition: 0.3s ease;
  }

  .btn-katalog:hover {
    background: #e0a800;
    color: #fff;
    transform: translateY(-2px);
  }

  h2 {
    color: #343a40;
  }

  .alert {
    background-color: #f8f9fa;
    border-left: 5px solid #007bff;
    color: #212529;
  }
</style>
@endpush

@section('content')
<div class="container py-5">
  <div class="riwayat-card">

    <h2 class="text-center mb-4">
      <i class="fas fa-receipt"></i> Riwayat Pesanan
    </h2>

    @if(session('success'))
      <div class="alert alert-success text-center">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
      </div>
    @endif

    @if($orders->count())
      <div class="table-responsive">
        <table class="table table-bordered shadow-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Produk</th>
              <th>Qty</th>
              <th>Total</th>
              <th>Status</th>
              <th>Keterangan</th> {{-- Tambahan kolom --}}
              <th>Waktu</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
              @php $item = $order->items->first(); @endphp
              <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $item->nama_produk ?? '-' }}</td>
                <td>{{ $item->jumlah ?? '-' }}</td>
                <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                <td>
                  <span class="badge badge-status badge-{{ $order->status == 'selesai' ? 'success' : ($order->status == 'batal' ? 'danger' : 'pending') }}">
                    {{ ucfirst($order->status) }}
                  </span>
                </td>
                <td>{{ $order->keterangan ?? '-' }}</td> {{-- Tampilkan keterangan --}}
                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="alert alert-info text-center">
        <i class="fas fa-info-circle"></i> Belum ada pesanan.
      </div>
    @endif

    <div class="text-center mt-4">
      <a href="{{ route('katalog') }}" class="btn-katalog">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Katalog
      </a>
    </div>

  </div>
</div>
@endsection
