<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CommandFlow | Gestion Intelligente des Bons de Commande</title>

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
            background: #ffffff;
            color: var(--tijari-dark);
            overflow-x: hidden;
        }

        /* NAVBAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 80px;
            position: absolute;
            width: 100%;
            box-sizing: border-box;
            z-index: 100;
        }

        .navbar img {
            width: 180px;
        }

        .nav-links {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #475569;
            font-weight: 600;
            font-size: 15px;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: var(--tijari-red);
        }

        .btn-login {
            padding: 12px 28px;
            border-radius: 12px;
            background: var(--tijari-red);
            color: white !important;
            font-weight: 700;
            transition: all 0.3s;
            box-shadow: 0 8px 15px rgba(227, 6, 19, 0.15);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(227, 6, 19, 0.25);
        }

        /* HERO SECTION */
        .hero {
            padding: 220px 80px 120px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: radial-gradient(circle at 80% 20%, rgba(255, 183, 27, 0.1), transparent),
                        radial-gradient(circle at 20% 80%, rgba(227, 6, 19, 0.05), transparent);
            min-height: 80vh;
        }

        .hero-content {
            max-width: 650px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 183, 27, 0.1);
            color: #b45309;
            padding: 10px 20px;
            border-radius: 100px;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 32px;
            border: 1px solid rgba(255, 183, 27, 0.2);
        }

        .hero h1 {
            font-size: 72px;
            line-height: 1.05;
            font-weight: 800;
            margin: 0 0 24px;
            letter-spacing: -3px;
            color: var(--tijari-dark);
        }

        .hero h1 span {
            color: var(--tijari-red);
        }

        .hero p {
            font-size: 20px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 48px;
            max-width: 550px;
        }

        .hero-image {
            position: relative;
            z-index: 1;
        }

        .hero-image img {
            width: 600px;
            border-radius: 40px;
            box-shadow: 0 60px 120px -30px rgba(0,0,0,0.2);
            border: 1px solid rgba(0,0,0,0.03);
        }

        /* FEATURES */
        .features {
            padding: 120px 80px;
            background: #ffffff;
        }

        .section-header {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 80px;
        }

        .section-header h2 {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 16px;
            letter-spacing: -1px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
        }

        .feature-card {
            background: #f8fafc;
            padding: 48px;
            border-radius: 32px;
            border: 1px solid #f1f5f9;
            transition: all 0.3s;
        }

        .feature-card:hover {
            background: white;
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
            border-color: var(--tijari-red);
        }

        .feature-icon {
            width: 64px;
            height: 64px;
            background: white;
            color: var(--tijari-red);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 32px;
            box-shadow: 0 8px 15px rgba(0,0,0,0.05);
        }

        /* CTA SECTION */
        .cta-section {
            padding: 100px 80px;
        }

        .cta-box {
            background: linear-gradient(135deg, var(--tijari-dark) 0%, #334155 100%);
            border-radius: 50px;
            padding: 80px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-cta {
            background: var(--tijari-yellow);
            color: var(--tijari-dark);
            padding: 20px 48px;
            border-radius: 16px;
            font-weight: 800;
            text-decoration: none;
            font-size: 18px;
            transition: all 0.3s;
            box-shadow: 0 10px 20px rgba(255, 183, 27, 0.2);
        }

        .btn-cta:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(255, 183, 27, 0.4);
        }

        /* FOOTER */
        footer {
            padding: 80px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-logo img {
            width: 140px;
        }

        .footer-links {
            display: flex;
            gap: 40px;
        }

        .footer-links a {
            text-decoration: none;
            color: #64748b;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <img src="{{ asset('images/attijari-logo.png') }}" alt="Tijari Logo">
        <div class="nav-links">
            <a href="#features">Fonctionnalités</a>
            <a href="#about">À propos</a>
            <a href="{{ route('login') }}" class="btn-login">Accès Client</a>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fa-solid fa-sparkles"></i>
                Innovation Bancaire : Workflow v2.0
            </div>
            <h1>Gérez vos commandes <span>avec précision.</span></h1>
            <p>La solution de gestion de bons de commande n°1 pour les filiales d'Attijariwafa Bank. Automatisez, validez et suivez en toute sécurité.</p>
            
            <div style="display: flex; gap: 20px;">
                <a href="{{ route('login') }}" class="btn-main" style="background: var(--tijari-red); color: white; padding: 20px 40px; border-radius: 16px; text-decoration: none; font-weight: 700; font-size: 18px;">
                    Démarrer maintenant
                </a>
                <a href="#demo" class="btn-main" style="background: white; border: 2px solid #e2e8f0; color: #475569; padding: 20px 40px; border-radius: 16px; text-decoration: none; font-weight: 700; font-size: 18px;">
                    Voir la démo
                </a>
            </div>
        </div>

        <div class="hero-image">
            <img src="{{ asset('images/image.png') }}" alt="Dashboard Preview">
        </div>
    </section>

    <section class="features" id="features">
        <div class="section-header">
            <h2>L'excellence opérationnelle</h2>
            <p>Des outils conçus pour répondre aux exigences de rigueur et de performance du groupe Attijariwafa Bank.</p>
        </div>

        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-bolt"></i></div>
                <h3>Validation Rapide</h3>
                <p>Circuits de validation optimisés pour réduire les délais de traitement de vos commandes.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-shield-check"></i></div>
                <h3>Conformité Totale</h3>
                <p>Respect strict des normes d'audit et de contrôle interne du groupe.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fa-solid fa-chart-pie"></i></div>
                <h3>Reporting Analytique</h3>
                <p>Tableaux de bord détaillés pour une visibilité complète sur vos engagements financiers.</p>
            </div>
        </div>
    </section>

    <section class="cta-section" style="padding: 0 80px 80px;">
        <div class="cta-box">
            <div class="cta-content">
                <h2 style="font-size: 42px; margin-bottom: 8px;">Prêt à optimiser vos flux ?</h2>
                <p style="font-size: 18px; opacity: 0.8;">Rejoignez les gestionnaires qui utilisent déjà CommandFlow.</p>
            </div>
            <a href="{{ route('login') }}" class="btn-cta">
                Accéder à mon espace
            </a>
        </div>
    </section>

    <footer>
        <div class="footer-logo">
            <img src="{{ asset('images/attijari-logo.png') }}" alt="Tijari Logo">
        </div>
        <div class="footer-links">
            <a href="#">Sécurité</a>
            <a href="#">Support Technique</a>
            <a href="#">© 2026 Attijariwafa Bank</a>
        </div>
    </footer>

</body>
</html>