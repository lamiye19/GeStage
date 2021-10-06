@extends('layout.index')

@section('headTitle')
Accueil
@endsection

@section('content')
<div class="row container mx-5">
    <div class="row">
        <marquee class="text-center ">Bienvenu sur le site de Pal Service</marquee>
        <span>Pal Service</span> est l'entreprise utilisateur de PalStage pour la gestion des stagiaires.
        <h3 class="text-teal">Fonctionnalités</h3>
    </div>
    <div class="row justify-content-center">
        <div class="card col-10 card-blue">
            <div class="card-body">
                <p class="">
                    Il y a deux cas possible:
                    <ul>
                        <li>
                            Pal Service est une entreprise utilisant la plateforme web PalStage pour gérer ses
                            stagiaires.
                        </li>
                        <li>
                            Pal Service est une entreprise dont le service est de recruter et de gérer les stagiaires
                            pour
                            d'autres entreprises.
                        </li>
                    </ul>
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <h3>Cas 1</h3>
        <p>
            L'entreprise fait sa présentation complète ici
        </p>
        <iframe src="https://jscorporationtogo.com" frameborder="0" width="100%" height="1000em"></iframe>
    </div>
</div>
@endsection