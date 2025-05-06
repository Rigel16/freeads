<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DashboardController;




Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {
    // Affichage de la liste des annonces
    Route::get('/annonces', [AnnonceController::class, 'index'])->name('annonces.index');

    // Formulaire de création d'une annonce
    Route::get('/annonces/create', [AnnonceController::class, 'create'])->name('annonces.create');
    Route::post('/annonces', [AnnonceController::class, 'store'])->name('annonces.store');

    // Afficher une annonce spécifique (si nécessaire)
    Route::get('/annonces/{annonce}', [AnnonceController::class, 'show'])->name('annonces.show');

    // Modifier une annonce
    Route::get('/annonces/{annonce}/edit', [AnnonceController::class, 'edit'])->name('annonces.edit');
    Route::put('/annonces/{annonce}', [AnnonceController::class, 'update'])->name('annonces.update');

    // Supprimer une annonce
    Route::delete('/annonces/{annonce}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');

    // recherche d'annonces
    Route::get('/annonces/search', [AnnonceController::class, 'search'])->name('annonces.search');
});

// Routes pour la messagerie
Route::middleware(['auth'])->group(function () {
    // Liste des messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

// Affiche les messages entre l'utilisateur connecté et un autre, pour une annonce donnée
Route::get('/annonces/{annonce}/messages/{user}', [MessageController::class, 'show'])->name('messages.show');

// Envoie un message pour une annonce
Route::post('/annonces/{annonce}/messages/{user}', [MessageController::class, 'send'])->name('messages.send');

});

    // // Envoyer un message
    // Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    // Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');