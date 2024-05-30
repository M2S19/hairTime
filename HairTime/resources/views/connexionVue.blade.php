@extends('layouts.app')

@section('title', 'Connexion')

@section('content')

<h1>Connexion</h1>
<form method="POST"  action="{{ Route('connexionStore') }}">
  @csrf
    <div class="mb-3 mt-3">
      <label for="email" class="form-label">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Entrer votre email" name="email">
    </div>
    @if ($errors->has('email'))
      <div class="alert alert-danger">
      {{ $errors->first('email') }}
      </div>
      @endif
    <div class="mb-3">
      <label for="mdp" class="form-label">Mot de passe:</label>
      <input type="password" class="form-control" id="mdp" placeholder="Entrer votre mot de passe" name="password">
    </div>
    @if ($errors->has('password'))
      <div class="alert alert-danger">
      {{ $errors->first('password') }}
      </div>
      @endif
    <div class="form-check mb-3">
        <a href="inscription">Vous n'avez pas de compte ?</a> <br>
        <a href="#">Mot de passe Oublié</a>
    </div>
    <button type="submit" class="btn btn-primary">Connexion</button>
  </form>

@endsection