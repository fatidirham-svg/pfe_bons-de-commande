@extends('layouts.app')

@section('content')

<div class="container-box">

<h2>Créer Bon de Commande ({{ $type }})</h2>

<form method="POST" action="{{ route('bon_commandes.store') }}">
@csrf

<input type="hidden" name="type" value="{{ $type }}">

<div class="form-grid">

    <div class="form-group">
        <label>Date de commande *</label>
        <input type="date" name="date_commande" required>
    </div>

    <div class="form-group">
        <label>Statut initial *</label>
        <select name="statut_id" required>
            <option value="">-- Choisir --</option>
            @foreach($statuts as $s)
                <option value="{{ $s->id }}">{{ $s->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Fournisseur *</label>
        <select name="fournisseur_id" required>
            <option value="">-- Choisir --</option>
            @foreach($fournisseurs as $f)
                <option value="{{ $f->id }}">{{ $f->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Mode de règlement *</label>
        <select name="mode_regelement" required>
            <option value="">-- Choisir --</option>
            <option value="1 mois">1 mois</option>
            <option value="2 mois">2 mois</option>
        </select>
    </div>

</div>

<div class="form-group">
    <label>Observations</label>
    <textarea name="observations" rows="3" placeholder="Notes internes ou instructions..."></textarea>
</div>

<hr>

<h4>Lignes de commande</h4>

<div id="lines">

    <div class="line-item">
        <select name="lignes[0][produit_id]" required>
            <option value="">Produit</option>
            @foreach($produits as $p)
                <option value="{{ $p->id }}">{{ $p->nom }}</option>
            @endforeach
        </select>

        <input type="number" name="lignes[0][quantite]" value="1" min="1" required>

        <button type="button" class="btn btn-danger btn-sm" onclick="removeLine(this)">🗑</button>
    </div>

</div>

<!-- ADD BUTTON -->
<div class="add-line" onclick="addLine()">
    + Ajouter un produit
</div>

<!-- FOOTER -->
<div class="footer-bar">
    <div class="total">Total TTC: 0 MAD</div>

    <div>
        <button type="reset" class="btn">Annuler</button>
        <button type="submit" class="btn btn-primary">Enregistrer le BC</button>
    </div>
</div>

</form>

</div>

<script>
let index = 1;

function addLine(){
    let container = document.getElementById('lines');

    let html = `
    <div class="line-item">
        <select name="lignes[${index}][produit_id]" required>
            <option value="">Produit</option>
            @foreach($produits as $p)
                <option value="{{ $p->id }}">{{ $p->nom }}</option>
            @endforeach
        </select>

        <input type="number" name="lignes[${index}][quantite]" value="1" min="1" required>


        <button type="button" class="btn btn-danger btn-sm" onclick="removeLine(this)">🗑</button>
    </div>`;

    container.insertAdjacentHTML('beforeend', html);
    index++;
}

function removeLine(btn){
    btn.parentElement.remove();
}
</script>

@endsection