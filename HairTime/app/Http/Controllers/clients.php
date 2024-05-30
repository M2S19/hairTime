<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\client;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class clients extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inscriptionClient');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $data = $request->validate([
            'email' => 'required|email|max:255|unique:users,email',
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'telephone' => 'required|max:255',
            'adresse' => 'required|max:255',
            'ville' => 'required|max:255',
            'mdp' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
            'confirm_mdp' => 'required|same:mdp',
            ], [
            'mdp.regex' => 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.',
        ]);

        // Création d'un nouvel utilisateur
        $user = new User;
        $user->email = $data['email'];
        $user->nom = $data['nom'];
        $user->prenom = $data['prenom'];
        $user->telephone = $data['telephone'];
        $user->adresse = $data['adresse'];
        $user->ville = $data['ville'];
        $user->role = 'client';
        $user->password = Hash::make($data['mdp']);
        $user->save();

        $client = new client();
        $client->users_id = $user->id; // Clé étrangère faisant référence à `users`
        $client->save();
        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('monCompteClient')->with('success', 'Vous avez créer votre compte avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
