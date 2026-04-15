@extends('layouts.app')

@section('content')

<div class="cards">

<div class="card">
    <div>
        <small>Total Commandes</small>
        <h4>{{ $totalCommandes }}</h4>
    </div>
    <div class="icon-box blue">📄</div>
</div>

<div class="card">
    <div>
        <small>En Attente</small>
        <h4>{{ $enAttente }}</h4>
    </div>
    <div class="icon-box orange">⏳</div>
</div>

<div class="card">
    <div>
        <small>Montant Total</small>
        <h4>{{ $montantTotal }} DH</h4>
    </div>
    <div class="icon-box purple">💰</div>
</div>

<div class="card">
    <div>
        <small>Fournisseurs</small>
        <h4>{{ $totalFournisseurs ?? 0 }}</h4>
    </div>
    <div class="icon-box green">👤</div>
</div>

</div>

<div class="table">

<table>

<thead>
<tr>
<th>ID</th>
<th>Fournisseur</th>
<th>Date</th>
<th>Articles</th>
<th>Montant</th>
<th>Statut</th>
</tr>
</thead>

<tbody>

@foreach($bons as $bon)
<tr>
<td>{{ $bon->reference }}</td>
<td>{{ $bon->fournisseur->nom  }}</td>
<td>{{ $bon->date_commande }}</td>
<td>{{ $bon->lignes->count() ?? 0 }}</td>
<td>{{ $bon->total_ttc }} DH</td>
<td>
<span class="status 
@if($bon->statut->nom == 'validé') valid
@elseif($bon->statut->nom == 'en attente') pending
@else refuse
@endif">
{{ $bon->statut->nom }}
</span>
</td>
</tr>
@endforeach

</tbody>

</table>

<br>

<a href="{{ route('dashboard.pdf') }}" class="btn btn-primary">
    Export PDF
</a>

</div>

@endsection