<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Barang</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; display: flex; }
        .sidebar { width: 250px; height: 100vh; background: #333; color: #fff; padding: 20px; position: fixed; }
        .sidebar a { color: #fff; text-decoration: none; display: block; padding: 10px 0; border-bottom: 1px solid #444; }
        .main-content { margin-left: 290px; padding: 20px; width: 100%; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 8px 12px; text-decoration: none; border-radius: 4px; cursor: pointer; border: none; }
        .btn-blue { background: #007bff; color: white; }
        .btn-red { background: #dc3545; color: white; }
        .btn-green { background: #28a745; color: white; }
        .alert { padding: 10px; background: #d4edda; color: #155724; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Monitoring</h3>
        <p>Halo, {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})</p>
        <hr>
        <a href="{{ route('items.index') }}">Daftar Barang</a>
        <a href="{{ route('transactions.index') }}">Riwayat Transaksi</a>
        <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
            @csrf
            <button type="submit" class="btn btn-red" style="width: 100%;">Logout</button>
        </form>
    </div>

    <div class="main-content">
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>