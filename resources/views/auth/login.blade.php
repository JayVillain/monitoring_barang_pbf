<!DOCTYPE html>
<html>
<head>
    <title>Login - Monitoring Barang</title>
    <style>
        body { display: flex; justify-content: center; align-items: center; height: 100vh; background: #f0f2f5; }
        .login-box { background: white; padding: 30px; border-radius: 8px; shadow: 0 4px 6px rgba(0,0,0,0.1); width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2 style="text-align: center;">Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Masuk</button>
        </form>
        @if($errors->any())
            <p style="color: red; font-size: 12px;">{{ $errors->first() }}</p>
        @endif
    </div>
</body>
</html>