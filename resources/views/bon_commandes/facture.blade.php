<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bon de Commande - {{ $bon->reference }}</title>
    <style>
        @page {
            margin: 2cm;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #000;
            line-height: 1.4;
        }
        .header-table {
            width: 100%;
            margin-bottom: 30px;
        }
        .logo-box img {
            width: 220px;
        }
        .date-box {
            text-align: right;
            vertical-align: top;
            padding-top: 10px;
        }
        .recipient-box {
            margin-left: 60%;
            margin-bottom: 40px;
        }
        .recipient-box p {
            margin: 2px 0;
            font-weight: bold;
        }
        .doc-title {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 20px;
            text-decoration: none;
        }
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }
        .main-table th {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            font-size: 10px;
            background: #fcfcfc;
        }
        .main-table td {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            padding: 8px 5px;
            vertical-align: top;
            height: 400px; /* Force minimum height for the table body like in the screenshot */
        }
        .main-table tr.item-row td {
            height: auto;
            border-bottom: none;
        }
        .main-table tr.last-row td {
            border-bottom: 1px solid #000;
            height: 20px;
        }
        .summary-wrapper {
            width: 100%;
            display: table;
        }
        .summary-table {
            width: 40%;
            float: right;
            border-collapse: collapse;
        }
        .summary-table td {
            border: 1px solid #000;
            padding: 5px;
        }
        .summary-table td.label {
            width: 60%;
            font-weight: bold;
        }
        .summary-table td.value {
            text-align: right;
        }
        .signature-section {
            margin-top: 40px;
            width: 100%;
        }
        .signature-section td {
            width: 33%;
            text-align: center;
            font-weight: bold;
        }
        .meta-info {
            margin-top: 60px;
        }
        .meta-info p {
            margin: 5px 0;
        }
        .footer {
            position: fixed;
            bottom: -1cm;
            left: 0;
            right: 0;
            border-top: 2px solid #e30613;
            padding-top: 10px;
            font-size: 8.5px;
            color: #444;
            text-align: left;
        }
        .footer strong {
            color: #000;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td class="logo-box">
                <img src="{{ public_path('images/attijari-logo.png') }}" alt="Logo">
            </td>
            <td class="date-box">
                Casablanca, le {{ $bon->date_commande ? \Carbon\Carbon::parse($bon->date_commande)->format('d/m/Y') : date('d/m/Y') }}
            </td>
        </tr>
    </table>

    <div class="recipient-box">
        <p>Mr :</p>
        <p>{{ $bon->fournisseur->nom ?? 'Destinataire' }}</p>
        <p>{{ $bon->fournisseur->adresse ?? 'Casablanca' }}</p>
    </div>

    <div class="doc-title">
        Bon de Commande N° : &nbsp;&nbsp; {{ $bon->reference }}
    </div>

    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 8%;">QTE</th>
                <th style="width: 15%;">Ref</th>
                <th style="width: 47%;">Désignation</th>
                <th style="width: 15%;">P.U HT</th>
                <th style="width: 15%;">TOTAL H.T.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bon->lignes as $ligne)
            <tr class="item-row">
                <td style="text-align: center;">{{ $ligne->quantite }}</td>
                <td style="text-align: center;">{{ $ligne->produit->reference ?? '-' }}</td>
                <td>{{ $ligne->produit->nom }}</td>
                <td style="text-align: right;">{{ number_format($ligne->prix_unitaire, 2, ',', ' ') }}</td>
                <td style="text-align: right;">{{ number_format($ligne->prix_unitaire * $ligne->quantite, 2, ',', ' ') }}</td>
            </tr>
            @endforeach
            
            {{-- Padding rows to keep table structure --}}
            <tr><td colspan="5" style="border-bottom: none;"></td></tr>
        </tbody>
    </table>

    <div class="summary-wrapper">
        <table class="summary-table">
            <tr>
                <td class="label">Prix Total HT</td>
                <td class="value">{{ number_format($bon->total_ht, 2, ',', ' ') }} DH</td>
            </tr>
            <tr>
                <td class="label">TVA 20 %</td>
                <td class="value">{{ number_format($bon->total_ht * 0.2, 2, ',', ' ') }} DH</td>
            </tr>
            <tr>
                <td class="label" style="background: #f8fafc;">Prix Total TTC</td>
                <td class="value" style="background: #f8fafc; font-weight: bold;">{{ number_format($bon->total_ttc, 2, ',', ' ') }} DH</td>
            </tr>
        </table>
    </div>

    <table class="signature-section">
        <tr>
            <td>Directeur</td>
            <td>Contrôleur</td>
            <td>Fournisseur</td>
        </tr>
    </table>

    <div class="meta-info">
        <p><strong>Mode de règlement :</strong> &nbsp;&nbsp;&nbsp;&nbsp; {{ $bon->mode_regelement ?? '03 mois' }}</p>
        <p><strong>Observation :</strong> {{ $bon->observations }}</p>
    </div>


    <div class="footer">
        <strong>Attijari Intermédiation</strong><br>
        Société Anonyme à Directoire et Conseil de Surveillance au capital de 1.000.000 DHs<br>
        Siège social : 163, Avenue Hassan II - 20140 CASABLANCA - MAROC<br>
        Tél. : 05 22 49 14 82 - Fax : 05 22 20 25 15<br>
        Patente : 37991708 - R.C : 77183 - CNSS : 2165171 - I.F : 01086093 - ICE : 001514530000080<br>
        <span style="color: #e30613;">www.ati.ma</span>
    </div>

</body>
</html>