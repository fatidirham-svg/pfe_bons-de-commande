<?php

namespace App\Policies;

use App\Models\BonCommande; // Remplace Post par BonCommande
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BonCommandePolicy
{
    use HandlesAuthorization;

    /**
     * L'utilisateur peut voir tous les bons de commande
     */
    public function viewAny(User $user): bool
    {
        // Les admins voient tous, les utilisateurs seulement leurs propres bons
        return $user->role === 'admin' || $user->role === 'user';
    }

    /**
     * L'utilisateur peut voir un bon spécifique
     */
    public function view(User $user, BonCommande $bon): bool
    {
        return $user->role === 'admin' || $user->id === $bon->user_id;
    }

    /**
     * L'utilisateur peut créer un bon
     */
    public function create(User $user): bool
    {
        // Tous les utilisateurs connectés peuvent créer un bon
        return in_array($user->role, ['admin', 'user']);
    }

    /**
     * Modifier un bon : seulement le propriétaire ou l'admin
     */
    public function update(User $user, BonCommande $bon): bool
    {
        return $user->role === 'admin' || $user->id === $bon->user_id;
    }

    /**
     * Supprimer un bon : seulement le propriétaire ou l'admin
     */
    public function delete(User $user, BonCommande $bon): bool
    {
        return $user->role === 'admin' || $user->id === $bon->user_id;
    }

    /**
     * Restaurer un bon (optionnel)
     */
    public function restore(User $user, BonCommande $bon): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Supprimer définitivement (optionnel)
     */
    public function forceDelete(User $user, BonCommande $bon): bool
    {
        return $user->role === 'admin';
    }
}