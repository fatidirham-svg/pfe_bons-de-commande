@extends('layouts.app')

@section('content')

<h2>📄 Liste des Bons de Commande</h2>

<form method="GET" class="form-group" style="max-width:300px;">
    <input type="text" name="fournisseur" placeholder="Rechercher fournisseur">
</form>

<table class="table">
    <thead>
        <tr>
            <th>Réf</th>
            <th>Utilisateur</th>
            <th>Fournisseur</th>
            <th>Statut</th>
            <th>Total HT</th>
            <th>Total TTC</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($bons as $bon)
        <tr>
            <td>{{ $bon->reference }}</td>
            <td>{{ $bon->user->name }}</td>
            <td>{{ $bon->fournisseur->nom ?? '-' }}</td>
            <td>
                <span class="status pending">{{ $bon->statut->nom }}</span>
            </td>
            <td>{{ $bon->total_ht }} DH</td>
            <td>{{ $bon->total_ttc }} DH</td>
            <td>
                <a href="{{ route('bon_commandes.show', $bon) }}">Voir</a>

                @if(Auth::user()->isAdmin() || Auth::id() === $bon->user_id)
                    <a href="{{ route('bon_commandes.edit', $bon) }}">Edit</a>
                @endif

                @if(Auth::user()->isAdmin())
                    <form method="POST" action="{{ route('bon_commandes.destroy', $bon) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection