<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nom de votre application')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
  <div id="react-root"></div>  <!-- Ici, React sera monté -->

 {{--  <script src="{{ mix('js/app.js') }}"></script>--}}
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{ route('home') }}">
                <img src="\resources\views\images\logoHairTime.webp" alt="Logo du site">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ Route('lesSalons') }}">Les salons</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                  </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link" href="ajouterSalon">Ajouter son salon</a>
                 </li>

                  <li class="nav-item">                    
                    @guest
                    <a class="nav-link" href="{{ route('connexion') }}">Connexion</a>
                    @endguest
                    @auth
                    @if(auth()->user()->role == 'coiffeur')
                        <a class="nav-link" href="{{ route('monCompteCoiffeur') }}">Mon compte</a>
                    @else
                        <a class="nav-link" href="{{ route('monCompteClient') }}">Mon compte</a>
                    @endif
                    @endauth                

                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        {{-- Contenu du pied de page ici --}}
    </footer>

    {{-- Liens vers les scripts JS --}}
</body>
</html>
