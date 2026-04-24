@extends('layouts.app')

@section('title', 'Tableau de Bord Analytique')

@section('content')

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card h-100 border-0 p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm" style="width: 54px; height: 54px; background: var(--tijari-red);">
                    <i class="fa-solid fa-file-invoice fs-5"></i>
                </div>
                <div>
                    <div class="text-muted small fw-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Commandes</div>
                    <div class="fs-4 fw-bold text-dark">{{ $totalCommandes }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 border-0 p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-dark shadow-sm" style="width: 54px; height: 54px; background: var(--tijari-yellow);">
                    <i class="fa-solid fa-clock-rotate-left fs-5"></i>
                </div>
                <div>
                    <div class="text-muted small fw-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">En Attente</div>
                    <div class="fs-4 fw-bold text-dark">{{ $enAttente }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 border-0 p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm" style="width: 54px; height: 54px; background: var(--tijari-dark);">
                    <i class="fa-solid fa-coins fs-5"></i>
                </div>
                <div>
                    <div class="text-muted small fw-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Montant Total</div>
                    <div class="fs-4 fw-bold text-dark">{{ number_format($montantTotal, 0) }} <small class="fw-normal">DH</small></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 border-0 p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm" style="width: 54px; height: 54px; background: #64748b;">
                    <i class="fa-solid fa-users fs-5"></i>
                </div>
                <div>
                    <div class="text-muted small fw-bold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Fournisseurs</div>
                    <div class="fs-4 fw-bold text-dark">{{ $totalFournisseurs }}</div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card bg-white p-4 h-100">
            <h6 class="fw-bold mb-4 text-secondary text-uppercase" style="letter-spacing: 1px;">Répartition par Statut</h6>
            <div style="height: 300px;">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-white p-4 h-100">
            <h6 class="fw-bold mb-4 text-secondary text-uppercase" style="letter-spacing: 1px;">Volume par Type de Bon</h6>
            <div style="height: 300px;">
                <canvas id="typeChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card bg-white p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold text-secondary text-uppercase mb-0" style="letter-spacing: 1px;">Suivi des Flux (Kanban)</h6>
        <a href="{{ route('dashboard.pdf') }}" class="btn btn-outline-dark btn-sm rounded-pill px-3">
            <i class="fa-solid fa-file-pdf me-2"></i> Exporter PDF
        </a>
    </div>

    <div class="row g-3">
        @php
            $statuses = [
                ['key' => 'en attente', 'label' => 'En attente', 'icon' => 'fa-clock', 'color' => '#f59e0b', 'bg' => '#fffbeb'],
                ['key' => 'validé', 'label' => 'Validé', 'icon' => 'fa-check-circle', 'color' => '#10b981', 'bg' => '#ecfdf5'],
                ['key' => 'annulé', 'label' => 'Annulé', 'icon' => 'fa-circle-xmark', 'color' => '#ef4444', 'bg' => '#fef2f2']
            ];
        @endphp

        @foreach($statuses as $status)
        <div class="col-md-4">
            <div class="p-3 rounded-4" style="background: #f8fafc; border: 1px dashed #cbd5e1; min-height: 400px;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge rounded-pill px-3 py-2" style="background: {{ $status['bg'] }}; color: {{ $status['color'] }}; font-weight: 700;">
                        <i class="fa-solid {{ $status['icon'] }} me-2"></i> {{ $status['label'] }}
                    </span>
                    <span class="small fw-bold text-muted">{{ $bons->filter(fn($b)=>strtolower($b->statut->nom) == $status['key'])->count() }}</span>
                </div>

                <div class="cards-zone h-100" data-statut="{{ $status['label'] }}">
                    @foreach($bons->filter(fn($b)=>strtolower($b->statut->nom) == $status['key']) as $bon)
                    <div class="card mb-3 p-3 shadow-sm border-0 bg-white" data-id="{{ $bon->id }}" style="cursor: grab;">
                        <div class="small fw-bold text-primary mb-2">{{ $bon->reference }}</div>
                        <div class="small text-muted mb-1"><i class="fa-solid fa-building me-2"></i> {{ $bon->fournisseur->nom }}</div>
                        <div class="small text-muted mb-3"><i class="fa-solid fa-calendar me-2"></i> {{ $bon->date_commande }}</div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small fw-bold">{{ $bon->lignes->count() }} Articles</span>
                            <span class="fw-bold text-dark">{{ number_format($bon->total_ttc, 2) }} DH</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    // CHARTS
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['En Attente', 'Validé', 'Annulé'],
            datasets: [{
                data: [{{ $chartStatus['en attente'] }}, {{ $chartStatus['validé'] }}, {{ $chartStatus['annulé'] }}],
                backgroundColor: ['#ffb71b', '#e30613', '#1a1a1a'],
                borderWidth: 0,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { family: 'Outfit', size: 12, weight: '600' } } }
            }
        }
    });

    const typeCtx = document.getElementById('typeChart').getContext('2d');
    new Chart(typeCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartType->keys()) !!},
            datasets: [{
                label: 'Nombre de Bons',
                data: {!! json_encode($chartType->values()) !!},
                backgroundColor: '#e30613',
                borderRadius: 12,
                barThickness: 30
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [5, 5], color: '#e2e8f0' }, ticks: { font: { family: 'Outfit' } } },
                x: { grid: { display: false }, ticks: { font: { family: 'Outfit', weight: '600' } } }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });


    // KANBAN
    document.querySelectorAll('.cards-zone').forEach(zone => {
        new Sortable(zone, {
            group: 'shared',
            animation: 250,
            ghostClass: 'sortable-ghost',
            onAdd: function(evt) {
                let id = evt.item.dataset.id;
                let statut = evt.to.dataset.statut;

                fetch("{{ route('dashboard.updateStatut') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: id, statut: statut })
                })
                .then(res => res.json())
                .then(data => {
                    // Update count badges if needed
                });
            }
        });
    });
</script>
@endsection

