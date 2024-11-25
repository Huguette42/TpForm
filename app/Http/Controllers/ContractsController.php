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



        for ($i = 0; $i < $partner_number; $i++) {
            global $validate_partner;

            $partner = request()->validate([
            'id'.($i) => 'required',
            'partner_contribution'.($i) => 'required',
            ]);

            $validate_partner[$i] = [
                'partner_id' => $partner['id'.($i)],
                'partner_contribution' => $partner['partner_contribution'.($i)],
            ];
        }


        $contract = auth()->user()->contracts()->create($validate_contract);








        foreach ($validate_partner as $partner) {
            $contract->partners()->attach($partner['partner_id'], ['partner_contribution' => $partner['partner_contribution']]);
        }

        $firstpartner = $contract->partners()->where('partner_email', auth()->user()->email)->first();
        if ($firstpartner != null) {
            return redirect(URL::signedRoute('signature.index', ['contract_id' => $contract->id, 'partner_id' => $firstpartner->id]));
        } else {
            $contract->update(['contract_status' => 1]);
            return redirect('/')->with('success', 'Contract created');
        }
    }

    public function partner(){
        if (request()->has('selected_partners')) {
            session()->flash('selected_partners', request()->get('selected_partners'));
        } else if (session()->has('selected_partners')) {
            session()->flash('selected_partners', session()->get('selected_partners'));
        } else {
            session()->flash('selected_partners', "vide");
        }

        if (request()->has('search')) {
            if (request()->get('search') === '') {
                $partners = Partner::limit(10)->get();
                return view('contract.partner', compact('partners'));// probleme avec le with
            }
            $partners = Partner::where('partner_name', 'like', '%'.request()->get('search').'%')->limit(10)->get();
            return view('contract.partner', compact('partners'));

        }
        $partners = Partner::limit(10)->get();

        return view('contract.partner', compact('partners'));
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

    public function storeshow() {
        $selected_partners = request()->get('selected_partners');
        if ($selected_partners != "vide") {
            $selected_partners = explode(',', $selected_partners);
            $partners = Partner::whereIn('id', $selected_partners)->get();
        } else {
            return redirect('/partner');
        }
        return view('contract.creationcontrat', compact('partners'));
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
    $partner_ids = $contract->partners->pluck('id')->toArray();

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

    $contract->update($validatedData);


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
    public function storepartner()
    {
        $validatedData = request()->validate([
            'partner_name' => 'required',
            'partner_firstname' => 'required',
            'partner_email' => 'required',
        ]);

        Partner::create($validatedData);

        //recuperer les partenaires avec l'input
        $selected_partner = request()->get('selected_partners');


        return redirect('/partner')->with('selected_partners', $selected_partner);
    }
}
