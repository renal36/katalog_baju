<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login – Katalog Baju</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <!-- FontAwesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #c4dfff, #f5d0ff);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
    }

    .login-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(14px);
      border-radius: 16px;
      padding: 40px 32px;
      max-width: 420px;
      width: 100%;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .login-icon {
      font-size: 48px;
      color: #6a67ce;
      text-align: center;
      margin-bottom: 10px;
    }

    h3 {
      font-weight: 600;
      text-align: center;
      color: #1f1f1f;
      margin-bottom: 28px;
    }

    .input-group-text {
      background: #fff;
      border: 1px solid #ced4da;
      border-right: none;
      border-radius: 8px 0 0 8px;
    }

    .form-control {
      border: 1px solid #ced4da;
      border-left: none;
      border-radius: 0 8px 8px 0;
    }

    .form-control:focus {
      border-color: #6a67ce;
      box-shadow: 0 0 0 0.1rem rgba(106, 103, 206, 0.25);
    }

    .btn-login {
      background: linear-gradient(135deg, #6a67ce, #fc5c7d);
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-weight: 600;
      color: white;
      margin-top: 10px;
    }

    .btn-login:hover {
      background: linear-gradient(135deg, #5a54b1, #e84e6a);
    }

    .form-link {
      margin-top: 20px;
      font-size: 14px;
      text-align: center;
      color: #333;
    }

    .form-link a {
      color: #6a67ce;
      text-decoration: none;
      font-weight: 500;
    }

    .alert {
      font-size: 13px;
    }
  </style>
</head>
<body>

  <form method="POST" action="{{ url('/login') }}" class="login-card">
    @csrf

    <div class="login-icon">
      <i class="fas fa-user-circle"></i>
    </div>

    <h3>Masuk ke Akun</h3>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <!-- Kolom Email dengan Ikon -->
    <div class="mb-3 input-group">
      <span class="input-group-text">
        <i class="fas fa-envelope"></i>
      </span>
      <input type="text" name="email" class="form-control" placeholder="Email atau Username" required>
    </div>

    <!-- Kolom Password dengan Ikon -->
    <div class="mb-3 input-group">
      <span class="input-group-text">
        <i class="fas fa-lock"></i>
      </span>
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>

    <button type="submit" class="btn btn-login w-100">Login</button>

    <div class="form-link">
      Belum punya akun? <a href="{{ url('/register') }}">Daftar Sekarang</a>
    </div>
  </form>

</body>
</html>
