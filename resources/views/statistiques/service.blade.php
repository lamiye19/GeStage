<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stages d'un service</title>
    <link rel="stylesheet" href="{{ mix("css/app.css")}} ">
</head>

<body>
    <style>
        body {
            text-align: justify;
            font-size: 1.25em;
        }

        table {
            word-wrap: none;
            border-collapse: collapse; 
        }
        ul {
            list-style: none;
        }
        ul li{
            margin-bottom: 10px;
        }

        h2,
        h4 {
            text-align: center;
        }

        h2 {
            color: blue;
            margin-bottom: 1.5em;
        }

        h3 {
            color: red;
            margin-bottom: 1.5em;
        }

    </style>
    <div>
        <h3><strong><u>Informations sur le service</u></strong></h3>
                    <ul class="info">
                        <li><strong><u>Libellés</u> : </strong>{{ $stages[0]->service->lib }}</li>
                        <li><strong><u>Directeur</u> : </strong>{{ $stages[0]->service->directeur }}</li>
                    </ul>
        <h2><strong><u>Liste des stages éffectués ce un service</u></strong></h2>
        <table border="1">
                        <thead>
                            <tr>
                                <th class="text-blue">N# </th>
                                <th>Thème</th>
                                <th>Stagiaire</th>
                                <th>Poste</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Observation</th>
                                <th>Service</th>
                                <th>Etat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stages as $stage)            
                            <tr>
                                <td>
                                    {{ $loop->index+1 }}
                                </td>
                                <td>{{ $stage->theme }}</td>
                                <td>{{ $stage->demande->stagiaire->nom }} {{ $stage->demande->stagiaire->prenom }}</td>
                                <td>{{ $stage->titreStage }}</td>
                                <td>{{ date('d - m - Y', strtotime($stage->debut))}}</td>
                                <td>{{ date('d - m - Y', strtotime($stage->fin))}}</td>
                                <td>
                                    @if ($stage->note != null)
                                    {{ $stage->note }}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>{{ $stage->service->lib }}</td>
                                <td>
                                    @if($stage->etat)
                                    <span>Terminé</span>
                                    @elseif ($stage->etat == 0)
                                    <span>En cours</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
    </div>

    <script src="{{mix('js/app.js')}}"></script>
</body>

</html>