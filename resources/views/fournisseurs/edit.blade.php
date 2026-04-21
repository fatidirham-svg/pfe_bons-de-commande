@extends('layouts.app')

@section('content')

<div style="max-width:600px;margin:40px auto;background:#fff;padding:25px;border-radius:15px;box-shadow:0 10px 25px rgba(0,0,0,0.1);">

<h2>Modifier Fournisseur</h2>

<form method="POST" action="{{ route('fournisseurs.update', $fournisseur->id) }}">
@csrf
@method('PUT')

<label>Nom</label>
<input type="text" name="nom" value="{{ $fournisseur->nom }}" class="form-control" required>

<br>

<label>Email</label>
<input type="email" name="email" value="{{ $fournisseur->email }}" class="form-control">

<br>

<label>Téléphone</label>
<input type="text" name="telephone" value="{{ $fournisseur->telephone }}" class="form-control">

<br>

<label>Adresse</label>
<textarea name="adresse" class="form-control">{{ $fournisseur->adresse }}</textarea>

<br>

<button type="submit" style="background:#2563eb;color:white;padding:10px 20px;border:none;border-radius:10px;">
💾 Sauvegarder
</button>

</form>

</div>

@endsection