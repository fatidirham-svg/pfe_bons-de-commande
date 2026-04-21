<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BonCommandeController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProduitController;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class,'showRegister'])->name('register');
Route::post('/register', [AuthController::class,'register']);

Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'login']);

Route::post('/logout', [AuthController::class,'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // ✅ Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/export-pdf', [DashboardController::class, 'exportPdf'])->name('dashboard.pdf');

    // ✅ Choose type (IMPORTANT)
    Route::get('/bon_commandes/choose-type', function () {
        return view('bon_commandes.choose_type');
    })->name('bon_commandes.choose_type');

    // ✅ BonCommande CRUD (IMPORTANT)
    Route::resource('bon_commandes', BonCommandeController::class);

    // ✅ Facture
    Route::get('/bon_commande/{bon}/facture', [BonCommandeController::class, 'facture'])
        ->middleware('admin')
        ->name('bon_commandes.facture');

    // ✅ Produits
    Route::resource('produits', ProduitController::class);

    // ✅ Fournisseurs
    Route::resource('fournisseurs', FournisseurController::class);
});


Route::post('/update-statut', [BonCommandeController::class, 'updateStatut']);
Route::resource('fournisseur', FournisseurController::class);
Route::resource('produit', ProduitController::class);

Route::post('/dashboard/update-statut', [DashboardController::class,'updateStatut'])
    ->name('dashboard.updateStatut');

        // a propos
        Route::get('/about', function () {
    return view('about');
})->name('about');