<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register – Katalog Baju</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap & Font -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

  <style>
    body {
      background: linear-gradient(145deg, #e8edf2, #dfe5ec);
      font-family: 'Inter', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .register-card {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(15px);
      padding: 40px 32px;
      border-radius: 16px;
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
      width: 100%;
      max-width: 450px;
      animation: fadeInUp 0.8s ease forwards;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h3 {
      text-align: center;
      font-weight: 600;
      margin-bottom: 25px;
      color: #222;
    }

    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    .input-icon {
      position: absolute;
      top: 50%;
      left: 12px;
      transform: translateY(-50%);
      color: #3b82f6;
      font-size: 16px;
    }

    .form-control {
      padding-left: 40px;
      height: 45px;
      font-size: 14px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    .form-control:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 0.15rem rgba(59, 130, 246, 0.25);
      outline: none;
    }

    .btn-custom {
      background-color: #3b82f6;
      color: #fff;
      border: none;
      font-weight: 600;
      padding: 12px;
      width: 100%;
      border-radius: 8px;
      transition: background 0.3s ease;
    }

    .btn-custom:hover {
      background-color: #2563eb;
    }

    .form-link {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
    }

    .form-link a {
      color: #3b82f6;
      text-decoration: none;
      font-weight: 500;
    }

    .form-link a:hover {
      text-decoration: underline;
    }

    .alert {
      font-size: 13px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <form method="POST" action="{{ url('/register') }}" class="register-card">
    @csrf
    <h3>Buat Akun Baru</h3>

    @if($errors->any())
      <div class="alert alert-danger text-dark">
        {{ $errors->first() }}
      </div>
    @endif

    <div class="input-group">
      <i class="fa fa-user input-icon"></i>
      <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required />
    </div>

    <div class="input-group">
      <i class="fa fa-envelope input-icon"></i>
      <input type="text" name="email" class="form-control" placeholder="Email atau Username" required />
    </div>

    <div class="input-group">
      <i class="fa fa-lock input-icon"></i>
      <input type="password" name="password" class="form-control" placeholder="Password" required />
    </div>

    <div class="input-group">
      <i class="fa fa-lock input-icon"></i>
      <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required />
    </div>

    <button type="submit" class="btn btn-custom">Daftar</button>

    <div class="form-link">
      Sudah punya akun? <a href="{{ url('/login') }}">Login Sekarang</a>
    </div>
  </form>

</body>
</html>
