{{--
    Utilisation de la template : base, dans layouts

    Plusieurs sections sont définies : header, title, content
--}}


@extends('layouts.base')

@section('header')
    <link rel="stylesheet"  href="{{ asset('/css/form.css')}}">
@endsection

@section('title')
Creer un contrat
@endsection

@section('content')
    <div class="main-block w-100 d-flex justify-content-center align-items-center py-4">

        {{--
            Formulaire de creation de contrat
        --}}

        <form class="form-contrat d-flex justify-content-center align-items-center flex-column" action="{{ route('contracts.store') }}" method="POST">
            @csrf

            <h1>Création du contrat</h1><br>

            {{--
                Div de la barre de progression du formulaire

                Les elements de la barre de progression sont ajoutés dynamiquement en javascript
            --}}

            <div id="stepper" class="stepper">

            </div>


            {{--
                Le formulaire est divisé en plusieurs étapes, chaque étape est une categorie de données du contrat
            --}}
            
            <div id="step1" class="">

                <span>Nombre de parties</span>
                <span id="numberparties-span">{{count($partners)}}</span>
                <input id="numberparties" type="hidden" name="number" value="{{count($partners)}}">

                <br>
                <div id="partenaire" class="d-flex flex-wrap justify-content-center w-100 align-items-center flex-row">
                    @for ($i = 0; $i < count($partners); $i++)
                        <div id='partner{{$i}}' class="m-3">
                            <h2>Partenaire {{$i}}</h2>
                            <div class='inputdiv'>
                                    <label class='form-label' for='nom{{$i}}'>Nom</label>
                                    <input disabled class='form-control' name='nom{{$i}}' type='text' value="{{$partners[$i]->partner_name}}">
                            </div><br>
                            <div>
                                    <label class='form-label' for='prenom{{$i}}'>Prénom</label>
                                    <input disabled class='form-control' name='prenom{{$i}}' type='text' value="{{$partners[$i]->partner_firstname}}">
                            </div><br>
                            <div>
                                    <label class='form-label' for='email{{$i}}'>Email</label>
                                    <input disabled class='form-control' name='email{{$i}}' type='text' value="{{$partners[$i]->partner_email}}">
                                    <input type='hidden' name='id{{$i}}' value='{{$partners[$i]->id}}'>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <br>
            <div id="step2" class="d-none inputdiv">
                <h2>Activités</h2>
                <div >
                    <label class="form-label" for="nature">Nature du contrat</label>
                    <textarea class="form-control" type="text" name="nature"></textarea>
                </div>
                <br>
                <div>
                    <label class="form-label" for="namepartenariat">Nom du partenariat</label>
                    <input class="form-control" type="text" name="namepartenariat">
                </div>
                <br>
                <div>
                    <label class="form-label" for="adresse">Adresse du siège</label>
                    <input class="form-control" type="text" name="adresse">
                </div>
                <br>
                <div>
                    <label class="form-label" for="date">Date de debut du partenariat</label>
                    <input class="form-control" type="date" name="date">
                </div>
                <br>
            </div>
            <div id="step3" class="d-none d-flex justify-content-center align-items-center flex-wrap">
                @for ($i = 0; $i < count($partners); $i++)
                    <div class="m-3 inputdivcontr">
                        <h2 id="contribtitle{{$i}}">Contribution {{$partners[$i]->partner_name}}</h2>
                        <textarea class="form-control" name='partner_contribution{{$i}}' placeholder='Contribution'></textarea><br>
                    </div>
                @endfor

            </div>
            <div id="step4" class="d-none">
                <h2>Modalités bancaire</h2>
                <label class="form-label" for="repartition">Répartition des bénéfices et des pertes</label>
                <textarea class="form-control" name="repartition" placeholder="Répartition des bénéfices et des pertes"></textarea>
                <br>
                <label for="minsignature">Les cheques doivent etre signer par au moins</label>
                <select class="form-select my-3" id="minsignature" name="minsignature">
                    @for ($i = 0; $i < count($partners); $i++)
                        <option value="{{$i+1}}">{{$i+1}} personne</option>
                    @endfor
                </select>
            </div>
            <div id="step5" class="d-none">
                <h2>Juridique </h2>
                <label class="form-label" for="duree">Durée de la clause de non concurence</label>
                <input class="form-control" type="text" name="duree">
                <br>
                <label class="form-label" for="juridiction">Nom de l'état de juridiction</label>
                <input class="form-control mb-3" type="text" name="juridiction">
            </div>
            <div id="step6" class="d-none">
                <h2>Information complementaire</h2>
                <div>
                    <label class="form-label" for="lieucreation">Lieu de création du contrat</label>
                    <input class="form-control" type="text" name="lieucreation">
                </div>
                <br>
                <div>
                    <label class="form-label" for="nameavocat">Nom de l'avocat</label>
                    <input class="form-control" type="text" name="nameavocat">
                </div>
                <br>

            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button id="buttonprev" class="btn btn-arrow m-2" type="button" onclick="prevstep()">Précédent</button>
                <button id="buttonsuivant" class="btn btn-arrow m-2" type="button" onclick="nextstep()">Suivant</button>
                <input id="buttonsubmit" class="btn btn-success d-none" type="submit" value="Valider">
            </div>
        </form>
    </div>
    <script src="{{ asset('/js/form.js') }}"></script>
@endsection
