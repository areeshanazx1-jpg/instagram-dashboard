<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Instagram Admin Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand-primary: #4338ca;
            --brand-primary-light: #6366f1;
            --brand-primary-dark: #3730a3;
            --brand-accent: #0ea5e9;
            --bg-page: #eef1f8;
            --bg-soft: #f8fafc;
            --text-dark: #1e1b3a;
            --text-muted: #6b7280;
            --border-soft: #e5e7eb;
            --shadow-soft: 0 1px 3px rgba(30, 27, 58, 0.06), 0 1px 2px rgba(30, 27, 58, 0.04);
            --shadow-hover: 0 12px 24px -8px rgba(67, 56, 202, 0.18);
            --shadow-nav: 0 4px 20px rgba(67, 56, 202, 0.15);
            --radius-lg: 16px;
            --radius-md: 10px;
        }

        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand, .card-title {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-page);
            background-image:
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.06) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(14, 165, 233, 0.06) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== Navbar ===== */
        .navbar {
            background: linear-gradient(100deg, #3730a3 0%, #4338ca 45%, #4f46e5 100%) !important;
            box-shadow: var(--shadow-nav);
            padding: 0.9rem 1.75rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.28rem;
            letter-spacing: 0.2px;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            color: #ffffff !important;
        }

        .navbar-brand .brand-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.16);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            backdrop-filter: blur(4px);
        }

        .navbar-nav {
            gap: 0.25rem;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            font-size: 0.92rem;
            padding: 0.55rem 1.1rem !important;
            border-radius: var(--radius-md);
            transition: background-color 0.2s ease, color 0.2s ease, transform 0.15s ease;
            color: rgba(255, 255, 255, 0.82) !important;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.12);
            color: #ffffff !important;
        }

        .navbar-nav .nav-link.active {
            background-color: rgba(255, 255, 255, 0.95);
            color: var(--brand-primary) !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
        }

        .navbar-toggler {
            border: none;
            box-shadow: none !important;
            filter: invert(1) grayscale(1) brightness(2);
        }

        /* ===== Layout wrapper ===== */
        .app-content {
            flex: 1;
            width: 100%;
            max-width: 1320px;
            margin: 0 auto;
            padding: 2.25rem 1.5rem 3rem;
        }

        /* ===== Alerts ===== */
        .alert {
            border: none;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-soft);
            padding: 1rem 1.25rem;
            font-weight: 500;
            font-size: 0.92rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            color: #047857;
            border-left: 4px solid #10b981;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            color: #b91c1c;
            border-left: 4px solid #ef4444;
        }

        /* ===== Reusable card style (available to child views) ===== */
        .card {
            border: 1px solid var(--border-soft);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-soft);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-3px);
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
            padding: 0.4em 0.8em;
            border-radius: 20px;
            font-size: 0.78rem;
            letter-spacing: 0.3px;
        }

        .badge-pending  { background-color: #fef3c7; color: #92400e; }
        .badge-success  { background-color: #d1fae5; color: #065f46; }
        .badge-failed   { background-color: #fee2e2; color: #991b1b; }

        /* ===== Buttons ===== */
        .btn-primary {
            background: linear-gradient(100deg, var(--brand-primary), var(--brand-primary-light));
            border: none;
            font-weight: 600;
            border-radius: var(--radius-md);
            box-shadow: 0 4px 12px rgba(67, 56, 202, 0.28);
            transition: box-shadow 0.2s ease, transform 0.15s ease;
        }

        .btn-primary:hover {
            box-shadow: 0 6px 16px rgba(67, 56, 202, 0.38);
            transform: translateY(-1px);
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
            padding: 1.1rem 1.5rem;
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
                <span class="brand-icon"><i class="fab fa-instagram"></i></span>
                Instagram Dashboard
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