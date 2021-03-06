<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Maitre;
use App\Models\Stage;
use App\Models\Stagiaire;
use App\Models\User;
use Illuminate\Http\Request;

class StagiaireController extends Controller
{
    function index(Request $request)
    {
        $demandes = Demande::where('statut', 'accept')->get();
        $ids = [];
        foreach ($demandes as $d) {
            array_push($ids, $d->stagiaire_id);
        }
        $stagiaires = Stagiaire::where([
            [function ($query) use ($request) {
                if (($mot = $request->search)) {
                    $query->orWhere('nom', 'LIKE', '%' . $mot . '%')
                        ->orWhere('prenom', 'LIKE', '%' . $mot . '%')
                        ->orWhere('email', 'LIKE', '%' . $mot . '%')
                        ->get();
                }
            }]
        ])->whereIn('id', $ids)->orderBy('nom', 'asc')->get();

        /* dd($stagiaires); */


        return view('stagiaires/index', compact("stagiaires"));
    }

    function mine(Request $request, User $user)
    {
        $maitre = Maitre::where('email', '=', $user->email)->first();
        $stages = Stage::where('maitre_id', '=', $maitre->id)->get();
        $stagiaires = $stages;
        // dd($stages);
        $i = 0;
        foreach ($stages as $stage) {
            if ($stage->demande->statut == 'accept') {
                $stagiaires[$i] = $stage->demande->stagiaire;
                $i++;
            }
        }

        $stagiaires = $stagiaires->unique();
        if (isset($request->search)) {
            $ids = [];
            foreach ($stagiaires as $s) {
                array_push($ids, $s->id);
            }
            $stagiaires = Stagiaire::where([
                [function ($query) use ($request) {
                    if (($mot = $request->search)) {
                        $query->orWhere('nom', 'LIKE', '%' . $mot . '%')
                            ->orWhere('prenom', 'LIKE', '%' . $mot . '%')
                            ->orWhere('email', 'LIKE', '%' . $mot . '%')
                            ->get();
                    }
                }]
            ])->whereIn('id', $ids)->orderBy('nom', 'asc')->get();
        }

        return view('stagiaires/index', compact("stagiaires"));
    }


    // La vue ajouter
    /* public function ajouter () {
        
        return view('stagiaires/create', compact("services"));
    }

    // La vue modifier
    public function modifier (Stagiaire $stagiaire) {

        
        return view('stagiaires/update', compact("stagiaire", "services"));
    }


    // La methode ajouter
    function create (Request $request) {

        //Verifier la validit?? des champs
        $request->validate([
            "nom"=>"required",
            "prenom"=>"required",
            "sexe"=>"required",
            "dateNais"=>"required",
            "tel"=>"required",
            "email"=>"required",
            "adr"=>"required"
        ]);

        //Cr??er l'objet
        Stagiaire::create($request->all());

        return back()->with("createSuccess", "Le stagiaire de stage '$request->nom $request->prenom' est ajout?? avec succ??ss");
    }

    // La methode supprimer
    public function delete (Stagiaire $stagiaire) {

        $stagiaire->service()->delete();

        //Chercher et supprimer le stagiaire
        $stagiaire->delete();

        return back()->with("deleteSuccess", "Le stagiaire de stage '$stagiaire->nom $stagiaire->prenom' est supprim?? avec succ??ss");
    }

    // La methode modifier
    public function update (Request $request, Stagiaire $stagiaire) {

        //Verifier la validit?? des champs
        $request->validate([
            "nom"=>"required",
            "prenom"=>"required",
            "sexe"=>"required",
            "dateNais"=>"required",
            "tel"=>"required",
            "email"=>"required",
            "adr"=>"required"
        ]);

        //Modifier l'objet
        $stagiaire->update($request->all());

        return back()->with("updateSuccess", "Le stagiaire a ??t?? mise ?? jour");
    } */
}
