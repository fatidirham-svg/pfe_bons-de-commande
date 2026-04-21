<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport d'activité - CommandFlow</title>
    <style>
        @page { margin: 1.5cm; }
        body { font-family: 'Helvetica', sans-serif; font-size: 10px; color: #333; line-height: 1.5; }
        .header { width: 100%; margin-bottom: 30px; border-bottom: 2px solid #e30613; padding-bottom: 10px; }
        .logo { width: 180px; }
        .title { text-align: right; font-size: 16px; font-weight: bold; color: #1a1a1a; vertical-align: bottom; }
        
        .stats-table { width: 100%; margin-bottom: 30px; }
        .stat-card { background: #f8fafc; padding: 15px; border-radius: 10px; border: 1px solid #e2e8f0; text-align: center; }
        .stat-value { font-size: 18px; font-weight: bold; color: #e30613; }
        .stat-label { font-size: 9px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }

        .main-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .main-table th { background: #1a1a1a; color: white; padding: 8px; font-size: 9px; text-align: left; text-transform: uppercase; }
        .main-table td { padding: 8px; border-bottom: 1px solid #e2e8f0; }
        
        .badge { padding: 4px 8px; border-radius: 12px; font-size: 8px; font-weight: bold; }
        .badge-pending { background: #ffb71b; color: #000; }
        .badge-success { background: #e30613; color: #fff; }
        .badge-danger { background: #1a1a1a; color: #fff; }

        .footer { position: fixed; bottom: -0.5cm; left: 0; right: 0; font-size: 8px; color: #64748b; text-align: center; border-top: 1px solid #e2e8f0; padding-top: 10px; }
    </style>
</head>
<body>

    <table class="header">
        <tr>
            <td><img src="{{ public_path('images/attijari-logo.png') }}" class="logo"></td>
            <td class="title">Rapport d'activité - Bons de Commande</td>
        </tr>
    </table>

    <table class="stats-table" cellspacing="10">
        <tr>
            <td width="33%">
                <div class="stat-card">
                    <div class="stat-value">{{ $totalCommandes }}</div>
                    <div class="stat-label">Total Commandes</div>
                </div>
            </td>
            <td width="33%">
                <div class="stat-card">
                    <div class="stat-value">{{ $enAttente }}</div>
                    <div class="stat-label">En Attente</div>
                </div>
            </td>
            <td width="33%">
                <div class="stat-card">
                    <div class="stat-value">{{ number_format($montantTotal, 0, ',', ' ') }} DH</div>
                    <div class="stat-label">Montant Global</div>
                </div>
            </td>
        </tr>
    </table>

    <h3 style="font-size: 12px; margin-bottom: 10px;">Liste des Commandes Récentes</h3>
    <table class="main-table">
        <thead>
            <tr>
                <th>Référence</th>
                <th>Fournisseur</th>
                <th>Type</th>
                <th>Statut</th>
                <th>Total TTC</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bons as $bon)
            <tr>
                <td style="font-weight: bold;">{{ $bon->reference }}</td>
                <td>{{ $bon->fournisseur->nom ?? '-' }}</td>
                <td>{{ ucfirst($bon->type) }}</td>
                <td>
                    @php
                        $badge = match($bon->statut->nom) {
                            'en attente' => 'badge-pending',
                            'validé' => 'badge-success',
                            'annulé' => 'badge-danger',
                            default => ''
                        };
                    @endphp
                    <span class="badge {{ $badge }}">{{ ucfirst($bon->statut->nom) }}</span>
                </td>
                <td style="font-weight: bold; color: #e30613;">{{ number_format($bon->total_ttc, 2, ',', ' ') }} DH</td>
                <td>{{ $bon->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        CommandFlow v2.0 - Généré le {{ date('d/m/Y H:i') }} - © Attijariwafa Bank
    </div>

</body>
</html>