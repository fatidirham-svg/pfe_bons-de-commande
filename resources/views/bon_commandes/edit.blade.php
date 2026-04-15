@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>✏️ Modifier Bon de Commande: {{ $bonCommande->reference }}</h2>

    <form action="{{ route('bon_commandes.update', $bonCommande) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <!-- STATUT -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Statut *</label>
                <select name="statut_id" class="form-control" required>
                    @foreach($statuts as $statut)
                        <option value="{{ $statut->id }}"
                            {{ $bonCommande->statut_id == $statut->id ? 'selected' : '' }}>
                            {{ $statut->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- DATE -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Date commande *</label>
                <input type="date"
                       name="date_commande"
                       class="form-control"
                       value="{{ $bonCommande->date_commande }}"
                       required>
            </div>

            <!-- CATEGORIE -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Catégorie</label>
                <select name="categorie" class="form-control">
                    <option value="Prestations de service"
                        {{ $bonCommande->categorie == 'Prestations de service' ? 'selected' : '' }}>
                        Prestations de service
                    </option>

                    <option value="Achat matériel"
                        {{ $bonCommande->categorie == 'Achat matériel' ? 'selected' : '' }}>
                        Achat matériel
                    </option>
                </select>
            </div>

            <!-- MODE REGLEMENT -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Mode règlement</label>
                <select name="mode_regelement" class="form-control">
                    <option value="1 mois" {{ $bonCommande->mode_regelement == '1 mois' ? 'selected' : '' }}>
                        1 mois
                    </option>
                    <option value="2 mois" {{ $bonCommande->mode_regelement == '2 mois' ? 'selected' : '' }}>
                        2 mois
                    </option>
                </select>
            </div>

            <!-- OBSERVATIONS -->
            <div class="col-12 mb-3">
                <label class="form-label">Observations</label>
                <textarea name="observations" class="form-control" rows="3">
                    {{ $bonCommande->observations }}
                </textarea>
            </div>

        </div>

        <hr>

        <button type="submit" class="btn btn-primary">
            💾 Sauvegarder modifications
        </button>

        <a href="{{ route('bon_commandes.index') }}" class="btn btn-secondary">
            Retour
        </a>

    </form>

</div>

@endsection