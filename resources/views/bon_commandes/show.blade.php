@extends('layouts.app')

@section('content')
<h2>Détail du bon {{ $bonCommande->reference }}</h2>

<p><strong>Utilisateur :</strong> {{ $bonCommande->user->name }}</p>
<p><strong>Fournisseur :</strong> {{ $bonCommande->fournisseur->nom ?? '-' }}</p>
<p><strong>Statut :</strong> {{ $bonCommande->statut->nom }}</p>
<p><strong>Total HT :</strong> {{ number_format($bonCommande->total_ht,2,',',' ') }} €</p>
<p><strong>Total TTC :</strong> {{ number_format($bonCommande->total_ttc,2,',',' ') }} €</p>

<h4>Lignes</h4>
<table class="table">
    <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
         
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bonCommande->lignes as $ligne)
        <tr>
            <td>{{ $ligne->produit->nom  }}</td>
            <td>{{ $ligne->quantite }}</td>
            <td>{{ number_format($ligne->prix_unitaire,2,',',' ') }}</td>
            <td>{{ number_format($ligne->total,2,',',' ') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('bon_commandes.index') }}" class="btn btn-secondary">Retour</a>
<a href="{{ route('bon_commandes.facture', $bonCommande) }}" class="btn btn-success">Télécharger facture</a>
@endsection