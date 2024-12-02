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


        return view('signature.index', compact('contract_id', 'partner_id', 'contract', 'dateajd', 'dateDebutContrat', 'nbpartner'));
    }

    public function show($contract_id, $partner_id)
    {
        $contract = Contract::find($contract_id);
        $partner = $contract->partners()->find($partner_id);


        return response()->file(storage_path('app/public/' . $partner->pivot->partner_signature));
    }
}
