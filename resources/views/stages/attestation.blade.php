<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attestation de stage</title>
</head>

<body>
<style>
    body{
        margin: 0.5cm 1cm;
        padding: 0.5cm;
        font: 14pt ;
        line-height: 1.45cm;
    }
    h1{
        text-align: center;
        font: 32pt;
        text-decoration: underline;
    }
    .bas{
       float: right;
    }
</style>



    <h1> ATTESTATION DE STAGE </h1>


    <p>
        Je soussigné, @if ($stage->maitre->sexe == 'M')
        Monsieur 
        @else
        Madame 
        @endif
        &nbsp;{{ $stage->maitre->nom }} {{ $stage->maitre->prenom }}&nbsp; Maitre de stage, en qualité de {{ $stage->maitre->poste }}
         de la société Pal Service sise à adidogomé, atteste que  @if ($stage->demande->stagiaire->sexe == 'M')
        Monsieur
        @else
        Mademoiselle
        @endif &nbsp;{{ $stage->demande->stagiaire->nom }} {{ $stage->demande->stagiaire->prenom }}&nbsp; demeurant à
        {{ $stage->demande->stagiaire->adr }}, a effectué un stage dans notre entreprise en qualité de "{{ $stage->titreStage }}", 
        au service {{ $stage->service->lib }}, durant la période du {{ date('d/m/Y', strtotime($stage->debut)) }}
         au {{ date('d/m/Y', strtotime($stage->fin)) }}.
    <br>
        Cette attestation est délivrée au stagiaire pour servir et valoir ce que de droit.
    <br>
        Fait à Lomé, le {{ date('d/m/Y', strtotime(now())) }}
    </p>

    <div class="bas">
        <p>
            <strong>{{ $stage->maitre->nom }} {{ $stage->maitre->prenom }}</strong>
            <br>Signature
        </p>
        
    </div>


</body>

</html>