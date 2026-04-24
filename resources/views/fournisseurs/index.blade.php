@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3> Liste des Fournisseurs</h3>

        <a href="{{ route('fournisseur.create') }}" class="btn btn-danger">
            Ajouter Fournisseur
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($fournisseurs as $f)
                        <tr>
                            <td>{{ $f->id }}</td>
                            <td>{{ $f->nom }}</td>
                            <td>{{ $f->email }}</td>
                            <td>{{ $f->telephone }}</td>
                            <td>{{ $f->adresse }}</td>
                            <td>
                                <a href="{{ route('fournisseur.edit', $f->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <form action="{{ route('fournisseur.destroy', $f->id) }}" method="POST" class="d-inline">
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