<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalonCoiffure;
use App\Models\Service;
use App\Models\SalonService;
use App\Models\creneau;
use Carbon\Carbon;


class ctrlCreneau extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth()->user();
        $creneaux = Creneau::where('salon_coiffures_id', $user->compteCoiffeur->salon_id)->get();
        return view('ajouterCreneaux', ['creneaux' => $creneaux]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth()->user();
        $coiffeur = $user->compteCoiffeur;
        date_default_timezone_set('Europe/paris');
        $data = $request->validate([
            'date' => 'required|date',
            'debut' => 'required|date_format:H:i',
            'fin' => 'required|date_format:H:i|after:debut',
            'recurrence' => 'required|in:aucune,quotidienne,hebdomadaire, mensuelle',
            'recurrence_debut' => 'required|date',
            'recurrence_fin' => 'required|date|after_or_equal:recurrence_debut',
        ]); 

            // Verifie si la date entrée est inférieur a la date actuel Récupérer tous les créneaux pour le salon et la date
            $dateActuelle = Carbon::today();
            $dateC = Carbon::parse($data['date']);

            if (($dateC < $dateActuelle)) {
                return back()->with('error', 'La date selectionné est avant la date actuelle');
            }

            $creneaux = creneau::where('salon_coiffures_id', $coiffeur->salon_id)
            ->where('date_c', $data['date'])
            ->get();

            // Vérifier Si le creneau existe déjà
            foreach ($creneaux as $creneau) {
                if (($data['debut'] < $creneau->heure_fin) && ($data['fin'] > $creneau->heure_debut )) {
                    return back()->with('error', 'Un créneau pour ces heures existe déjà.');
                }
            }

            $recurrence = $request->recurrence;
            $recurrenceDebut = Carbon::createFromDate($request->recurrence_debut);
            $recurrenceFin = Carbon::createFromDate($request->recurrence_fin);
            $currentDate = $recurrenceDebut->copy();

            while ($currentDate->lte($recurrenceFin)) { 
    
                $creneau = new creneau;
                $creneau->statut = "disponible";
                $creneau->date_c = $currentDate;
                $creneau->heure_debut = $data['debut'];
                $creneau->heure_fin = $data['fin'];
                $creneau->salon_coiffures_id = $coiffeur->salon_id;
                $creneau->type_recurrence = $data['recurrence'];
                $creneau->save();

                if ($recurrence == 'quotidienne') {
                    $currentDate->addDay();
                } else if ($recurrence == 'hebdomadaire') {
                    $currentDate->addWeek();
                } else if ($recurrence == 'mensuelle') {
                    $currentDate->addMonth();
                }
                
            }
            
            return redirect()->route('ajouterCreneaux')->with('success', 'Creneau ajouté avec succès au salon.');
    
                      
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
