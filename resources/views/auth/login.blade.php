<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | CommandFlow Tijari</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css'])

    <style>
        :root {
            --tijari-red: #e30613;
            --tijari-yellow: #ffb71b;
            --tijari-dark: #1a1a1a;
        }

        body {
            margin: 0;
            font-family: 'Outfit', sans-serif;
            display: flex;
            height: 100vh;
            background: #f8fafc;
        }

        .login-side {
            width: 40%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: white;
            z-index: 2;
            box-shadow: 20px 0 60px rgba(0,0,0,0.05);
        }

        .visual-side {
            width: 60%;
            background: linear-gradient(135deg, var(--tijari-red) 0%, #c20510 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px;
            color: white;
        }

        .visual-side::before {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            top: -100px;
            right: -100px;
        }

        .visual-content {
            position: relative;
            z-index: 1;
            max-width: 500px;
        }

        .visual-content h1 {
            font-size: 56px;
            font-weight: 800;
            margin-bottom: 24px;
            letter-spacing: -2px;
            line-height: 1.1;
        }

        .visual-content p {
            font-size: 20px;
            opacity: 0.9;
            line-height: 1.6;
        }

        .form-container {
            width: 100%;
            max-width: 400px;
        }

        .logo-box {
            margin-bottom: 48px;
        }

        .logo-box img {
            width: 180px;
        }

        h2 {
            font-size: 32px;
            font-weight: 700;
            color: var(--tijari-dark);
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 32px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: #475569;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            font-family: inherit;
            font-size: 15px;
            transition: all 0.2s;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: var(--tijari-red);
            background: white;
            box-shadow: 0 0 0 4px rgba(227, 6, 19, 0.1);
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: var(--tijari-red);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            box-shadow: 0 10px 20px rgba(227, 6, 19, 0.2);
        }

        .btn-submit:hover {
            background: #c20510;
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(227, 6, 19, 0.3);
        }

        .error-msg {
            background: #fef2f2;
            color: #dc2626;
            padding: 14px;
            border-radius: 12px;
            font-size: 14px;
            margin-bottom: 24px;
            border: 1px solid #fee2e2;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-text {
            text-align: center;
            margin-top: 32px;
            font-size: 14px;
            color: #64748b;
        }

        .footer-text a {
            color: var(--tijari-red);
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>
<body>

    <div class="login-side">
        <div class="form-container">
            <div class="logo-box">
                <img src="{{ asset('images/attijari-logo.png') }}" alt="Tijari Logo">
            </div>

            <h2>Espace Client</h2>
            <p class="subtitle">Connectez-vous pour gérer vos bons de commande en toute sécurité.</p>

            @if($errors->any())
                <div class="error-msg">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label>Adresse Email</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="email" placeholder="votre@email.com" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Mot de passe</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    Se connecter
                </button>
            </form>

            <p class="footer-text">
                Problème de connexion ? <a href="#">Contactez le support</a>
            </p>
        </div>
    </div>

    <div class="visual-side">
        <div class="visual-content">
            <img src="{{ asset('images/attijari-logo.png') }}" style="width: 140px; margin-bottom: 40px; filter: brightness(0) invert(1);">
            <h1>La sécurité au cœur de vos échanges.</h1>
            <p>CommandFlow accompagne les collaborateurs d'Attijariwafa Bank dans la digitalisation de leurs processus d'achats.</p>
        </div>
    </div>

</body>
</html>