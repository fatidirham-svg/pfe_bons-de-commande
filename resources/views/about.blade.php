@extends('layouts.app')

@section('content')

<style>

/* ===== GLOBAL ===== */
.about-container{
padding:40px;
max-width:1100px;
margin:auto;
font-family:'Inter',sans-serif;
}

/* ===== HERO ===== */
.hero{
text-align:center;
margin-bottom:40px;
animation:fadeIn 1s ease;
}

.hero h1{
font-size:34px;
font-weight:700;
}

.hero span{
color:#f59e0b;
}

.hero p{
margin-top:10px;
color:#666;
line-height:1.7;
}

/* ===== CARDS ===== */
.info-grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
margin-top:30px;
}

.card{
background:white;
padding:25px;
border-radius:18px;
box-shadow:0 10px 30px rgba(0,0,0,0.08);
transition:0.4s;
position:relative;
overflow:hidden;
}

.card:hover{
transform:translateY(-10px) scale(1.02);
box-shadow:0 20px 40px rgba(0,0,0,0.12);
}

/* glow effect */
.card::before{
content:"";
position:absolute;
width:200%;
height:200%;
background:radial-gradient(circle, rgba(245,158,11,0.15), transparent);
top:-50%;
left:-50%;
opacity:0;
transition:0.4s;
}

.card:hover::before{
opacity:1;
}

/* ===== SECTION ===== */
.section{
margin-top:50px;
display:grid;
grid-template-columns:2fr 1fr;
gap:30px;
align-items:center;
}

.section-box{
background:white;
padding:25px;
border-radius:18px;
box-shadow:0 10px 25px rgba(0,0,0,0.07);
animation:fadeUp 1s ease;
}

.quote{
background:#1f2937;
color:white;
padding:20px;
border-radius:18px;
font-style:italic;
}

/* ===== FEATURES ===== */
.features{
margin-top:40px;
background:#f1f5f9;
padding:30px;
border-radius:20px;
}

.feature{
display:flex;
gap:15px;
margin-bottom:20px;
transition:0.3s;
}

.feature:hover{
transform:translateX(10px);
}

.icon{
width:40px;
height:40px;
border-radius:10px;
display:flex;
align-items:center;
justify-content:center;
color:white;
}

.blue{background:#3b82f6;}
.orange{background:#f59e0b;}
.green{background:#22c55e;}

/* ===== CTA ===== */
.cta{
margin-top:50px;
background:linear-gradient(135deg,#fef3c7,#fde68a);
padding:30px;
border-radius:20px;
text-align:center;
animation:fadeUp 1.2s ease;
}

.cta button{
margin-top:15px;
padding:12px 20px;
border:none;
background:#111827;
color:white;
border-radius:10px;
cursor:pointer;
transition:0.3s;
}

.cta button:hover{
transform:scale(1.05);
background:#000;
}

/* ===== ANIMATIONS ===== */
@keyframes fadeIn{
from{opacity:0;transform:translateY(-20px);}
to{opacity:1;transform:translateY(0);}
}

@keyframes fadeUp{
from{opacity:0;transform:translateY(30px);}
to{opacity:1;transform:translateY(0);}
}

</style>

<div class="about-container">

<!-- HERO -->

<div class="hero">
<h1>Optimisez vos opérations avec <span>CommandFlow</span></h1>
<p>
Une solution intelligente conçue pour digitaliser la gestion des bons de commande
au sein de <strong>Attijari Intermédiation</strong>.
</p>
</div>

<!-- CARDS -->

<div class="info-grid">

<div class="card">
<small>Version</small>
<h3>1.0 (ATI)</h3>
<p>Solution optimisée pour le secteur financier</p>
</div>

<div class="card">
<small>Modules</small>
<h3>BC / Finance / ATI</h3>
<p>Gestion centralisée des opérations d’achat</p>
</div>

<div class="card">
<small>Technologie</small>
<h3>Laravel + JavaScript</h3>
<p>Performance, sécurité et flexibilité</p>
</div>

</div>

<!-- SECTION -->

<div class="section">

<div class="section-box">
<h3>💡 Expertise au cœur du marché financier</h3>
<p style="margin-top:10px;color:#555;line-height:1.7;">
CommandFlow accompagne <strong>Attijari Intermédiation</strong>
dans la transformation digitale de ses processus internes,
en améliorant la traçabilité, la rapidité et la conformité.
</p>
</div>

<div class="quote">
“Une solution stratégique pour une gestion moderne, rapide et sécurisée.”
</div>

</div>

<!-- FEATURES -->

<div class="features">

<h3>⚙️ Fonctionnalités Stratégiques</h3>

<div class="feature">
<div class="icon blue">📊</div>
<div>
<strong>Suivi des Bons de Commande</strong>
<p style="color:#666;">Visualisation claire et dynamique des opérations</p>
</div>
</div>

<div class="feature">
<div class="icon orange">⚡</div>
<div>
<strong>Analyse en Temps Réel</strong>
<p style="color:#666;">Prise de décision rapide et efficace</p>
</div>
</div>

<div class="feature">
<div class="icon green">🔐</div>
<div>
<strong>Conformité & Sécurité</strong>
<p style="color:#666;">Respect des normes financières strictes</p>
</div>
</div>

</div>

<!-- CTA -->

<div class="cta">
<h3>Besoin d’assistance ?</h3>
<p>Notre équipe est disponible pour vous accompagner</p>
<button>Contacter</button>
</div>

</div>

@endsection
