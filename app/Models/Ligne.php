<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ligne extends Model
{
    protected $fillable = [
        'bon_commande_id',
        'produit_id',
        'quantite',
        'prix_unitaire',
        'total'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
