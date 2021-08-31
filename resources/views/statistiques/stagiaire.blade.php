<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stages d'un stagiaire</title>
    <link rel="stylesheet" href="{{ mix("css/app.css")}} ">
</head>

<body>
    <style>
        body{
            text-align: justify;
            font-size: 1.25em;
        }
        ul {
            list-style: none;
            margin-left: 10%;
        }
        ul li{
            margin-bottom: 10px;
        }

        h2,
        h4 {
            text-align: center;
        }
        h2{
            color: blue;
            margin-bottom: 1.5em;
        }
        h3{
            color: red;
            margin-bottom: 1.5em;
        }
        .info {
            margin: 0;
        }
    </style>
    <div class="text-red">
        <h2><strong><u>Liste des stages effectués par ce stagiaire</u></strong></h2>
        <h3><strong><u>Informations personnelles</u></strong></h3>
                    <ul class="info">
                        <li><strong><u>Nom</u> : </strong>{{ $stages[0]->demande->stagiaire->nom }}</li>
                        <li><strong><u>Prenom</u> : </strong>{{ $stages[0]->demande->stagiaire->prenom }}</li>
                        <li><strong><u>Sexe</u> : </strong>{{ $stages[0]->demande->stagiaire->sexe }}</li>
                        <li><strong><u>Ecole</u> : </strong>{{ $stages[0]->demande->stagiaire->ecole }}</li>
                        <li><strong><u>Téléphone</u> : </strong>{{ $stages[0]->demande->stagiaire->tel }}</li>
                        <li><strong><u>E-mail</u> : </strong>{{ $stages[0]->demande->stagiaire->email }}</li>
                    </ul>
        @foreach ($stages as $stage)
        <h4 class=""><u>Stage {{ $loop->index+1 }} </u></h4>
        <ul class="mb-5">
            <li class="">
                <strong><u>Thème</u> : </strong> {{ $stage->theme }}
            </li>
            <li class="">
                <strong><u>Poste</u> : </strong> {{ $stage->titreStage }}
            </li>
            <li class="">
                <strong><u>Date de début</u> : </strong> {{ $stage->debut }}
            </li>
            <li class="">
                <strong><u>Date de fin</u> : </strong> {{ $stage->fin }}
            </li>
            @if ($stage->note != null)
            <li>
                <strong><u>Observation</u> : </strong> {{ $stage->note }}
            </li>
            @endif
            <li>
                <strong><u>Maître de stage</u> : </strong> {{ $stage->maitre->nom }} {{ $stage->maitre->prenom }}
            </li>
            <li class="">
                <strong><u>Service</u> : </strong> {{ $stage->service->lib }}
            </li>
            <li>
                <strong><u>Etat</u> : </strong> 
                @if($stage->etat)
                    <span>Terminé</span>
                @elseif ($stage->etat == 0)
                    <span>En cours</span>
                @endif
            </li>
        </ul>
        {{-- <table>
        <tr>
            <th>Thème</th>
            <th>{{ $stage->theme }}</th>
        </tr>
        <tr>
            <th>Poste</th>
            <th>{{ $stage->titreStage }}</th>
        </tr>
        <tr>
            <th>Date de début</th>
            <th>{{ $stage->debut }}</th>
        </tr>
        <tr>
            <th>Date de fin</th>
            <th>{{ $stage->fin }}</th>
        </tr>
        </table> --}}
        @endforeach
    </div>

    <script src="{{mix('js/app.js')}}"></script>
</body>

</html>