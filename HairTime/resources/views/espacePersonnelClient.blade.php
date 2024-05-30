@extends('layouts.app')

@section('title', 'Espace personnel')

@section('content')

<h1>Bienvenue, {{ $user->prenom }}</h1>
<p>Email: {{ $user->email }}</p>



<div class="d-flex justify-content-end">
    <form method="POST" action="{{ route('deconnexion') }}">
      @method('delete')
      @csrf
      <button type="submit">Déconnexion</button>
    </form>
</div>
<div>

</div>
@endsection