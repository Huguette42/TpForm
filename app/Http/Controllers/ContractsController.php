<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Partner;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Storage;
use URL;

class ContractsController extends Controller
{
    public function store(){
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

        $validate_partner = [];

        $fields = request()->get('include') === 'on'
        ? ['nom99', 'prenom99', 'contribution1', 'email99']
        : ['nom1', 'prenom1', 'contribution1', 'email1'];

        $firstpartner = request()->validate([
        $fields[0] => 'required',
        $fields[1] => 'required',
        $fields[2] => 'required',
        $fields[3] => 'required',
        ]);


        for ($i = 1; $i < $partner_number; $i++) {
            global $validate_partner;

            $partner = request()->validate([
            'nom'.($i+1) => 'required',
            'prenom'.($i+1) => 'required',
            'contribution'.($i+1) => 'required',
            'email'.($i+1) => 'required',
            ]);

            $validate_partner[$i] = [
                'partner_name' => $partner['nom'.($i+1)],
                'partner_firstname' => $partner['prenom'.($i+1)],
                'partner_contribution' => $partner['contribution'.($i+1)],
                'partner_email' => $partner['email'.($i+1)],
            ];
        }


        $contract = auth()->user()->contracts()->create($validate_contract);

        $firstpartner = $contract->partners()->create([
            'partner_name' => $firstpartner[$fields[0]],
            'partner_firstname' => $firstpartner[$fields[1]],
            'partner_contribution' => $firstpartner[$fields[2]],
            'partner_email' => $firstpartner[$fields[3]],
            ]);

        foreach ($validate_partner as $partner) {
            $contract->partners()->create($partner);
        }
        if (request()->get('include') === 'on') {
            return redirect(URL::signedRoute('signature.index', ['contract_id' => $contract->id, 'partner_id' => $firstpartner->id]));
        } else {
            return redirect('/')->with('success', 'Contract created');
        }
    }

    public function show($id){

        // Récupérer le contrat qui a l'id passé en paramètre
        $contract = Contract::find($id);

        // Tableau des mois en français
        $mois = array(1=>'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');

        // Tableau des jours de la semaine en français
        $jours = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');

        // Récupérer la date actuelle et la formater en jour, jour du mois, mois et année
        $dateajd = $jours[date('w')].' '.date('j').' '.$mois[date('n')].' '.date('Y');

        // Récupérer la date depuis l'input (ex: "2024-10-07")
        $date_input = $contract->contract_date;

        // Convertir en timestamp
        $timestamp = strtotime($date_input);

        // Formater la date en jour de la semaine, jour du mois, mois et année
        $dateDebutContrat = $jours[date('w', $timestamp)].' '.date('j', $timestamp).' '.$mois[date('n', $timestamp)].' '.date('Y', $timestamp);

        $nbpartner = $contract->partners->count();

        return view('contract.show', ['contract' => $contract, 'dateajd' => $dateajd, 'dateDebutContrat' => $dateDebutContrat, 'nbpartner' => $nbpartner]);
    }

    public function destroy($id)
    {
        $contract = Contract::find($id);

        foreach ($contract->partners as $partner) {
            if ($partner->partner_signature) {
                Storage::disk('public')->delete($partner->partner_signature); // Supprimer la signature du partenaire
            }
        }

        $contract->delete();

        return redirect('/')->with('success', 'Contract deleted');
    }

    public function downloadPDF($id)
    {
        $contract = Contract::find($id);
        $nbpartner = $contract->partners->count();

        $pdf = Pdf::loadView('contract.pdf', array('contract' =>  $contract, 'nbpartner' => $nbpartner))
        ->setPaper('a4', 'portrait');

        return $pdf->download('Contract-'.$id.'.pdf');
    }

    public function edit($id)
    {
        $contract = Contract::find($id);

        $nbpartner = $contract->partners->count();

        return view('contract.edit', ['contract' => $contract, 'nbpartner' => $nbpartner]);
    }

    public function update($id)
    {

        $contract = Contract::find($id);

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
        $partner_number = $contract->partners->count();

        for ($i = 0; $i < $partner_number; $i++) {
            global $validate_partners;

            $partner = request()->validate([
            'partner_name_'.$i => 'required',
            'partner_firstname_'.$i => 'required',
            'partner_contribution_'.$i => 'required',
            'partner_email_'.$i => 'required',
            ]);
            $validate_partners[$i] = [
                'partner_name' => $partner['partner_name_'.$i],
                'partner_firstname' => $partner['partner_firstname_'.$i],
                'partner_contribution' => $partner['partner_contribution_'.$i],
                'partner_email' => $partner['partner_email_'.$i],
            ];
        }

        $contract->update($validatedData);

        for ($i = 0; $i < $partner_number; $i++) {
            $contract->partners[$i]->update($validate_partners[$i]);
        }
        return redirect('/')->with('success', 'Contract updated');
    }
}
