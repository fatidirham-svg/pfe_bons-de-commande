@extends('layouts.app')

@section('title', 'Modifier Bon de Commande')

@section('content')

<style>
    .create-wrapper {
        max-width: 1020px;
        margin: 0 auto;
        padding-bottom: 40px;
    }

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 32px;
        padding: 22px 26px;
        border-radius: 24px;
        background: linear-gradient(135deg, rgba(227,6,19,0.12), rgba(255,183,27,0.12));
        border: 1px solid rgba(227,6,19,0.16);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.05);
    }

    .page-header-left {
        display: grid;
        gap: 6px;
    }

    .page-header h2 {
        margin: 0;
        font-size: 28px;
        font-weight: 800;
        color: #111827;
    }

    .page-subtitle {
        font-size: 14px;
        color: #4b5563;
    }

    .type-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 18px;
        border-radius: 999px;
        background: #fff;
        border: 1px solid rgba(227,6,19,0.18);
        color: #b91c1c;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
    }

    .form-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 34px;
        box-shadow: 0 18px 45px rgba(12, 12, 13, 0.06);
        margin-bottom: 24px;
        border: 1px solid #f3f4f6;
        position: relative;
        overflow: hidden;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, rgba(227,6,19,0.22), rgba(255,183,27,0.24));
    }

    .form-card-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid #eef2ff;
    }

    .form-card-title i {
        width: 36px;
        height: 36px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--tijari-red), #c20510);
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(227,6,19,0.2);
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-row.full {
        grid-template-columns: 1fr;
    }

    .field-group label {
        display: block;
        margin-bottom: 10px;
        color: #4b5563;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .field-group label .required {
        color: var(--tijari-red);
    }

    .field-group input,
    .field-group select,
    .field-group textarea {
        width: 100%;
        min-height: 48px;
        padding: 14px 16px;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
        font-size: 14px;
        color: #111827;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .field-group input:focus,
    .field-group select:focus,
    .field-group textarea:focus {
        outline: none;
        border-color: var(--tijari-red);
        box-shadow: 0 0 0 5px rgba(227,6,19,0.08);
        background: #ffffff;
    }

    .field-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .lines-header,
    .line-item {
        display: grid;
        grid-template-columns: 50px 1fr 130px 100px 140px 50px;
        gap: 12px;
        align-items: center;
    }

    .lines-header {
        padding: 14px 16px;
        background: #111827;
        color: #ffffff;
        border-radius: 16px 16px 0 0;
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 700;
    }

    .line-item {
        padding: 16px;
        background: #f8fafc;
        border-left: 2px solid #e5e7eb;
        border-right: 2px solid #e5e7eb;
        border-bottom: 1px solid #e5e7eb;
        border-radius: 0;
    }

    .line-item:last-child {
        border-bottom: 2px solid #e5e7eb;
        border-radius: 0 0 16px 16px;
    }

    .line-num {
        width: 38px;
        height: 38px;
        display: grid;
        place-items: center;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        font-weight: 700;
        color: #374151;
    }

    .line-item select,
    .line-item input {
        width: 100%;
        min-height: 48px;
        padding: 12px 14px;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        background: #ffffff;
        font-size: 14px;
        color: #111827;
    }

    .line-price {
        font-weight: 700;
        font-size: 14px;
        color: #111827;
        text-align: right;
    }

    .btn-remove {
        width: 38px;
        height: 38px;
        border: none;
        background: #fee2e2;
        color: #b91c1c;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-remove:hover {
        background: #dc2626;
        color: #ffffff;
        transform: scale(1.05);
    }

    .btn-add-line {
        width: 100%;
        padding: 16px;
        margin-top: 18px;
        border: 2px dashed #e5e7eb;
        border-radius: 16px;
        background: transparent;
        color: #374151;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .btn-add-line:hover {
        border-color: var(--tijari-red);
        color: var(--tijari-red);
        background: rgba(227,6,19,0.06);
    }

    .totals-bar {
        display: flex;
        justify-content: flex-end;
        gap: 28px;
        margin-top: 24px;
        padding: 22px 24px;
        background: linear-gradient(135deg, #111827, #1f2937);
        border-radius: 20px;
    }

    .total-item {
        text-align: right;
        color: #d1d5db;
    }

    .total-item .total-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .total-item .total-value {
        display: block;
        font-size: 22px;
        font-weight: 800;
        color: #ffffff;
    }

    .total-item.ttc .total-value {
        color: #ffbf00;
    }

    .submit-bar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-top: 28px;
    }

    .btn-cancel,
    .btn-submit {
        padding: 14px 30px;
        border-radius: 16px;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.25s ease;
    }

    .btn-cancel {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        color: #374151;
    }

    .btn-cancel:hover {
        background: #f8fafc;
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--tijari-red), #c20510);
        border: none;
        color: #ffffff;
        box-shadow: 0 10px 30px rgba(227,6,19,0.24);
    }

    .btn-submit:hover {
        transform: translateY(-1px);
    }

    .error-box {
        background: #fff1f2;
        border: 1px solid #fecaca;
        border-radius: 16px;
        padding: 18px 22px;
        margin-bottom: 26px;
    }

    .error-box ul {
        margin: 0;
        padding-left: 18px;
    }

    .error-box li {
        color: #b91c1c;
        font-size: 13px;
        line-height: 1.6;
    }
</style>

