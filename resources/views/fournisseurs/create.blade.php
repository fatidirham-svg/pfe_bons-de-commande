@extends('layouts.app')

@section('content')

<style>
    /* ===== TIJARI THEME - FORMULAIRE FOURNISSEUR ===== */

    /* Variables Tijari */
    :root {
        --tijari-red: #e30613;
        --tijari-yellow: #ffb71b;
        --tijari-dark: #1a1a1a;
        --tijari-light: #f8fafc;
        --shadow-soft: 0 4px 20px rgba(227, 6, 19, 0.08);
        --shadow-hover: 0 8px 30px rgba(227, 6, 19, 0.15);
    }

    /* Carte principale avec dégradé */
    .tijari-card {
        border: none;
        border-radius: 16px;
        background: linear-gradient(135deg, #ffffff 0%, #fefefe 100%);
        box-shadow: var(--shadow-soft);
        border-top: 4px solid var(--tijari-red);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        position: relative;
    }

    .tijari-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--tijari-red) 0%, var(--tijari-yellow) 100%);
    }

    .tijari-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
    }

    /* En-tête avec icône animée */
    .tijari-header {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-bottom: 1px solid #edf2f7;
        padding: 24px 0;
        position: relative;
    }

    .tijari-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 2px;
        background: linear-gradient(90deg, var(--tijari-red), var(--tijari-yellow));
        border-radius: 1px;
    }

    .tijari-icon {
        color: var(--tijari-red);
        font-size: 28px;
        animation: pulse 2s infinite;
        background: linear-gradient(135deg, var(--tijari-red), #c00510);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    /* Champs de saisie avec icônes */
    .tijari-input-group {
        position: relative;
        margin-bottom: 20px;
    }

    .tijari-input {
        width: 100%;
        padding: 14px 16px 14px 50px;
        border: 2px solid #e1e5e9;
        border-radius: 12px;
        background: #ffffff;
        font-size: 15px;
        font-family: inherit;
        transition: all 0.3s ease;
        outline: none;
    }

    .tijari-input:focus {
        border-color: var(--tijari-red);
        box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.1);
        background: #fefefe;
        transform: translateY(-1px);
    }

    .tijari-input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--tijari-red);
        font-size: 18px;
        z-index: 2;
    }

    .tijari-input:focus + .tijari-input-icon {
        color: var(--tijari-yellow);
        animation: bounce 0.6s ease;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(-50%) translateX(0); }
        40% { transform: translateY(-50%) translateX(-2px); }
        60% { transform: translateY(-50%) translateX(2px); }
    }

    /* Labels stylisés */
    .tijari-label {
        font-weight: 600;
        color: var(--tijari-dark);
        margin-bottom: 8px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .tijari-label i {
        color: var(--tijari-red);
        font-size: 12px;
    }

    .required-star {
        color: var(--tijari-red);
        font-weight: bold;
    }

    /* Bouton principal */
    .tijari-btn {
        background: linear-gradient(135deg, var(--tijari-red) 0%, #c00510 100%);
        color: white;
        border: none;
        padding: 16px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(227, 6, 19, 0.2);
        position: relative;
        overflow: hidden;
    }

    .tijari-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .tijari-btn:hover::before {
        left: 100%;
    }

    .tijari-btn:hover {
        background: linear-gradient(135deg, #c00510 0%, #a0040e 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(227, 6, 19, 0.3);
    }

    .tijari-btn:active {
        transform: translateY(0);
    }

    /* Alertes d'erreur */
    .tijari-alert {
        background: linear-gradient(135deg, #fee, #fdd);
        border: 1px solid #f8d7da;
        border-left: 4px solid var(--tijari-red);
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        color: #721c24;
    }

    .tijari-alert ul {
        margin: 0;
        padding-left: 20px;
    }

    .tijari-alert li {
        margin-bottom: 4px;
    }

    /* Section d'information */
    .info-section {
        background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
        border: 1px solid #b3e5fc;
        border-left: 4px solid var(--tijari-red);
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        font-size: 14px;
    }

    .info-section i {
        color: var(--tijari-red);
        margin-right: 8px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        .tijari-card {
            border-radius: 12px;
        }

        .tijari-header {
            padding: 20px 0;
        }

        .tijari-input {
            padding: 12px 14px 12px 45px;
            font-size: 16px; /* Prevent zoom on iOS */
        }
    }

    /* Animation d'entrée */
    .fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container mt-5 mb-5 fade-in" style="max-width: 750px;">

    <div class="tijari-card">

        <!-- ===== EN-TÊTE ===== -->
        <div class="tijari-header">
            <div class="d-flex align-items-center justify-content-center gap-3 ps-4 pe-4">
                <i class="fa-solid fa-building tijari-icon"></i>
                <div class="text-center">
                    <h3 class="fw-bold mb-1" style="color: var(--tijari-dark); font-size: 24px;">
                        Ajouter un Fournisseur
                    </h3>
                    <p class="text-muted mb-0" style="font-size: 14px;">
                        Enregistrez un nouveau partenaire commercial
                    </p>
                </div>
            </div>
        </div>

        <!-- ===== CORPS ===== -->
        <div class="card-body p-4">

            {{-- Section informative --}}
            <div class="info-section">
                <i class="fa-solid fa-circle-info"></i>
                <strong>Conseil :</strong> Remplissez tous les champs obligatoires marqués d'un
                <span class="required-star">*</span> pour une meilleure gestion de vos fournisseurs.
            </div>

            {{-- Affichage des erreurs --}}
            @if ($errors->any())
                <div class="tijari-alert">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i>
                        <strong>Erreurs détectées :</strong>
                    </div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulaire --}}
            <form action="{{ route('fournisseurs.store') }}" method="POST" novalidate>
                @csrf

                <div class="row g-4">

                    <!-- NOM (Obligatoire) -->
                    <div class="col-12">
                        <label class="tijari-label">
                            <i class="fa-solid fa-briefcase"></i>
                            Nom de l'entreprise
                            <span class="required-star">*</span>
                        </label>
                        <div class="tijari-input-group">
                            <input type="text"
                                   name="nom"
                                   class="tijari-input"
                                   placeholder="Ex: SARL Distribution Tijari"
                                   value="{{ old('nom') }}"
                                   required
                                   autocomplete="organization">
                            <i class="fa-solid fa-building tijari-input-icon"></i>
                        </div>
                        @error('nom')
                            <div class="text-danger mt-1" style="font-size: 13px;">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- EMAIL -->
                    <div class="col-md-6">
                        <label class="tijari-label">
                            <i class="fa-solid fa-envelope"></i>
                            Email de contact
                        </label>
                        <div class="tijari-input-group">
                            <input type="email"
                                   name="email"
                                   class="tijari-input"
                                   placeholder="contact@fournisseur.com"
                                   value="{{ old('email') }}"
                                   autocomplete="email">
                            <i class="fa-solid fa-envelope tijari-input-icon"></i>
                        </div>
                        @error('email')
                            <div class="text-danger mt-1" style="font-size: 13px;">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- TÉLÉPHONE -->
                    <div class="col-md-6">
                        <label class="tijari-label">
                            <i class="fa-solid fa-phone"></i>
                            Numéro de téléphone
                        </label>
                        <div class="tijari-input-group">
                            <input type="tel"
                                   name="telephone"
                                   class="tijari-input"
                                   placeholder="+212 6XX XXX XXX"
                                   value="{{ old('telephone') }}"
                                   autocomplete="tel">
                            <i class="fa-solid fa-phone tijari-input-icon"></i>
                        </div>
                        @error('telephone')
                            <div class="text-danger mt-1" style="font-size: 13px;">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- ADRESSE -->
                    <div class="col-12">
                        <label class="tijari-label">
                            <i class="fa-solid fa-location-dot"></i>
                            Adresse complète
                        </label>
                        <div class="tijari-input-group">
                            <input type="text"
                                   name="adresse"
                                   class="tijari-input"
                                   placeholder="Ex: 123 Rue de l'Industrie, Casablanca"
                                   value="{{ old('adresse') }}"
                                   autocomplete="address-line1">
                            <i class="fa-solid fa-location-dot tijari-input-icon"></i>
                        </div>
                        @error('adresse')
                            <div class="text-danger mt-1" style="font-size: 13px;">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <!-- BOUTON D'ENREGISTREMENT -->
                <div class="text-center mt-4">
                    <button type="submit" class="tijari-btn">
                        <i class="fa-solid fa-save me-2"></i>
                        Enregistrer le Fournisseur
                    </button>
                </div>

                <!-- TEXTE DE CONFIDENTIALITÉ -->
                <div class="text-center mt-3" style="font-size: 12px; color: #666;">
                    <i class="fa-solid fa-shield-alt me-1" style="color: var(--tijari-red);"></i>
                    Toutes les informations sont sécurisées et confidentielles
                </div>

            </form>

        </div>
    </div>
</div>

@endsection