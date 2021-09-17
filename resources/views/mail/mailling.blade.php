<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
    <link rel="stylesheet" href="{{mix("css/app.css")}}">
</head>
<body>
    <div style="background-color: aliceblue; align-items: center;">
        <img href="users-icons/F.jpeg" alt="" style="text-align: center; background-position: center">
    <h1 align="center" style="font-weight: bolder; background-position: center">{{ config('app.name', 'GeStage') }}</h1>
    </div>
    <h2>Bonjour {{ $data['name'] }} !</h2>
    <div style="margin: 5px; margin-top: 0; font-size: 14pt;">
        @php
            echo $data['message'];
        @endphp
    </p>


  <script src="{{mix('js/app.js')}}"></script>
</body>
</html>