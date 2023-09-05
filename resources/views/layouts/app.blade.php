<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ecommerce_project') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
    <script>
    function logout() {
        // Envoie de la requête de déconnexion au serveur
        document.getElementById('logout-form').submit();
    }
    </script>
</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="header">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="admin-logo d-flex align-items-center flex-column">
                        @php
                            // Utilisez la classe InfoSite pour récupérer les informations du logo depuis la base de données
                            $infoSite = \App\Models\InfoSite::find(1); // Assurez-vous que 1 est l'ID correct de votre enregistrement
                
                            // Vérifiez si l'enregistrement a été trouvé avant d'afficher le logo
                            if ($infoSite && !empty($infoSite->urlPhotoS)) {

                                echo '<img width="75px" height="75px" src="' . asset('storage/' .$infoSite->urlPhotoS) . '" alt="Logo">';
                            } else {
                                echo '<img width="50px" height="50px" src="' . asset('/images/logo.jpeg') . '" alt="Logo">';
                            }
                        @endphp
                    </div>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
    <!-- Authentication Links -->
    @guest
        <!-- Afficher les liens de connexion et d'inscription si l'utilisateur n'est pas connecté -->
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <!-- Afficher le menu déroulant de l'utilisateur connecté -->
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onClick="()=>console.log('Hello')">
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#" onclick="logout();">
                    {{ __('Logout') }}
                </a>
                <!-- Le champ bouton submit pour le formulaire de déconnexion -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>

                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B0eGhr/LCwSlAg5DHRrMIWgaKpFII5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>