<?php

namespace App\Http\Controllers;

use App\Models\Maitre;
use App\Models\Service;
use Illuminate\Http\Request;

class MaitreController extends Controller
{

    function index(Request $request)
    {

        $maitres = Maitre::where([
            [function ($query) use ($request) {
                if (($mot = $request->search)) {
                    $query->orWhere('nom', 'LIKE', '%' . $mot . '%')
                        ->orWhere('prenom', 'LIKE', '%' . $mot . '%')
                        ->orWhere('email', 'LIKE', '%' . $mot . '%')
                        ->orWhere('poste', 'LIKE', '%' . $mot . '%')
                        ->get();
                }
            }]
        ])->orderBy("nom", "asc")->get();

        return view('maitres/index', compact("maitres"));
    }

    // La vue ajouter
    public function ajouter()
    {

        return view('maitres/create');
    }

    // La vue modifier
    public function modifier(Maitre $maitre)
    {

        return view('maitres/update', compact("maitre"));
    }


    // La methode ajouter
    function create(Request $request)
    {

        //Verifier la validité des champs
        $request->validate([
            "nom" => "required",
            "prenom" => "required",
            "sexe" => "required",
            "dateNais" => "required",
            "tel" => "required",
            'email' => ['required', 'string', 'email', 'max:255', 'unique:maitres'],
            "adr" => "required",
            "poste" => "required"
        ]);

        //Créer l'objet
        Maitre::create($request->all());

        return back()->with("createSuccess", "Le maitre de stage '$request->nom $request->prenom' est ajouté avec succèss");
    }

    // La methode supprimer
    public function delete(Maitre $maitre)
    {

        //$maitre->stage()->delete();

        //Chercher et supprimer le maitre
        $maitre->delete();

        return back()->with("deleteSuccess", "Le maitre de stage '$maitre->nom $maitre->prenom' est supprimé avec succèss");
    }

    // La methode modifier
    public function update(Request $request, Maitre $maitre)
    {

        //Verifier la validité des champs
        $request->validate([
            "nom" => "required",
            "prenom" => "required",
            "sexe" => "required",
            "dateNais" => "required",
            "tel" => "required",
            "email" => "required",
            "adr" => "required",
            "poste" => "required",
        ]);

        //Modifier l'objet
        $maitre->update($request->all());

        return back()->with("updateSuccess", "Le maitre a été mise à jour");
    }
}
