@extends('layouts.app')

@section('content')

<h2>Créer Bon de Commande ({{ $type }})</h2>

<form method="POST" action="{{ route('bon_commandes.store') }}">
@csrf

<input type="hidden" name="type" value="{{ $type }}">

<div class="row">

<div class="col-md-6">

<label>Date</label>
<input type="date" name="date_commande" class="form-control">

<label>Catégorie</label>
<select name="categorie" class="form-control">
    <option>Prestations de service</option>
    <option>Achat matériel</option>
</select>

<label>Fournisseur</label>
<select name="fournisseur_id" class="form-control">
    @foreach($fournisseurs as $f)
        <option value="{{ $f->id }}">{{ $f->nom }}</option>
    @endforeach
</select>

<label>Mode règlement</label>
<select name="mode_reglement" class="form-control">
    <option>1 mois</option>
    <option>2 mois</option>
</select>

<label>Observation</label>
<textarea name="observation" class="form-control"></textarea>

</div>

</div>

<hr>

<h4>Produits</h4>

<div id="lignes">

<div class="ligne mb-2">
    <select name="lignes[0][produit_id]">
        @foreach($produits as $p)
            <option value="{{ $p->id }}">{{ $p->nom }}</option>
        @endforeach
    </select>

    <input type="number" name="lignes[0][quantite]" placeholder="Quantité">
</div>

</div>

<button type="submit" class="btn btn-success">Enregistrer</button>

</form>

@endsection