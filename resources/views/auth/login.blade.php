<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Se connecter</title>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    display: flex;
    height: 100vh;
}

/* Left side */
.left {
    width: 50%;
    background: #092c4c
    color: white;
    padding: 60px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.logo {
    width: 120px;
    margin-bottom: 30px;
}

.left h1 {
    font-size: 40px;
}

.left span {
    color: #daa412;
}

/* Right side */
.right {
    width: 50%;
    background: #f5f5f5;
    display: flex;
    justify-content: center;
    align-items: center;
}

.form-box {
    width: 320px;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0px 5px 20px rgba(0,0,0,0.1);
}

.form-logo {
    width: 80px;
    display: block;
    margin: 0 auto 20px;
}

input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
}

button {
    width: 100%;
    padding: 12px;
    background: #0d3b66;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

button:hover {
    background: #092c4c;
}

.error {
    color: red;
    margin-bottom: 10px;
}
</style>
</head>
<body>

<div class="left">
    <!-- Logo -->
    <img src="{{ asset('images/image.png') }}" class="logo" alt="logo">

    <h1>Simplifiez votre gestion de <span>Bons de Commande</span></h1>
    <p>Accédez à votre espace sécurisé pour gérer vos commandes بسهولة.</p>
</div>

<div class="right">
    <div class="form-box">

        <!-- Logo (optionnel) -->
        <img src="{{ asset('images/attijari-logo.png') }}" class="form-logo" alt="logo">

        <h2>Se connecter</h2>

        @if($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Mot de passe" required>

            <button type="submit">Se connecter</button>
        </form>

        <p>Pas encore de compte ? <a href="{{ route('register') }}">S'inscrire</a></p>
    </div>
</div>

</body>
</html>