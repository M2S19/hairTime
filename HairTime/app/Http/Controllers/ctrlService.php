<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\salonCoiffure;
use App\Models\Service;
use App\Models\SalonService; // Si vous utilisez une table de jointure

class ctrlService extends Controller
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
        $services = Service::all(); // Ceci retourne une collection de tous les services
        return view('ajouterService', ['services' => $services]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth()->user();
        $coiffeur = $user->compteCoiffeur;
        if (!$coiffeur) {
            return back()->withErrors(['error' => 'Compte coiffeur non trouvé']);
        }
    
        $request->validate([
            'duree.*' => 'required|max:255',
            'prix.*' => 'required|numeric',
            'description.*' => 'required|max:255',
            'services.*' => 'required', // Chaque élément doit être requis
        ]);
    
        foreach ($request->input('services') as $index => $serviceId) {
            $salonService = new SalonService;
            $salonService->description = $request->description[$index];
            $salonService->duree = $request->duree[$index];
            $salonService->prix = $request->prix[$index];
            $salonService->service_id = $serviceId;
            $salonService->salon_coiffures_id = $coiffeur->salon_id;
 
            $genres = [];
            if (isset($request->Homme[$index])) {
                $genres[] = 'Homme';
            }
            if (isset($request->Femme[$index])) {
                $genres[] = 'Femme';
            }
            $salonService->genre = implode(',', $genres);
        
            $salonService->save();
 
        }
    
        return redirect()->route('monCompteCoiffeur')->with('success', 'Service ajouté avec succès au salon.');
    }
    

        /*} else {
            // Gérer le cas où certaines données sont manquantes
            // Redirigez avec un message d'erreur ou retournez une réponse JSON
            return back()->with('error', 'Toutes les informations requises ne sont pas fournies.');
        } */
    


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
