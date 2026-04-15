<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #0d3b66;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo {
            width: 120px;
        }

        .company {
            text-align: right;
        }

        .company h2 {
            margin: 0;
            color: #0d3b66;
        }

        .invoice-title {
            text-align: center;
            margin: 20px 0;
            font-size: 22px;
            font-weight: bold;
            color: #0d3b66;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background: #0d3b66;
            color: white;
            padding: 10px;
        }

        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .totals {
            margin-top: 20px;
            text-align: right;
        }

        .totals h3 {
            margin: 5px 0;
        }

        .signature {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
        }

        .box {
            width: 200px;
            text-align: center;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <div>
    <img src="{{ asset('images/image.png') }}" class="logo" alt="logo">
    </div>

    <div class="company">
        <h2>CommandFlow SARL</h2>
        <p>Casablanca, Maroc</p>
        <p>Email: contact@company.com</p>
    </div>
</div>

<div class="invoice-title">
    FACTURE BON DE COMMANDE
</div>

@foreach($bons as $bon)

    <p><strong>Référence:</strong> {{ $bon->reference }}</p>
    <p><strong>Client:</strong> {{ $bon->user->name }}</p>
    <p><strong>Statut:</strong> {{ $bon->statut->nom }}</p>
    <p><strong>Date:</strong> {{ $bon->created_at->format('d/m/Y') }}</p>

    <!-- TABLE -->
    <table>
        <thead>
        <tr>
            <th>Produit</th>
            <th>Prix Unitaire</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
        </thead>

        <tbody>
        @foreach($bon->lignes as $ligne)
            <tr>
                <td>{{ $ligne->produit->nom }}</td>
                <td>{{ number_format($ligne->prix_unitaire, 2) }} DH</td>
                <td>{{ $ligne->quantite }}</td>
                <td>{{ number_format($ligne->total, 2) }} DH</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- TOTAL -->
    <div class="totals">
        <h3>Total HT: {{ number_format($bon->total_ht, 2) }} DH</h3>
        <h3>Total TTC (20% TVA): {{ number_format($bon->total_ttc, 2) }} DH</h3>
    </div>

    <hr style="margin:30px 0;">

@endforeach

<!-- SIGNATURE -->
<div class="signature">
    <div class="box">
        <p>Signature Client</p>
        <br><br>
        ____________
    </div>

    <div class="box">
        <p>Signature Société</p>
        <br><br>
        ____________
    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    Merci pour votre confiance — CommandFlow © {{ date('Y') }}
</div>

</body>
</html>