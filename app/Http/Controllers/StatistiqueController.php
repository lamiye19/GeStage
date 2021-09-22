<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Maitre;
use App\Models\Service;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    function showStagiaire(Demande $demande)
    {

        $demande = Demande::find($demande);
        $stages = $demande[0]->stage;

        view()->share('stages', $stages);
        $pdf = PDF::loadView('statistiques.stagiaire', $stages);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download("stages-S-" . $demande[0]->stagiaire->nom . "_" . $demande[0]->stagiaire->prenom . ".pdf");
    }

    function showMaitre(Maitre $maitre)
    {

        $maitre = Maitre::find($maitre);
        $stages = $maitre[0]->stage;

        view()->share('stages', $stages);
        $pdf = PDF::loadView('statistiques.maitre', $stages);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download("stages-M-" . $maitre[0]->nom . "_" . $maitre[0]->prenom . ".pdf");
    }

    function showService(Service $service)
    {

        $service = Service::find($service);
        $stages = $service[0]->stage;

        view()->share('stages', $stages);
        $pdf = PDF::loadView('statistiques.service', $stages);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download("stages-service_" . $service[0]->lib . ".pdf");
    }

    public function maitreStagiaire(Request $request)
    {
        $request->validate([
            "maitre_id" => "required",
        ]);

        $maitre = Maitre::find($request->maitre_id);
        $stages = $maitre->stage->groupBy('demande_id');
        $i = 0;
        $stagiaires= null;
        foreach ($stages as $stage) {
            $stagiaires[$i] = $stage->first();
            $i++;
        }
        if($stagiaires == null){
            return back()->with('message', 'Aucun resultat ne correspond à votre requête');
        }
        $stages = $stagiaires;
        view()->share('stages', $stages);
        $pdf = PDF::loadView('statistiques.stagiaires.maitre', $stages);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download("stagiaires-" . $maitre->nom . "_" . $maitre->prenom . ".pdf");
    }

    function serviceStagiaire(Request $request)
    {
        $request->validate([
            "maitre_id" => "required",
            "service_id" => "required",
        ]);

        $maitre = Maitre::find($request->maitre_id);
        $service = Service::find($request->service_id);
        $stages = $maitre->stage->where('service_id',$request->service_id)->groupBy('demande_id');
        $i = 0;
        $stagiaires= null;
        foreach ($stages as $stage) {
            $stagiaires[$i] = $stage->first();
            $i++;
        }
        if($stagiaires == null){
            return back()->with('messageService', 'Aucun resultat ne correspond à votre requête');
        }
        $stages = $stagiaires;

        view()->share('stages', $stages);
        $pdf = PDF::loadView('statistiques.stagiaires.service', $stages);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download("stagiaires-S_". $service->lib."-" . $maitre->nom . "_" . $maitre->prenom . ".pdf");
    }
}
