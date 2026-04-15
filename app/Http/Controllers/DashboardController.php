<?php

namespace App\Http\Controllers;

use App\Models\BonCommande;
use App\Models\Fournisseur;
use App\Services\DashboardService;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalCommandes' => BonCommande::count(),
            'enAttente' => BonCommande::whereHas('statut', function ($q) {
                $q->where('nom', 'En attente');
            })->count(),
            'montantTotal' => BonCommande::sum('total_ttc'),
            'totalFournisseurs' => Fournisseur::count(),

            'bons' => BonCommande::with(['fournisseur', 'statut', 'lignes'])
                ->latest()
                ->take(10)
                ->get(),
        ]);
    }

    // ✅ FIX: هادي هي اللي ناقصاك
    public function exportPdf()
    {
        $data = [
            'totalCommandes' => BonCommande::count(),
            'enAttente' => BonCommande::whereHas('statut', function ($q) {
                $q->where('nom', 'En attente');
            })->count(),
            'montantTotal' => BonCommande::sum('total_ttc'),
            'totalFournisseurs' => Fournisseur::count(),

            'bons' => BonCommande::with(['fournisseur', 'statut'])
                ->latest()
                ->get(),
        ];

        $pdf = Pdf::loadView('dashboard.pdf', $data);

        return $pdf->download('dashboard.pdf');
    }
}