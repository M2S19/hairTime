@extends('layouts.app')

@section('title', $salon->nom,'/',$creneau->id)

@section('content')
<h2 class="">Prendre Rendez-Vous</h2>

<h1>{{ $salon->nom }}</h1>
<h3>creneau de rendez-vous :</h3>
<div class="creneau-details">
    <span class="statut">{{ $creneau->statut }}</span>
    <span class="date">{{ $creneau->date_c }}</span>
    <span class="heure">{{ \Carbon\Carbon::parse($creneau->heure_debut)->format('H:i') }} - {{ \Carbon\Carbon::parse($creneau->heure_fin)->format('H:i') }}</span>
</div>
<form action="{{ route('ajouterRendezVousStore', ['id' => $salon->id, 'idC' => $creneau->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="nom" class="form-label">Votre nom</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom" required>
        <label for="prenom" class="form-label">Votre prénom</label>
        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom" required>
        <label for="remarque" class="form-label">Vous pouvez ajouter une remarque</label>
        <input type="text" class="form-control" id="remarque" name="remarque" placeholder="Ajouter une remarque" >
    </div>
    <h3 class="my-3">Sélectionnez un service :</h3>
    <div class="row">
        @foreach ($salon->services as $service)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $service->nom }}</h5>
                    <p class="card-text">Genre: {{ $service->pivot->genre }}</p>
                    <p class="card-text">Description: {{ $service->pivot->description }}</p>
                    <p class="card-text">Durée: {{ $service->pivot->duree }} min</p>
                    <p class="card-text">Prix: {{ $service->pivot->prix }}€</p>
                    <input type="radio" name="service_id" id="service{{ $service->id }}" value="{{ $service->id }}" class="card-input-element">
                    <label for="service{{ $service->id }}" class="card-input-label btn btn-primary btn-block">Sélectionner</label>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <button type="submit" class="btn btn-primary mt-3">Réserver</button>
</form>


@endsection