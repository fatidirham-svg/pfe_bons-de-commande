@extends('layouts.app')

@section('title', 'Détail Bon de Commande')

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">
        <i class="fa-solid fa-file-invoice-dollar me-2" style="color: var(--tijari-red);"></i>
        Bon de Commande : {{ $bonCommande->reference }}
    </h5>
    <div class="d-flex gap-2">
        <a href="{{ route('bon_commandes.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="fa-solid fa-arrow-left me-1"></i> Retour
        </a>
        <a href="{{ route('bon_commandes.facture', $bonCommande) }}" class="btn btn-tijari btn-sm rounded-pill px-3" target="_blank">
            <i class="fa-solid fa-file-pdf me-1"></i> Télécharger PDF
        </a>
    </div>
</div>

{{-- All BC Info --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-4">
        <h6 class="fw-bold text-uppercase text-muted mb-3" style="letter-spacing: 1px; font-size: 12px;">
            <i class="fa-solid fa-info-circle me-2"></i> Informations du Bon
        </h6>

        <div class="row">
            {{-- Left column --}}
            <div class="col-md-6">
                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="text-muted py-2" style="width: 40%;">Référence</td>
                        <td class="fw-bold text-dark py-2">{{ $bonCommande->reference }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted py-2">Émetteur</td>
                        <td class="fw-bold text-dark py-2">{{ $bonCommande->user->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted py-2">Fournisseur</td>
                        <td class="fw-bold text-dark py-2">{{ $bonCommande->fournisseur->nom ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted py-2">Date commande</td>
                        <td class="fw-bold text-dark py-2">
                            {{ $bonCommande->date_commande ? \Carbon\Carbon::parse($bonCommande->date_commande)->format('d/m/Y') : $bonCommande->created_at->format('d/m/Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted py-2">Créé le</td>
                        <td class="fw-bold text-dark py-2">{{ $bonCommande->created_at->format('d/m/Y à H:i') }}</td>
                    </tr>
                </table>
            </div>

            {{-- Right column --}}
            <div class="col-md-6">
                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="text-muted py-2" style="width: 40%;">Type</td>
                        <td class="py-2">
                            @php
                                $typeLabel = match($bonCommande->type) {
                                    'finance' => 'Attijari Finance',
                                    'intermediation' => 'Attijari Intermédiation',
                                    'management' => 'Attijari Management',
                                    default => ucfirst($bonCommande->type)
                                };
                            @endphp
                            <span class="badge bg-light text-dark border fw-bold px-3 py-1 rounded-pill">{{ $typeLabel }}</span>
                        </td>
                    </tr>
                    <tr>

                        <td class="text-muted py-2">Statut</td>
                        <td class="py-2">
                            @php
                                $statusBadge = match($bonCommande->statut->nom) {
                                    'en attente' => 'warning',
                                    'validé' => 'success',
                                    'annulé' => 'danger',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $statusBadge }} px-3 py-1 rounded-pill fw-bold">{{ ucfirst($bonCommande->statut->nom) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted py-2">Mode règlement</td>
                        <td class="fw-bold text-dark py-2">{{ $bonCommande->mode_regelement ?? '—' }}</td>
                    </tr>
                    <tr>
                        
                        <td class="text-dark py-2">{{ $bonCommande->observations ?? '—' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Lines Table --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-4">
        <h6 class="fw-bold text-uppercase text-muted mb-3" style="letter-spacing: 1px; font-size: 12px;">
            <i class="fa-solid fa-cart-shopping me-2"></i> Lignes de Commande
        </h6>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 py-3 small fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">#</th>
                        <th class="border-0 py-3 small fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Produit</th>
                        <th class="border-0 py-3 small fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Réf</th>
                        <th class="border-0 py-3 small fw-bold text-muted text-uppercase text-end" style="letter-spacing: 0.5px;">Prix Unitaire</th>
                        <th class="border-0 py-3 small fw-bold text-muted text-uppercase text-end" style="letter-spacing: 0.5px;">Quantité</th>
                        <th class="border-0 py-3 small fw-bold text-muted text-uppercase text-end" style="letter-spacing: 0.5px;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bonCommande->lignes as $i => $ligne)
                    <tr>
                        <td class="text-muted">{{ $i + 1 }}</td>
                        <td class="fw-bold text-dark">{{ $ligne->produit->nom }}</td>
                        <td class="text-muted small">{{ $ligne->produit->reference ?? '—' }}</td>
                        <td class="text-end">{{ number_format($ligne->prix_unitaire, 2, ',', ' ') }} DH</td>
                        <td class="text-end">{{ $ligne->quantite }}</td>
                        <td class="text-end fw-bold" style="color: var(--tijari-red);">{{ number_format($ligne->total, 2, ',', ' ') }} DH</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Totals --}}
        <div class="d-flex justify-content-end mt-3">
            <div style="min-width: 280px;">
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted fw-semibold">Total HT</span>
                    <span class="fw-bold">{{ number_format($bonCommande->total_ht, 2, ',', ' ') }} DH</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted fw-semibold">TVA 20%</span>
                    <span class="fw-bold">{{ number_format($bonCommande->total_ht * 0.2, 2, ',', ' ') }} DH</span>
                </div>
                <div class="d-flex justify-content-between py-2">
                    <span class="fw-bold">Total TTC</span>
                    <span class="fs-5 fw-bold" style="color: var(--tijari-red);">{{ number_format($bonCommande->total_ttc, 2, ',', ' ') }} DH</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection