<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bon de Commande - {{ $bon->reference }}</title>
    <style>
        @page {
            margin-top: 1.8cm;
            margin-bottom: 3.2cm;
            margin-left: 1.5cm;
            margin-right: 1.5cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10.5px;
            color: #1a1a1a;
            line-height: 1.45;
            margin: 0;
            padding: 0;
        }

        /* ========== HEADER ========== */
        .header-table {
            width: 100%;
            margin-bottom: 12px;
            border-collapse: collapse;
        }
        .header-table td {
            vertical-align: top;
            padding: 0;
        }
        .logo-cell img {
            width: 200px;
            height: auto;
        }
        .date-cell {
            text-align: right;
            font-size: 10.5px;
            padding-top: 30px;
            color: #333;
        }

        /* ========== RECIPIENT ========== */
        .recipient-block {
            width: 100%;
            margin-bottom: 18px;
        }
        .recipient-inner {
            float: right;
            text-align: left;
            width: 35%;
        }
        .recipient-inner p {
            margin: 1px 0;
            font-size: 10.5px;
            font-weight: bold;
        }
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        /* ========== BON TITLE ========== */
        .bon-title {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 14px;
            margin-top: 8px;
            color: #000;
        }

        /* ========== MAIN TABLE ========== */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }
        .main-table thead th {
            border: 1px solid #000;
            padding: 6px 5px;
            text-align: center;
            font-size: 9.5px;
            font-weight: bold;
            background-color: #fafafa;
            color: #000;
            text-transform: none;
        }
        .main-table tbody td {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-bottom: none;
            padding: 5px 6px;
            vertical-align: top;
            font-size: 10px;
        }
        .main-table tbody tr:first-child td {
            padding-top: 8px;
        }

        /* Spacer: creates the tall body area like in the screenshot */
        .table-body-spacer td {
            height: 280px;
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            border-top: none;
        }

        /* ========== SUMMARY TABLE ========== */
        .summary-wrapper {
            width: 100%;
            margin-bottom: 0;
        }
        .summary-table {
            float: right;
            width: 38%;
            border-collapse: collapse;
        }
        .summary-table td {
            border: 1px solid #000;
            padding: 4px 8px;
            font-size: 10px;
        }
        .summary-table .label-cell {
            font-weight: bold;
            width: 62%;
            text-align: left;
        }
        .summary-table .value-cell {
            text-align: right;
            width: 38%;
        }
        .summary-table tr:last-child td {
            font-weight: bold;
        }

        /* ========== SIGNATURE SECTION ========== */
        .signature-table {
            width: 100%;
            margin-top: 35px;
            border-collapse: collapse;
        }
        .signature-table td {
            width: 33.33%;
            text-align: center;
            vertical-align: top;
            padding: 0 10px;
        }
        .sig-title {
            font-weight: bold;
            font-size: 10px;
            margin-bottom: 50px;
            display: block;
        }
        .sig-line {
            border-top: 1px solid #333;
            width: 80%;
            margin: 0 auto;
            margin-top: 50px;
        }

        /* ========== META INFO ========== */
        .meta-section {
            margin-top: 30px;
        }
        .meta-section p {
            margin: 6px 0;
            font-size: 10.5px;
        }
        .meta-section .meta-label {
            font-weight: bold;
        }
        .observation-box {
            margin-top: 12px;
            padding: 6px 0;
            min-height: 30px;
        }

        /* ========== FOOTER ========== */
        .footer {
            position: fixed;
            bottom: -1.8cm;
            left: 0;
            right: 0;
            border-top: 2.5px solid #e30613;
            padding-top: 8px;
            font-size: 8px;
            color: #444;
            text-align: left;
            line-height: 1.55;
        }
        .footer strong {
            color: #000;
            font-size: 8.5px;
        }
        .footer .website {
            color: #e30613;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>
<body>

    {{-- ===================== FOOTER (fixed) ===================== --}}
    <div class="footer">
        <strong>{{ $societe ?? 'Attijari Intermédiation' }}</strong><br>
        @if($societe === 'Attijari Intermédiation')
        Société Anonyme à Directoire et Conseil de Surveillance au capital de 1.000.000 DHs<br>
        Siège social : 163, Avenue Hassan II – 20140 CASABLANCA – MAROC<br>
        Tél. : 05 22 49 14 82 &nbsp; Fax : 05 22 20 25 15<br>
        Patente : 37991708 – R.C : 77183 – CNSS : 2165171 – I.F : 01086093 – ICE : 001514530000080<br>
        <span class="website">www.ati.ma</span>
        @elseif($societe === 'Attijari Finance')
        Société Anonyme à Directoire et Conseil de Surveillance au capital de 500.000.000 DHs<br>
        Siège social : Tour ATTijariwafa Bank, Boulevard Mohamed Zerktouni – 20100 CASABLANCA – MAROC<br>
        Tél. : 05 22 43 33 33 &nbsp; Fax : 05 22 43 33 34<br>
        Patente : 44556677 – R.C : 889900 – CNSS : 3344556 – I.F : 44556677 – ICE : 004455667000001<br>
        <span class="website">www.attijarifinance.ma</span>
        @elseif($societe === 'Attijari Management')
        Société Anonyme à Directoire et Conseil de Surveillance au capital de 200.000.000 DHs<br>
        Siège social : 163, Avenue Hassan II – 20140 CASABLANCA – MAROC<br>
        Tél. : 05 22 49 15 00 &nbsp; Fax : 05 22 20 25 20<br>
        Patente : 77889900 – R.C : 112233 – CNSS : 4455667 – I.F : 77889900 – ICE : 007788990000001<br>
        <span class="website">www.attijarimanagement.ma</span>
        @elseif($societe === 'BMCE Bank')
        Société Anonyme à Directoire et Conseil de Surveillance au capital de 1.000.000 DHs<br>
        Siège social : 1, Boulevard Zerktouni – 20000 CASABLANCA – MAROC<br>
        Tél. : 05 22 20 20 20 &nbsp; Fax : 05 22 20 20 21<br>
        Patente : 12345678 – R.C : 98765 – CNSS : 1234567 – I.F : 12345678 – ICE : 001234567000001<br>
        <span class="website">www.bmce.ma</span>
        @elseif($societe === 'Banque Populaire')
        Société Anonyme à Directoire et Conseil de Surveillance au capital de 1.000.000 DHs<br>
        Siège social : 2, Boulevard Al Massira Al Khadra – 20100 CASABLANCA – MAROC<br>
        Tél. : 05 22 54 54 54 &nbsp; Fax : 05 22 54 54 55<br>
        Patente : 87654321 – R.C : 56789 – CNSS : 7654321 – I.F : 87654321 – ICE : 008765432000001<br>
        <span class="website">www.banquepopulaire.ma</span>
        @elseif($societe === 'Société Générale Maroc')
        Société Anonyme à Directoire et Conseil de Surveillance au capital de 1.000.000 DHs<br>
        Siège social : 55, Boulevard Abdelmoumen – 20000 CASABLANCA – MAROC<br>
        Tél. : 05 22 43 43 43 &nbsp; Fax : 05 22 43 43 44<br>
        Patente : 11223344 – R.C : 44556 – CNSS : 7788990 – I.F : 11223344 – ICE : 001122334000001<br>
        <span class="website">www.sgmaroc.ma</span>
        @elseif($societe === 'Crédit du Maroc')
        Société Anonyme à Directoire et Conseil de Surveillance au capital de 1.000.000 DHs<br>
        Siège social : 1, Boulevard Mohammed V – 20000 CASABLANCA – MAROC<br>
        Tél. : 05 22 22 22 22 &nbsp; Fax : 05 22 22 22 23<br>
        Patente : 55667788 – R.C : 99001 – CNSS : 2233445 – I.F : 55667788 – ICE : 005566778000001<br>
        <span class="website">www.creditdumaroc.ma</span>
        @else
        Société Anonyme<br>
        Siège social : [Adresse à définir] – MAROC<br>
        Tél. : [Téléphone] &nbsp; Fax : [Fax]<br>
        Patente : [Numéro] – R.C : [Numéro] – CNSS : [Numéro] – I.F : [Numéro] – ICE : [Numéro]<br>
        <span class="website">[Site web]</span>
        @endif
    </div>

    {{-- ===================== HEADER ===================== --}}
    <table class="header-table">
        <tr>
            <td class="logo-cell" width="55%">
                <img src="{{ public_path('images/attijari-logo.png') }}" alt="Attijari Intermediation">
            </td>
            <td class="date-cell" width="45%">
                Casablanca, le {{ $bon->date_commande ? \Carbon\Carbon::parse($bon->date_commande)->translatedFormat('d F Y') : now()->translatedFormat('d F Y') }}
            </td>
        </tr>
    </table>

    {{-- ===================== RECIPIENT BLOCK ===================== --}}
    <div class="recipient-block clearfix">
        <div class="recipient-inner">
            <p>Mr :</p>
            <p>{{ $bon->fournisseur->nom ?? 'Destinataire' }}</p>
            <p>{{ $bon->fournisseur->adresse ?? 'Casablanca' }}</p>
        </div>
    </div>

    {{-- ===================== BON TITLE ===================== --}}
    <div class="bon-title">
        Bon de Commande N° : &nbsp;&nbsp; {{ $bon->reference }}
    </div>

    {{-- ===================== ITEMS TABLE ===================== --}}
    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 8%;">QTE</th>
                <th style="width: 16%;">Réf</th>
                <th style="width: 42%;">Désignation</th>
                <th style="width: 17%;">P.U H.T</th>
                <th style="width: 17%;">TOTAL H.T</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bon->lignes as $index => $ligne)
            <tr>
                <td style="text-align: center;">{{ $ligne->quantite }}</td>
                <td style="text-align: center;">{{ $ligne->produit->reference ?? '-' }}</td>
                <td>{{ $ligne->produit->nom ?? '-' }}</td>
                <td style="text-align: right;">{{ number_format($ligne->prix_unitaire, 2, ',', ' ') }}</td>
                <td style="text-align: right;">{{ number_format($ligne->prix_unitaire * $ligne->quantite, 2, ',', ' ') }}</td>
            </tr>
            @endforeach

            {{-- Spacer row to maintain tall table body --}}
            <tr class="table-body-spacer">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    {{-- ===================== SUMMARY TOTALS ===================== --}}
    <div class="summary-wrapper clearfix">
        <table class="summary-table">
            <tr>
                <td class="label-cell">Prix Total HT</td>
                <td class="value-cell">{{ number_format($bon->total_ht, 2, ',', ' ') }}</td>
            </tr>
            <tr>
                <td class="label-cell">TVA 20 %</td>
                <td class="value-cell">{{ number_format($bon->total_ht * 0.2, 2, ',', ' ') }}</td>
            </tr>
            <tr>
                <td class="label-cell" style="background: #f5f5f5;">Prix Total TTC</td>
                <td class="value-cell" style="background: #f5f5f5;">{{ number_format($bon->total_ttc, 2, ',', ' ') }}</td>
            </tr>
        </table>
    </div>

    {{-- ===================== SIGNATURE SECTION ===================== --}}
    <table class="signature-table">
        <tr>
            <td>
                <span class="sig-title">{{ $signataire1['nom'] ?? 'Premier Signataire' }}</span>
                <div style="font-size: 9px; color: #666; margin-bottom: 5px;">{{ $signataire1['poste'] ?? 'Poste' }}</div>
                <div class="sig-line"></div>
            </td>
            <td>
                <span class="sig-title">{{ $signataire2['nom'] ?? 'Deuxième Signataire' }}</span>
                <div style="font-size: 9px; color: #666; margin-bottom: 5px;">{{ $signataire2['poste'] ?? 'Poste' }}</div>
                <div class="sig-line"></div>
            </td>
            <td>
                <span class="sig-title">Le Fournisseur</span>
                <div class="sig-line"></div>
            </td>
        </tr>
    </table>

    {{-- ===================== META INFORMATION ===================== --}}
    <div class="meta-section">
        <p>
            <span class="meta-label">Mode de règlement :</span>
            &nbsp;&nbsp;&nbsp;&nbsp; {{ $bon->mode_regelement ?? '03 mois' }}
        </p>

        <div class="observation-box">
            <p>
                <span class="meta-label">Observation :</span>
                {{ $bon->observations ?? '' }}
            </p>
        </div>
    </div>

</body>
</html>