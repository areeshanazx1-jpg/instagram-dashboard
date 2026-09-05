<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Instagram Admin Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --ig-purple: #833AB4;
            --ig-pink: #C13584;
            --ig-orange: #F77737;
            --ig-yellow: #FCAF45;
            --bg-soft: #F4F6F9;
            --text-dark: #212529;
            --text-muted: #6c757d;
            --border-soft: #e9ecef;
            --shadow-soft: 0 4px 20px rgba(0, 0, 0, 0.06);
            --shadow-hover: 0 8px 28px rgba(0, 0, 0, 0.10);
            --radius-lg: 14px;
            --radius-md: 10px;
        }

        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand, .card-title {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-soft);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== Navbar ===== */
        .navbar {
            background: linear-gradient(90deg, var(--ig-purple) 0%, var(--ig-pink) 50%, var(--ig-orange) 100%) !important;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.12);
            padding: 0.85rem 1.5rem;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: 0.3px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand i {
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: var(--radius-md);
            transition: background-color 0.2s ease, transform 0.15s ease;
            color: rgba(255, 255, 255, 0.92) !important;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background-color: rgba(255, 255, 255, 0.18);
            color: #fff !important;
        }

        .navbar-toggler {
            border: none;
            box-shadow: none !important;
        }

        /* ===== Layout wrapper ===== */
        .app-content {
            flex: 1;
            width: 100%;
            max-width: 1320px;
            margin: 0 auto;
            padding: 2rem 1.5rem 3rem;
        }

        /* ===== Alerts ===== */
        .alert {
            border: none;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-soft);
            padding: 0.9rem 1.2rem;
            font-weight: 500;
        }

        .alert-success {
            background-color: #e7f7ee;
            color: #157347;
            border-left: 4px solid #198754;
        }

        .alert-danger {
            background-color: #fdecea;
            color: #b02a37;
            border-left: 4px solid #dc3545;
        }

        /* ===== Reusable card style (available to child views) ===== */
        .card {
            border: 1px solid var(--border-soft);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-soft);
            transition: box-shadow 0.25s ease, transform 0.25s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-2px);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid var(--border-soft);
            font-weight: 600;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0 !important;
        }

        /* ===== Status badges ===== */
        .badge-status {
            font-weight: 600;
            padding: 0.4em 0.75em;
            border-radius: 20px;
            font-size: 0.78rem;
            letter-spacing: 0.3px;
        }

        .badge-pending  { background-color: #fff3cd; color: #997404; }
        .badge-success  { background-color: #d1e7dd; color: #146c43; }
        .badge-failed   { background-color: #f8d7da; color: #b02a37; }

        /* ===== Buttons ===== */
        .btn-primary {
            background: linear-gradient(90deg, var(--ig-purple), var(--ig-pink));
            border: none;
            font-weight: 500;
            border-radius: var(--radius-md);
            transition: opacity 0.2s ease;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        .btn-outline-secondary {
            border-radius: var(--radius-md);
        }

        /* ===== Tables ===== */
        .table {
            background-color: #fff;
            border-radius: var(--radius-md);
            overflow: hidden;
        }

        .table thead th {
            background-color: #f8f9fb;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: var(--text-muted);
            border-bottom: 2px solid var(--border-soft);
        }

        /* ===== Footer ===== */
        .app-footer {
            background-color: #fff;
            border-top: 1px solid var(--border-soft);
            padding: 1rem 1.5rem;
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-muted);
        }
    </style>

    @stack('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fab fa-instagram"></i> Instagram Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-chart-line me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.accounts.*') ? 'active' : '' }}" href="{{ route('admin.accounts.index') }}">
                            <i class="fas fa-users-cog me-1"></i> Accounts
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="app-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-triangle-exclamation me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="app-footer">
        &copy; {{ date('Y') }} Instagram Account Management Dashboard — Built with Laravel
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>