<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Katalog Baju')</title>
  <!-- Judul halaman dinamis, default "Katalog Baju" jika tidak ada @section('title') -->

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- Library AdminLTE untuk UI admin yang modern -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- FontAwesome untuk ikon -->

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
  <!-- Styling DataTables yang kompatibel dengan Bootstrap 4 -->

  <!-- Style tambahan untuk transparansi background dan estetika sidebar -->
  <style>
    /* Konten utama dibuat transparan supaya background halaman terlihat */
    .content-wrapper {
      background: transparent !important;
    }

    /* Sidebar dibuat sedikit transparan dengan warna gelap */
    .main-sidebar {
      background: rgba(0, 0, 0, 0.85) !important;
    }

    /* Footer dengan background transparan dan warna teks yang lembut */
    .main-footer {
      background: rgba(255, 255, 255, 0.1);
      color: #ddd;
    }

    /* Scrollbar custom halus untuk browser Webkit */
    ::-webkit-scrollbar {
      width: 6px;
    }
    ::-webkit-scrollbar-thumb {
      background-color: rgba(0,0,0,0.2);
      border-radius: 10px;
    }
  </style>

  {{-- Tempat sisip style khusus halaman, misal: @push('styles') di child view --}}
  @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar atas -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <!-- Tombol toggle sidebar -->
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <!-- Link Home -->
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/') }}" class="nav-link">Home</a>
      </li>
    </ul>
  </nav>

  <!-- Sidebar kiri -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo / brand -->
    <a href="{{ url('/') }}" class="brand-link text-center">
      <i class="fas fa-tshirt ml-2 mr-2"></i>
      <span class="brand-text font-weight-light">Katalog Baju</span>
    </a>

    <!-- Menu sidebar -->
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
          <!-- Link ke halaman data produk -->
          <li class="nav-item">
            <a href="{{ route('produk.index') }}" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>Data Produk</p>
            </a>
          </li>
          <!-- Link ke halaman data kategori -->
          <li class="nav-item">
            <a href="{{ route('kategori.index') }}" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>Data Kategori</p>
            </a>
          </li>
          <!-- Link ke halaman daftar pesanan -->
          <li class="nav-item">
            <a href="{{ route('orders.index') }}" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>Lihat Pesanan</p>
            </a>
          </li>

          <!-- Link ke halaman Tim Developer -->
          <li class="nav-item">
            <a href="{{ url('/developer') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Tim Developer</p>
            </a>
          </li>

        </ul>
      </nav>
    </div>
  </aside>

  <!-- Area konten utama -->
  <div class="content-wrapper pt-3 px-3">
    @yield('content')
    <!-- Isi konten akan diisi oleh child views -->
  </div>

<!-- Skrip JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

{{-- Tempat sisip skrip khusus halaman --}}
@stack('scripts')
</body>
</html>
