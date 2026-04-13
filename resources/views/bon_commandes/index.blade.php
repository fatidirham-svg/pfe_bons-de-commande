@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Liste des Bons de Commande</h2>
    <a href="{{ route('bon_commandes.create') }}" class="btn btn-primary">Créer un bon</a>
</div>
<a href="{{ route('bon_commandes.create') }}">
    <button>Créer un bon</button>
</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Référence</th>
            <th>Utilisateur</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
@foreach($bons as $bon)
<tr>
    <td>{{ $bon->reference }}</td>
    <td>{{ $bon->user->name }}</td>
    <td>{{ $bon->statut->nom }}</td>
            <td>{{ $bon->total_ht }} DH</td>
            <td>{{ $bon->total_ttc }} DH</td>
    <td>
        <a href="{{ route('bon_commandes.show', $bon) }}">Voir</a>

        @if(Auth::user()->isAdmin() || Auth::id() === $bon->user_id)
            <a href="{{ route('bon_commandes.edit', $bon) }}">Modifier</a>
        @endif

        @if(Auth::user()->isAdmin())
            <form method="POST" action="{{ route('bon_commandes.destroy', $bon) }}">
                @csrf
                @method('DELETE')
                <button>Supprimer</button>
            </form>
        @endif
    </td>
</tr>
@endforeach
    </tbody>
</table>

@endsection