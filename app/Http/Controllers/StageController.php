<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Demande;
use App\Models\Maitre;
use App\Models\Renouveller;
use App\Models\Service;
use App\Models\Stage;
use App\Models\Stagiaire;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StageController extends Controller
{

    public function index()
    {

        $stages = Stage::all();
        return view('stages/index', compact("stages"));
    }

    function mine(User $user)
    {
        $maitre = Maitre::where('email', '=', $user->email)->get();
        //dd($maitre);
        $stages = Stage::where('maitre_id', '=', $maitre[0]->id)->get();

        return view('stages/index', compact("stages"));
    }

    // La vue ajouter
    public function ajouter(Demande $demande)
    {

        $maitres = Maitre::all();
        $services = Service::all();

        return view('demandes/accept', compact("demande", "maitres", "services"));
    }


    // La vue ajouter un stage de renouvellement
    public function ajouterRenew(Renouveller $renew)
    {

        $maitres = Maitre::all();
        $services = Service::all();

        return view('demandes/accept', compact("renew", "maitres", "services"));
    }

    // La vue pour soumettre le document
    public function renduDoc()
    {
        $maitres = Maitre::all();
        $services = Service::all();

        return view('stages.rendu', compact("maitres", "services"));
    }
    // La methode ajouter
    public function createRenew(Request $request, Renouveller $renew)
    {

        //Verifier la validité des champs
        $request->validate([
            "titreStage" => "required",
            "theme" => "required",
            "debut" => "required",
            "fin" => "required",
            "demande_id" => "required",
            "service_id" => "required",
            "maitre_id" => "required"
        ]);

        $stage = new Stage([
            "titreStage" => $request->titreStage,
            "theme" => $request->theme,
            "debut" => $request->debut,
            "fin" => $request->fin,
            "demande_id" => $request->demande_id,
            "maitre_id" => $request->maitre_id,
            "service_id" => $request->service_id,
        ]);

        $leMail = [
            'name' => $stage->demande->stagiaire->nom . ' ' . $stage->demande->stagiaire->prenom,
            'email' => $stage->demande->stagiaire->email,
            'subject' => "Renouvellement de stage",
            'message' => '<p>Votre demande de renouvellement de stage à Pal Service a été acceptée. </p>
                <p>Voici les informations par rapports à votre nouveau stage:</p>
                <ul>
                    <li> Poste : ' . $stage->titreStage . '</li>
                    <li> thème : ' . $stage->theme . '</li>
                    <li> Date de début : ' .date('d/m/Y', strtotime($stage->debut))  . '</li>
                    <li> Date de fin : ' . date('d/m/Y', strtotime($stage->fin)) . '</li>
                    <li> Maitre de stage : ' . $stage->maitre->nom . ' ' . $stage->maitre->prenom . '</li>
                    <li>Contacts
                        <ul class="mail-contact">
                            <li>
                                <i class="fas fa-envelope"></i><a class="text-success" href="mailto:' . $stage->maitre->email . '">' . $stage->maitre->email . '
                            </li>
                            <li>
                                <i class="fas fa-phone"></i><a href="tel:' . $stage->maitre->tel . '">' . $stage->maitre->tel . '</a>
                            </li>
                        </ul>
                    </li>
                </ul>'
        ];

        $this->Email($leMail);

        if (Stage::create($request->all())) {
            /* $renew = Renouveller::where('demande_id', $request->demande_id);
            $renew = $renew->last(); */
            $renew->statut = 1;
            $renew->update();
        }
        return back()->with("createSuccess", "Le stage est ajouté avec succèss");
    }


    // La methode ajouter
    public function create(Request $request)
    {

        //Verifier la validité des champs
        $request->validate([
            "titreStage" => "required",
            "theme" => "required",
            "debut" => "required",
            "fin" => "required",
            "demande_id" => "required",
            "service_id" => "required",
            "maitre_id" => "required"
        ]);

        $stage = new Stage([
            "titreStage" => $request->titreStage,
            "theme" => $request->theme,
            "debut" => $request->debut,
            "fin" => $request->fin,
            "demande_id" => $request->demande_id,
            "maitre_id" => $request->maitre_id,
            "service_id" => $request->service_id,
        ]);

        $leMail = [
            'name' => $stage->demande->stagiaire->nom . ' ' . $stage->demande->stagiaire->prenom,
            'email' => $stage->demande->stagiaire->email,
            'subject' => "Confirmation de stage",
            'message' => '<p>Votre demande de stage à Pal Service en tant que "' . $stage->demande->specialite . '" été acceptée. </p>
                <p>Voici les informations par rapports à votre stage:</p>
                <ul>
                    <li> Poste : ' . $stage->titreStage . '</li>
                    <li> thème : ' . $stage->theme . '</li>
                    <li> Date de début : ' . date('d/m/Y', strtotime($stage->debut)) . '</li>
                    <li> Date de fin : ' . date('d/m/Y', strtotime($stage->fin)) . '</li>
                    <li> Maitre de stage : ' . $stage->maitre->nom . ' ' . $stage->maitre->prenom . '</li>
                    <li>Contacts
                        <ul class="mail-contact">
                            <li>
                                <i class="fas fa-envelope"></i><a class="text-success" href="mailto:' . $stage->maitre->email . '">' . $stage->maitre->email . '
                            </li>
                            <li>
                                <i class="fas fa-phone"></i><a href="tel:' . $stage->maitre->tel . '">' . $stage->maitre->tel . '</a>
                            </li>
                        </ul>
                    </li>
                </ul>'
        ];

        $this->Email($leMail);
        if (Stage::create([
            "titreStage" => $request->titreStage,
            "theme" => $request->theme,
            "demande_id" => $request->demande_id,
            "maitre_id" => $request->maitre_id,
            "debut" => $request->debut,
            "fin" => $request->fin,
            "service_id" => $request->service_id
        ])) {
            $demande = Demande::find($request->demande_id);
            $demande->statut = 'accept';
            $demande->update();
        }
        return back()->with("createSuccess", "Le stage est ajouté avec succèss");
    }
    // La methode modifier
    public function update(Request $request, Stage $stage)
    {
        $request->validate([
            'observation' => 'required',
        ]);


        $stage->observation = $request->observation;

        //Modifier l'objet
        $stage->update([
            $stage->all()
        ]);

        return back()->with("updateSuccess", "Le stage a été noté");
    }

    // La methode modifier
    public function verification(Request $request)
    {
        $request->validate([
            "email" => "required",
            "service_id" => "required",
            "maitre_id" => "required"
        ]);


        $stagiaire = Stagiaire::where('email', '=', $request->email)->first();
        $demande = Demande::where('stagiaire_id', '=', $stagiaire->id)->first();


        $stage = Stage::all();
        $stage = $stage->where('maitre_id', '=', $request->maitre_id)->where('service_id', $request->service_id)
            ->where('demande_id', '=', $demande->id);
        
            
        $stage = $stage[array_key_last($stage->toArray())];

        if ($stage == null) {
            return back()->with("stageFalse", "Les informations entrées ne correspondent pas aux enregistrements.");
        } else {

            return view('stages.rendu', compact("stage"));
        }
    }


    public function rendre(Request $request)
    {
        $request->validate([
            "renduDoc" => "required",
        ]);

        $file = $request->file('renduDoc');

        $path = $file->store('rapports', 'public');
        $stage = Stage::find($request->stage);
        $stage->renduDoc = $path;
        $stage->etat = true;

        $stage->update();

        return back()->with("updateSuccess", "Rapport enregistré");
    }

    public function Email(array $data)
    {

        Mail::to($data['email'])
            ->send(new SendEmail($data));

        return view('demandes.index');
    }

    // La methode supprimer
    /* public function delete (stage $stage) {

        //Chercher et supprimer le stage
        $stage->delete();

        return back()->with("deleteSuccess", "Le stage '$stage->lib' est supprimé avec succèss");
    } */

    /* RENOUVELLER
        $stag = Demande::find(1);
        //$stage = $stage->whereIn('hobbies', "sport")->first();
        $stage->statut = null;
        Demande::create($stage->toArray());
    */
}
