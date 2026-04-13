<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = ['bon_commande_id', 'fichier'];

    public function bonCommande() {
        return $this->belongsTo(BonCommande::class);
    }
}
