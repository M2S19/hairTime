@extends('layouts.app')
<style>
/* styles.css */
.container {
    max-width: 1200px;
    margin: auto;
    padding: 20px;
}

.photo-container img {
    width: 100%;
    height: auto;
}

.salon-description {
    margin-top: 20px;
}

.table {
    margin-top: 20px;
}

@media (max-width: 768px) {
    .photo-container, .salon-description, .table {
        margin-top: 20px;
    }
}


.creneaux-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 10px;
    padding: 10px;
}

.creneau {
    display: block;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 10px;
    text-decoration: none;
    color: black;
}

.creneau:hover {
    background-color: #e2e6ea;
    cursor: pointer;
}

.creneau-details {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.statut {
    font-weight: bold;
}

.date, .heure {
    font-size: 0.8em;
}



</style>
@section('title', $salon->nom)


@section('content')
<div class="container my-4">
    <h2>{{ $salon->nom }}</h2>
    <div class="row">
        <div class="col-md-8">
            <div class="photo-container">
                @if($salon->photos->isNotEmpty())
                    <!-- Carousel -->
                    <div id="carousel{{ $salon->id }}" class="carousel slide" data-interval="false">
                        <div class="carousel-inner">
                            @foreach($salon->photos as $photo)
                                <div class="carousel-item @if($loop->first) active @endif">
                                    <img src="{{ asset('storage/' . $photo->path) }}" class="d-block w-100" alt="Photo de {{ $salon->nom }}">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carousel{{ $salon->id }}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Précédent</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel{{ $salon->id }}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Suivant</span>
                        </a>
                    </div>
                @else
                    <img src="{{ asset('storage/salons/pasImageDisponible.jpg') }}" class="d-block w-100" alt="Pas de photo disponible">
                @endif
            </div>
            <div class="salon-description mt-3">
                <strong>Nom:</strong> {{ $salon->nom }}<br>
                <strong>Ville:</strong> {{ $salon->ville }}<br>
                <strong>Description:</strong> {{ $salon->description }}
            </div>
        </div>
        <div class="col-md-4">
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
        </div>
    </div>
    <h3 class="my-3">Services proposés</h3>
    <ul>
        @foreach ($salon->services as $service)
        <li>
            <strong>{{ $service->nom }}</strong><br>
            Genre: {{ $service->pivot->genre }}<br>
            Description: {{ $service->pivot->description }}<br>
            Durée: {{ $service->pivot->duree }} min<br>
            Prix: {{ $service->pivot->prix }}€
        </li>
    @endforeach
    </ul>
    <h2>Selectionne un creneau de Rendez-Vous</h2>
    <h3 class="my-3">Créneaux</h3>
    <div class="creneaux-grid">
        @foreach ($creneaux as $creneau)
        <a href="{{ route('ajouterRendezVous', ['id' => $salon->id, 'idC' => $creneau->id]) }}" class="creneau">
                <div class="creneau-details">
                    <span class="statut">{{ $creneau->statut }}</span>
                    <span class="date">{{ $creneau->date_c }}</span>
                    <span class="heure">{{ \Carbon\Carbon::parse($creneau->heure_debut)->format('H:i') }} - {{ \Carbon\Carbon::parse($creneau->heure_fin)->format('H:i') }}</span>
                </div>
            </a>
            

        @endforeach
    </div>
    
        


</div>



@endsection
