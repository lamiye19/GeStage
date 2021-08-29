<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{mix("css/app.css")}}">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    

    <nav class="navbar navbar-expand navbar-light navbar-light">
      <a href="{{ route('admin') }}" class="brand-link">
        <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">{{ config('app.name', 'GeStage') }}</span>
      </a><!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link btn" href="/" role="button">Demande de stage</a>
        </li>
        <li>
          <a class="nav-link btn" href="{{ route('rendu-stage') }}" role="button">Soumettre rapport de stage</a>
        </li>
      </ul>
    </nav>

    <div class="">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
  </div>
    
  <script src="{{mix('js/app.js')}}"></script>

</body>
</html>