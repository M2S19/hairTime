@extends('layouts.app')

@section('title', 'Inscription Coiffeur')

@section('content')
<form action="{{route('inscriptionUser')}}" method="POST">
    @csrf
    <div class="mb-3 mt-3">
      <label for="email" class="form-label"><i class="bi bi-envelope-fill"></i> Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Entrer votre email" name="email" required>
      @if ($errors->has('email'))
      <div class="alert alert-danger">
      {{ $errors->first('email') }}
      </div>
      @endif
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="nom" placeholder="Votre nom" name="nom" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" class="form-control" id="prenom" placeholder="Votre prénom" name="prenom" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone :</label>
        <input type="tel" class="form-control" id="telephone" placeholder="Votre numéro de téléphone" name="telephone" pattern="[0-9]{10}" required>
        @if ($errors->has('telephone'))
        <div class="alert alert-danger">
        {{ $errors->first('telephone') }}
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nom" class="form-label">Adresse :</label>
            <input type="text" class="form-control" id="adresse" placeholder="Votre adresse" name="adresse" required>
        </div>
        @if ($errors->has('adresse'))
        <div class="alert alert-danger">
        {{ $errors->first('adresse') }}
        </div>
        @endif
        <div class="col-md-6 mb-3">
            <label for="prenom" class="form-label">Ville :</label>
            <input type="text" class="form-control" id="ville" placeholder="Votre ville" name="ville" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="mdp" class="form-label">Mot de Passe :</label>
        <input type="password" class="form-control" id="mdp" placeholder="Entrer votre mot de passe" name="mdp" required>
        @if ($errors->has('mdp'))
        <div class="alert alert-danger">
        {{ $errors->first('mdp') }}
        </div>
        @endif
    </div>
    <div class="mb-3">
        <label for="confirm-mdp" class="form-label">Confirmer Mot de Passe :</label>
        <input type="password" class="form-control" id="confirm-mdp" placeholder="Confirmer votre mot de passe" name="confirm_mdp" required>
    </div>
    <button type="submit" class="btn btn-primary">Inscription</button>
</form>
@endsection
