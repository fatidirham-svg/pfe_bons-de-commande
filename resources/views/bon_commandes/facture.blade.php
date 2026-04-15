<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Facture PDF</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #0d3b66;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo {
            width: 120px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            color: #0d3b66;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th {
            background: #0d3b66;
            color: white;
            padding: 8px;
        }

        td {
            padding: 8px;
            text-align: center;
        }

        .total {
            margin-top: 20px;
            text-align: right;
            font-size: 14px;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0;
            text-align: center;
            font-size: 10px;
            width: 100%;
            color: #777;
        }
    </style>
</head>

<body>

<div class="header">
    <img src="{{ asset('images/image.png') }}" class="logo" alt="logo">
    <div class="title">FACTURE BON DE COMMANDE</div>
</div>

<div class="info">
    <p><strong>Référence:</strong> {{ $bon->reference }}</p>
    <p><strong>Client:</strong> {{ $bon->user->name }}</p>
    <p><strong>Statut:</strong> {{ $bon->statut->nom }}</p>
    <p><strong>Date:</strong> {{ $bon->created_at->format('d/m/Y') }}</p>
</div>

<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>PU</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>
        @php $totalHT = 0; @endphp

        @foreach($bon->lignes as $ligne)
            @php $total = $ligne->prix_unitaire * $ligne->quantite; @endphp

            <tr>
                <td>{{ $ligne->produit->nom }}</td>
                <td>{{ $ligne->prix_unitaire }} DH</td>
                <td>{{ $ligne->quantite }}</td>
                <td>{{ $total }} DH</td>
            </tr>

            @php $totalHT += $total; @endphp
        @endforeach
    </tbody>
</table>

<div class="total">
    Total HT: {{ $totalHT }} DH <br>
    Total TTC: {{ $totalHT * 1.2 }} DH
</div>

<div class="footer">
    CommandFlow © {{ date('Y') }} - Tous droits réservés
</div>
<a href="{{ route('dashboard.pdf') }}" class="btn btn-danger">
    Export PDF
</a>
</body>
</html>