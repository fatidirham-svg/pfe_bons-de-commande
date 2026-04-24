@extends('layouts.app')

@section('title', 'Configuration de la Facture')

@section('content')

<style>
    .config-wrapper {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .config-header {
        text-align: center;
        margin-bottom: 40px;
        padding: 30px;
        background: linear-gradient(135deg, rgba(227,6,19,0.1), rgba(255,183,27,0.1));
        border-radius: 20px;
        border: 1px solid rgba(227,6,19,0.2);
    }

    .config-header h2 {
        color: #1a1a1a;
        font-size: 24px;
        font-weight: 700;
        margin: 0 0 10px 0;
    }

    .config-header p {
        color: #6b7280;
        font-size: 16px;
        margin: 0;
    }

    .config-card {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        margin-bottom: 24px;
        border: 1px solid #e5e7eb;
    }

    .config-section {
        margin-bottom: 32px;
    }

    .config-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 18px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid #e5e7eb;
    }

    .section-title i {
        color: var(--tijari-red);
        font-size: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-row.full {
        grid-template-columns: 1fr;
    }

    .field-group {
        position: relative;
    }

    .field-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .field-group label .required {
        color: var(--tijari-red);
    }

    .field-group input,
    .field-group select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 14px;
        color: #1f2937;
        background: #f9fafb;
        transition: all 0.2s ease;
    }

    .field-group input:focus,
    .field-group select:focus {
        outline: none;
        border-color: var(--tijari-red);
        background: white;
        box-shadow: 0 0 0 3px rgba(227,6,19,0.1);
    }

    .signatory-card {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
    }

    .signatory-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
    }

    .signatory-number {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--tijari-red);
        color: white;
        border-radius: 50%;
        font-weight: 700;
        font-size: 14px;
    }

    .signatory-title {
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
        margin: 0;
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid #e5e7eb;
    }

    .btn-cancel {
        padding: 12px 24px;
        border: 2px solid #d1d5db;
        background: white;
        color: #6b7280;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-cancel:hover {
        border-color: #9ca3af;
        background: #f9fafb;
    }

    .btn-submit {
        padding: 12px 32px;
        border: none;
        background: linear-gradient(135deg, var(--tijari-red), #c20510);
        color: white;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(227,6,19,0.3);
    }

    .btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(227,6,19,0.4);
    }

    .info-box {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        border: 1px solid #bfdbfe;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
    }

    .info-box p {
        margin: 0;
        color: #1e40af;
        font-size: 14px;
        line-height: 1.5;
    }

    .info-box i {
        color: #3b82f6;
        margin-right: 8px;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
            gap: 12px;
        }

        .btn-cancel,
        .btn-submit {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="config-wrapper">

    <div class="config-header">
        <h2>⚙️ Configuration de la Facture</h2>
        <p>Personnalisez votre facture avant de la télécharger</p>
    </div>

    <div class="info-box">
        <p><i class="fa-solid fa-info-circle"></i>
        Ces informations seront intégrées dans le PDF de votre facture pour une présentation professionnelle.</p>
    </div>

    <form method="POST" action="{{ route('dashboard.generatePdf') }}">
        @csrf
        <input type="hidden" name="bon_id" value="{{ $bon->id }}">

        <div class="config-card">
            <div class="config-section">
                <div class="section-title">
                    <i class="fa-solid fa-building"></i>
                    Société
                </div>

                <div class="form-row full">
                    <div class="field-group">
                        <label>Société <span class="required">*</span></label>
                        <select name="societe" required>
                            <option value="">— Choisir une société —</option>
                            <option value="Attijariwafa Bank">Attijariwafa Bank</option>
                            <option value="Attijari Finance">Attijari Finance</option>
                            <option value="Attijari Intermédiation">Attijari Intermédiation</option>
                            <option value="Attijari Management">Attijari Management</option>
                            <option value="BMCE Bank">BMCE Bank</option>
                            <option value="Banque Populaire">Banque Populaire</option>
                            <option value="Société Générale Maroc">Société Générale Maroc</option>
                            <option value="Crédit du Maroc">Crédit du Maroc</option>
                            <option value="Autre">Autre (spécifier)</option>
                        </select>
                    </div>
                </div>

                <div class="form-row full" id="autre-societe" style="display: none;">
                    <div class="field-group">
                        <label>Nom de la société</label>
                        <input type="text" name="societe_autre" placeholder="Nom de la société...">
                    </div>
                </div>
            </div>

            <div class="config-section">
                <div class="section-title">
                    <i class="fa-solid fa-signature"></i>
                    Signataires
                </div>

                <div class="signatory-card">
                    <div class="signatory-header">
                        <div class="signatory-number">1</div>
                        <h4 class="signatory-title">Premier Signataire</h4>
                    </div>

                    <div class="form-row">
                        <div class="field-group">
                            <label>Nom complet <span class="required">*</span></label>
                            <input type="text" name="signataire1_nom" required placeholder="Ex: M. Dupont">
                        </div>
                        <div class="field-group">
                            <label>Poste <span class="required">*</span></label>
                            <input type="text" name="signataire1_poste" required placeholder="Ex: Directeur Général">
                        </div>
                    </div>
                </div>

                <div class="signatory-card">
                    <div class="signatory-header">
                        <div class="signatory-number">2</div>
                        <h4 class="signatory-title">Deuxième Signataire</h4>
                    </div>

                    <div class="form-row">
                        <div class="field-group">
                            <label>Nom complet <span class="required">*</span></label>
                            <input type="text" name="signataire2_nom" required placeholder="Ex: Mme. Martin">
                        </div>
                        <div class="field-group">
                            <label>Poste <span class="required">*</span></label>
                            <input type="text" name="signataire2_poste" required placeholder="Ex: Directrice Financière">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('dashboard') }}" class="btn-cancel">
                <i class="fa-solid fa-arrow-left"></i> Retour
            </a>
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-download"></i> Générer la Facture PDF
            </button>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const societeSelect = document.querySelector('select[name="societe"]');
    const autreSocieteDiv = document.getElementById('autre-societe');

    societeSelect.addEventListener('change', function() {
        if (this.value === 'Autre') {
            autreSocieteDiv.style.display = 'block';
        } else {
            autreSocieteDiv.style.display = 'none';
        }
    });
});
</script>
@endsection