@extends('layouts.app')

@section('title', 'Ajouter votre salon')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="display-4 text-center">Ajoutez votre salon</h1>
            <p class="lead text-center mt-3">Rejoignez notre communauté et faites découvrir votre talent à un plus large public. Facilitez la prise de rendez-vous et boostez votre activité.</p>

            <div class="text-center mt-5">
                <a href="{{ route('inscriptionCoiffeur') }}" class="btn btn-primary btn-lg">Commencer maintenant</a>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gérez facilement vos rendez-vous</h5>
                    <p class="card-text">Avec notre système de gestion intégré, simplifiez la planification de votre agenda et réduisez les rendez-vous manqués.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Augmentez votre visibilité</h5>
                    <p class="card-text">Attirez de nouveaux clients grâce à une présence en ligne renforcée et une exposition sur notre plateforme dédiée.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sécurité et fiabilité</h5>
                    <p class="card-text">Profitez d'une plateforme sécurisée pour vous et vos clients.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
