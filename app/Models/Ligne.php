<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ===== MODÈLE: Ligne =====
 * Représente une LIGNE d'un bon de commande
 * Exemple: un bon avec 3 lignes = 3 produits commandés
 * Table en BDD: lignes
 */
class Ligne extends Model
{
    /**
     * $fillable = les champs qui peuvent être remplis
     * Tous les champs nécessaires pour une ligne de commande
     */
    protected $fillable = [
        'bon_commande_id',    // ID du bon auquel appartient cette ligne
        'produit_id',         // ID du produit commandé
        'quantite',           // Combien de produits (ex: 5)
        'prix_unitaire',      // Prix pour 1 unité (ex: 10€)
        'total'               // Quantité × Prix (ex: 5 × 10€ = 50€)
    ];

    /**
     * Relation: Une ligne appartient à UN produit
     * belongsTo = relation inverse
     * Permet de récupérer les infos du produit (nom, description, etc)
     */
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
