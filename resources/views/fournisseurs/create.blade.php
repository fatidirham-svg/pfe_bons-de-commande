@extends('layouts.app')

@section('content')

<div class="container mt-5" style="max-width:700px">

    <div class="card shadow-lg border-0" style="border-top:5px solid #E30613;">
        
        <div class="card-header bg-light">
            <h3 class="fw-bold text-danger">➕ Ajouter un Fournisseur</h3>
            <p class="text-muted mb-0">Enregistrez un nouveau partenaire</p>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('fournisseurs.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nom *</label>
                        <input type="text" name="nom" class="form-control" placeholder="SARL Distribution" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="contact@mail.com">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="telephone" class="form-control" placeholder="+212...">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Adresse</label>
                        <input type="text" name="adresse" class="form-control" placeholder="Casablanca">
                    </div>

                </div>

                <button class="btn btn-danger w-100 mt-3">
                    💾 Enregistrer le Fournisseur
                </button>

            </form>

        </div>
    </div>

</div>

@endsection