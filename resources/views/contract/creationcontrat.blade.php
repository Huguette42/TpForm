@extends('layouts.base')

@section('header')
    <link rel="stylesheet"  href="{{ asset('/css/form.css')}}">

@endsection

@section('title')
Creer un contrat
@endsection

@section('content')
    <div class="w-100 d-flex justify-content-center align-items-center py-4 testmain">
        <form id="mainform" class="d-flex justify-content-center align-items-center flex-column" action="{{ route('contracts.store') }}" method="POST">
            @csrf
            <h1>Création du contrat</h1><br>
            <div id="stepper" class="stepper">

            </div>

            <div id="step1" class="">

                <span>Nombre de parties</span>
                <span id="numberparties-span">1</span>
                <input id="numberparties" type="hidden" name="number" value="1">

                <div>
                    <button class="btn btn-arrow" type="button" onclick="addpartie()">Ajouter une partie</button>
                    <button class="btn btn-arrow" type="button" onclick="removepartie()">Supprimer une partie</button>
                </div>
                <br>
                <div class="d-flex justify-content-start align-items-center">
                    <label class="form-check-label mx-3" for="include">S'inclure dans le contrat</label>
                    <div class="form-check form-switch">
                        <input name="include" class="form-check-input cursor-pointer contractcheckbox" type="checkbox" onclick="included()" id="include">
                    </div>
                </div>
                <div id="partenaire" class="d-flex flex-wrap justify-content-center w-100 align-items-center flex-row">

                    <div id='partner1' class="m-3">
                        <h2>Partenaire 1</h2>
                        <div class='inputdiv'>
                                <label class='form-label' for='nom1'>Nom</label>
                                <input class='form-control' name='nom1' type='text' placeholder='Nom'>
                        </div><br>
                        <div>
                                <label class='form-label' for='prenom1'>Prénom</label>
                                <input class='form-control' name='prenom1' type='text' placeholder='Prénom'>
                        </div><br>
                        <div>
                                <label class='form-label' for='email1'>Email</label>
                                <input class='form-control' name='email1' type='text' placeholder='Email'>
                        </div>
                </div>
                    <div id="partnerinclude" class="m-3 d-none">
                        <h2>Moi</h2>
                        <div class='inputdiv'>
                                <label class='form-label' for='nom99'>Nom</label>
                                <input disabled class='form-control' name='nom99' type='text' value="{{auth()->user()->lastname}}" placeholder='Nom'>
                        </div><br>
                        <div>
                                <label class='form-label' for='prenom99'>Prénom</label>
                                <input disabled class='form-control' name='prenom99' type='text' value="{{auth()->user()->firstname}}" placeholder='Prénom'>
                        </div><br>
                        <div>
                                <label class='form-label' for='email99'>Email</label>
                                <input disabled class='form-control' name='email99' type='text' value="{{auth()->user()->email}}" placeholder='Email'>
                        </div>
                        @error('nom99')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('prenom99')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('email99')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
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
                <div class="m-3 inputdiv">
                    <h2 id="contribtitle1">Contribution 1</h2>
                    <textarea class="form-control" name='contribution1' placeholder='Contribution'></textarea><br>
                </div>
            </div>
            <div id="step4" class="d-none">
                <h2>Modalités bancaire</h2>
                <label class="form-label" for="repartition">Répartition des bénéfices et des pertes</label>
                <textarea class="form-control" name="repartition" placeholder="Répartition des bénéfices et des pertes"></textarea>
                <br>
                <label for="minsignature">Les cheques doivent etre signer par au moins</label>
                <select class="form-select my-3" id="minsignature" name="minsignature">
                    <option value="1">1 personne</option>
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
