<?php  ?>
@extends('layouts.app')

@section('content')

<div class="container mt-5" style="max-width:700px">

    <div class="card shadow-lg border-0" style="border-top:5px solid #0d3b66;">
        
        <div class="card-header bg-light">
            <h3 class="fw-bold text-primary">➕ Ajouter un Produit</h3>
            <p class="text-muted mb-0">Ajoutez un produit avec fournisseur</p>
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

            <form action="{{ route('produits.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nom *</label>
                    <input type="text" name="nom" class="form-control" placeholder="Nom produit" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" placeholder="Description produit"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Prix *</label>
                    <input type="number" step="0.01" name="prix" class="form-control" placeholder="100.00" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fournisseur *</label>
                    <select name="fournisseur_id" class="form-control" required>
                        <option value="">-- Choisir Fournisseur --</option>
                        @foreach($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}">
                                {{ $fournisseur->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary w-100 mt-3">
                    💾 Enregistrer Produit
                </button>

            </form>

        </div>
    </div>

</div>

@endsection