<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\compteCoiffeur;
use App\Models\salonCoiffure;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class coiffeurs extends Controller
{

    protected $table = 'compte_coiffeurs';
    // Assurez-vous que `users_id` est assignable en masse si nécessaire
    protected $fillable = ['users_id', 'specialite'];
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
        return view('inscriptionCoiffeur');
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
        $user->role = 'coiffeur';
        $user->password = Hash::make($data['mdp']);
        $user->save();


        $compteCoiffeur = new compteCoiffeur();
        $compteCoiffeur->users_id = $user->id; // Clé étrangère faisant référence à `users`
        // Assignez les autres champs spécifiques au coiffeur si nécessaire
        $compteCoiffeur->specialite = $request->specialite;
        $compteCoiffeur->save();

        //session(['compte_coiffeurs_users_id' => $compteCoiffeur->users_id]);


        event(new Registered($user));

        Auth::login($user);


        return redirect()->to('/ajouterSalon/inscriptionCoiffeur/redirectionInscriptionSalon')->with('success', 'Vous avez crée votre Compte');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        
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
