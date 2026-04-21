@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>📦 Liste des Produits</h3>

        <a href="{{ route('produit.create') }}" class="btn btn-danger">
            + Ajouter Produit
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($produits as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->nom }}</td>
                            <td>{{ $p->prix }} MAD</td>
                            <td>{{ $p->description }}</td>
                            <td>
                                <a href="{{ route('produit.edit', $p->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <form action="{{ route('produit.destroy', $p->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection