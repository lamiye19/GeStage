<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GeStage') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style="background: black;">
    <div id="app">
    <h1 class="text-white mt-4 text-center">
        {{ config('app.name', 'GeStage') }}
    </h1>
    <main class="py-4">
        @yield('content')
    </main>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card container text-center">
                    <div class="card-header">
                        Ou
                    </div>
                    <div class="card-body h5">
                        @guest
                        
                        @if (Route::is('login'))
                        Vous ne disposez pas encore de compte?
                        <a class="" href="{{ route('register') }}">{{ __(' Créez-en un.') }}</a>
                        @else
                        Vous disposez déjà d'un compte?
                        <a class="" href="{{ route('login') }}">{{ __(' Connectez-vous.') }}</a>
                        @endif
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>