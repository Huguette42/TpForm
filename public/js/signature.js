
let signaturePad; // Variable globale

document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById("signature");
    signaturePad = new SignaturePad(canvas);
});

function clearSignature() {
    signaturePad.clear();
}

function saveSignature() {
    const signature = signaturePad.toDataURL("image/png");
    document.getElementById('signatureInput').value = signature;
    //console.log(document.getElementById("signatureInput").value);
    document.getElementById('signform').submit();
}
