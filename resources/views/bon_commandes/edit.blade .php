
use App\Http\Controllers\BonCommandeController;

Route::middleware('auth')->group(function () {
    Route::resource('bon_commandes', BonCommandeController::class);
});
@extends('layouts.app')

@section('content')
<h2>Modifier le statut du bon {{ $bonCommande->reference }}</h2>

<form action="{{ route('bon_commandes.update', $bonCommande) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Statut</label>
        <select name="statut_id" class="form-control">
            @foreach($statuts as $statut)
            <option value="{{ $statut->id }}" @if($bonCommande->statut_id == $statut->id) selected @endif>{{ $statut->nom }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
@endsection