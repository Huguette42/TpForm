@extends('layouts.base')

@section('header')
<link rel="stylesheet"  href="{{ asset('/css/home.css')}}">
@endsection

@section('title')
Dashboard
@endsection

@section('content')
<div class="d-flex justify-content-end px-5 align-items-center">
    <a href="{{ route('contracts.get')}}"><button class="btn btn-lg btn-theme">Creer un contrat</button></a>
</div>
<div class="mt-5 d-flex justify-content-around align-items-center flex-column" id="contratdiv">

    @if (count($contracts) != 0)
        @foreach ($contracts as $contract)
            <div class="contrat my-3 d-flex justify-content-around align-items-center p-3">
                <span>{{ $contract->contract_nature }}</span>
                <span>{{ $contract->contract_name }}</span>
                <span>{{ $contract->contract_adress }}</span>
                <button class="btn btn-theme" onclick='window.location="{{ url("contract/".$contract->id) }}"'>Voir</button>
                <button class="btn btn-theme" onclick='window.location="{{ url("contract/".$contract->id."/download") }}"'>PDF</button>
                <form method="POST" action="{{route('contracts.destroy', ['id' => $contract->id])}}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-theme" value="Suprimer">
                </form>
            </div>
        @endforeach
    @else
        <h1>Vous n'avez pas de contrat</h1>
    @endif

</div>
@endsection
