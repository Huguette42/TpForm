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
<link rel="stylesheet"  href="{{ asset('/css/home.css')}}">
@endsection

@section('title')
Dashboard
@endsection

@section('content')
<div class="main-block">

    {{--
        Bouton création de contrat
    --}}

    <div class="d-flex justify-content-end px-5 align-items-center">

        <a href="{{ route('partner.get')}}">

            <button class="btn btn-lg btn-theme">Creer un contrat</button>

        </a>

    </div>


    {{--
        Affichage des contrats
    --}}

    <div class="mt-5 mb-auto d-flex justify-content-around align-items-center flex-column">

        {{--
            Verifier si il y a au moins un contrat
        --}}

        @if (count($contracts) != 0)

            {{--
                Parcours des contrats
            --}}

            @foreach ($contracts as $contract)
                <div class="contrat my-3 d-flex justify-content-around align-items-center p-3">

                    <div class="contrat__status">

                        {{--
                            Verification du status du contrat et affichage en consequence:
                            -Affichage du bouton de signature si le createur fait partie des partenaires et n'a pas signé
                            -Affichage du status "En attente" si le contrat n'est pas encore signé par tout les partenaires
                            -Affichage du status "Prêt" si le contrat est signé par tout les partenaires
                        --}}

                        @if ($contract->contract_status == 0)
                            @for ($i = 0; $i < count($contract->partners); $i++)
                                @php
                                    $partner = $contract->partners[$i];
                                @endphp

                                @if ($partner->partner_email == Auth::user()->email)

                                    {{--
                                        Création d'un lien pour signer le contrat avec un hash de sécurité
                                    --}}

                                    <a class="contrat__link" href="{{URL::signedRoute('signature.index', ['contract_id' => $contract->id, 'partner_id' => $partner->id])}}">

                                        <span class="contrat__status-btn">

                                            Signer  <img class="contrat__image" id="signatureimg" src="{{asset('img/signature.png')}}">

                                        </span>

                                    </a>
                                @endif
                            @endfor

                        @elseif ($contract->contract_status == 1)

                            <span>En attente</span>

                        @else

                            <span>Prêt</span>

                        @endif

                    </div>

                    {{--
                        Affichage des informations du contrat : nature et nom
                    --}}

                    <div class="contract__info d-flex justify-content-around align-items-center">

                        <span class="contrat__info-1">

                            <span class="strong">Nature : </span>{{ $contract->contract_nature }}

                        </span>

                        <span class="contrat__info-2">

                            <span class="strong">Nom : </span>{{ $contract->contract_name }}

                        </span>

                    </div>

                    {{--
                        Bouton du CRUD : READ, UPDATE, DELETE

                        Bonus READ : Telechargement du contrat en PDF
                    --}}

                    <a class="contrat__link" href="{{ url("contract/".$contract->id) }}">

                        <button class="btn btn-theme">Voir</button>

                    </a>

                    <a class="contrat__link" href="{{ url("contract/".$contract->id."/download") }}">

                        <button class="btn btn-theme">PDF</button>

                    </a>

                    <a class="contrat__link" href="{{ url("contract/".$contract->id."/edit") }}">

                        <button class="btn btn-theme">Modifier</button>

                    </a>

                    <form method="POST" action="{{route('contracts.destroy', ['id' => $contract->id])}}">
                        @csrf

                        {{--
                            Spoofing de la methpde DELETE
                        --}}

                        @method('DELETE')

                        <input type="submit" class="btn btn-theme" value="Suprimer">

                    </form>

                </div>

            @endforeach

        @else

        {{--
            Si il n'y a pas de contrat
        --}}

            <h1>Vous n'avez pas de contrat</h1>

        @endif

    </div>

</div>
@endsection
