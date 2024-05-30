<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB; 


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        $user = Auth::user(); // Récupère l'utilisateur connecté
        $salon = $user->salon;
        return view('espacePersonnel', ['user' => $user, 'salon' => $salon]);

        //return view('espacePersonnel', [
        //    'user' => $request->user(),
        //]);
    }

    public function espacePersonnelCoiffeur()
    {
        $user = Auth()->user(); // Récupère l'utilisateur connecté
        $coiffeur = $user->compteCoiffeur;

        $salon = null;
        if ($coiffeur) {
            $salon = $coiffeur->salon; // Utilise la relation salon() dans le modèle CompteCoiffeur
        }
        $horaires = DB::select(
            "SELECT jour, ouverture, fermeture FROM horaires_salon WHERE salon_coiffures_id = ?", 
            [$salon->id]
        );
        $creneaux = DB::select(
            "SELECT statut, date_c, heure_debut, heure_fin FROM creneaux WHERE salon_coiffures_id = $salon->id"
        );
    
        return view('espacePersonnelCoiffeur', [
            'user' => $user,
            'coiffeur' => $coiffeur,
            'salon' => $salon,
            'horaires' => $horaires,
            'creneaux' => $creneaux,
        ]);
    }

    public function espacePersonnelClient()
    {
        $user = Auth()->user(); // Récupère l'utilisateur connecté
        $client = $user->client;

    
        return view('espacePersonnelClient', [
            'user' => $user,
            'client' => $client,
        ]);
    }
    


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
