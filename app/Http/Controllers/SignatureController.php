<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SignatureController extends Controller
{
    public function store($contract_id, $partner_id)
    {
        // Valider que le champ 'signature' est bien présent
        $signature = request()->validate([
            'signature' => 'required',
        ]);


        $base64Image = $signature['signature'];

        if (strpos($base64Image, ',') === false) {
            return redirect()->back()->withErrors('Le format de la signature est invalide.');
        }

        $imageData = explode(',', $base64Image)[1]; // Enlever le type de données
        $imageData = base64_decode($imageData);

        if ($imageData === false) {
            return redirect()->back()->withErrors('Impossible de décoder l\'image.');
        }

        $fileName = 'signature_' . time() . '.png';

        $filePath = 'signatures/' . $fileName;
        Storage::disk('public')->put($filePath, $imageData);

        $contract = Contract::find($contract_id);

        $foundpartner = $contract->partners()->find($partner_id);

        if (!$foundpartner) {
            return redirect()->back()->withErrors('Partenaire non trouvé pour ce contrat.');
        }

        $contract->partners()->updateExistingPivot($partner_id, [
            'partner_signature' => $filePath,
        ]);

        if ($foundpartner->partner_email == $contract->user->email) {
            $contract->update([
                'contract_status' => 1,
            ]);
        }

        if ($contract->partners()->whereNotNull('partner_signature')->count() === $contract->partners()->count()) {
            $contract->update([
                'contract_status' => 2,
            ]);
        }
        return redirect('/')->with('success', 'Signature enregistrée avec succès');

    }

    public function index($contract_id, $partner_id)
    {
        $contract = Contract::find($contract_id);


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

        return view('signature.index', compact('contract_id', 'partner_id', 'contract', 'dateajd', 'dateDebutContrat', 'nbpartner'));
    }

    public function show($contract_id, $partner_id)
    {
        $contract = Contract::find($contract_id);
        $partner = $contract->partners()->find($partner_id);


        return response()->file(storage_path('app/public/' . $partner->pivot->partner_signature));
    }
}
