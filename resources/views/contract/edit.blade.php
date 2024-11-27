@extends('layouts.base')

@section('header')
    <link rel="stylesheet"  href="{{ asset('/css/editcontract.css')}}">
@endsection

@section('content')
<form class="d-flex justify-content-center" action="{{ route('contracts.update', ['id' => $contract->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="w-75 maindiv">
    <!-- Informations générales -->
    <h1>Informations générales</h1>
    <div class="mb-3">
        <label for="contract_date" class="form-label">Date du contrat :</label>
        <input type="date" id="contract_date" name="contract_date" class="form-control" value="{{ $contract->contract_date }}">
    </div>

    <div class="mb-3">
        <label for="contract_name" class="form-label">Nom du partenariat :</label>
        <input type="text" id="contract_name" name="contract_name" class="form-control" value="{{ $contract->contract_name }}">
    </div>

    <div class="mb-3">
        <label for="contract_nature" class="form-label">Nature des activités :</label>
        <input type="text" id="contract_nature" name="contract_nature" class="form-control" value="{{ $contract->contract_nature }}">
    </div>

    <div class="mb-3">
        <label for="contract_address" class="form-label">Adresse officielle :</label>
        <input type="text" id="contract_address" name="contract_address" class="form-control" value="{{ $contract->contract_adress }}">
    </div>

    <!-- Partenaires -->
    <h1>Partenaires</h1>
    @for ($i = 0; $i < $nbpartner; $i++)
        <h2>Partenaire {{ $i + 1 }}</h2>
        <div class="mb-3">
            <label for="partner_name_{{ $i }}" class="form-label">Nom :</label>
            <input type="text" id="partner_name_{{ $i }}" name="partner_name_{{ $i }}" class="form-control" value="{{ $contract->partners[$i]->partner_name }}">
        </div>

        <div class="mb-3">
            <label for="partner_firstname_{{ $i }}" class="form-label">Prénom :</label>
            <input type="text" id="partner_firstname_{{ $i }}" name="partner_firstname_{{ $i }}" class="form-control" value="{{ $contract->partners[$i]->partner_firstname }}">
        </div>

        <div class="mb-3">
            <label for="partner_email_{{ $i }}" class="form-label">Email :</label>
            <input type="text" id="partner_email_{{ $i }}" name="partner_email_{{ $i }}" class="form-control" value="{{ $contract->partners[$i]->partner_email }}">
        </div>

        <div class="mb-3">
            <label for="partner_contribution_{{ $i }}" class="form-label">Contribution :</label>
            <input type="text" id="partner_contribution_{{ $i }}" name="partner_contribution_{{ $i }}" class="form-control" value="{{ $contract->partners[$i]->pivot->partner_contribution }}">
        </div>
    @endfor

    <!-- Termes -->
    <h1>Termes</h1>
    <div class="mb-3">
        <label for="contract_repartition" class="form-label">Répartition des bénéfices et pertes :</label>
        <input type="text" id="contract_repartition" name="contract_repartition" class="form-control" value="{{ $contract->contract_repartition }}">
    </div>

    <div class="mb-3">
        <label for="contract_min_sign" class="form-label">Nombre minimum de signatures bancaires :</label>
        <input type="number" id="contract_min_sign" name="contract_min_sign" class="form-control" value="{{ $contract->contract_min_sign }}">
    </div>

    <div class="mb-3">
        <label for="contract_clause_duration" class="form-label">Durée de la clause de non-concurrence :</label>
        <input type="text" id="contract_clause_duration" name="contract_clause_duration" class="form-control" value="{{ $contract->contract_clause_duration }}">
    </div>

    <!-- Juridiction -->
    <h1>Juridiction</h1>
    <div class="mb-3">
        <label for="contract_state" class="form-label">État de juridiction :</label>
        <input type="text" id="contract_state" name="contract_state" class="form-control" value="{{ $contract->contract_state }}">
    </div>

    <div class="mb-3">
        <label for="contract_location" class="form-label">Lieu :</label>
        <input type="text" id="contract_location" name="contract_location" class="form-control" value="{{ $contract->contract_location }}">
    </div>

    <div class="mb-3">
        <label for="contract_avocate_name" class="form-label">Nom de l'avocat :</label>
        <input type="text" id="contract_avocate_name" name="contract_avocate_name" class="form-control" value="{{ $contract->contract_avocate_name }}">
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </div>
</form>

@endsection
