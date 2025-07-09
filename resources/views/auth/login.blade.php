<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login – Katalog Baju</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
      background: linear-gradient(145deg, #e8edf2, #dfe5ec);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-card {
      background: rgba(255, 255, 255, 0.6);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 16px;
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
      padding: 40px 32px;
      width: 100%;
      max-width: 400px;
    }

    .login-card h3 {
      font-weight: 600;
      text-align: center;
      margin-bottom: 28px;
      color: #222;
    }

    .form-control {
      background-color: rgba(255,255,255,0.85);
      border: 1px solid #ced4da;
      padding: 12px;
      font-size: 14px;
      border-radius: 8px;
      color: #333;
    }

    .form-control:focus {
      border-color: #4f8ef7;
      box-shadow: 0 0 0 0.15rem rgba(79, 142, 247, 0.25);
    }

    .btn-login {
      background-color: #4f8ef7;
      border: none;
      font-weight: 600;
      padding: 12px;
      border-radius: 8px;
      color: #fff;
      transition: background 0.3s;
    }

    .btn-login:hover {
      background-color: #3a75d1;
    }

    .form-link {
      margin-top: 20px;
      font-size: 14px;
      text-align: center;
      color: #444;
    }

    .form-link a {
      color: #4f8ef7;
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

  <form method="POST" action="{{ url('/login') }}" class="login-card">
    @csrf
    <h3>Masuk ke Akun</h3>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="mb-3">
      <input type="text" name="email" class="form-control" placeholder="Email atau Username" required>
    </div>

    <div class="mb-3">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>

    <button type="submit" class="btn btn-login w-100">Login</button>

    <div class="form-link">
      Belum punya akun? <a href="{{ url('/register') }}">Daftar Sekarang</a>
    </div>
  </form>

</body>
</html>
