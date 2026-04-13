<?php

namespace App\Http\Controllers;

use App\Models\BonCommande;
use App\Models\Produit;
use App\Models\Statut;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BonCommandeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $bons = Auth::user()->isAdmin()
            ? BonCommande::with(['user', 'statut'])->latest()->get()
            : Auth::user()->bonCommandes()->with('statut')->latest()->get();

        return view('bon_commandes.index', compact('bons'));
    }

    public function create(Request $request)
    {
        $type = $request->type;

        $produits = Produit::all();
        $statuts = Statut::all();
        $fournisseurs = Fournisseur::all();

        return view('bon_commandes.create', compact(
            'produits',
            'statuts',
            'type',
            'fournisseurs'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'statut_id' => 'required|exists:statuts,id',
            'lignes' => 'required|array|min:1',
            'lignes.*.produit_id' => 'required|exists:produits,id',
            'lignes.*.quantite' => 'required|integer|min:1',
        ]);

        $bon = BonCommande::create([
            'reference' => 'BC-' . rand(1000,9999),
            'user_id' => auth()->id(),
            'statut_id' => 1,
            'type' => $request->type,
            'categorie' => $request->categorie,
            'mode_regelement' => $request->mode_regelement,
            'observations' => $request->observations,
            'date_commande' => $request->date_commande,
            'fournisseur_id' => $request->fournisseur_id,
            'total_ht' => 0,
            'total_ttc' => 0,
        ]);

        $totalHT = 0;

        foreach ($request->lignes as $ligne) {
            $produit = Produit::find($ligne['produit_id']);
            if (!$produit) continue;

            $total = $ligne['quantite'] * $produit->prix;
            $totalHT += $total;

            $bon->lignes()->create([
                'produit_id' => $produit->id,
                'quantite' => $ligne['quantite'],
                'prix_unitaire' => $produit->prix,
                'total' => $total,
            ]);
        }

        $bon->update([
            'total_ht' => $totalHT,
            'total_ttc' => $totalHT * 1.2,
        ]);

        return redirect()->route('bon_commandes.index')
            ->with('success', 'Bon de commande créé.');
    }

    public function show(BonCommande $bonCommande)
    {
        $this->checkAccess($bonCommande);

        $bonCommande->load('lignes.produit', 'user', 'statut');

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
            ->with('success', 'Statut modifié');
    }

    public function destroy(BonCommande $bonCommande)
    {
        $this->checkAccess($bonCommande);

        $bonCommande->delete();

        return redirect()->route('bon_commandes.index')
            ->with('success', 'Supprimé');
    }

    private function checkAccess($bon)
    {
        if (!Auth::user()->isAdmin() && $bon->user_id !== Auth::id()) {
            abort(403, 'Accès refusé');
        }
    }

    public function facture(BonCommande $bon)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $bon->load('lignes.produit','statut','user');

        return view('bon_commandes.facture', compact('bon'));
    }
}