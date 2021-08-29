<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Renouveller;
use Illuminate\Http\Request;

class RenouvellerController extends Controller
{
    public function create (Request $request) {
        
        Renouveller::create($request->all());
        $demande = Demande::find($request->demande_id);
        $demande->statut = 'attente';
        $demande->update();
        return back()->with("createSuccess", "Votre demande de renouvellement a été enregistré");
    }
}
