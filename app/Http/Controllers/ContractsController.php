<?php

namespace App\Http\Controllers;

use App\Mail\SignatureContrat;
use App\Models\Contract;
use App\Models\Partner;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Storage;
use URL;

class ContractsController extends Controller
{

    // Methode de creation de contrat

    public function store(){

        // Verification des champs reçus ainsi que changement du nom des champs pour correspondre à la base de données
        // et recuperation du nombre de partenaires

        $partner_number = request()->get('number', 0);

        $validated_data = request()->validate([
            'nature' => 'required',
            'namepartenariat' => 'required',
            'adresse' => 'required',
            'date' => 'required|date',
            'repartition' => 'required',
            'minsignature' => 'required',
            'duree' => 'required',
            'juridiction' => 'required',
            'lieucreation' => 'required',
            'nameavocat' => 'required',
        ]);

        $validate_contract = [
            'contract_datecreation' => date('Y-m-d'),
            'contract_nature' => $validated_data['nature'],
            'contract_name' => $validated_data['namepartenariat'],
            'contract_adress' => $validated_data['adresse'],
            'contract_date' => $validated_data['date'],
            'contract_repartition' => $validated_data['repartition'],
            'contract_min_sign' => $validated_data['minsignature'],
            'contract_clause_duration' => $validated_data['duree'],
            'contract_state' => $validated_data['juridiction'],
            'contract_location' => $validated_data['lieucreation'],
            'contract_avocate_name' => $validated_data['nameavocat'],
        ];


        // Recuperation et verification des partenaires en fonction du nombre de partenaires

        $validate_partner = [];

        for ($i = 0; $i < $partner_number; $i++) {

            global $validate_partner;

            // Recuperation

            $partner = request()->validate([

                    'id'.($i) => 'required',
                    'partner_contribution'.($i) => 'required',

            ]);

            // Verification

            $validate_partner[$i] = [

                'partner_id' => $partner['id'.($i)],
                'partner_contribution' => $partner['partner_contribution'.($i)],

            ];
        }


        // Creation du contrat

        $contract = auth()->user()->contracts()->create($validate_contract);


        // Creation des partenaires

        foreach ($validate_partner as $partner) {

            $contract->partners()->attach($partner['partner_id'], ['partner_contribution' => $partner['partner_contribution']]);

        }


        // Pour chaque partenaire -> envoi d'un mail de signature
        // SAUF pour le partenaire correspondant à l'utilisateur si il est inclus dans le contrat

        foreach ($contract->partners as $partner) {

            // Verifie si le partenaire est celui qui a  créé le contrat

            if ($partner->partner_email !== auth()->user()->email) {

                // Creation d'une URL signée ce qui permet de verifier l'authenticité de l'URL

                $url =URL::signedRoute('signature.index', ['contract_id' => $contract->id, 'partner_id' => $partner->id]);

                Mail::to($partner->partner_email)->send(new SignatureContrat($url));

            }

        }


        // Redirection vers la page de signature si le createur du contrat est inclus dans le contrat

        $firstpartner = $contract->partners()->where('partner_email', auth()->user()->email)->first();

        if ($firstpartner != null) {

            return redirect(URL::signedRoute('signature.index', ['contract_id' => $contract->id, 'partner_id' => $firstpartner->id]));

        } else {

            // Changement du statut du contrat 1 = en attente de signature

            // Sinon 0 = le createur doit signer

            $contract->update(['contract_status' => 1]);

            return redirect('/')->with('success', 'Contract created');

        }
    }



    // Methode affichant la page de choix des partenaires

    public function partner(){

        // Permet de sauvegarder dans la session flash les partenaires selectionnés

        if (request()->has('selected_partners')) {

            session()->flash('selected_partners', request()->get('selected_partners'));

        } else if (session()->has('selected_partners')) {

            session()->flash('selected_partners', session()->get('selected_partners'));

        } else {

            session()->flash('selected_partners', "vide");

        }


        // Si l'utilisateur a chercher un partenaire

        if (request()->has('search')) {

            // Si il n'y a pas de critère de recherche

            if (request()->get('search') === '') {

                $partners = Partner::limit(10)->get();

                return view('contract.partner', compact('partners'));

            }

            // Sinon chercher la chaine demander dans les noms de familles

            $partners = Partner::where('partner_name', 'like', '%'.request()->get('search').'%')->limit(10)->get();

            return view('contract.partner', compact('partners'));

        }

        // Si l'utilisateur ne cherche pas de partenaire les 10 dernier lui sont envoyés

        $partners = Partner::limit(10)->get();

        return view('contract.partner', compact('partners'));
    }



    // Methode affichant lun contrat

    public function show($id){

        $contract = Contract::find($id);

        /// Recuperation des dates

        $date_creation = strtotime($contract->contract_datecreation);

        $date_start = strtotime($contract->contract_date);

        // Mise en forme de la date

        $mois = array(1=>'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');

        $jours = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');

        $dateajd = $jours[date('w', $date_creation)].' '.date('j', $date_creation).' '.$mois[date('n', $date_creation)].' '.date('Y', $date_creation);

        $dateDebutContrat = $jours[date('w', $date_start)].' '.date('j', $date_start).' '.$mois[date('n', $date_start)].' '.date('Y', $date_start);


        // Recuperation du nombre de partenaires

        $nbpartner = $contract->partners->count();


        return view('contract.show', ['contract' => $contract, 'dateajd' => $dateajd, 'dateDebutContrat' => $dateDebutContrat, 'nbpartner' => $nbpartner]);
    }



