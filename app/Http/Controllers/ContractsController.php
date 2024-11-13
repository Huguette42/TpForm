<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Partner;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

        for ($i = 0; $i < $partner_number; $i++) {
            global $validate_partner;

            $partner = request()->validate([
            'nom'.($i+1) => 'required',
            'prenom'.($i+1) => 'required',
            'contribution'.($i+1) => 'required',
            ]);

            $validate_partner[$i] = [
                'partner_name' => $partner['nom'.($i+1)],
                'partner_firstname' => $partner['prenom'.($i+1)],
                'partner_contribution' => $partner['contribution'.($i+1)],
            ];
        }


        $contract = auth()->user()->contracts()->create($validate_contract);

        foreach ($validate_partner as $partner) {
            $contract->partners()->create($partner);
        }

        return redirect('/')->with('success', 'Contract created');

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

        return view('contract/show', ['contract' => $contract, 'dateajd' => $dateajd, 'dateDebutContrat' => $dateDebutContrat, 'nbpartner' => $nbpartner]);
    }

    public function downloadPDF($id)
    {
        $contract = Contract::find($id);

        $pdf = Pdf::loadView('contract.pdf', array('contract' =>  $contract))
        ->setPaper('a4', 'portrait');

        return $pdf->download('Contract-'.$id.'.pdf');
    }
}
