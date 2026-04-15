@extends('layouts.app')

@section('content')

<h2>Choisir le type de Bon de Commande</h2>

<div style="display:flex; gap:20px;">

    <a href="{{ route('bon_commandes.create', ['type' => 'finance']) }}" class="btn btn-primary">
        Attijari Finance
    </a>

    <a href="{{ route('bon_commandes.create', ['type' => 'intermediation']) }}" class="btn btn-success">
        Attijari Intermédiation
    </a>

    <a href="{{ route('bon_commandes.create', ['type' => 'management']) }}" class="btn btn-dark">
        Attijari Management
    </a>

</div>

@endsection