<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Demande;
use App\Models\Maitre;
use App\Models\Service;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StageController extends Controller
{

    public function index()
    {

        $stages = Stage::all();
        return view('stages/index', compact("stages"));
    }

    function mine (string $email) {
        $maitre = Maitre::where('email', '=', $email)->get();
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
            "demande_id" => $request->demande_id,
            "maitre_id" => $request->maitre_id,
            "observation" => $request->observation,
            "note" => $request->observation,
            "renduDoc" => $request->observation,
            "effectuer" => true,
        ]);

        $leMail = [
            'name' => $stage->demande->stagiaire->nom . ' '.$stage->demande->stagiaire->prenom,
            'email' => $stage->demande->stagiaire->email,
            'subject' => "Confirmation de stage",
            'message' => '<p>Votre demande de stage à Pal Service en tant que "' . $stage->demande->titreStage . '" été acceptée. </p>
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
                                <i class="fas fa-envelope"></i><a class="text-success" href="mailto:' . $stage->maitre->email . '">' . $stage->maitre->email .'
                            </li>
                            <li>
                                <i class="fas fa-phone"></i><a href="tel:' . $stage->maitre->tel . '">' . $stage->maitre->tel . '</a>
                            </li>
                        </ul>
                    </li>
                </ul>'
        ];

        if(Stage::create([
            "titreStage" => $request->titreStage,
            "theme" => $request->theme,
            "demande_id" => $request->demande_id,
            "maitre_id" => $request->maitre_id,
            "debut" => $request->debut,
            "fin" => $request->fin,
            "service_id" => $request->service_id
        ])){
            $this->Email($leMail);
            $demande = Demande::where('id', '=', $request->demande_id)->get();
            app('App\Http\Controllers\DemandeController')->update($demande[0], "accept");
        }
        return back()->with("createSuccess", "Le stage est ajoutée avec succèss");
    }

    // La methode supprimer
    /* public function delete (stage $stage) {

        //Chercher et supprimer le stage
        $stage->delete();

        return back()->with("deleteSuccess", "Le stage '$stage->lib' est supprimé avec succèss");
    } */

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

        return back()->with("updateSuccess", "Le stage a changé de status");
    }

    public function Email(array $data)
    {

        Mail::to($data['email'])
            ->send(new SendEmail($data));

        return view('demandes.index');
    }
}