<div class="create-wrapper">

    @if($errors->any())
        <div class="error-box">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="page-header">
        <div class="page-header-left">
            <h2>✏️ Modifier Bon de Commande</h2>
            <p class="page-subtitle">Référence : {{ $bonCommande->reference }}</p>
        </div>
        <span class="type-badge">Modifier</span>
    </div>

    <form method="POST" action="{{ route('bon_commandes.update', $bonCommande) }}" id="bcForm">
        @csrf
        @method('PUT')

        <div class="form-card">
            <div class="form-card-title">
                <i class="fa-solid fa-clipboard-list"></i>
                Informations Générales
            </div>

            <div class="form-row">
                <div class="field-group">
                    <label>Date de commande <span class="required">*</span></label>
                    <input type="date" name="date_commande" value="{{ old('date_commande', $bonCommande->date_commande) }}" required>
                </div>
                <div class="field-group">
                    <label>Fournisseur <span class="required">*</span></label>
                    <select name="fournisseur_id" required>
                        <option value="">— Sélectionner un fournisseur —</option>
                        @foreach($fournisseurs as $f)
                            <option value="{{ $f->id }}" {{ old('fournisseur_id', $bonCommande->fournisseur_id) == $f->id ? 'selected' : '' }}>{{ $f->nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="field-group">
                    <label>Statut <span class="required">*</span></label>
                    <select name="statut_id" required>
                        <option value="">— Sélectionner un statut —</option>
                        @foreach($statuts as $s)
                            <option value="{{ $s->id }}" {{ old('statut_id', $bonCommande->statut_id) == $s->id ? 'selected' : '' }}>{{ ucfirst($s->nom) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-group">
                    <label>Catégorie</label>
                    <select name="categorie">
                        <option value="Prestations de service" {{ old('categorie', $bonCommande->categorie) == 'Prestations de service' ? 'selected' : '' }}>Prestations de service</option>
                        <option value="Achat matériel" {{ old('categorie', $bonCommande->categorie) == 'Achat matériel' ? 'selected' : '' }}>Achat matériel</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="field-group">
                    <label>Mode de règlement <span class="required">*</span></label>
                    <select name="mode_regelement" required>
                        <option value="">— Sélectionner —</option>
                        <option value="Comptant" {{ old('mode_regelement', $bonCommande->mode_regelement) == 'Comptant' ? 'selected' : '' }}>Comptant</option>
                        <option value="1 mois" {{ old('mode_regelement', $bonCommande->mode_regelement) == '1 mois' ? 'selected' : '' }}>1 mois</option>
                        <option value="2 mois" {{ old('mode_regelement', $bonCommande->mode_regelement) == '2 mois' ? 'selected' : '' }}>2 mois</option>
                        <option value="03 mois" {{ old('mode_regelement', $bonCommande->mode_regelement) == '03 mois' ? 'selected' : '' }}>03 mois</option>
                    </select>
                </div>
                <div class="field-group">
                    <label>Référence</label>
                    <input type="text" value="{{ $bonCommande->reference }}" disabled>
                </div>
            </div>

            <div class="form-row full">
                <div class="field-group">
                    <label>Observations</label>
                    <textarea name="observations" placeholder="Notes internes, instructions spéciales...">{{ old('observations', $bonCommande->observations) }}</textarea>
                </div>
            </div>
        </div>

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
                @if($bonCommande->lignes->count())
                    @foreach($bonCommande->lignes as $index => $ligne)
                        <div class="line-item" data-index="{{ $index }}">
                            <div class="line-num">{{ $index + 1 }}</div>
                            <select name="lignes[{{ $index }}][produit_id]" class="produit-select" required onchange="updateLinePrice(this)">
                                <option value="">— Choisir un produit —</option>
                                @foreach($produits as $p)
                                    <option value="{{ $p->id }}" data-prix="{{ $p->prix }}" {{ $ligne->produit_id == $p->id ? 'selected' : '' }}>{{ $p->nom }}</option>
                                @endforeach
                            </select>
                            <div class="line-price prix-unit">{{ number_format($ligne->prix_unitaire, 2, ',', ' ') }}</div>
                            <input type="number" name="lignes[{{ $index }}][quantite]" value="{{ $ligne->quantite }}" min="1" class="qte-input" required oninput="updateLinePrice(this)">
                            <div class="line-price sous-total">{{ number_format($ligne->total, 2, ',', ' ') }} DH</div>
                            <button type="button" class="btn-remove" onclick="removeLine(this)" title="Supprimer">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    @endforeach
                @else
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
                @endif
            </div>

            <button type="button" class="btn-add-line" onclick="addLine()">
                <i class="fa-solid fa-plus"></i> Ajouter un produit
            </button>

            <div class="totals-bar">
                <div class="total-item">
                    <div class="total-label">Total HT</div>
                    <div class="total-value" id="totalHT">{{ number_format($bonCommande->total_ht, 2, ',', ' ') }} DH</div>
                </div>
                <div class="total-item">
                    <div class="total-label">TVA 20%</div>
                    <div class="total-value" id="totalTVA">{{ number_format($bonCommande->total_ht * 0.2, 2, ',', ' ') }} DH</div>
                </div>
                <div class="total-item ttc">
                    <div class="total-label">Total TTC</div>
                    <div class="total-value" id="totalTTC">{{ number_format($bonCommande->total_ttc, 2, ',', ' ') }} DH</div>
                </div>
            </div>
        </div>

        <div class="submit-bar">
            <a href="{{ route('bon_commandes.index') }}" class="btn-cancel">
                <i class="fa-solid fa-arrow-left"></i> Retour
            </a>
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-save"></i> Sauvegarder les modifications
            </button>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
let lineIndex = {{ $bonCommande->lignes->count() }};

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

document.addEventListener('DOMContentLoaded', function() {
    recalcTotals();
});
</script>
@endsection