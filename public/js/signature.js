/**
 * Nom du fichier : signature.js
 * Description    : Fichier de script de la page de signature
 * Auteur         : Hugo Jeanselme
 *
 * Utilisation :
 * - Inititialisation du canvas de signature
 * - Fonction pour effacer la signature
 * - Fonction pour sauvegarder la signature
 *
*/


let signaturePad; // Variable globale

// Fonction pour initialiser le canvas

document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById("signature");

    signaturePad = new SignaturePad(canvas);

});

// Fonction pour effacer le canvas

function clearSignature() {

    signaturePad.clear();

}

// Fonction pour sauvegarder la signature

function saveSignature() {

    //Converti le canva en image sous la forme d'une URL en base64

    const signature = signaturePad.toDataURL("image/png");

    // Met la signature dans un input pour l'envoyé

    document.getElementById('signatureInput').value = signature;

    // Envoi le formulaire

    document.getElementById('signform').submit();

}
