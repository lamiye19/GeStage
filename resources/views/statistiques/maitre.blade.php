<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stages d'un maitre</title>
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
    <div>
        <h2><strong><u>Liste des stages suivi par ce maître de stage</u></strong></h2>
        <h3><strong><u>Informations personnelles</u></strong></h3>
                    <ul class="info">
                        <li><strong><u>Nom</u> : </strong>{{ $stages[0]->maitre->nom }}</li>
                        <li><strong><u>Prenom</u> : </strong>{{ $stages[0]->maitre->prenom }}</li>
                        <li><strong><u>Sexe</u> : </strong>{{ $stages[0]->maitre->sexe }}</li>
                        <li><strong><u>Poste</u> : </strong>{{ $stages[0]->maitre->poste }}</li>
                        <li><strong><u>Téléphone</u> : </strong>{{ $stages[0]->maitre->tel }}</li>
                        <li><strong><u>E-mail</u> : </strong>{{ $stages[0]->maitre->email }}</li>
                    </ul>
        @foreach ($stages as $stage)
        <h4><u>Stage {{ $loop->index+1 }} </u></h4>
        <ul class="mb-5">
            <li>
                <strong><u>Thème</u> : </strong> {{ $stage->theme }}
            </li>
            <li>
                <strong><u>Stagiaire</u> : </strong> {{ $stage->demande->stagiaire->nom }} {{ $stage->demande->stagiaire->prenom }}
            </li>
            <li>
                <strong><u>Poste</u> : </strong> {{ $stage->titreStage }}
            </li>
            <li>
                <strong><u>Date de début</u> : </strong> {{ $stage->debut }}
            </li>
            <li>
                <strong><u>Date de fin</u> : </strong> {{ $stage->fin }}
            </li>
            @if ($stage->note != null)
            <li>
                <strong><u>Observation</u> : </strong> {{ $stage->note }}
            </li>
            @endif
            <li>
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
        @endforeach
    </div>

    <script src="{{mix('js/app.js')}}"></script>
</body>

</html>