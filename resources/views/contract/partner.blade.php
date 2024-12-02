{{--
    Nom du fichier : home.blade.php
    Description    : Page principale de l'application
    Auteur         : Hugo Jeanselme

    Utilisation :
    - Affichage des contrats avec les controles (CRUD)
    - Bouton de création de contrat
--}}



{{--
    Utilisation de la template : base, dans layouts

    Plusieurs sections sont définies : header, title, content
--}}

@extends('layouts.base')

@section('header')
    <link rel="stylesheet"  href="{{ asset('/css/form.css')}}">
@endsection

@section('content')
<div class="main-block w-100 d-flex justify-content-center align-items-center py-4">

    <div id="mainpartner" class="partner d-flex justify-content-around align-items-center">

        <div>

            {{--
                Formulaire de recherche de partenaire
            --}}

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


            {{--
                Formulaire de selection de partenaires

                Ils sont affichés sous forme de liste avec un checkbox pour les selectionner
            --}}

            <form action="{{ route('contracts.get') }}" method="GET">

                @if (count($partners) != 0)
                
                    @foreach ($partners as $partner)

                        <div class="partner__item my-3 d-flex justify-content-around align-items-center p-3">

                            <input type="checkbox" class=" form-check-input partnercheck cursor-pointer me-3 mt-0" onclick="checkbox_change(this)" value="{{ $partner->id }}">

                            <span class="partneritem">{{ $partner->partner_name }}</span>

                            <span class="partneritem">{{ $partner->partner_firstname }}</span>

                            <span class="partneremail">{{ $partner->partner_email }}</span>

                            <a class="link" href="{{ url("partner/".$partner->id."/destroy") }}">

                                <span class="btn btn-danger ms-3">Suprimer</span>

                            </a>

                        </div>

                    @endforeach

                @endif

                <input type="hidden" class="selected_partner_hidden" name="selected_partners" value="{{ session('selected_partners') }}">

                <input type="submit" class="btn btn-success mt-3" value="Ajouter les partenaires selectionnés">

            </form>

        </div>


        {{--
            Formulaire de création de partenaire
        --}}

        <form method="POST" action="{{ route('partner.store') }}">
            @csrf

            <div class="d-flex justify-content-center align-items-center flex-column">

                <h1>Ajouter un partenaire</h1><br>

                <div class="inputdiv">

                    <label class="form-label" for="partner_name">Nom</label>

                    <input class="form-control" name="partner_name" type="text" placeholder="Nom">

                </div><br>

                <div class="inputdiv">

                    <label class="form-label" for="partner_firstname">Prénom</label>

                    <input class="form-control" name="partner_firstname" type="text" placeholder="Prénom">

                </div><br>

                <div class="inputdiv">

                    <label class="form-label" for="partner_email">Email</label>

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
