<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use App\Models\User; // si ce n'est pas déjà importé
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    // Gate simple : l'utilisateur doit être admin 
    Gate::define('access-admin', function (User $user) { 
        return $user->role === 'admin'; 
    }); 
 
    // Gate avec ressource : l'utilisateur doit posséder l'article 
    Gate::define('update-post', function (User $user, Post $post) { 
        return $user->id === $post->user_id; 
    }); 
    }
}
