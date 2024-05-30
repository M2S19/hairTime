<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\horaireSalon;
use App\Models\salonCoiffure;
use App\Models\compteCoiffeur;


class horaire extends Controller
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
        return view('ajouterHoraire');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $user = Auth()->user();
        // Accéder au modèle CompteCoiffeur associé à cet utilisateur
        $coiffeur = $user->compteCoiffeur;
        if ($coiffeur) {
            $salonId = $coiffeur->salon_id;
            $salon = $coiffeur->salon;
        }
            //dd($coiffeur);


        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];

        foreach ($jours as $jour) {

            $ouverture = $request->input("ouverture_{$jour}");
            $fermeture = $request->input("fermeture_{$jour}");

            $horaireSalon = new HoraireSalon;
            $horaireSalon->salon_coiffures_id = $salonId;
            $horaireSalon->jour = $jour; 
            $horaireSalon->ouverture = $ouverture;
            $horaireSalon->fermeture = $fermeture;
            $horaireSalon->save();
        }
       return redirect()->route('ajouterService');
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
