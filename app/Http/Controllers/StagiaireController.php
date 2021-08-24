<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Maitre;
use App\Models\Stage;
use App\Models\Stagiaire;
use Illuminate\Http\Request;

class StagiaireController extends Controller
{
    function index () {

        $demandes = Demande::where('statut', '=', 'accept')->get();

        return view('stagiaires/index', compact("demandes"));
    }

    function mine (string $email) {
        $maitre = Maitre::where('email', '=', $email)->get();
        $stages = Stage::where('maitre_id', '=', $maitre[0]->id)->get();
        $demandes = [];
        $i = 0;
        foreach($stages as $stage){
            $demandes[$i] = $stage->demande;
            $i++;
        }
        
        return view('stagiaires/index', compact("demandes"));
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

        //Verifier la validité des champs
        $request->validate([
            "nom"=>"required",
            "prenom"=>"required",
            "sexe"=>"required",
            "dateNais"=>"required",
            "tel"=>"required",
            "email"=>"required",
            "adr"=>"required"
        ]);

        //Créer l'objet
        Stagiaire::create($request->all());

        return back()->with("createSuccess", "Le stagiaire de stage '$request->nom $request->prenom' est ajouté avec succèss");
    }

    // La methode supprimer
    public function delete (Stagiaire $stagiaire) {

        $stagiaire->service()->delete();

        //Chercher et supprimer le stagiaire
        $stagiaire->delete();

        return back()->with("deleteSuccess", "Le stagiaire de stage '$stagiaire->nom $stagiaire->prenom' est supprimé avec succèss");
    }

    // La methode modifier
    public function update (Request $request, Stagiaire $stagiaire) {

        //Verifier la validité des champs
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

        return back()->with("updateSuccess", "Le stagiaire a été mise à jour");
    } */
}
