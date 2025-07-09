@extends('layout.template')

@section('title', 'Tim Developer')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #ffffff;
  }

  .content-wrapper {
    background: transparent !important;
  }

  h2 {
    font-weight: 600;
    color: #333;
    margin-bottom: 2rem;
  }

  .developer-card {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(6px);
    border-radius: 20px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    overflow: hidden;
    animation: float 6s ease-in-out infinite;
    transition: transform 0.3s;
    box-shadow: 0 0 15px rgba(0,0,0,0.05);
  }

  .developer-card:hover {
    transform: translateY(-6px);
  }

  .developer-img {
    height: 230px;
    object-fit: cover;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
  }

  .developer-name {
    font-size: 1.2rem;
    font-weight: 600;
    color: #000;
  }

  .developer-role {
    font-size: 0.95rem;
    color: #444;
  }

  .social-icons a {
    color: #333;
    margin: 0 8px;
    font-size: 1.2rem;
    transition: color 0.3s;
  }

  .social-icons a:hover {
    color: #007bff;
  }

  @keyframes float {
    0%, 100% { transform: translateY(0); }
    50%      { transform: translateY(-8px); }
  }

  @keyframes glow-purple {
    0%,100% { box-shadow: 0 0 8px #a855f7; }
    50%     { box-shadow: 0 0 20px #a855f7; }
  }

  @keyframes glow-red {
    0%,100% { box-shadow: 0 0 8px #ef4444; }
    50%     { box-shadow: 0 0 20px #ef4444; }
  }

  @keyframes glow-yellow {
    0%,100% { box-shadow: 0 0 8px #facc15; }
    50%     { box-shadow: 0 0 20px #facc15; }
  }

  @keyframes glow-blue {
    0%,100% { box-shadow: 0 0 8px #38bdf8; }
    50%     { box-shadow: 0 0 20px #38bdf8; }
  }

  .purple { animation: float 6s ease-in-out infinite, glow-purple 4s ease-in-out infinite; }
  .red    { animation: float 6s ease-in-out infinite, glow-red    4s ease-in-out infinite; }
  .yellow { animation: float 6s ease-in-out infinite, glow-yellow 4s ease-in-out infinite; }
  .blue   { animation: float 6s ease-in-out infinite, glow-blue   4s ease-in-out infinite; }
</style>
@endpush

@section('content')
<div class="container py-4">
  <h2 class="text-center">👥 Tim Pengembang</h2>
  <div class="row justify-content-center">

    @php
      $developers = [
        [
          'nama'=>'Doni',
          'gambar'=>'foto3.jpg',
          'peran'=>'Project Manager',
          'icon'=>'fas fa-briefcase',
          'kelas'=>'purple',
          'wa' => 'xxxxxxxxx',
          'ig' => 'xxxxxxxxx'
        ],
        [
          'nama'=>'Renal',
          'gambar'=>'foto2.jpg',
          'peran'=>'Frontend Developer',
          'icon'=>'fas fa-laptop-code',
          'kelas'=>'red',
          'wa' => 'xxxxxxxxx',
          'ig' => 'xxxxxxxxxx'
        ],
        [
          'nama'=>'Yusuf',
          'gambar'=>'foto4.jpg',
          'peran'=>'Backend Developer',
          'icon'=>'fas fa-database',
          'kelas'=>'yellow',
          'wa' => 'xxxxxxx',
          'ig' => 'xxxxxxxx'
        ],
        [
          'nama'=>'Dafi',
          'gambar'=>'foto1.jpg',
          'peran'=>'Perancang & Database',
          'icon'=>'fas fa-pencil-ruler',
          'kelas'=>'blue',
          'wa' => 'xxxxxxxxx',
          'ig' => 'xxxxxxxxx'
        ],
      ];
    @endphp

    @foreach ($developers as $dev)
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
      <div class="card developer-card {{ $dev['kelas'] }} w-100 text-center">
        <img src="{{ asset('storage/developer/' . $dev['gambar']) }}" class="card-img-top developer-img" alt="{{ $dev['nama'] }}">
        <div class="card-body">
          <div class="developer-name">{{ $dev['nama'] }}</div>
          <div class="developer-role">
            <i class="{{ $dev['icon'] }} developer-icon"></i>{{ $dev['peran'] }}
          </div>
          <div class="social-icons mt-3">
            <a href="https://wa.me/{{ $dev['wa'] }}" target="_blank" title="WhatsApp">
              <i class="fab fa-whatsapp"></i>
            </a>
            <a href="https://instagram.com/{{ $dev['ig'] }}" target="_blank" title="Instagram">
              <i class="fab fa-instagram"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    @endforeach

  </div>
</div>
@endsection
