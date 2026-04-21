<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CommandFlow | Tijari Management</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --tijari-red: #e30613;
            --tijari-yellow: #ffb71b;
            --tijari-dark: #1a1a1a;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            display: flex;
            min-height: 100vh;
            color: var(--tijari-dark);
        }

        .sidebar {
            width: var(--sidebar-width);
            background: white;
            color: var(--tijari-dark);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            border-right: 1px solid #edf2f7;
        }

        .sidebar-brand {
            padding: 30px 20px;
            text-align: center;
            background: white;
        }

        .sidebar-brand img {
            width: 160px;
            object-fit: contain;
        }

        .nav-link {
            color: #64748b;
            padding: 14px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            transition: all 0.2s;
            text-decoration: none;
            border-radius: 0 50px 50px 0;
            margin-right: 15px;
        }

        .nav-link:hover {
            color: var(--tijari-red);
            background: rgba(227, 6, 19, 0.05);
        }

        .nav-link.active {
            color: white;
            background: var(--tijari-red);
            box-shadow: 0 4px 12px rgba(227, 6, 19, 0.2);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 18px;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            height: 80px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            border-bottom: 1px solid #edf2f7;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .page-container {
            padding: 40px;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            background: white;
        }

        .btn-tijari {
            background: var(--tijari-red);
            color: white;
            border: none;
            font-weight: 700;
            padding: 12px 24px;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .btn-tijari:hover {
            background: #c20510;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(227, 6, 19, 0.2);
        }

        .btn-outline-tijari {
            border: 2px solid var(--tijari-red);
            color: var(--tijari-red);
            font-weight: 700;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .btn-outline-tijari:hover {
            background: var(--tijari-red);
            color: white;
        }

        .badge-tijari-yellow {
            background: var(--tijari-yellow);
            color: var(--tijari-dark);
            font-weight: 800;
        }
    </style>

</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('images/attijari-logo.png') }}" alt="Tijari Logo">
        </div>

        <nav class="mt-4 flex-grow-1">
            <a href="{{ route('dashboard') }}" class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i> <span>Tableau de Bord</span>
            </a>
            
            <div class="px-4 py-3 text-uppercase small fw-bold text-muted" style="letter-spacing: 1px; font-size: 10px;">Opérations</div>
            
            <a href="{{ route('bon_commandes.index') }}" class="nav-link {{ Request::routeIs('bon_commandes.*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-invoice-dollar"></i> <span>Bons de Commande</span>
            </a>
            <a href="{{ route('produit.index') }}" class="nav-link {{ Request::routeIs('produit.*') ? 'active' : '' }}">
                <i class="fa-solid fa-box"></i> <span>Catalogue Produits</span>
            </a>
            <a href="{{ route('fournisseur.index') }}" class="nav-link {{ Request::routeIs('fournisseur.*') ? 'active' : '' }}">
                <i class="fa-solid fa-truck-ramp-box"></i> <span>Fournisseurs</span>
            </a>
        </nav>

        <div class="p-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-tijari w-100">
                    <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Déconnexion
                </button>
            </form>
        </div>
    </aside>

    <div class="main-content">
        <header class="top-navbar">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-tijari-red rounded-3 p-2 d-none d-md-block" style="width: 4px; height: 24px; background: var(--tijari-red);"></div>
                <h5 class="mb-0 fw-bold text-dark">@yield('title', 'Plateforme de Gestion')</h5>
            </div>
            
            <div class="d-flex align-items-center gap-4">
                <div class="dropdown">
                    <button class="btn btn-tijari dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-plus me-2"></i> Nouveau Bon
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2" style="border-radius: 15px;">
                        <li><a class="dropdown-item rounded-3 py-2" href="{{ route('bon_commandes.create', ['type'=>'finance']) }}"><i class="fa-solid fa-circle text-warning me-2" style="font-size: 10px;"></i> Attijari Finance</a></li>
                        <li><a class="dropdown-item rounded-3 py-2" href="{{ route('bon_commandes.create', ['type'=>'intermediation']) }}"><i class="fa-solid fa-circle text-success me-2" style="font-size: 10px;"></i> Attijari Intermédiation</a></li>
                        <li><a class="dropdown-item rounded-3 py-2" href="{{ route('bon_commandes.create', ['type'=>'management']) }}"><i class="fa-solid fa-circle text-dark me-2" style="font-size: 10px;"></i> Attijari Management</a></li>
                    </ul>
                </div>

                <div class="d-flex align-items-center gap-3 border-start ps-4">
                    <div class="text-end d-none d-sm-block">
                        <div class="small fw-bold text-dark">{{ Auth::user()->name }}</div>
                        <div class="small text-muted" style="font-size: 11px;">Gestionnaire</div>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" 
                         style="width: 45px; height: 45px; background: linear-gradient(135deg, var(--tijari-red), #c20510); border: 2px solid white;">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                </div>
            </div>
        </header>


        <main class="page-container">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')

</body>
</html>
l>