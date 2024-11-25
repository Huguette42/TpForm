@extends('layouts.base')

@section('header')
    <link rel="stylesheet"  href="{{ asset('/css/form.css')}}">
@endsection

@section('content')
<div class="w-100 d-flex justify-content-center align-items-center py-4 testmain">

<div id="mainform" class="d-flex justify-content-center align-items-center flex-column">
<form id="formsearch" method="GET" action="{{ route('partner.get') }}">
    @csrf
    <h1>Rechercher un partenaire</h1><br>
    <input name="search" type="text" placeholder="Nom de famille">
    <input type="submit" value="Rechercher">
    <input type="hidden" id="selectedPartnersInput" class="selected_partner_hidden" name="selected_partners" value="{{ session('selected_partners') }}">
    <button type="button" onclick="reset_partner()">Enlever tout les partenaire</button>
</form>

<form method="POST" action="{{ route('partner.store') }}">
    @csrf
    <div class="d-flex justify-content-center align-items-center flex-column">
        <h1>Ajouter un partenaire</h1><br>
        <div class="inputdiv">
            <label class="form-label
            " for="partner_name">Nom</label>
            <input class="form-control" name="partner_name" type="text" placeholder="Nom">
        </div><br>
        <div class="inputdiv">
            <label class="form-label
            " for="partner_firstname">Prénom</label>
            <input class="form-control" name="partner_firstname" type="text" placeholder="Prénom">
        </div><br>
        <div class="inputdiv">
            <label class="form-label
            " for="partner_email">Email</label>
            <input class="form-control" name="partner_email" type="text" placeholder="Email">
        </div>
        <input type="submit" value="Créer">
    </div>
    <input type="hidden" class="selected_partner_hidden" name="selected_partners" value="{{ session('selected_partners') }}">
</form>

<form action="{{ route('contracts.get') }}" method="GET">
@if (count($partners) != 0)
    @foreach ($partners as $partner)
        <div class="partner my-3 d-flex justify-content-around align-items-center p-3">
            <input type="checkbox" onclick="checkbox_change(this)" class="partner_checkbox" value="{{ $partner->id }}">
            <span>{{ $partner->partner_name }}</span>
            <span>{{ $partner->partner_firstname }}</span>
            <span>{{ $partner->partner_email }}</span>
        </div>
    @endforeach
@endif
<input type="hidden" class="selected_partner_hidden" name="selected_partners" value="{{ session('selected_partners') }}">
<input type="submit" value="Ajouter les partenaires selectionnés">
</form>
</div>
</div>
<script src="{{ asset('/js/partner.js') }}"></script>
@endsection
