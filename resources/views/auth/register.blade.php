<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Register – Katalog Baju</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap & FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

  <style>
    body {
      background: linear-gradient(135deg, #c4dfff, #f5d0ff);
      font-family: 'Inter', sans-serif;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
    }

    .register-card {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(16px);
      padding: 40px 32px;
      border-radius: 16px;
      max-width: 450px;
      width: 100%;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      animation: fadeIn 0.7s ease forwards;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .register-card h3 {
      text-align: center;
      font-weight: 600;
      margin-bottom: 28px;
      color: #1f1f1f;
    }

    .input-group {
      margin-bottom: 20px;
    }

    .input-group .form-control {
      padding: 12px 16px 12px 42px;
      font-size: 14px;
      border-radius: 10px;
      border: 1px solid #ccc;
    }

    .input-group .input-group-text {
      position: absolute;
      z-index: 2;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: transparent;
      border: none;
      color: #6a67ce;
    }

    .form-control:focus {
      border-color: #6a67ce;
      box-shadow: 0 0 0 0.15rem rgba(106, 103, 206, 0.25);
      outline: none;
    }

    .btn-custom {
      background: linear-gradient(135deg, #6a67ce, #fc5c7d);
      color: white;
      font-weight: 600;
      padding: 12px;
      width: 100%;
      border-radius: 10px;
      border: none;
      transition: 0.3s;
    }

    .btn-custom:hover {
      background: linear-gradient(135deg, #5a54b1, #e84e6a);
    }

    .form-link {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: #333;
    }

    .form-link a {
      color: #6a67ce;
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

    .position-relative {
      position: relative;
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

    <div class="position-relative input-group">
      <span class="input-group-text"><i class="fa fa-user"></i></span>
      <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required />
    </div>

    <div class="position-relative input-group">
      <span class="input-group-text"><i class="fa fa-envelope"></i></span>
      <input type="text" name="email" class="form-control" placeholder="Email atau Username" required />
    </div>

    <div class="position-relative input-group">
      <span class="input-group-text"><i class="fa fa-lock"></i></span>
      <input type="password" name="password" class="form-control" placeholder="Password" required />
    </div>

    <div class="position-relative input-group">
      <span class="input-group-text"><i class="fa fa-lock"></i></span>
      <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required />
    </div>

    <button type="submit" class="btn btn-custom">Daftar</button>

    <div class="form-link">
      Sudah punya akun? <a href="{{ url('/login') }}">Login Sekarang</a>
    </div>
  </form>

</body>
</html>
