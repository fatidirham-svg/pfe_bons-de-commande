@extends('layouts.app')

@section('title', 'Gestion des Bons de Commande')

@section('content')

<div class="card bg-white p-4 shadow-sm">
    {{-- FILTER BOX --}}
    <div class="mb-4">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-bold text-secondary small">Fournisseur</label>
                <input type="text" name="fournisseur" class="form-control rounded-pill px-3" placeholder="Rechercher..." value="{{ request('fournisseur') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold text-secondary small">Type de Bon</label>
                <select name="type" class="form-select rounded-pill px-3">
                    <option value="">Tous les types</option>
                    <option value="Nouveau" {{ request('type')=='Nouveau' ? 'selected' : '' }}>Nouveau</option>
                    <option value="Attijari Finance" {{ request('type')=='Attijari Finance' ? 'selected' : '' }}>Attijari Finance</option>
                    <option value="Attijari Intermédiation" {{ request('type')=='Attijari Intermédiation' ? 'selected' : '' }}>Attijari Intermédiation</option>
                    <option value="Attijari Management" {{ request('type')=='Attijari Management' ? 'selected' : '' }}>Attijari Management</option>
                </select>
            </div>

            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-tijari flex-grow-1">
                    <i class="fa-solid fa-filter me-2"></i> Filtrer
                </button>
                @if(request()->anyFilled(['fournisseur', 'type']))
                    <a href="{{ route('bon_commandes.index') }}" class="btn btn-outline-secondary rounded-pill px-3">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- TABLE --}}
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="bg-light">
                <tr>
                    <th class="border-0 px-4 py-3 text-uppercase small fw-bold text-muted" style="letter-spacing: 0.5px;">Référence</th>
                    <th class="border-0 py-3 text-uppercase small fw-bold text-muted" style="letter-spacing: 0.5px;">Émetteur</th>
                    <th class="border-0 py-3 text-uppercase small fw-bold text-muted" style="letter-spacing: 0.5px;">Fournisseur</th>
                    <th class="border-0 py-3 text-uppercase small fw-bold text-muted" style="letter-spacing: 0.5px;">Type</th>
                    <th class="border-0 py-3 text-uppercase small fw-bold text-muted" style="letter-spacing: 0.5px;">Statut</th>
                    <th class="border-0 py-3 text-uppercase small fw-bold text-muted" style="letter-spacing: 0.5px;">Total TTC</th>
                    <th class="border-0 text-end px-4 py-3 text-uppercase small fw-bold text-muted" style="letter-spacing: 0.5px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bons as $bon)
                <tr>
                    <td class="px-4 fw-bold text-dark">{{ $bon->reference }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" style="width: 32px; height: 32px; background: var(--tijari-red); font-size: 11px;">
                                {{ substr($bon->user->name, 0, 1) }}
                            </div>
                            <span class="small fw-semibold text-dark">{{ $bon->user->name }}</span>
                        </div>
                    </td>
                    <td class="small">{{ $bon->fournisseur->nom ?? '-' }}</td>
                    <td><span class="badge bg-light text-muted fw-bold border">{{ $bon->type }}</span></td>
                    <td>
                        @php
                            $statusInfo = match($bon->statut->nom) {
                                'en attente' => ['color' => 'var(--tijari-yellow)', 'text' => 'var(--tijari-dark)', 'icon' => 'fa-clock'],
                                'validé' => ['color' => 'var(--tijari-red)', 'text' => 'white', 'icon' => 'fa-check'],
                                'annulé' => ['color' => 'var(--tijari-dark)', 'text' => 'white', 'icon' => 'fa-xmark'],
                                default => ['color' => '#cbd5e1', 'text' => 'white', 'icon' => 'fa-question']
                            };
                        @endphp
                        <span class="badge px-3 py-2 rounded-pill d-inline-flex align-items-center gap-2" style="background: {{ $statusInfo['color'] }}; color: {{ $statusInfo['text'] }};">
                            <i class="fa-solid {{ $statusInfo['icon'] }}" style="font-size: 10px;"></i>
                            {{ ucfirst($bon->statut->nom) }}
                        </span>
                    </td>
                    <td class="fw-bold" style="color: var(--tijari-red);">{{ number_format($bon->total_ttc, 2) }} DH</td>

                    <td class="text-end">
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('bon_commandes.show', $bon) }}" class="btn btn-light btn-sm rounded-circle shadow-sm" style="width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-eye text-primary"></i>
                            </a>
                            @if(Auth::user()->isAdmin() || Auth::id() === $bon->user_id)
                            <a href="{{ route('bon_commandes.edit', $bon) }}" class="btn btn-light btn-sm rounded-circle shadow-sm" style="width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-pen text-info"></i>
                            </a>
                            @endif
                            @if(Auth::user()->isAdmin())
                            <form method="POST" action="{{ route('bon_commandes.destroy', $bon) }}" class="d-inline" onsubmit="return confirm('Supprimer ce bon ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-light btn-sm rounded-circle shadow-sm" style="width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="fa-solid fa-folder-open fs-2 d-block mb-3"></i>
                        Aucun résultat trouvé.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
ndsection