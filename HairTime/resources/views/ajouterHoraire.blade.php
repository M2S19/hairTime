@extends('layouts.app')

@section('title', 'Ajouter horaire salon')

@section('content')

<form action="{{route('ajouterHoraireStore')}}" method="POST">
    @csrf
    <div class="container mt-5">
        <h2>Ajouter les horaires de votre salon</h2>

            <!-- Bouclez sur chaque jour de la semaine -->
            @php
            $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
            @endphp
    
            @foreach($jours as $jour)
            <div class="row mb-3 align-items-center">
                <div class="col-md-2">
                    <label class="form-label">{{ $jour }} :</label>
                </div>
                <div class="col-md-5">
                    <input type="time" class="form-control" placeholder="Horaire d'ouverture" name="ouverture_{{ strtolower($jour) }}" required>
                </div>
                <div class="col-md-5">
                    <input type="time" class="form-control" placeholder="Horaire de fermeture" name="fermeture_{{ strtolower($jour) }}" required>
                </div>
            </div>
            @endforeach
    </div>
    <button type="submit" class="btn btn-primary">Suivant</button>
</form>


@endsection