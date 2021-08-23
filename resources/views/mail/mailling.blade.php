<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{mix("css/app.css")}}">
</head>
<body>
    <h3>Bonjour {{ $data['name'] }},</h3>
    <p>
        @php
            echo $data['message'];
        @endphp
    </p>


  <script src="{{mix('js/app.js')}}"></script>
</body>
</html>