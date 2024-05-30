<?php

namespace App\Http\Controllers;
use App\Models\SalonCoiffure;
use App\Models\compteCoiffeur;
use App\Models\Photo;
use App\Models\horaireSalon;
use App\Models\SalonService;
use App\Models\Service;
use App\Models\creneau;
use App\Models\rendezVous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Str;


class ctrlRendezVous extends Controller
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
    public function create($id, $idC)
    {
        $salon = SalonCoiffure::with(['photos', 'services'])->findOrFail($id);
        $service = Service::all();
        $user = Auth()->user();
        $client = $user->clients;
        $horaires = DB::select(
            "SELECT jour, ouverture, fermeture FROM horaires_salon WHERE salon_coiffures_id = ?", 
            [$salon->id]
        );
        $creneau = DB::selectOne(
            "SELECT id, statut, date_c, heure_debut, heure_fin FROM creneaux WHERE id = $idC"
        );
        return view('ajouterRendezVous', [
            'salon' => $salon,
            'client' => $client,
            'horaires' => $horaires,
            'creneau' => $creneau,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id, $idC)
    {
        $user = auth()->user();
        $client = $user->clients;
        $salon = SalonCoiffure::with(['photos', 'services'])->findOrFail($id);
        $creneau = creneau::find($idC);
        $data = $request->validate([
            'nom' => 'required|max:50',
            'prenom' => 'required|max:50',
            'remarque' => 'required|max:200',
            'service_id' => 'required|exists:services,id'
        ]);

        $rdv = new rendezVous;
        $rdv->nom_client = $data['nom'];
        $rdv->prenom_client = $data['prenom'];
        $rdv->remarque = $data['remarque'];
        $rdv->service_id = $data['service_id'];
        $rdv->client_users_id = $user->id;
        $rdv->salon_coiffures_id = $salon->id;
        $rdv->creneaux_id = $creneau->id;
        $rdv->save();

        return redirect()->route('monCompteClient')->with('success', 'Rendez-vous enregistré avec succès.');
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
