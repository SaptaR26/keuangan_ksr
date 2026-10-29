<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengurus KSR</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Arial, sans-serif; }
        body { background-color: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .box-login { background: #fff; padding: 35px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; border-top: 4px solid #dc3545; }
        
        .login-logo { text-align: center; margin-bottom: 20px; display: flex; flex-direction: column; align-items: center; gap: 10px; }
        .login-logo img { width: 65px; height: auto; }
        .login-logo h3 { color: #333; font-size: 1.3rem; font-weight: bold; }
        
        .form-group { margin-bottom: 18px; }
        label { display: block; margin-bottom: 6px; font-weight: bold; font-size: 0.85rem; color: #495057; }
        input { width: 100%; padding: 10px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 0.9rem; transition: border-color 0.15s ease-in-out; }
        input:focus { border-color: #dc3545; outline: 0; }
        
        .btn-login { width: 100%; padding: 11px; background-color: #dc3545; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 0.95rem; margin-top: 5px; transition: background-color 0.2s; }
        .btn-login:hover { background-color: #c82333; }
        
        .alert { background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 20px; font-size: 0.85rem; border: 1px solid #f5c6cb; text-align: center; }
    </style>
</head>
<body>

<div class="box-login">
    <div class="login-logo">
        <img src="{{ asset('images/KSR.png') }}" alt="Logo KSR">
        <h3>🔴 Login Pengurus KSR</h3>
    </div>

    <!-- Menampilkan Pesan Eror Jika Username/Password Salah -->
    @if(session('error'))
        <div class="alert">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('login.proses') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="btn-login">Masuk ke Sistem</button>
    </form>
</div>

</body>
</html>
