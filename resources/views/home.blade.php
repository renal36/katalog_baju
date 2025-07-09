@extends('layout.template')
@section('title', 'Katalog Produk')

@section('content')
<!-- Font Poppins + Font Awesome -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<style>
body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  background: #000;
  color: #fff;
  overflow-x: hidden;
}

/* Hero Section */
.hero-container {
  position: relative;
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  overflow: hidden;
  background: url('{{ asset('images/foto2.jpg') }}') center/cover no-repeat fixed;
  transition: opacity 0.6s ease;
}

.hero-container::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.55);
  z-index: 0;
}

/* Floating animation */
@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}

.section-title, .welcome-text {
  animation: float 2.5s ease-in-out infinite;
  z-index: 1;
  position: relative;
  text-shadow: 2px 2px 6px rgba(0,0,0,0.6);
}

.section-title {
  font-size: 2.8rem;
  font-weight: bold;
  margin-bottom: 20px;
  color: #fff;
}

.welcome-text {
  font-size: 1.2rem;
  max-width: 640px;
  margin-bottom: 35px;
  color: #f1f1f1;
}

/* Tombol Mulai Cari */
.btn-start {
  position: relative; /* ⬅️ Pastikan tombol berada di atas salju */
  display: inline-flex;
  align-items: center;
  gap: 10px;
  font-size: 1.1rem;
  padding: 14px 36px;
  border-radius: 50px;
  background: linear-gradient(135deg, #ff512f, #f09819);
  border: none;
  color: #fff;
  font-weight: 600;
  box-shadow: 0 0 15px rgba(255, 81, 47, 0.5), 0 8px 18px rgba(0,0,0,0.6);
  text-shadow: 1px 1px 2px rgba(0,0,0,0.6);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  z-index: 5; /* ⬅️ JAUH lebih tinggi dari .snow */
}
.btn-start:hover {
  transform: scale(1.08);
  box-shadow: 0 0 25px rgba(255, 81, 47, 0.8), 0 12px 28px rgba(0,0,0,0.7);
}

/* Snow particles */
.snow {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none; /* ⬅️ Tetap tidak blok input */
  z-index: 2;            /* ⬅️ DI BAWAH tombol */
  background: transparent;
}

.snow span {
  position: absolute;
  display: block;
  width: 6px;
  height: 6px;
  background: white;
  border-radius: 50%;
  opacity: 0.8;
  animation: snowfall 10s linear infinite;
}
@keyframes snowfall {
  0% { transform: translateY(-10px); }
  100% { transform: translateY(100vh); }
}

/* Footer */
.footer-copyright {
  background: #111;
  color: #ccc;
  padding: 18px 0;
  text-align: center;
  font-size: 0.95rem;
  letter-spacing: 0.5px;
}
.footer-copyright span {
  color: #ffc107;
}
</style>

<!-- JavaScript: Fade out + Salju -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('searchForm');
  const container = document.querySelector('.hero-container');

  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      container.style.opacity = '0';
      setTimeout(() => form.submit(), 500);
    });
  }

  // Snow effect
  const snowContainer = document.querySelector('.snow');
  for (let i = 0; i < 80; i++) {
    const snow = document.createElement('span');
    snow.style.left = Math.random() * 100 + 'vw';
    snow.style.animationDelay = Math.random() * 10 + 's';
    snow.style.animationDuration = (5 + Math.random() * 5) + 's';
    snowContainer.appendChild(snow);
  }
});
</script>

<!-- ========== Hero Section ========== -->
<div class="hero-container">
  <h2 class="section-title">
    Selamat Datang di Katalog <span style="color: #ffc107">Bajuin</span>
  </h2>
  <p class="welcome-text">
    Temukan berbagai pilihan baju pria, wanita, dan anak-anak yang cocok untuk gaya harianmu.
  </p>

  <form method="GET" action="{{ route('katalog') }}" id="searchForm">
    <button type="submit" class="btn-start">
      <i class="fas fa-store"></i> Mulai Cari Produk
    </button>
  </form>
</div>

<!-- Efek Salju -->
<div class="snow"></div>

<!-- Footer -->
<div class="footer-copyright">
  &copy; {{ date('Y') }} <span>Bajuin</span> - All Rights Reserved.
</div>
@endsection
