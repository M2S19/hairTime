@extends('layouts.app')

@section('title', 'Inscription')

@section('content')


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center mb-5">
                <h2>Inscription</h2>
                <p>Êtes-vous un coiffeur ou un client ? Choisissez le type de compte que vous souhaitez créer.</p>
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
                <a href="{{ route('inscriptionCoiffeur') }}" class="btn btn-primary btn-block">Compte Coiffeur</a>
                <a href="inscriptionClient" class="btn btn-secondary btn-block">Compte Client</a>
            </div>
        </div>
    </div>
</div>
@endsection