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

        // Décoder les données base64
        $base64Image = $signature['signature'];
        $imageData = explode(',', $base64Image)[1]; // Enlever le type de données (e.g., "data:image/png;base64,")
        $imageData = base64_decode($imageData);

        // Créer un nom de fichier unique pour la signature
        $fileName = 'signature_' . time() . '.png';

        // Sauvegarder l'image décodée dans le dossier de stockage public
        $filePath = 'signatures/' . $fileName;
        Storage::disk('public')->put($filePath, $imageData);

        // Mettre à jour le champ `partner_signature` avec le chemin de l'image
        Contract::find($contract_id)->partners()->find($partner_id)->update([
            'partner_signature' => $filePath,
        ]);


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

    public function show($partner_id)
    {
        return response()->file(storage_path('app/public/' . Partner::find($partner_id)->partner_signature));
    }
}
