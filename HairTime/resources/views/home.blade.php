

@extends('layouts.app')

@section('title', 'Page d\'accueil')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="display-4">C'est l'heure de se faire beaux.</h1>
            <p class="lead">Prends rendez-vous avec le coiffeur de ton choix en un clic.</p>
            <a href="#" class="btn btn-primary btn-lg">Prendre un rendez-vous</a>
        </div>
    </div>
</div>
@endsection

