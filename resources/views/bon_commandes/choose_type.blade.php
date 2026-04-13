<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion BC</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: white;
            position: fixed;
            padding: 20px;
            border-right: 1px solid #eee;
        }

        .sidebar h4 {
            font-weight: bold;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            color: #555;
            text-decoration: none;
            border-radius: 10px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: #6c63ff;
            color: white;
        }

        .main {
            margin-left: 270px;
            padding: 30px;
        }

        .card-box {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .btn-purple {
            background: #6c63ff;
            color: white;
            border-radius: 10px;
        }

        .btn-purple:hover {
            background: #574fd6;
        }
    </style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4>📦 Gestion BC</h4>

    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        🏠 Tableau de bord
    </a>

    <a href="{{ route('bon-commandes.index') }}" class="{{ request()->routeIs('bon-commandes.*') ? 'active' : '' }}">
        📄 Bons de Commande
    </a>

    <a href="{{ route('clients.index') }}" class="{{ request()->routeIs('clients.*') ? 'active' : '' }}">
        👤 Clients
    </a>

    <a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}">
        ⚙️ Paramètres
    </a>

    <hr>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-danger w-100">Déconnexion</button>
    </form>
</div>

<!-- Main Content -->
<div class="main">

    <!-- Top Bar -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>Tableau de Bord</h3>
            <p class="text-muted">Bienvenue {{ Auth::user()->name }}, voici l'état de vos commandes</p>
        </div>

        <a href="{{ route('bon-commandes.create') }}" class="btn btn-purple">
            + Nouveau Bon de Commande
        </a>
    </div>

    <!-- Cards (تقدر تربطهم بالداتاباز من بعد) -->
    <div class="row">

        <div class="col-md-4">
            <div class="card-box">
                <h6>Total BC</h6>
                <h3>{{ $totalBC ?? 0 }}</h3>
                <span class="text-success">+12%</span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <h6>Validés</h6>
                <h3>{{ $validatedBC ?? 0 }}</h3>
                <span class="text-success">+5%</span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box">
                <h6>En attente</h6>
                <h3>{{ $pendingBC ?? 0 }}</h3>
                <span class="text-warning">-2%</span>
            </div>
        </div>

    </div>

    <!-- Content -->
    <div class="mt-4">
        @yield('content')
    </div>

</div>

</body>
</html>