@extends('layouts.app')

@section('title', 'RedirectionSalon')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class=" text-center">Super tu est Inscrit Maintenant ajoute ton salon</h1>

            <div class="text-center mt-5">
                <a href="{{ route('inscriptionSalonCreate') }}" class="btn btn-primary btn-lg">Ajouter salon</a>
            </div>
        </div>
    </div>
</div>

@endsection
