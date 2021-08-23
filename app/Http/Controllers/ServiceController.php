<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index () {

        $services = Service::orderBy("lib","asc")->paginate(5);
        return view('services/index', compact("services"));
    }

    // La vue ajouter
    public function ajouter () {
        return view('services/create');
    }

    // La vue modifier
    public function modifier (Service $service) {
        
        return view('services/update', compact("service"));
    }

    
    // La methode ajouter
    public function create (Request $request) {

        //Verifier la validité des champs
        $request->validate([
            "lib"=>"required",
            "directeur"=>"required"
        ]);

        //Créer l'objet
        Service::create($request->all());
        /* Service::create([
            "lib" => $request->lib,
            "directeur" => $request->directeur
        ]); */

        return back()->with("createSuccess", "Le service '$request->lib' est ajouté avec succèss");
    }

    // La methode supprimer
    public function delete (Service $service) {

        $service->maitre()->delete();
        //Chercher et supprimer le service
        $service->delete();

        return back()->withErrors("deleteSuccess", "Le service '$service->lib' est supprimé avec succèss");
    }

    // La methode modifier
    public function update (Request $request, Service $service) {

        //Verifier la validité des champs
        $request->validate([
            "lib"=>"required",
            "directeur"=>"required"
        ]);

        //Modifier l'objet
        $service->update($request->all());
        /* $service->update([
            "lib" => $request->lib,
            "directeur" => $request->directeur
        ]); */

        return back()->with("updateSuccess", "Le service a été mise à jour");
    }
}
