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
                    <option value="finance" {{ request('type')=='finance' ? 'selected' : '' }}>Attijari Finance</option>
                    <option value="intermediation" {{ request('type')=='intermediation' ? 'selected' : '' }}>Attijari Intermédiation</option>
                    <option value="management" {{ request('type')=='management' ? 'selected' : '' }}>Attijari Management</option>
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
                    @php
                        $typeLabel = match($bon->type) {
                            'finance' => 'Attijari Finance',
                            'intermediation' => 'Attijari Intermédiation',
                            'management' => 'Attijari Management',
                            default => ucfirst($bon->type)
                        };
                        $typeBg = match($bon->type) {
                            'finance' => 'background: linear-gradient(135deg, #fff3cd, #ffeaa7); color: #856404; border: 1px solid #ffc107;',
                            'intermediation' => 'background: linear-gradient(135deg, #d4edda, #a8e6cf); color: #155724; border: 1px solid #28a745;',
                            'management' => 'background: linear-gradient(135deg, #e2e8f0, #cbd5e1); color: #1a1a1a; border: 1px solid #94a3b8;',
                            default => 'background: #f1f5f9; color: #64748b;'
                        };
                    @endphp
                    <td><span class="badge fw-bold px-3 py-2 rounded-pill" style="{{ $typeBg }}">{{ $typeLabel }}</span></td>
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
