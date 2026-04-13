<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Dashboard BC</title>

<style>
body{
    margin:0;
    font-family: Arial, sans-serif;
    background:#f5f6f8;
}

/* HEADER */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 30px;
    background:white;
    border-bottom:1px solid #ddd;
}

.header h2{
    margin:0;
    font-size:18px;
}

.actions a{
    text-decoration:none;
    padding:10px 15px;
    border-radius:8px;
    font-size:13px;
    margin-left:10px;
}

.btn-red{
    background:#E30613;
    color:white;
}

.btn-dark{
    background:#111827;
    color:white;
}

/* CONTAINER */
.container{
    padding:30px;
}

/* GRID CARDS */
.grid{
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    gap:20px;
}

/* CARD */
.card{
    background:white;
    border-radius:12px;
    padding:20px;
    box-shadow:0 2px 8px rgba(0,0,0,0.05);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-3px);
}

.card h3{
    margin:0 0 10px 0;
    font-size:16px;
}

.card p{
    font-size:13px;
    color:#666;
}

/* special cards */
.card.dark{
    background:#111;
    color:white;
}

.card.gold{
    background:#c8a45d;
    color:white;
}

.btn-link{
    display:inline-block;
    margin-top:10px;
    text-decoration:none;
    font-size:13px;
    color:inherit;
    font-weight:bold;
}

/* image card */
.img-card img{
    width:100%;
    border-radius:10px;
}

</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <h2>Gestion des Bons de Commandes</h2>

    <div class="actions">
        <a href="{{ route('produits.create') }}" class="btn-red">+ Ajouter Produit</a>
        <a href="{{ route('fournisseurs.create') }}" class="btn-red">+ Ajouter Fournisseur</a>
        <a href="{{ route('bon_commandes.create') }}" class="btn-red">
    + Ajouter Bon de Commande
</a>
<form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button class="btn-dark" style="border:none;">Quitter</button>
</form>    </div>
</div>

<!-- CONTENT -->
<div class="container">

    <div class="grid">

        <div class="card gold">
            <h3>Saisie des Bons</h3>
            <p>Créer et gérer les commandes fournisseurs</p>
            <a href="#" class="btn-link">ACCÉDER →</a>
        </div>

        <div class="card dark">
            <h3>Listing & Suivi</h3>

        </div>

        <div class="card">
            <h3>Accompagner votre croissance</h3>
            <p>Optimisation des achats et performance</p>
            <a href="#" class="btn-link">Détails →</a>
        </div>

        <div class="card">
            <h3>Édition & Rapports</h3>
            <p>Générer PDF et statistiques</p>
            <a href="#" class="btn-link">ACCÉDER →</a>
        </div>

        <div class="card img-card">
            <img src="{{ asset('images/bc-illustration.png') }}" alt="">
        </div>

    </div>

</div>

</body>
</html>