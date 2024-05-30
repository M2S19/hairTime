@extends('layouts.app')

@section('title', 'les Salons')

@section('content')
<style>
    .carousel-item img {
        height: 200px;
        object-fit: cover;
    }
    .salon-card {
        margin-bottom: 30px;
    }
    .salon-info {
        text-align: center;
        margin-top: 15px;
    }
</style>


<div class="container mt-5">
    <h1 class="text-center mb-4">Liste des Salons</h1>
    <div class="row">
        
        @foreach($lesSalons as $salon)
        
            <div class="col-md-4 salon-card">
                <a href="{{ route('unSalon', $salon->id) }}">
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
                            <span class="sr-only">Precedent</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel{{ $salon->id }}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Suivant</span>
                        </a>
                    </div>
                @else
                    <img src="{{ asset('storage/salons/pasImageDisponible.jpg') }}" class="d-block w-100" alt="Pas de photo disponible">
                @endif
            </a>
                <div class="salon-info">
                    <strong>Nom:</strong> {{ $salon->nom }}<br>
                    <strong>Ville:</strong> {{ $salon->ville }}<br>
                    <strong>Description:</strong> {{ $salon->description }}
                </div>
            </div>
        @endforeach
    
    </div>
</div>
@endsection
