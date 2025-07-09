@extends('layout.template')
@section('title','Data Produk')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
<style>
  body {
    font-family: 'Montserrat', sans-serif;
    color: #000; /* font hitam */
  }

  .card-table {
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    padding: 20px;
  }

  .table th {
    background: #0d6efd;
    color: #fff;
    text-align: center;
  }

  .table td {
    vertical-align: middle;
    text-align: center;
    color: #000;
  }

  .table img {
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  }

  .btn-primary {
    background: linear-gradient(135deg, #0d6efd, #003cb3);
    border: none;
    font-weight: 600;
    transition: .3s ease-in-out;
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0, 60, 179, 0.4);
  }

  .btn-warning, .btn-danger {
    font-weight: 600;
  }

  .alert-success {
    background: #28a745;
    color: #fff;
    font-weight: 500;
    border-radius: 8px;
  }

</style>
@endpush

@section('content')
<div class="container py-3">
  <h2 class="mb-4"><i class="fas fa-tshirt"></i> Data Produk</h2>

  <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">
    <i class="fa fa-plus"></i> Tambah Produk
  </a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card-table">
    <table id="produkTable" class="table table-hover table-bordered">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Kategori</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Gambar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $item)
        <tr>
          <td>{{ $item->nama_produk }}</td>
          <td>{{ $item->kategori->nama_kategori }}</td>
          <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
          <td>{{ $item->stok }}</td>
          <td>
            @if($item->gambar)
              <img src="{{ asset('storage/'.$item->gambar) }}" width="60">
            @else
              <span class="text-muted">Tidak Ada</span>
            @endif
          </td>
          <td>
            <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-warning">
              <i class="fa fa-edit"></i>
            </a>
            <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style="display:inline">
              @csrf @method('DELETE')
              <button onclick="return confirm('Hapus?')" class="btn btn-sm btn-danger">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function(){
  $('#produkTable').DataTable({
    responsive: true,
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Cari produk...",
      lengthMenu: "Tampilkan _MENU_ entri",
      zeroRecords: "Tidak ditemukan data",
      info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
      infoEmpty: "Tidak ada data tersedia",
      paginate: {
        next: "Berikutnya",
        previous: "Sebelumnya"
      }
    }
  });
});
</script>
@endpush
