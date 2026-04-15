<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>CommandFlow</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body{
    margin:0;
    font-family:'Inter', sans-serif;
    background:#f6f7fb;
    display:flex;
}

/* SIDEBAR */
.sidebar{
    width:240px;
    background:white;
    height:100vh;
    padding:20px;
    border-right:1px solid #eee;
}

.logo{
    font-weight:600;
    font-size:18px;
    margin-bottom:30px;
}

.menu a{
    display:flex;
    align-items:center;
    gap:10px;
    padding:10px;
    margin-bottom:10px;
    border-radius:10px;
    text-decoration:none;
    color:#555;
    font-size:14px;
}

.menu a.active,
.menu a:hover{
    background:#eef2ff;
    color:#4f46e5;
}

/* MAIN */
.main{
    flex:1;
}

/* HEADER */
.header{
    background:white;
    padding:15px 25px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:1px solid #eee;
}

.btn{
    padding:10px 16px;
    border-radius:10px;
    border:none;
    cursor:pointer;
}

.btn-primary{
    background:#4f46e5;
    color:white;
}

/* CONTENT */
.container{
    padding:25px;
}

/* CARDS */
.cards{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:25px;
}

.card{
    background:white;
    padding:20px;
    border-radius:14px;
    box-shadow:0 6px 20px rgba(0,0,0,0.04);
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.card small{
    color:#888;
    font-size:13px;
}

.card h4{
    margin-top:6px;
    font-size:20px;
}

/* ICON */
.icon-box{
    width:42px;
    height:42px;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
}

.blue{background:#eef2ff;color:#4f46e5;}
.orange{background:#fff7ed;color:#ea580c;}
.green{background:#ecfdf5;color:#059669;}
.purple{background:#f5f3ff;color:#7c3aed;}

/* TABLE */
.table{
    background:white;
    border-radius:14px;
    padding:20px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    text-align:left;
    font-size:12px;
    color:#888;
    padding-bottom:10px;
}

td{
    padding:12px 0;
    border-top:1px solid #eee;
}

/* STATUS */
.status{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:500;
}

.valid{background:#d1fae5;color:#065f46;}
.pending{background:#fef3c7;color:#92400e;}
.refuse{background:#fee2e2;color:#991b1b;}
/* FORM CARD */
.container-box{
    background:white;
    padding:25px;
    border-radius:14px;
    box-shadow:0 6px 20px rgba(0,0,0,0.05);
}

/* GRID */
.form-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
}

/* INPUTS */
.form-group label{
    font-weight:600;
    margin-bottom:5px;
    display:block;
}

.form-group input,
.form-group select,
textarea{
    width:100%;
    padding:10px;
    border-radius:10px;
    border:1px solid #ddd;
    font-family:inherit;
}

/* LINE ITEMS */
.line-item{
    display:grid;
    grid-template-columns:2fr 1fr 1fr auto;
    gap:10px;
    margin-bottom:10px;
}

/* ADD BUTTON (DASHED) */
.add-line{
    margin-top:10px;
    border:2px dashed #4f46e5;
    padding:12px;
    text-align:center;
    border-radius:10px;
    color:#4f46e5;
    cursor:pointer;
    font-weight:600;
}

.add-line:hover{
    background:#eef2ff;
}

/* FOOTER */
.footer-bar{
    margin-top:20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.total{
    font-weight:600;
    font-size:16px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo">📦 CommandFlow</div>

    <div class="menu">
        <a href="{{'dashboard'}}" class="active">📊 Tableau de bord</a>
        <a href="{{ route('bon_commandes.index') }}">📄 Bons de commande</a>
        <a href="{{ route('fournisseurs.create') }}">👤 Fournisseurs</a>
        <a href="{{ route('produits.create') }}">📦 Produits</a>
    </div>
</div>

<!-- MAIN -->
<div class="main">

<div class="header">
    <h3>Bons de Commande</h3>

    <button class="btn btn-primary" onclick="openModal()">
        + Nouveau Bon
    </button>
</div>

<div class="container">
    @yield('content')
</div>

<!-- MODAL -->
<div id="typeModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">

    <div style="background:white; width:400px; margin:100px auto; padding:20px; border-radius:10px; text-align:center;">

        <h3>Choisir le type</h3>

        <a href="{{ route('bon_commandes.create', ['type'=>'finance']) }}" class="btn btn-primary" style="display:block; margin:10px;">
            Attijari Finance
        </a>

        <a href="{{ route('bon_commandes.create', ['type'=>'intermediation']) }}" class="btn" style="background:#22c55e;color:white;display:block;margin:10px;">
            Attijari Intermédiation
        </a>

        <a href="{{ route('bon_commandes.create', ['type'=>'management']) }}" class="btn" style="background:#111;color:white;display:block;margin:10px;">
            Attijari Management
        </a>

        <button onclick="closeModal()" style="margin-top:10px;">Fermer</button>

    </div>

</div>

</div>

<script>
function openModal(){
    document.getElementById('typeModal').style.display='block';
}
function closeModal(){
    document.getElementById('typeModal').style.display='none';
}
</script>

</body>
</html>