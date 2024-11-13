<?php

namespace App\Http\Controllers;

use App\Models\Contract;
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

}
