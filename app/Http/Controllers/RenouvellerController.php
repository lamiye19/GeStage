<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Demande;
use App\Models\Renouveller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RenouvellerController extends Controller
{
    public function index () {
        $renews = Renouveller::all();
        return view('renouveller.index', compact("renews"));
    }

    public function create (Request $request) {
        
        Renouveller::create($request->all());
        return back()->with("createSuccess", "Votre demande de renouvellement a été enregistré");
    }

    // La methode modifier - refuser
    public function update (Request $request, Renouveller $renew) {

        $renew->statut = 0;
            $leMail = [
                'name' => $renew->demande->stagiaire->nom . ' '.$renew->demande->stagiaire->prenom,
                'email' => $renew->demande->stagiaire->email,
                'subject' => "Renouvellement non acceptée",
                'message' => '<p>Votre demande de renouvellement du '. date('d/m/Y', strtotime($renew->created_at)).', n\'a malheureusement pas été retenue.</p> <p>Soyez cependant assuré que 
                    cette décision ne met pas en cause vos compétences et qualités.</p>
                    <p>Nous sommes très sensibles à l\'intérêt que vous portez à notre entreprise, et conservons vos 
                    coordonnées afin de vous recontacter au bésoin.</p>
                    <p>Nous vous souhaitons une pleine réussite dans vos recherches futures.</p>'
            ];
            $this->Email($leMail);

            //Modifier l'objet
            $renew->update([
                $renew->all()
            ]);
    
            return back()->with("updateSuccess", "La demande de renouvellement a été refusée.");
    }

    public function Email(array $data)
    {

        Mail::to($data['email'])
            ->send(new SendEmail($data));

        return view('demandes.index');
    }
}

