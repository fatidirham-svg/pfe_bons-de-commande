<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Statut;

class BonCommande extends Model
{
protected $fillable = [
    'reference',
    'user_id',
    'statut_id',
    'type',
    'categorie',
    'mode_reglement',
    'observation',
    'date_commande',
    'fournisseur_id',
    'total_ht',
    'total_ttc'
];
    public function lignes(){
        return $this->hasMany(Ligne::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function statut()
    {
        return $this->belongsTo(Statut::class);
    }
    public function fournisseur()
{
    return $this->belongsTo(Fournisseur::class);
}
}
