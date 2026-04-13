<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Liste des commandes</h1>
<a href="{{ route('orders.create') }}">Créer une commande</a>

@foreach($orders as $order)
    <div>
        <h2>{{ $order->title }}</h2>
        <p>{{ $order->description }}</p>
        <p>Montant: {{ $order->amount }}</p>
        <a href="{{ route('orders.edit', $order) }}">Modifier</a>
        <form action="{{ route('orders.destroy', $order) }}" method="POST">
            @csrf
            @method('DELETE')
            <button>Supprimer</button>
        </form>
    </div>
@endforeach
</body>
</html>