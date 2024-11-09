function createPDF() {
    var element = document.getElementById('contrat');
   
    var doc = new jsPDF('p', 'mm', 'a4'); // Mode portrait, format A4

    doc.html(element, {
        callback: function(doc) {
            doc.save('newpdf.pdf'); // Sauvegarde le fichier PDF
        },
        x: 10, // Position X de départ
        y: 10, // Position Y de départ
        html2canvas: {
            scale: 0.5, // Ajuste l'échelle pour un rendu plus précis
        }
    });
}
