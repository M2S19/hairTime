<?php

namespace App\Http\Controllers;

use App\Models\SalonCoiffure;
use App\Models\compteCoiffeur;
use App\Models\Photo;
use App\Models\horaireSalon;
use App\Models\SalonService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Str;




class salon extends Controller
{
    /**
     * Display a listing of the resource.
     */

    
    public function index()
    {
        return view('inscriptionSalon');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inscriptionSalon');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $coiffeurId = auth()->user()->id; // Récupérer l'ID du coiffeur depuis la session
        // Validation des données du salon
        $dataSalon = $request->validate([
            'nom' => 'required|max:50',
            'adresse' => 'required|max:70',
            'ville' => 'required|max:30',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|max:500',
        ]);

        $salon = new salonCoiffure;
        $salon->nom = $dataSalon['nom'];
        $salon->adresse = $dataSalon['adresse'];
        $salon->ville = $dataSalon['ville'];
        $salon->description = $dataSalon['description'];
        $salon->save();


        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('public/salons');
                $correctPath = Str::replaceFirst('public/', '', $path);
                
                Photo::create([
                    'salon_id' => $salon->id,
                    'path' => $correctPath,
                ]);
            }
        }

        $coiffeur = compteCoiffeur::where('users_id', $coiffeurId)->first();
        if ($coiffeur) {
            $coiffeur->salon_id = $salon->id;
            $coiffeur->save();
        }
        // Stocker l'ID du salon dans la session
        session(['salon_id' => $salon->id]);

        return redirect()->route('ajouterHoraireSalon');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $salon = SalonCoiffure::with(['photos', 'services'])->findOrFail($id);
        $service = Service::all();
        $user = Auth()->user();
        $client = $user->clients;
        $horaires = DB::select(
            "SELECT jour, ouverture, fermeture FROM horaires_salon WHERE salon_coiffures_id = ?", 
            [$salon->id]
        );
        $creneaux = DB::select(
            "SELECT id, statut, date_c, heure_debut, heure_fin FROM creneaux WHERE salon_coiffures_id = $salon->id"
        );
        return view('unSalon', [
            'salon' => $salon,
            'client' => $client,
            'horaires' => $horaires,
            'creneaux' => $creneaux,
        ]);
    }

    public function lesSalons()
    {
        $user = Auth()->user(); // Récupère l'utilisateur connecté
        $coiffeur = $user->compteCoiffeur;
        
       /* $lesSalons = DB::select(
            "SELECT nom, ville, description 
            FROM salon_coiffures"
        ); */
        // Charger tous les salons avec leurs photos associées

        $lesPhotos = Photo::all();
        $lesSalons = SalonCoiffure::with('photos')->get();
        return view('lesSalons', [
            //'user' => $user,
            'lesPhotos' => $lesPhotos,
            'coiffeur' => $coiffeur,
            'lesSalons' => $lesSalons, 
        ]);
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
