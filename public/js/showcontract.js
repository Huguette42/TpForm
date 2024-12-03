
/**
 * Nom du fichier : showcontract.js
 * Description    : Fichier de script de la page d'affichage du contrat
 * Auteur         : Hugo Jeanselme
 *
 * Utilisation :
 * - Permet d'imprimer le contrat
 *
*/


function printcontract(){

    // Recupere la div du contrat a imprimer (sans le header et le footer)

    const divToPrint = document.getElementById("contrat").innerHTML;

    // Sauvegarde la page actuelle

    const originalContent = document.body.innerHTML;

    // Change le contenu de la page actuelle pour la div a imprimer

    document.body.innerHTML = divToPrint;

    // Imprime la fenetre

    window.print();

    // Remet le contenu de la page a son etat original

    document.body.innerHTML = originalContent;

}

