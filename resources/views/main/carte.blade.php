@extends('layouts/app')

@section('contenu')

<div class="tout"> 

    <div id="grid">
    <div id="item1"><b>Carte</b></div>
    </div>

    <div>
    <p><b>Petit déjeuner</b></p>
    <img src="{{ asset('img/breakfast_menu.jpg')}}" alt="photo petit déjeuner">
    </div>

    <div>
    <p><b>Déjeuner</b></p>
    <img src="{{ asset('img/lunch.jpg')}}" alt="photo déjeuner">
    </div>

    <div>
    <p><b>Diner</b></p>
    <img src="{{ asset('img/dinner_menu.jpg')}}" alt="photo diner">
    </div>
</div>
@endsection('contenu')