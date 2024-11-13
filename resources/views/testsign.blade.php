<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>


    <title>Document</title>
</head>
<body>
    <canvas id="signature" width=400 height=200></canvas>
    <button onclick="clearSignature()">Clear</button>
    <button onclick="saveSignature()">Save</button>
    <form id="signform" action="{{ route('signature.store', ['contract_id' => 1, 'partner_id' => 1]) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="signature" id="signatureInput">

    </form>
    @error('signature')
    <p>{{ $message }}</p>
    @enderror
    <script src="{{ asset('js/signature.js') }}"></script>
</body>
</html>
