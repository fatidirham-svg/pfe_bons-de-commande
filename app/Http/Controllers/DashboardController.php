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

    public function exportPdf(Request $request)
    {
        $id = $request->query('id');

        if ($id) {
            $bon = BonCommande::with(['fournisseur', 'statut', 'lignes.produit'])->findOrFail($id);
        } else {
            $bon = BonCommande::with(['fournisseur', 'statut', 'lignes.produit'])->latest()->firstOrFail();
        }

        return view('dashboard.facture-config', compact('bon'));
    }

    public function generatePdf(Request $request)
    {
        $request->validate([
            'bon_id' => 'required|exists:bon_commandes,id',
            'societe' => 'required|string',
            'societe_autre' => 'nullable|string',
            'signataire1_nom' => 'required|string|max:255',
            'signataire1_poste' => 'required|string|max:255',
            'signataire2_nom' => 'required|string|max:255',
            'signataire2_poste' => 'required|string|max:255',
        ]);

        $bon = BonCommande::with(['fournisseur', 'statut', 'lignes.produit'])->findOrFail($request->bon_id);

        // Préparer les données pour le PDF
        $pdfData = [
            'bon' => $bon,
            'societe' => $request->societe === 'Autre' ? $request->societe_autre : $request->societe,
            'signataire1' => [
                'nom' => $request->signataire1_nom,
                'poste' => $request->signataire1_poste,
            ],
            'signataire2' => [
                'nom' => $request->signataire2_nom,
                'poste' => $request->signataire2_poste,
            ],
        ];

        $pdf = Pdf::loadView('dashboard.pdf', $pdfData);

        return $pdf->download('facture-' . $bon->reference . '.pdf');
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