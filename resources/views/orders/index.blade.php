@extends('layout.template')
@section('title','Daftar Pesanan')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Montserrat', sans-serif;
    }

    .table th, .table td {
        vertical-align: middle !important;
        text-align: center;
    }

    .table thead {
        background-color: #243b55;
        color: #fff;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .badge-status {
        font-size: 0.9rem;
        padding: 6px 12px;
        border-radius: 12px;
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
</style>
@endpush

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="fas fa-clipboard-list"></i> Daftar Pesanan</h2>

    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif

    @if($orders->count())
        <div class="table-responsive">
            <table class="table table-bordered bg-white shadow-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pemesan</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Aksi</th> {{-- Tambahan kolom untuk edit --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        @php
                            $item = $order->items->first(); // asumsi 1 produk per pesanan
                        @endphp
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->nama_pemesan }}</td>
                            <td>{{ $order->telepon }}</td>
                            <td>{{ $order->alamat }}</td>
                            <td>{{ $item->nama_produk ?? '-' }}</td>
                            <td>{{ $item->jumlah ?? '-' }}</td>
                            <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge badge-status badge-{{ $order->status === 'selesai' ? 'success' : ($order->status === 'batal' ? 'danger' : 'pending') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info"><i class="fas fa-info-circle"></i> Belum ada pesanan.</div>
    @endif
</div>
@endsection
