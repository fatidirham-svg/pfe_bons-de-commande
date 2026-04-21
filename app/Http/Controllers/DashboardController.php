<?php

namespace App\Http\Controllers;
    use Illuminate\Http\Request;
use App\Models\Statut;
use App\Models\BonCommande;
use App\Models\Fournisseur;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $bons = BonCommande::with(['fournisseur','statut','lignes'])
            ->latest()
            ->get();

        // Data for charts
        $chartStatus = [
            'en_attente' => $bons->where('statut.nom', 'en attente')->count(),
            'valide' => $bons->where('statut.nom', 'validé')->count(),
            'annule' => $bons->where('statut.nom', 'annulé')->count(),
        ];

        $chartType = $bons->groupBy('type')->map->count();

        return view('dashboard', [
            'totalCommandes' => $bons->count(),
            'enAttente' => $chartStatus['en_attente'],
            'montantTotal' => $bons->sum('total_ttc'),
            'totalFournisseurs' => Fournisseur::count(),
            'bons' => $bons,
            'chartStatus' => $chartStatus,
            'chartType' => $chartType,
        ]);

    }

    public function exportPdf()
    {
        $bons = BonCommande::with(['fournisseur','statut'])->latest()->get();

        $data = [
            'totalCommandes' => $bons->count(),
            'enAttente' => $bons->where('statut.nom', 'en attente')->count(),
            'montantTotal' => $bons->sum('total_ttc'),
            'totalFournisseurs' => Fournisseur::count(),
            'bons' => $bons
        ];

        $pdf = Pdf::loadView('dashboard.pdf', $data);

        return $pdf->download('dashboard.pdf');
    }


public function updateStatut(Request $request)
{
    $bon = BonCommande::findOrFail($request->id);

    $statut = Statut::where('nom', $request->statut)->first();

    if($statut){
        $bon->statut_id = $statut->id;
        $bon->save();
    }

    return response()->json([
        'success' => true
    ]);
}
}