    // Methode affichant la page de creation de contrat en fonction des partenaires selectionnés

    public function storeshow() {

        // Recuperation des partenaires selectionner
        // Verifie egalement que au moins un partenaire est selectionné

        $selected_partners = request()->get('selected_partners');

        if ($selected_partners != "vide") {

            // Fais un liste avec les id des partenaire a partir d'une chaine de caractère

            $selected_partners = explode(',', $selected_partners);

            $partners = Partner::whereIn('id', $selected_partners)->get();

        } else {

            return redirect('/partner');

        }


        // Envoie de la page avec les partenaires selectionner

        return view('contract.creationcontrat', compact('partners'));
    }



    // Methode de suppression de contrat

    public function destroy($id){

        $contract = Contract::find($id);

        // Pour chaque partenaire cela suprime sa signature si il a deja signé

        foreach ($contract->partners as $partner) {

            if ($partner->partner_signature) {

                Storage::disk('public')->delete($partner->partner_signature);

            }

        }

        // Suppression du contrat qui suprime automatiquement tout les partenaires associé

        $contract->delete();

        return redirect('/')->with('success', 'Contract deleted');

    }


    // Methode de telechargement du contrat en PDF

    public function downloadPDF($id){

        $contract = Contract::find($id);

        $nbpartner = $contract->partners->count();

        // Creation d'un PDF a partir de la vue contract.pdf avec le Plugin DomPDF

        $pdf = Pdf::loadView('contract.pdf', array('contract' =>  $contract, 'nbpartner' => $nbpartner))->setPaper('a4', 'portrait');

        // Renvoie le fichier PDF qui se telecharge

        return $pdf->download('Contract-'.$id.'.pdf');
    }


    // Methode d'edition de contrat

    public function edit($id){
        $contract = Contract::find($id);

        $nbpartner = $contract->partners->count();

        // Renvoie la page d'edition du contrat avec les champs prérempli

        return view('contract.edit', ['contract' => $contract, 'nbpartner' => $nbpartner]);
    }


    // Methode de mise a jour de contrat
    // Code similaire a la creation du contrat

    public function update($id){

        $contract = Contract::findOrFail($id);

        $validatedData = request()->validate([
            'contract_date' => 'required',
            'contract_name' => 'required',
            'contract_nature' => 'required',
            'contract_address' => 'required',
            'contract_repartition' => 'required',
            'contract_min_sign' => 'required',
            'contract_clause_duration' => 'required',
            'contract_state' => 'required',
            'contract_location' => 'required',
            'contract_avocate_name' => 'required',
        ]);

        $validate_partners = [];


        // Recuperation de la liste des IDs de tout les partenaires

        $partner_ids = $contract->partners->pluck('id')->toArray();

        // Parcours les partenaires en les ajoutant a la liste validate_partners

        foreach ($partner_ids as $index => $partner_id) {
            $partnerData = request()->validate([
                "partner_name_$index" => 'required',
                "partner_firstname_$index" => 'required',
                "partner_contribution_$index" => 'required',
                "partner_email_$index" => 'required|email',
            ]);

            $validate_partners[$partner_id] = [
                'partner_name' => $partnerData["partner_name_$index"],
                'partner_firstname' => $partnerData["partner_firstname_$index"],
                'partner_contribution' => $partnerData["partner_contribution_$index"],
                'partner_email' => $partnerData["partner_email_$index"],
            ];
        }

        // Mis a jour du contrat

        $contract->update($validatedData);


        // Pour chaque partenaire mis a jour de la contribution dans la table pivot et mise a jour du nom/prenom/email dans la table partenaire

        foreach ($validate_partners as $partner_id => $partnerData) {

            $contract->partners()->updateExistingPivot($partner_id, [

                'partner_contribution' => $partnerData['partner_contribution'],

            ]);

            $partner = $contract->partners()->find($partner_id);

            if ($partner) {

                $partner->update([

                    'name' => $partnerData['partner_name'],
                    'firstname' => $partnerData['partner_firstname'],
                    'email' => $partnerData['partner_email'],

                ]);

            }

        }

        return redirect('/')->with('success', 'Contract updated successfully.');
    }


    // Methode de création de partenaire

    public function storepartner(){
        $validatedData = request()->validate([
            'partner_name' => 'required',
            'partner_firstname' => 'required',
            'partner_email' => 'required',
        ]);

        Partner::create($validatedData);

        // Renvoie la page avec les elements selectionné pour ne pas retirer tout les partenaires selectionnées

        $selected_partner = request()->get('selected_partners');

        return redirect('/partner')->with('selected_partners', $selected_partner);
    }


    // Methode de suppression de partenaire

    public function destroyPartner($id){

        $partner = Partner::find($id);

        $partner->delete();

        return redirect('/partner');

    }
    
}
