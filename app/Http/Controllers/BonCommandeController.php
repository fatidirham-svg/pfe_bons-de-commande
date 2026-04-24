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

        // 🔐 access control
        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }

        // 🔎 filter by fournisseur
        if ($request->fournisseur) {
            $query->whereHas('fournisseur', function($q) use ($request){
                $q->where('nom', 'like', '%'.$request->fournisseur.'%');
            });
        }

        // 🔎 filter by type (NEW ADD)
        if ($request->type) {
            $query->where('type', $request->type);
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
        $request->validate([
            'statut_id' => 'required|exists:statuts,id',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'lignes' => 'required|array|min:1',
            'lignes.*.produit_id' => 'required|exists:produits,id',
            'lignes.*.quantite' => 'required|integer|min:1',
        ]);

        $bon = BonCommande::create([
            'reference' => 'BC-' . time(),
            'user_id' => Auth::id(),
            'statut_id' => $request->statut_id,

            'date_commande' => $request->date_commande,
            'categorie' => $request->categorie,
            'fournisseur_id' => $request->fournisseur_id,

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
            'statuts' => Statut::all(),
            'fournisseurs' => Fournisseur::all(),
            'produits' => Produit::all()
        ]);
    }

    public function update(Request $request, BonCommande $bonCommande)
    {
        $this->checkAccess($bonCommande);

        $request->validate([
            'statut_id' => 'required|exists:statuts,id',
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'date_commande' => 'required|date',
            'categorie' => 'nullable|string|max:255',
            'mode_regelement' => 'required|string|max:50',
            'observations' => 'nullable|string',
            'lignes' => 'required|array|min:1',
            'lignes.*.produit_id' => 'required|exists:produits,id',
            'lignes.*.quantite' => 'required|integer|min:1',
        ]);

        $bonCommande->update([
            'statut_id' => $request->statut_id,
            'fournisseur_id' => $request->fournisseur_id,
            'date_commande' => $request->date_commande,
            'categorie' => $request->categorie,
            'mode_regelement' => $request->mode_regelement,
            'observations' => $request->observations,
        ]);

        $bonCommande->lignes()->delete();
        $totalHT = 0;

        foreach ($request->lignes as $ligne) {
            $produit = Produit::find($ligne['produit_id']);
            if (!$produit) {
                continue;
            }

            $total = $ligne['quantite'] * $produit->prix;
            $bonCommande->lignes()->create([
                'produit_id' => $produit->id,
                'quantite' => $ligne['quantite'],
                'prix_unitaire' => $produit->prix,
                'total' => $total,
            ]);
            $totalHT += $total;
        }

        $bonCommande->update([
            'total_ht' => $totalHT,
            'total_ttc' => $totalHT * 1.2,
        ]);

        return redirect()->route('bon_commandes.index')
            ->with('success', 'Bon de commande mis à jour');
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

    // 🔥 DRAG & DROP UPDATE STATUS
    public function updateStatut(Request $request)
    {
        $bon = BonCommande::findOrFail($request->id);

        $statut = Statut::where('nom', $request->statut)->first();

        if ($statut) {
            $bon->statut_id = $statut->id;
            $bon->save();
        }

        return response()->json(['success' => true]);
    }

    // 🔥 OPTIONAL: reorder (kanban position)
    public function reorder(Request $request)
    {
        foreach ($request->order as $item) {
            BonCommande::where('id', $item['id'])
                ->update(['position' => $item['position']]);
        }

        return response()->json(['success' => true]);
    }
}
