@extends('layouts.app')

@section('content')

<style>
    /* ===== TIJARI THEME - FORMULAIRE MODIFICATION PRODUIT ===== */

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

    .tijari-textarea {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e1e5e9;
        border-radius: 12px;
        background: #ffffff;
        font-size: 15px;
        font-family: inherit;
        transition: all 0.3s ease;
        outline: none;
        resize: vertical;
        min-height: 100px;
    }

    .tijari-textarea:focus {
        border-color: var(--tijari-red);
        box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.1);
        background: #fefefe;
        transform: translateY(-1px);
    }

    .tijari-select {
        width: 100%;
        padding: 14px 16px 14px 50px;
        border: 2px solid #e1e5e9;
        border-radius: 12px;
        background: #ffffff;
        font-size: 15px;
        font-family: inherit;
        transition: all 0.3s ease;
        outline: none;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 16px;
    }

    .tijari-select:focus {
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
        pointer-events: none;
    }

    .tijari-input:focus + .tijari-input-icon,
    .tijari-select:focus + .tijari-input-icon {
        color: var(--tijari-yellow);
        animation: bounce 0.6s ease;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(-50%); }
        40% { transform: translateY(-60%); }
        60% { transform: translateY(-40%); }
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

    /* Boutons */
    .tijari-btn-primary {
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

    .tijari-btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .tijari-btn-primary:hover::before {
        left: 100%;
    }

    .tijari-btn-primary:hover {
        background: linear-gradient(135deg, #c00510 0%, #a0040e 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(227, 6, 19, 0.3);
    }

    .tijari-btn-secondary {
        background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
        color: white;
        border: none;
        padding: 14px 20px;
        border-radius: 12px;
        font-weight: 500;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .tijari-btn-secondary:hover {
        background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
        background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        border: 1px solid #ffeaa7;
        border-left: 4px solid var(--tijari-yellow);
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        font-size: 14px;
        color: #856404;
    }

    .info-section i {
        color: var(--tijari-yellow);
        margin-right: 8px;
    }

    /* Badge fournisseur */
    .supplier-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, #e8f5e8, #f1f8e9);
        color: #2e7d32;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
        border: 1px solid #c8e6c9;
    }

    .supplier-badge i {
        font-size: 11px;
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

        .tijari-input,
        .tijari-textarea,
        .tijari-select {
            padding-left: 45px;
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
                <i class="fa-solid fa-edit tijari-icon"></i>
                <div class="text-center">
                    <h3 class="fw-bold mb-1" style="color: var(--tijari-dark); font-size: 24px;">
                        Modifier le Produit
                    </h3>
                    <p class="text-muted mb-0" style="font-size: 14px;">
                        Mettez à jour les informations du produit
                    </p>
                </div>
            </div>
        </div>

        <!-- ===== CORPS ===== -->
        <div class="card-body p-4">

            {{-- Section informative --}}
            <div class="info-section">
                <i class="fa-solid fa-info-circle"></i>
                <strong>Modification :</strong> Vous êtes en train de modifier
                <strong>"{{ $produit->nom }}"</strong>.
                Le prix actuel est de <strong>{{ number_format($produit->prix, 2) }} DH</strong>.
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
            <form action="{{ route('produits.update', $produit->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- NOM DU PRODUIT (Obligatoire) -->
                    <div class="col-12">
                        <label class="tijari-label">
                            <i class="fa-solid fa-tag"></i>
                            Nom du produit
                            <span class="required-star">*</span>
                        </label>
                        <div class="tijari-input-group">
                            <input type="text"
                                   name="nom"
                                   class="tijari-input"
                                   placeholder="Ex: Clavier USB Gaming RGB"
                                   value="{{ old('nom', $produit->nom) }}"
                                   required
                                   autocomplete="off">
                            <i class="fa-solid fa-box tijari-input-icon"></i>
                        </div>
                        @error('nom')
                            <div class="text-danger mt-1" style="font-size: 13px;">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="col-12">
                        <label class="tijari-label">
                            <i class="fa-solid fa-align-left"></i>
                            Description détaillée
                        </label>
                        <textarea name="description"
                                  class="tijari-textarea"
                                  placeholder="Décrivez les caractéristiques du produit, dimensions, spécifications techniques..."
                                  autocomplete="off">{{ old('description', $produit->description) }}</textarea>
                        @error('description')
                            <div class="text-danger mt-1" style="font-size: 13px;">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- PRIX UNITAIRE (Obligatoire) -->
                    <div class="col-md-6">
                        <label class="tijari-label">
                            <i class="fa-solid fa-coins"></i>
                            Prix unitaire (DH)
                            <span class="required-star">*</span>
                        </label>
                        <div class="tijari-input-group">
                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   name="prix"
                                   class="tijari-input"
                                   placeholder="0.00"
                                   value="{{ old('prix', $produit->prix) }}"
                                   required>
                            <i class="fa-solid fa-coins tijari-input-icon"></i>
                        </div>
                        @error('prix')
                            <div class="text-danger mt-1" style="font-size: 13px;">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- FOURNISSEUR (Obligatoire) -->
                    <div class="col-md-6">
                        <label class="tijari-label">
                            <i class="fa-solid fa-building"></i>
                            Fournisseur
                            <span class="required-star">*</span>
                        </label>
                        <div class="tijari-input-group">
                            <select name="fournisseur_id" class="tijari-select" required>
                                <option value="">-- Sélectionnez un fournisseur --</option>
                                @foreach($fournisseurs as $fournisseur)
                                    <option value="{{ $fournisseur->id }}"
                                            {{ old('fournisseur_id', $produit->fournisseur_id) == $fournisseur->id ? 'selected' : '' }}>
                                        {{ $fournisseur->nom }}
                                        @if($fournisseur->email)
                                            ({{ $fournisseur->email }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <i class="fa-solid fa-building tijari-input-icon"></i>
                        </div>
                        @error('fournisseur_id')
                            <div class="text-danger mt-1" style="font-size: 13px;">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}
                            </div>
                        @enderror

                        {{-- Affichage du fournisseur actuel --}}
                        <div class="supplier-badge mt-2">
                            <i class="fa-solid fa-info-circle"></i>
                            Fournisseur actuel: <strong>{{ $produit->fournisseur->nom }}</strong>
                        </div>
                    </div>

                </div>

                <!-- BOUTONS D'ACTION -->
                <div class="d-flex gap-3 justify-content-center mt-4">
                    <a href="{{ route('produits.index') }}" class="tijari-btn-secondary">
                        <i class="fa-solid fa-arrow-left me-2"></i>
                        Annuler
                    </a>
                    <button type="submit" class="tijari-btn-primary">
                        <i class="fa-solid fa-save me-2"></i>
                        Sauvegarder les Modifications
                    </button>
                </div>

                <!-- TEXTE DE CONFIDENTIALITÉ -->
                <div class="text-center mt-3" style="font-size: 12px; color: #666;">
                    <i class="fa-solid fa-shield-alt me-1" style="color: var(--tijari-red);"></i>
                    Toutes les modifications sont sécurisées et traçables
                </div>

            </form>

        </div>
    </div>
</div>

@endsection