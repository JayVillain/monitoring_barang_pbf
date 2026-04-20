<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMaster - Monitoring Barang</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg-body: #f9fafb;
            --bg-sidebar: #ffffff;
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --white: #ffffff;
            --danger: #ef4444;
            --success: #10b981;
            --warning: #f59e0b;
        }

        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

        body { 
            margin: 0; 
            display: flex; 
            background-color: var(--bg-body); 
            color: var(--text-main); 
        }

        /* Sidebar Modern */
        .sidebar { 
            width: 260px; 
            height: 100vh; 
            background: var(--bg-sidebar); 
            border-right: 1px solid var(--border);
            padding: 24px; 
            position: fixed;
            display: flex;
            flex-direction: column;
        }

        .sidebar h3 { 
            font-size: 1.25rem; 
            font-weight: 700; 
            color: var(--primary);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
        }

        .user-info {
            background: #f3f4f6;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 24px;
        }

        .user-info p { margin: 0; font-size: 0.875rem; font-weight: 500; }
        .user-info span { font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; }

        .sidebar a { 
            color: var(--text-main); 
            text-decoration: none; 
            padding: 12px 16px; 
            border-radius: 8px;
            font-size: 0.95rem;
            margin-bottom: 4px;
            transition: all 0.2s;
            display: block;
        }

        .sidebar a:hover { background: #f3f4f6; color: var(--primary); }
        .sidebar a.active { background: var(--primary); color: white; }

        /* Main Content area */
        .main-content { 
            margin-left: 260px; 
            padding: 40px; 
            width: calc(100% - 260px); 
            min-height: 100vh;
        }

        /* Card Style */
        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        /* Table Modern */
        table { 
            width: 100%; 
            border-collapse: separate; 
            border-spacing: 0; 
            margin-top: 20px; 
        }

        th { 
            background-color: #f9fafb; 
            padding: 12px 16px; 
            font-size: 0.75rem; 
            text-transform: uppercase; 
            letter-spacing: 0.05em;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
            text-align: left;
        }

        td { 
            padding: 16px; 
            font-size: 0.875rem;
            border-bottom: 1px solid var(--border);
        }

        tr:hover { background-color: #fcfcfd; }

        /* Buttons */
        .btn { 
            padding: 10px 18px; 
            border-radius: 8px; 
            font-size: 0.875rem; 
            font-weight: 600;
            cursor: pointer; 
            border: none; 
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-hover); }

        .btn-danger { background: #fee2e2; color: var(--danger); }
        .btn-danger:hover { background: #fecaca; }

        /* Badge Style */
        .badge {
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .badge-warning { background: #fef3c7; color: #92400e; }

        /* Form Controls */
        input, select, textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.875rem;
            outline: none;
            transition: border 0.2s;
        }

        input:focus, select:focus { border-color: var(--primary); ring: 2px solid var(--primary); }

        .logout-btn {
            margin-top: auto;
            padding-top: 20px;
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <h3> StockMaster</h3>
        
        <div class="user-info">
            <p>{{ Auth::user()->name }}</p>
            <span>{{ Auth::user()->role }} Account</span>
        </div>

        <nav>
            <a href="{{ route('items.index') }}" class="{{ request()->is('items*') ? 'active' : '' }}">Daftar Barang</a>
            <a href="{{ route('transactions.index') }}" class="{{ request()->is('transactions*') ? 'active' : '' }}">Monitoring Stok</a>
        </nav>

        <div class="logout-btn">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger" style="width: 100%;">Logout</button>
            </form>
        </div>
    </div>

    <div class="main-content">
        @yield('content')
    </div>
</body>
</html>