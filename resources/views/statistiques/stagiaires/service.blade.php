<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stagiaires d'un maitre dans un service</title>
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
        <h3><strong><u>Informations personnelles</u></strong></h3>
        <ul class="info">
            <li><strong><u>Nom</u> : </strong>{{ $stages[0]->maitre->nom }}</li>
            <li><strong><u>Prenom</u> : </strong>{{ $stages[0]->maitre->prenom }}</li>
            <li><strong><u>Sexe</u> : </strong>{{ $stages[0]->maitre->sexe }}</li>
            <li><strong><u>Poste</u> : </strong>{{ $stages[0]->maitre->poste }}</li>
            <li><strong><u>Téléphone</u> : </strong>{{ $stages[0]->maitre->tel }}</li>
            <li><strong><u>E-mail</u> : </strong>{{ $stages[0]->maitre->email }}</li>
        </ul>
        <h3><strong><u>Service concerné</u></strong></h3>
        <ul class="info">
            <li><strong><u>Libellé</u> : </strong>{{ $stages[0]->service->lib }}</li>
            <li><strong><u>Directeur</u> : </strong>{{ $stages[0]->service->directeur }}</li>
        </ul>
        <h2><strong><u>Liste des stagiaires suivi</u></strong></h2>
        <table border="1">
            <thead>
                <tr>
                    <th class="text-blue">N# </th>
                    <th>Nom et Prénoms</th>
                    <th>Sexe</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Date de Naissance</th>
                    <th>Adresse</th>
                    <th>Ecole</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stages as $stage)
                @if ($stage->demande->statut == 'accept')
                    
                <tr>
                    <td>
                        {{ $loop->index+1 }}
                    </td>
                    <td>{{ $stage->demande->stagiaire->nom }} {{ $stage->demande->stagiaire->prenom }}</td>
                    <td>{{ $stage->demande->stagiaire->sexe }}</td>
                    <td>{{ $stage->demande->stagiaire->tel }}</td>
                    <td>{{ $stage->demande->stagiaire->email }}</td>
                    <td>{{ date('d - m - Y', strtotime($stage->demande->stagiaire->dateNais))}}</td>
                    <td>{{ $stage->demande->stagiaire->adr }}</td>
                    <td>{{ $stage->demande->stagiaire->ecole }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>