@extends('layouts.app')

@section('title', 'Espace personnel')

@section('content')

<div class="container">
    <h1 class="my-4">Bienvenue, {{ $user->nom }}</h1>

    <div class="d-flex justify-content-end">
        <form method="POST" action="{{ route('deconnexion') }}">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger">Déconnexion</button>
        </form>
    </div>

    <div class="my-4">
        <h2>Votre Salon {{ $salon->nom }}</h2>
        <p>ID : {{$salon->id}}</p>
        <a href="{{ route('ajouterCreneaux') }}" class="btn btn-primary my-2">Ajouter créneaux</a>

        <h3 class="my-3">Horaires d'ouverture</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Jour</th>
                    <th>Ouverture</th>
                    <th>Fermeture</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($horaires as $horaire)
                    <tr>
                        <td>{{ $horaire->jour }}</td>
                        <td>{{ \Carbon\Carbon::parse($horaire->ouverture)->format('H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($horaire->fermeture)->format('H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3 class="my-3">Créneaux</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Début</th>
                    <th>Fin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($creneaux as $creneau)
                    <tr>
                        <td>{{ $creneau->statut }}</td>
                        <td>{{ $creneau->date_c }}</td>
                        <td>{{ \Carbon\Carbon::parse($creneau->heure_debut)->format('H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($creneau->heure_fin)->format('H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
