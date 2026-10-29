<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin Keuangan KSR</title>
    <!-- Desain CSS Internal ala AdminLTE -->
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Arial, sans-serif; }
        body { display: flex; background-color: #f4f6f9; min-height: 100vh; }
        
        /* Sidebar (Menu Samping) */
        .sidebar { width: 250px; background-color: #343a40; color: #fff; display: flex; flex-direction: column; position: fixed; height: 100vh; }
        .sidebar-brand { padding: 20px; font-size: 1.2rem; font-weight: bold; text-align: center; background-color: #2e343a; border-bottom: 1px solid #4b545c; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .sidebar-menu { list-style: none; padding: 15px 0; flex-grow: 1; }
        .sidebar-menu li a { display: block; padding: 12px 20px; color: #c2c7d0; text-decoration: none; font-size: 0.95rem; border-left: 3px solid transparent; }
        .sidebar-menu li a:hover, .sidebar-menu li a.active { color: #fff; background-color: rgba(255,255,255,0.1); border-left-color: #dc3545; }
        .sidebar-footer { padding: 15px; text-align: center; background-color: #2e343a; font-size: 0.8rem; color: #868e96; }

        /* Konten Utama */
        .main-content { margin-left: 250px; flex-grow: 1; padding: 30px; width: calc(100% - 250px); }
        .page-title { font-size: 1.6rem; font-weight: 600; margin-bottom: 25px; color: #333; border-bottom: 2px solid #dee2e6; padding-bottom: 10px; }
        
        /* Komponen Global */
        .card { background: #fff; border-radius: 6px; box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2); padding: 20px; margin-bottom: 25px; border-top: 3px solid #6c757d; }
        .card-primary { border-top-color: #0d6efd; }
        .card-danger { border-top-color: #dc3545; }
        .card-success { border-top-color: #198754; }
        
        /* Tombol & Tabel */
        .btn { display: inline-block; padding: 8px 16px; font-weight: bold; border-radius: 4px; text-decoration: none; cursor: pointer; border: none; font-size: 0.9rem; }
        .btn-primary { background-color: #0d6efd; color: white; }
        .btn-danger { background-color: #dc3545; color: white; }
        .btn-dark { background-color: #212529; color: white; }
        .table { width: 100%; border-collapse: collapse; margin-top: 15px; background: #fff; }
        .table th, .table td { padding: 12px; border: 1px solid #dee2e6; text-align: left; }
        .table th { background-color: #f8f9fa; font-weight: bold; }
        
        /* Form */
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; font-size: 0.9rem; }
        .form-control { width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 0.9rem; }
    </style>
</head>
<body>

    <!-- SIDEBAR UTAMA -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('images/KSR.png') }}" style="width: 35px; height: auto;" alt="KSR">
            <span>Keuangan KSR</span>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}" class="{{ Request::is('/') ? 'active' : '' }}">📊 1. Dashboard Ringkas</a></li>
            <li><a href="{{ route('anggota.index') }}" class="{{ Request::is('anggota*') ? 'active' : '' }}">👥 2. Daftar Anggota</a></li>
            <li><a href="{{ route('kas.index') }}" class="{{ Request::is('kas*') ? 'active' : '' }}">💰 3. Input Uang Kas</a></li>
            <li><a href="{{ route('pengeluaran.index') }}" class="{{ Request::is('pengeluaran*') ? 'active' : '' }}">📉 4. Catat Pengeluaran</a></li>
            <li><a href="{{ route('logout') }}" style="color: #ffc107; font-weight: bold;">🚪 5. Keluar (Logout)</a></li>
        </ul>
        <div class="sidebar-footer">
            UKM KSR ASM ARIYANTI©2026
        </div>
    </div>

    <!-- AREA KONTEN DARI HALAMAN LAIN -->
    <div class="main-content">
        @yield('content')
    </div>

</body>
</html>
