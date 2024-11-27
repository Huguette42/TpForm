@extends('layouts.base')

@section('header')
    <link rel="stylesheet"  href="{{ asset('/css/form.css')}}">
@endsection

@section('content')
<div class="w-100 d-flex justify-content-center align-items-center py-4 testmain">

<div id="mainpartner" class="d-flex justify-content-around align-items-center">
<div>
    <form id="formsearch" method="GET" action="{{ route('partner.get') }}">
    @csrf
    <h1>Rechercher un partenaire</h1><br>

    <div class="d-flex align-items-center">
        <p id="numberpartnerselect" class="m-0"></p>
        <button type="button" class="btn btn-theme mx-3" onclick="reset_partner()">Enlever tout les partenaire</button>
    </div>

    <div class="d-flex align-items-center mt-3">
            <input name="search" class="form-control"  type="text" placeholder="Nom de famille">
            <input type="submit" class="btn btn-theme mx-3" value="Rechercher">
    </div>

    <input type="hidden" id="selectedPartnersInput" class="selected_partner_hidden" name="selected_partners" value="{{ session('selected_partners') }}">

</form>

<form action="{{ route('contracts.get') }}" method="GET">
    @if (count($partners) != 0)
        @foreach ($partners as $partner)
            <div class="partner my-3 d-flex justify-content-around align-items-center p-3">
                <input type="checkbox" class="form-check-input partnercheck cursor-pointer me-3 mt-0" onclick="checkbox_change(this)" class="partner_checkbox" value="{{ $partner->id }}">
                <span class="partneritem">{{ $partner->partner_name }}</span>
                <span class="partneritem">{{ $partner->partner_firstname }}</span>
                <span class="partneremail">{{ $partner->partner_email }}</span>
            </div>
        @endforeach
    @endif
    <input type="hidden" class="selected_partner_hidden" name="selected_partners" value="{{ session('selected_partners') }}">
    <input type="submit" class="btn btn-success mt-3" value="Ajouter les partenaires selectionnés">
    </form>
</div>

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
        <input class="btn btn-theme mt-3" type="submit" value="Créer">
    </div>
    <input type="hidden" class="selected_partner_hidden" name="selected_partners" value="{{ session('selected_partners') }}">
</form>


</div>
</div>
<script src="{{ asset('/js/partner.js') }}"></script>
@endsection
