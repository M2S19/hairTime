@extends('layouts.app')

@section('title', 'Ajouter creneaux')

@section('content')

<body>
<div class="container">
    <h2>Ajouter des Créneaux de Travail</h2>
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ Route('ajouterCreneauxStore') }}">
        @csrf
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="mb-3">
            <label for="debut" class="form-label">Heure de Début</label>
            <input type="time" class="form-control" id="debut" name="debut" required>
        </div>
        <div class="mb-3">
            <label for="fin" class="form-label">Heure de Fin</label>
            <input type="time" class="form-control" id="fin" name="fin" required>
        </div>
        <h3>Gerer la recurrence des creneau</h3>
        <div class="mb-3">
            <label for="recurrence" class="form-label">Répétition</label>
            <select class="form-control" id="recurrence" name="recurrence">
                <option value="aucune">Aucune</option>
                <option value="quotidienne">Quotidienne</option>
                <option value="hebdomadaire">Hebdomadaire</option>
                <option value="mensuelle">Mensuelle</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="recurrence_debut" class="form-label">Debut de la répétition</label>
            <input type="date" class="form-control" id="recurrence_debut" name="recurrence_debut">
        </div>
        <div class="mb-3">
            <label for="recurrence_fin" class="form-label">Fin de la répétition</label>
            <input type="date" class="form-control" id="recurrence_fin" name="recurrence_fin">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter Créneau</button>
    </form>
        <a href="{{ Route('monCompteCoiffeur')}}"><button type="submit" calss="btn">Fin d'ajout</button></a>
    <h3>Créneaux Existant</h3>
    <ul class="list-group">
        @foreach ($creneaux as $creneau)
        <li class="list-group-item">{{ $creneau->date_c }} de {{ $creneau->heure_debut }} à {{ $creneau->heure_fin }}</li>
        @endforeach
    </ul>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




@endsection