<?php

namespace App\Http\Controllers;

use App\Models\BonCommande;
use App\Models\Fournisseur;
use App\Models\Statut;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BonCommandeController extends Controller
{
    public function index(Request $request)
    {
        $query = BonCommande::with(['user','statut','fournisseur']);

        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }

        if ($request->fournisseur) {
            $query->whereHas('fournisseur', function($q) use ($request){
                $q->where('nom', 'like', '%' . $request->fournisseur . '%');
            });
        }

        $bons = $query->latest()->get();

        return view('bon_commandes.index', compact('bons'));
    }

    public function create(Request $request)
    {
        return view('bon_commandes.create', [
            'produits' => Produit::all(),
            'statuts' => Statut::all(),
            'fournisseurs' => Fournisseur::all(),
            'type' => $request->type
        ]);
    }

    public function store(Request $request)
    {
        // ❌ REMOVE dd() (كان كايوقف الكود)

        $request->validate([
            'statut_id' => 'required|exists:statuts,id',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'lignes' => 'required|array|min:1',
            'lignes.*.produit_id' => 'required|exists:produits,id',
            'lignes.*.quantite' => 'required|integer|min:1',
        ]);

        // ✅ CREATE BON
        $bon = BonCommande::create([
            'reference' => 'BC-' . time(),
            'user_id' => Auth::id(),
            'statut_id' => $request->statut_id,

            'date_commande' => $request->date_commande,
            'categorie' => $request->categorie,
            'fournisseur_id' => $request->fournisseur_id,

            // ⚠️ FIX TYPO
            'mode_regelement' => $request->mode_regelement,

            'observations' => $request->observations,
            'type' => $request->type,

            'total_ht' => 0,
            'total_ttc' => 0,
        ]);

        $totalHT = 0;

        foreach ($request->lignes as $ligne) {

            $produit = Produit::find($ligne['produit_id']);
            if (!$produit) continue;

            $total = $ligne['quantite'] * $produit->prix;

            $bon->lignes()->create([
                'produit_id' => $produit->id,
                'quantite' => $ligne['quantite'],
                'prix_unitaire' => $produit->prix,
                'total' => $total,
            ]);

            $totalHT += $total;
        }

        $bon->update([
            'total_ht' => $totalHT,
            'total_ttc' => $totalHT * 1.2,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Bon de commande créé avec succès');
    }

    public function show(BonCommande $bonCommande)
    {
        $this->checkAccess($bonCommande);

        $bonCommande->load('lignes.produit','user','statut','fournisseur');

        return view('bon_commandes.show', compact('bonCommande'));
    }

    public function edit(BonCommande $bonCommande)
    {
        $this->checkAccess($bonCommande);

        return view('bon_commandes.edit', [
            'bonCommande' => $bonCommande,
            'statuts' => Statut::all()
        ]);
    }

    public function update(Request $request, BonCommande $bonCommande)
    {
        $this->checkAccess($bonCommande);

        $request->validate([
            'statut_id' => 'required|exists:statuts,id',
        ]);

        $bonCommande->update([
            'statut_id' => $request->statut_id,
        ]);

        return redirect()->route('bon_commandes.index')
            ->with('success', 'Statut mis à jour');
    }

    public function destroy(BonCommande $bonCommande)
    {
        $this->checkAccess($bonCommande);

        $bonCommande->delete();

        return back()->with('success', 'Bon supprimé');
    }

    private function checkAccess($bon)
    {
        if (!Auth::user()->isAdmin() && $bon->user_id !== Auth::id()) {
            abort(403, 'Accès refusé');
        }
    }

    public function facture(BonCommande $bon)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $bon->load('lignes.produit','user','statut','fournisseur');

        return view('bon_commandes.facture', compact('bon'));
    }
}