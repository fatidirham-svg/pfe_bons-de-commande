<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BonCommandeController;
use App\Http\Controllers\FournisseurController;

Route::get('/', function () {
    return view('welcome');
});


// 🔐 Auth
Route::get('/register', [AuthController::class,'showRegister'])->name('register');
Route::post('/register', [AuthController::class,'register']);

Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'login']);

Route::post('/logout', [AuthController::class,'logout'])->name('logout');

// 🔒 Routes protégées
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AuthController::class,'dashboard'])->name('dashboard');

    // Bon de commande (CRUD)
    Route::resource('bon_commandes', BonCommandeController::class);

    Route::get('/bon_commande/{bon}/facture', [BonCommandeController::class, 'facture'])
        ->middleware('admin')
        ->name('bon_commandes.facture');
});

// routes/web.php
use App\Http\Controllers\ProduitController;

Route::middleware('auth')->group(function () {
    Route::resource('produits', ProduitController::class);
});
Route::get('/bon_commandes/type', function () {
    return view('bon_commandes.choose_type');
})->name('bon_commandes.choose_type');Route::middleware('auth')->group(function () {
    Route::resource('fournisseurs', FournisseurController::class);
});Route::middleware('auth')->group(function () {
    Route::resource('produits', ProduitController::class);
});