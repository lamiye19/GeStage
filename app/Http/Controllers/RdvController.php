<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Rdv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class rdvController extends Controller
{

    public function index () {

        $rdvs = Rdv::all();
        return view('rdvs/index', compact("rdvs"));
    }

     // La vue modifier
    public function modifier (Rdv $rdv) {
        
        return view('rdvs/update', compact("rdv"));
    }

    // La methode modifier
    public function update (Request $request, Rdv $rdv) {
        //Verifier la validité des champs
        $request->validate([
            "confirmer"=>"required",
        ]);

        //Modifier l'objet
        $rdv->confirmer = $request->confirmer;
        $rdv->message = $request->message;
        $rdv->update();

        return back()->with("updateSuccess", "Votre réponse a été prise en compte.");
        //return back();
    }

    // La methode modifier
    public function reprise (Request $request, Rdv $rdv) {
        //Verifier la validité des champs
        $request->validate([
            'dateHeure' => ['required', 'after:' . now()],
        ]);

        //'email' => "omolola0119@gmail.com",
        $leMail = [
            'name' => $rdv->demande->stagiaire->nom . ' ' . $rdv->demande->stagiaire->prenom,
            'email' => $rdv->demande->stagiaire->email,
            'subject' => "Reprise de rendez-vous",
            'message' => "<p>Nous vous proposons un autre rendez-vous
                avec le directeur des ressources humaines le <strong>" . date('d/m/Y', strtotime($request->dateHeure)) .
                "</strong> à <strong>" . date('H:m', strtotime($request->dateHeure)) . "</strong> dans nos locaux.</p>
                <p>Nous vous prions de bien vouloir nous confirmer votre présence à ce rendez-vous en utilisant ce 
                <a href=\"http://127.0.0.1:8000/confirmation/$rdv->id\">lien</a>.</p>
                "
        ];

        $this->Email($leMail);


        //Modifier l'objet
        $rdv->confirmer = null;
        $rdv->dateHeure = $request->dateHeure;
        $rdv->update();

        return back()->with("updateSuccess", "Email envoyé.");
        //return back();
    }

    public function Email(array $data)
    {

        Mail::to($data['email'])
            ->send(new SendEmail($data));

        return view('demandes.index');
    }
}
