<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Gestion BC</title>

<style>
body{
    margin:0;
    font-family: Arial, sans-serif;
    color:#111827;
}

/* NAVBAR */
.navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 60px;
    background:rgb(236, 149, 19);
    border-bottom:1px solid #ffffff;
}

.navbar a{
    text-decoration:none;
    margin-left:15px;
    color:#111827;
    font-weight:500;
}

.btn-register{
    background:#ffcd27;
;
    color:white;
    padding:8px 14px;
    border-radius:6px;
}

/* HERO */
.hero{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:70px 60px;
}

.hero-text{
    max-width:520px;
}

.hero-text h1{
    font-size:42px;
    margin-bottom:15px;
}

.hero-text span{
    color:#ffcd27;
}

.hero-text p{
    color:#6b7280;
    line-height:1.6;
}

/* BUTTONS */
.buttons{
    margin-top:20px;
}

.btn{
    display:inline-block;
    padding:12px 16px;
    border-radius:6px;
    text-decoration:none;
    margin-right:10px;
    font-weight:500;
}

.btn-primary{
    background:#ffcd27;
    color:white;
}

.btn-outline{
    border:1px solid #d1d5db;
    color:#111827;
}

/* IMAGE */
.hero img{
    width:420px;
    border-radius:10px;
    border:1px solid #eee;
}

/* STATS */
.stats{
    display:flex;
    gap:40px;
    margin-top:25px;
    font-size:14px;
    color:#6b7280;
}

.stats strong{
    display:block;
    color:#111827;
    font-size:16px;
}

/* SECTION */
.section{
    text-align:center;
    padding:60px;
}

.cards{
    display:flex;
    justify-content:center;
    gap:20px;
    margin-top:25px;
}

.card{
    width:240px;
    padding:18px;
    border:1px solid #eee;
    border-radius:8px;
    text-align:left;
}

.card h3{
    margin-bottom:10px;
}

/* CTA */
.cta{
    margin:60px;
    padding:40px;
    background:#111827;
    color:white;
    border-radius:10px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.cta a{
    text-decoration:none;
    padding:10px 14px;
    border-radius:6px;
    margin-left:10px;
}

.cta .red{
    background:#ffcd27;
    color:white;
}

.cta .white{
    border:1px solid white;
    color:white;
}

/* FOOTER */
footer{
    text-align:center;
    padding:30px;
    font-size:14px;
    color:#6b7280;
    border-top:1px solid #eee;
}

footer a{
    margin:0 10px;
    color:#6b7280;
    text-decoration:none;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div><strong>Gestion BC</strong></div>

    <div>
        <a href="{{ route('login') }}">Se connecter</a>
        <a href="{{ route('register') }}" class="btn-register">S'inscrire</a>
    </div>
</div>

<!-- HERO -->
<div class="hero">

    <div class="hero-text">
        <h1>Gestion simple de vos <span>bons de commande</span></h1>

        <p>
            Plateforme professionnelle pour gérer vos bons de commande,
            suivre vos opérations et améliorer votre productivité.
        </p>

        <div class="buttons">
            <a href="{{ route('register') }}" class="btn btn-primary">Commencer</a>
            <a href="{{ route('login') }}" class="btn btn-outline">Se connecter</a>
        </div>

        <div class="stats">
            <div><strong>2k+</strong> Utilisateurs</div>
            <div><strong>99%</strong> Satisfaction</div>
            <div><strong>MAD 50M+</strong> Transactions</div>
        </div>
    </div>

    <div>
        <img src="{{ asset('images/image.png') }}" alt="">
    </div>

</div>

<!-- FEATURES 1 -->
<div class="section">
    <h2>Pourquoi nous choisir ?</h2>

    <div class="cards">

        <div class="card">
            <h3>Rapidité</h3>
            <p>Création rapide des bons de commande.</p>
        </div>

        <div class="card">
            <h3>Sécurité</h3>
            <p>Données protégées et fiables.</p>
        </div>

        <div class="card">
            <h3>Analyse</h3>
            <p>Suivi intelligent des opérations.</p>
        </div>

    </div>
</div>

<!-- FEATURES 2 -->
<div class="section">
    <h2>Fonctionnalités principales</h2>

    <div class="cards">

        <div class="card">
            <h3>Accès partout</h3>
            <p>Disponible sur tous les appareils.</p>
        </div>

        <div class="card">
            <h3>Multi-utilisateurs</h3>
            <p>Gestion collaborative des équipes.</p>
        </div>

        <div class="card">
            <h3>Paiement intégré</h3>
            <p>Gestion simplifiée des opérations.</p>
        </div>

    </div>
</div>

<!-- CTA -->
<div class="cta">
    <div>
        <h2>Prêt à commencer ?</h2>
        <p>Créez votre compte et commencez à gérer vos bons de commande.</p>
    </div>

    <div>
        <a href="{{ route('register') }}" class="red">Créer compte</a>
        <a href="{{ route('login') }}" class="white">Connexion</a>
    </div>
</div>

<!-- FOOTER -->
<footer>
    <div><strong>Gestion BC</strong></div>

    <div>© 2026 Tijariwafa Bank. Tous droits réservés.</div>

    <div style="margin-top:10px;">
        <a href="#">Confidentialité</a>
        <a href="#">Conditions</a>
        <a href="#">Contact</a>
    </div>
</footer>

</body>
</html>