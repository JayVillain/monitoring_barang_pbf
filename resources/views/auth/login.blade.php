<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | StockMaster</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg-body: #f3f4f6;
            --text-main: #1f2937;
            --white: #ffffff;
        }

        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: radial-gradient(circle at top left, #e0e7ff, var(--bg-body));
        }

        .login-card {
            background: var(--white);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 8px;
            display: block;
            text-decoration: none;
        }

        h2 {
            font-size: 1.25rem;
            color: var(--text-main);
            margin-bottom: 24px;
            font-weight: 600;
        }

        .form-group {
            text-align: left;
            margin-bottom: 16px;
        }

        label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #4b5563;
            display: block;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.2s;
            outline: none;
        }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        button {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 10px;
        }

        button:hover {
            background: var(--primary-hover);
        }

        .error-msg {
            background: #fef2f2;
            color: #991b1b;
            padding: 10px;
            border-radius: 6px;
            font-size: 0.85rem;
            margin-bottom: 16px;
            border: 1px solid #fee2e2;
        }

        .footer-text {
            margin-top: 24px;
            font-size: 0.8rem;
            color: #9ca3af;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="logo"> StockMaster</div>
        <h2>Selamat Datang Kembali</h2>

        @if($errors->any())
            <div class="error-msg">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Alamat Email</label>
                <input type="email" name="email" placeholder="contoh@mail.com" required autofocus>
            </div>

            <div class="form-group">
                <label>Kata Sandi</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit">Masuk ke Sistem</button>
        </form>

        <div class="footer-text">
            &copy; 2026 StockMaster v1.0 <br>
            Inventory Management System
        </div>
    </div>

</body>
</html>