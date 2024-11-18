@extends('layouts.base')

@section('header')
    <link rel="stylesheet"  href="{{ asset('/css/form.css')}}">
    <script src="{{ asset('/js/form.js') }}"></script>
@endsection

@section('title')
Creer un contrat
@endsection

@section('content')
    <div class="w-100 d-flex justify-content-center align-items-center py-4">
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
                <div id="partenaire" class="d-flex flex-wrap justify-content-center align-items-center flex-row">

                </div>
            </div>
            <br>
            <div id="step2" class="d-none">
                <h2>Activités</h2>
                <div>
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
                <h2>Contributions</h2>
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
@endsection
