<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ctrlAccueil;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\salon;
use App\Http\Controllers\users;
use App\Http\Controllers\coiffeurs;
use App\Http\Controllers\clients;
use App\Http\Controllers\connexion;
use App\Http\Controllers\horaire;
use App\Http\Controllers\ctrlService;
use App\Http\Controllers\ctrlCreneau;
use App\Http\Controllers\ctrlRendezVous;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/accueil', [ctrlAccueil::class, 'index'])->name('home');


Route::get('/inscription', function() {
    return view('inscription');
});

Route::get('/inscriptionSalon', function() {
    return view('inscriptionSalon');
});

Route::get('/ajouterSalon', function() {
    return view('ajouterSalon');
});

//client
Route::get('/inscriptionClient', [clients::class, 'create'])->name('inscriptionClient');
Route::POST('/inscriptionClient', [clients::class, 'store'])->name('inscriptionClientStore');


//Compte Coiffeur
Route::get('/ajouterSalon/inscriptionCoiffeur', [coiffeurs::class, 'create'])->name('inscriptionCoiffeur');
Route::post('/ajouterSalon/inscriptionCoiffeur', [coiffeurs::class, 'store'])->name('inscriptionUser');

Route::get('/ajouterSalon/inscriptionCoiffeur/redirectionInscriptionSalon', function() {
    return view('redirectionInscriptionSalon');
})->middleware('auth');

//Creation salon
Route::get('/ajouterSalon/inscriptionCoiffeur/redirectionInscriptionSalon/inscriptionSalon', [salon::class, 'create'])->name('inscriptionSalonCreate')->middleware('auth');
Route::POST('/ajouterSalon/inscriptionCoiffeur/redirectionInscriptionSalon/inscriptionSalon', [salon::class, 'store'])->name('inscriptionSalonStore');

//horaire
Route::get('/ajouterSalon/inscriptionCoiffeur/redirectionInscriptionSalon/inscriptionSalon/ajouterHoraire', [horaire::class, 'create'])->name('ajouterHoraireSalon');
Route::POST('/ajouterSalon/inscriptionCoiffeur/redirectionInscriptionSalon/inscriptionSalon/ajouterHoraire', [horaire::class, 'store'])->name('ajouterHoraireStore');

//Service
Route::get('/ajouterSalon/inscriptionCoiffeur/redirectionInscriptionSalon/inscriptionSalon/ajouterHoraire/ajouterService', [ctrlService::class, 'create'])->name('ajouterService');
Route::POST('/ajouterSalon/inscriptionCoiffeur/redirectionInscriptionSalon/inscriptionSalon/ajouterHoraire/ajouterService', [ctrlService::class, 'store'])->name('ajouterServiceStore');

//Creneau
Route::get('/monCompteCoiffeur/ajouterCreneaux', [ctrlCreneau::class, 'create'])->name('ajouterCreneaux')->middleware('auth');
Route::POST('/monCompteCoiffeur/ajouterCreneaux', [ctrlCreneau::class, 'store'])->name('ajouterCreneauxStore');


//Connexion
Route::get('/connexion', [AuthenticatedSessionController::class, 'create'])->name('connexion');
Route::POST('/connexion', [AuthenticatedSessionController::class, 'store'])->name('connexionStore');

//Gestion Compte
Route::get('/monCompteCoiffeur', [ProfileController::class, 'espacePersonnelCoiffeur'])->name('monCompteCoiffeur')->middleware('auth');
Route::get('/monCompteClient', [ProfileController::class, 'espacePersonnelClient'])->name('monCompteClient')->middleware('auth');

//deconnexion
Route::delete('/deconnexion', [AuthenticatedSessionController::class, 'destroy'])->name('deconnexion');

//tous les salon
Route::get('/lesSalons', [salon::class, 'lesSalons'])->name('lesSalons');
//unSalon
Route::get('Salon/{id}', [salon::class, 'show'])->name('unSalon');

//Rendez-Vous
Route::get('Rendez-Vous/{id}/{idC}', [ctrlRendezVous::class, 'create'])->name('ajouterRendezVous');
Route::POST('Rends-Vous/{id}/{idC}', [ctrlRendezVous:: class, 'store'])->name('ajouterRendezVousStore');
require __DIR__.'/auth.php';
