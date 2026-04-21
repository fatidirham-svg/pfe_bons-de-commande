<?php

namespace App\Http\Controllers;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $fournisseurs = Fournisseur::all();
    return view('fournisseurs.index', compact('fournisseurs'));
}

    /**
     * Show the form for creating a new resource.
     */


public function create()
{
    return view('fournisseurs.create');
}

public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|min:2',
        'email' => 'nullable|email',
        'telephone' => 'nullable|min:10',
        'adresse' => 'nullable'
    ]);

    Fournisseur::create($request->all());

    return redirect()->route('dashboard')
        ->with('success', 'Fournisseur ajouté avec succès');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit($id)
{
    $fournisseur = Fournisseur::findOrFail($id);
    return view('fournisseurs.edit', compact('fournisseur'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required',
        'email' => 'nullable|email',
        'telephone' => 'nullable',
        'adresse' => 'nullable',
    ]);

    $fournisseur = Fournisseur::findOrFail($id);

    $fournisseur->update([
        'nom' => $request->nom,
        'email' => $request->email,
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
    ]);

    return redirect()->route('fournisseurs.index')
        ->with('success', 'Fournisseur modifié avec succès');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
