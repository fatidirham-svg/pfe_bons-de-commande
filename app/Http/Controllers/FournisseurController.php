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
        //
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

    return redirect()->route('fournisseur.index')
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
