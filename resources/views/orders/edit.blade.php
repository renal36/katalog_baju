@extends('layout.template')
@section('title','Edit Pesanan')

@section('content')
<div class="container py-4" style="max-width:600px">
  <h3 class="mb-3">Edit Pesanan #{{ $order->id }}</h3>

  <form action="{{ route('orders.update',$order->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="form-group mb-3">
      <label>Status</label>
      <select name="status" class="form-control">
        @foreach(['pending','diproses','dikirim','selesai','batal'] as $st)
          <option value="{{ $st }}" {{ $order->status==$st?'selected':'' }}>
            {{ ucfirst($st) }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="form-group mb-4">
      <label>Keterangan</label>
      <textarea name="keterangan" rows="3" class="form-control"
        placeholder="Catatan tambahan…">{{ $order->keterangan }}</textarea>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection
