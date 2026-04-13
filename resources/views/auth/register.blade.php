<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Créer un compte</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    display: flex;
    height: 100vh;
}

/* LEFT */
.left {
    width: 50%;
    background: linear-gradient(135deg, #E30613, #b8000f);
    color: white;
    padding: 50px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.left img {
    width: 260px;
    margin-bottom: 30px;
}

.left h1 {
    font-size: 36px;
}

.left span {
    color: #F4C430;
}

.left p {
    margin-top: 15px;
    line-height: 1.6;
}

/* RIGHT */
.right {
    width: 50%;
    background: #f9f9f9;
    display: flex;
    justify-content: center;
    align-items: center;
}

.form-box {
    width: 350px;
    background: white;
    padding: 35px;
    border-radius: 14px;
    box-shadow: 0px 8px 25px rgba(0,0,0,0.08);
}

.form-box h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #E30613;
}

input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ddd;
}

input:focus {
    border-color: #E30613;
    outline: none;
}

button {
    width: 100%;
    padding: 12px;
    background: #E30613;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background: #b8000f;
}

.error {
    color: red;
    margin-bottom: 10px;
}

.footer-text {
    margin-top: 15px;
    font-size: 13px;
    color: #666;
    text-align: center;
}
</style>
</head>

<body>

<!-- LEFT -->
<div class="left">
    <img src="{{ asset('images/bank-illustration.png') }}" alt="bank">

    <h1>Bienvenue chez <span>Attijariwafa Bank</span></h1>

    <p>
        Accédez à une plateforme sécurisée dédiée à la gestion de vos opérations.
        Suivez vos bons de commande, gérez vos transactions et bénéficiez d’un environnement fiable,
        conçu pour répondre aux exigences des professionnels.
    </p>
</div>

<!-- RIGHT -->
<div class="right">
    <div class="form-box">

        <h2>Créer un compte</h2>

        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text" name="name" placeholder="Nom complet" required>
            <input type="email" name="email" placeholder="Adresse email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required>

            <button type="submit">Créer mon compte</button>
        </form>

        <div class="footer-text">
            Vos données sont protégées وفق أعلى معايير الأمان البنكي.
        </div>

        <p style="text-align:center; margin-top:10px;">
            Déjà inscrit ? <a href="{{ route('login') }}">Se connecter</a>
        </p>

    </div>
</div>

</body>
</html>