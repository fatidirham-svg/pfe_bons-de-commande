@extends('layouts.app')

@section('title', 'Nouveau Bon de Commande')

@section('content')

<style>
    .create-wrapper {
        max-width: 960px;
        margin: 0 auto;
    }

    /* ===== PAGE HEADER ===== */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 32px;
    }
    .page-header h2 {
        font-size: 26px;
        font-weight: 800;
        color: var(--tijari-dark);
        margin: 0;
    }
    .page-header .type-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 13px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .type-finance { background: linear-gradient(135deg, #fff3cd, #ffeaa7); color: #856404; }
    .type-intermediation { background: linear-gradient(135deg, #d4edda, #a8e6cf); color: #155724; }
    .type-management { background: linear-gradient(135deg, #e2e8f0, #cbd5e1); color: #1a1a1a; }

    /* ===== FORM CARD ===== */
    .form-card {
        background: white;
        border-radius: 20px;
        padding: 36px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
        margin-bottom: 24px;
        border: 1px solid #f1f5f9;
        position: relative;
        overflow: hidden;
    }
    .form-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--tijari-red), var(--tijari-yellow));
    }
    .form-card-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 700;
        color: var(--tijari-dark);
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f1f5f9;
    }
    .form-card-title i {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 16px;
        color: white;
        background: linear-gradient(135deg, var(--tijari-red), #c20510);
        box-shadow: 0 4px 10px rgba(227,6,19,0.2);
    }

    /* ===== FORM GRID ===== */
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    .form-row.full { grid-template-columns: 1fr; }

    .field-group { position: relative; }
    .field-group label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 8px;
    }
    .field-group label .required { color: var(--tijari-red); }

    .field-group input,
    .field-group select,
    .field-group textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        font-weight: 500;
        color: var(--tijari-dark);
        background: #f8fafc;
        transition: all 0.25s ease;
        outline: none;
        box-sizing: border-box;
    }
    .field-group input:focus,
    .field-group select:focus,
    .field-group textarea:focus {
        border-color: var(--tijari-red);
        background: white;
        box-shadow: 0 0 0 4px rgba(227,6,19,0.08);
    }
    .field-group textarea { resize: vertical; min-height: 80px; }

    /* ===== LINES TABLE ===== */
    .lines-header {
        display: grid;
        grid-template-columns: 50px 1fr 120px 120px 140px 50px;
        gap: 12px;
        padding: 10px 16px;
        background: var(--tijari-dark);
        border-radius: 12px 12px 0 0;
        margin-top: 4px;
    }
    .lines-header span {
        font-size: 11px;
        font-weight: 700;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .line-item {
        display: grid;
        grid-template-columns: 50px 1fr 120px 120px 140px 50px;
        gap: 12px;
        padding: 12px 16px;
        background: white;
        border-left: 2px solid #e2e8f0;
        border-right: 2px solid #e2e8f0;
        border-bottom: 1px solid #f1f5f9;
        align-items: center;
        animation: slideIn 0.3s ease;
    }
    .line-item:last-child {
        border-radius: 0 0 12px 12px;
        border-bottom: 2px solid #e2e8f0;
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .line-num {
        width: 30px; height: 30px;
        display: flex; align-items: center; justify-content: center;
        background: #f1f5f9;
        border-radius: 8px;
        font-weight: 700;
        font-size: 12px;
        color: #64748b;
    }
    .line-item select,
    .line-item input {
        width: 100%;
        padding: 10px 12px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-family: 'Outfit', sans-serif;
        font-size: 13px;
        font-weight: 500;
        background: #f8fafc;
        outline: none;
        transition: all 0.2s;
        box-sizing: border-box;
    }
    .line-item select:focus,
    .line-item input:focus {
        border-color: var(--tijari-red);
        background: white;
    }
    .line-price {
        font-weight: 700;
        font-size: 14px;
        color: var(--tijari-dark);
        text-align: right;
        padding-right: 8px;
    }
    .btn-remove {
        width: 34px; height: 34px;
        border: none;
        background: #fee2e2;
        color: #dc2626;
        border-radius: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        font-size: 14px;
    }
    .btn-remove:hover {
        background: #dc2626;
        color: white;
        transform: scale(1.1);
    }

    /* ===== ADD LINE BUTTON ===== */
    .btn-add-line {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 14px;
        margin-top: 16px;
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        background: transparent;
        color: #64748b;
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s;
    }
    .btn-add-line:hover {
        border-color: var(--tijari-red);
        color: var(--tijari-red);
        background: rgba(227,6,19,0.03);
    }

    /* ===== TOTALS BAR ===== */
    .totals-bar {
        display: flex;
        justify-content: flex-end;
        gap: 24px;
        margin-top: 20px;
        padding: 20px 24px;
        background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
        border-radius: 14px;
    }
    .total-item {
        text-align: right;
    }
    .total-item .total-label {
        font-size: 11px;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    .total-item .total-value {
        font-size: 20px;
        font-weight: 800;
        color: white;
    }
    .total-item.ttc .total-value {
        color: var(--tijari-yellow);
        font-size: 24px;
    }

    /* ===== SUBMIT BAR ===== */
    .submit-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 28px;
    }
    .btn-cancel {
        padding: 14px 28px;
        border: 2px solid #e2e8f0;
        background: white;
        color: #64748b;
        border-radius: 14px;
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-cancel:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
        color: var(--tijari-dark);
    }
    .btn-submit {
        padding: 14px 36px;
        border: none;
        background: linear-gradient(135deg, var(--tijari-red), #c20510);
        color: white;
        border-radius: 14px;
        font-family: 'Outfit', sans-serif;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(227,6,19,0.25);
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(227,6,19,0.35);
    }

    /* ===== VALIDATION ERRORS ===== */
    .error-box {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
    }
    .error-box ul { margin: 0; padding-left: 18px; }
    .error-box li { color: #dc2626; font-size: 13px; font-weight: 500; }
</style>

<div class="create-wrapper">

    {{-- Validation Errors --}}
    @if($errors->any())
    <div class="error-box">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Page Header --}}
    <div class="page-header">
        <h2>Nouveau Bon de Commande</h2>
        @php
            $typeClass = match($type) {
                'finance' => 'type-finance',
                'intermediation' => 'type-intermediation',
                'management' => 'type-management',
                default => 'type-finance'
            };
            $typeIcon = match($type) {
                'finance' => 'fa-coins',
                'intermediation' => 'fa-chart-line',
                'management' => 'fa-briefcase',
                default => 'fa-file'
            };
        @endphp
        <span class="type-badge {{ $typeClass }}">
            <i class="fa-solid {{ $typeIcon }}"></i>
            Attijari {{ ucfirst($type) }}
        </span>
    </div>

    <form method="POST" action="{{ route('bon_commandes.store') }}" id="bcForm">
        @csrf
        <input type="hidden" name="type" value="{{ $type }}">

        {{-- === SECTION 1: Informations Générales === --}}
        <div class="form-card">
            <div class="form-card-title">
                <i class="fa-solid fa-clipboard-list"></i>
                Informations Générales
            </div>

            <div class="form-row">
                <div class="field-group">
                    <label>Date de commande <span class="required">*</span></label>
                    <input type="date" name="date_commande" value="{{ old('date_commande', date('Y-m-d')) }}" required>
                </div>
                <div class="field-group">
                    <label>Fournisseur <span class="required">*</span></label>
                    <select name="fournisseur_id" required>
                        <option value="">— Sélectionner un fournisseur —</option>
                        @foreach($fournisseurs as $f)
                            <option value="{{ $f->id }}" {{ old('fournisseur_id') == $f->id ? 'selected' : '' }}>{{ $f->nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="field-group">
                    <label>Statut initial <span class="required">*</span></label>
                    <select name="statut_id" required>
                        <option value="">— Sélectionner un statut —</option>
                        @foreach($statuts as $s)
                            <option value="{{ $s->id }}" {{ old('statut_id') == $s->id ? 'selected' : '' }}>{{ ucfirst($s->nom) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group">
                    <label>Mode de règlement <span class="required">*</span></label>
                    <select name="mode_regelement" required>
                        <option value="">— Sélectionner —</option>
                        <option value="Comptant" {{ old('mode_regelement') == 'Comptant' ? 'selected' : '' }}>Comptant</option>
                        <option value="1 mois" {{ old('mode_regelement') == '1 mois' ? 'selected' : '' }}>1 mois</option>
                        <option value="2 mois" {{ old('mode_regelement') == '2 mois' ? 'selected' : '' }}>2 mois</option>
                        <option value="03 mois" {{ old('mode_regelement') == '03 mois' ? 'selected' : '' }}>03 mois</option>
                    </select>
                </div>
            </div>

            <div class="form-row full">
                <div class="field-group">
                    <label>Observations</label>
                    <textarea name="observations" placeholder="Notes internes, instructions spéciales...">{{ old('observations') }}</textarea>
                </div>
            </div>
        </div>

        {{-- === SECTION 2: Lignes de Commande === --}}
        <div class="form-card">
            <div class="form-card-title">
                <i class="fa-solid fa-cart-shopping"></i>
                Lignes de Commande
            </div>

            <div class="lines-header">
                <span>#</span>
                <span>Produit</span>
                <span>Prix Unit.</span>
                <span>Quantité</span>
                <span style="text-align:right;">Sous-total</span>
                <span></span>
            </div>

            <div id="linesContainer">
                <div class="line-item" data-index="0">
                    <div class="line-num">1</div>
                    <select name="lignes[0][produit_id]" class="produit-select" required onchange="updateLinePrice(this)">
                        <option value="">— Choisir un produit —</option>
                        @foreach($produits as $p)
                            <option value="{{ $p->id }}" data-prix="{{ $p->prix }}">{{ $p->nom }}</option>
                        @endforeach
                    </select>
                    <div class="line-price prix-unit">0,00</div>
                    <input type="number" name="lignes[0][quantite]" value="1" min="1" class="qte-input" required oninput="updateLinePrice(this)">
                    <div class="line-price sous-total">0,00 DH</div>
                    <button type="button" class="btn-remove" onclick="removeLine(this)" title="Supprimer">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>

            <button type="button" class="btn-add-line" onclick="addLine()">
                <i class="fa-solid fa-plus"></i> Ajouter un produit
            </button>

            {{-- Totals --}}
            <div class="totals-bar">
                <div class="total-item">
                    <div class="total-label">Total HT</div>
                    <div class="total-value" id="totalHT">0,00 DH</div>
                </div>
                <div class="total-item">
                    <div class="total-label">TVA 20%</div>
                    <div class="total-value" id="totalTVA">0,00 DH</div>
                </div>
                <div class="total-item ttc">
                    <div class="total-label">Total TTC</div>
                    <div class="total-value" id="totalTTC">0,00 DH</div>
                </div>
            </div>
        </div>

        {{-- === SUBMIT BAR === --}}
        <div class="submit-bar">
            <a href="{{ route('bon_commandes.index') }}" class="btn-cancel">
                <i class="fa-solid fa-arrow-left"></i> Retour
            </a>
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-check"></i> Enregistrer le Bon de Commande
            </button>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
let lineIndex = 1;

const produitsData = @json($produits->mapWithKeys(fn($p) => [$p->id => $p->prix]));

function addLine() {
    const container = document.getElementById('linesContainer');
    const num = container.children.length + 1;

    const html = `
    <div class="line-item" data-index="${lineIndex}">
        <div class="line-num">${num}</div>
        <select name="lignes[${lineIndex}][produit_id]" class="produit-select" required onchange="updateLinePrice(this)">
            <option value="">— Choisir un produit —</option>
            @foreach($produits as $p)
                <option value="{{ $p->id }}" data-prix="{{ $p->prix }}">{{ $p->nom }}</option>
            @endforeach
        </select>
        <div class="line-price prix-unit">0,00</div>
        <input type="number" name="lignes[${lineIndex}][quantite]" value="1" min="1" class="qte-input" required oninput="updateLinePrice(this)">
        <div class="line-price sous-total">0,00 DH</div>
        <button type="button" class="btn-remove" onclick="removeLine(this)" title="Supprimer">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>`;

    container.insertAdjacentHTML('beforeend', html);
    lineIndex++;
}

function removeLine(btn) {
    const container = document.getElementById('linesContainer');
    if (container.children.length <= 1) return;
    btn.closest('.line-item').remove();
    renumberLines();
    recalcTotals();
}

function renumberLines() {
    document.querySelectorAll('#linesContainer .line-item').forEach((item, i) => {
        item.querySelector('.line-num').textContent = i + 1;
    });
}

function updateLinePrice(el) {
    const line = el.closest('.line-item');
    const select = line.querySelector('.produit-select');
    const qteInput = line.querySelector('.qte-input');
    const prixUnitEl = line.querySelector('.prix-unit');
    const sousTotalEl = line.querySelector('.sous-total');

    const produitId = select.value;
    const qte = parseInt(qteInput.value) || 0;
    const prix = produitId ? (produitsData[produitId] || 0) : 0;

    prixUnitEl.textContent = formatNumber(prix);
    sousTotalEl.textContent = formatNumber(prix * qte) + ' DH';

    recalcTotals();
}

function recalcTotals() {
    let totalHT = 0;
    document.querySelectorAll('#linesContainer .line-item').forEach(line => {
        const select = line.querySelector('.produit-select');
        const qte = parseInt(line.querySelector('.qte-input').value) || 0;
        const prix = select.value ? (produitsData[select.value] || 0) : 0;
        totalHT += prix * qte;
    });

    const tva = totalHT * 0.2;
    const ttc = totalHT + tva;

    document.getElementById('totalHT').textContent = formatNumber(totalHT) + ' DH';
    document.getElementById('totalTVA').textContent = formatNumber(tva) + ' DH';
    document.getElementById('totalTTC').textContent = formatNumber(ttc) + ' DH';
}

function formatNumber(n) {
    return n.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}
</script>
@endsection