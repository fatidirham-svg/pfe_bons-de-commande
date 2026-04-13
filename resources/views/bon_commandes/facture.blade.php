@extends('layouts.app')
@section('content')
<h2>Facture: {{ $bon->reference }}</h2>
<p><strong>Client:</strong> {{ $bon->user->name }}</p>
<p><strong>Statut:</strong> {{ $bon->statut->nom }}</p>
<p><strong>Date:</strong> {{ $bon->created_at->format('d/m/Y') }}</p>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Produit</th>
            <th>Prix Unitaire</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php $totalHT = 0; @endphp
        @foreach($bon->lignes as $ligne)
            @php $totalLigne = $ligne->prix_unitaire * $ligne->quantite; @endphp
            <tr>
                <td>{{ $ligne->produit->nom }}</td>
                <td>{{ $ligne->prix_unitaire }} DH</td>
                <td>{{ $ligne->quantite }}</td>
                <td>{{ $totalLigne }} DH</td>
            </tr>
            @php $totalHT += $totalLigne; @endphp
        @endforeach
    </tbody>
</table>

<h3>Total HT: {{ $totalHT }} DH</h3>
<h3>Total TTC (20% TVA): {{ $totalHT * 1.2 }} DH</h3>

@endsection