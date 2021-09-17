<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Demande;
use App\Models\Rdv;
use App\Models\Renouveler;
use App\Models\Service;
use App\Models\Stagiaire;
use Dotenv\Parser\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class DemandeController extends Controller
{
    public function index()
    {

        $demandes = Demande::orderBy("specialite", "asc")->get();
        $renews = Renouveler::all();
        return view('demandes/index', compact("demandes", "renews"));
    }

    // La vue ajouter
    public function ajouter()
    {
        return view('demandes/create');
    }

    // La vue consulter
    public function consulter(Demande $demande)
    {


        return view('demandes/consulter', compact("demande"));
    }



    // La methode ajouter
    public function create(Request $request)
    {
        $request1 = $request;

        //Verifier la validité des champs
        $request->validate([
            "nom" => "required",
            "prenom" => "required",
            "sexe" => "required",
            "dateNais" => "required",
            "tel" => "required",
            "email" => "required",
            "ecole" => "required",
            "adr" => "required",
            "specialite" => "required",
            "expDate1" => "required",
            "expDate2" => "required",
            "expDate3" => "required",
            "expTitre1" => "required",
            "expTitre2" => "required",
            "expTitre3" => "required",
            "exp1" => "required",
            "exp2" => "required",
            "exp3" => "required",
            "pDate1" => "required",
            "pDate2" => "required",
            "pDate3" => "required",
            "pTitre1" => "required",
            "pTitre2" => "required",
            "pTitre3" => "required",
            "p1" => "required",
            "p2" => "required",
            "p3" => "required",
            "hobbies" => "required"
        ]);

        $request1->validate([
            "nom" => "required",
            "prenom" => "required",
            "sexe" => "required",
            "dateNais" => "required",
            "tel" => "required",
            "email" => "required",
            "adr" => "required",
            "ecole" => "required"
        ]);

        //Créer l'objet
        Stagiaire::create($request1->all());

        $ask = Stagiaire::selectRaw('MAX(id) as id')->get();


        Demande::create([
            "stagiaire_id" => $ask[0]->id,
            "specialite" => $request->specialite,
            "expDate1" => $request->expDate1,
            "expTitre1" => $request->expTitre1,
            "exp1" => $request->exp1,
            "expDate2" => $request->expDate2,
            "expTitre2" => $request->expTitre2,
            "exp2" => $request->exp2,
            "expDate3" => $request->expDate3,
            "expTitre3" => $request->expTitre3,
            "exp3" => $request->exp3,
            "pDate1" => $request->pDate1,
            "pTitre1" => $request->pTitre1,
            "p1" => $request->p1,
            "pDate2" => $request->pDate2,
            "pTitre2" => $request->pTitre2,
            "p2" => $request->p2,
            "pDate3" => $request->pDate3,
            "pTitre3" => $request->pTitre3,
            "p3" => $request->p3,
            "competences" => $request->competences,
            "langues" => $request->langues,
            "hobbies" => $request->hobbies,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        return back()->with("createSuccess", "La demande est ajoutée avec succèss");
    }

    // La methode modifier
    public function update(Request $request, Demande $demande, string $statut)
    {

        $demande->statut = $statut;
        if ($statut == 'refus') {
            $leMail = [
                'name' => $demande->stagiaire->nom . ' ' . $demande->stagiaire->prenom,
                'email' => $demande->stagiaire->email,
                'subject' => "Candidature non acceptée",
                'message' => '<p>En réponse à votre candidature du ' . date('d/m/Y', strtotime($demande->created_at)) . ', je suis au regret de 
                    devoir vous informer que celle-ci n\'a pas été retenue.</p> <p>Soyez cependant assuré que 
                    cette décision ne met pas en cause vos qualités personnelles, ni même celle de votre formation.</p>
                    <p>Nous sommes très sensibles à l\'intérêt que vous portez à notre entreprise, et conservons vos 
                    coordonnées afin de vous recontacter au bésoin.</p>
                    <p>Nous vous souhaitons une pleine réussite dans vos recherches futures.</p>'
            ];
            $this->Email($leMail);

            //Modifier l'objet
            $demande->update([
                $demande->all()
            ]);

            return back()->with("updateSuccess", "La demande a été refusée.");
        } elseif ($statut == 'attente') {
            $request->validate([
                'dateHeure' => ['required', 'after:' . now()],
            ]);

            Rdv::create([
                "dateHeure" => $request->dateHeure,
                "demande_id" => $demande->id
            ]);

            $id = Rdv::selectRaw('MAX(id) as id')->get();

            $rdv = Rdv::find($id[0]->id);

            //'email' => "omolola0119@gmail.com",
            $leMail = [
                'name' => $demande->stagiaire->nom . ' ' . $demande->stagiaire->prenom,
                'email' => $demande->stagiaire->email,
                'subject' => "Convocation à un entretien",
                'message' => "<p>Votre candidature au poste de ( stagiaire . $demande->specialite .) au sein de notre société a 
                    retenu notre attention et nous souhaiterons vous rencontrer. Nous vous proposons un entretien 
                    avec le directeur des ressources humaines le <strong>" . date('d/m/Y', strtotime($request->dateHeure)) .
                    "</strong> à <strong>" . date('h:m', strtotime($request->dateHeure)) . "</strong> dans nos locaux.</p>
                    <p>Nous vous prions de bien vouloir nous confirmer votre présence à ce rendez-vous en utilisant ce 
                    <a href=\"http://127.0.0.1:8000/confirmation/$rdv->id]) }}\">lien</a>.</p>
                    "
            ];

            $this->Email($leMail);

            //Modifier l'objet
            $demande->update([
                $demande->all()
            ]);

            return back()->with("updateSuccess", "La demande a été mise en attente.");
        }
    }

    public function Email(array $data)
    {

        Mail::to($data['email'])
            ->send(new SendEmail($data));

        return view('demandes.index');
    }

    // La methode supprimer
    /* public function delete (Demande $demande) {

        //Chercher et supprimer le demande
        $demande->delete();

        return back()->with("deleteSuccess", "Le demande '$demande->lib' est supprimé avec succèss");
    } */
}
