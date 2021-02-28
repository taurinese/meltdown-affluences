@extends('layouts.default', ['title' => "Accueil"])

@section('content')

<?php $horaires = config('information.horaires') ?>

<style type="text/css">
      /* Set the size of the div element that contains the map */
      #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
      }
</style>

<script>
  // Initialize and add the map
  function initMap() {
    // The location of Uluru
    const uluru = { lat: 48.857960237872554, lng: 2.370683325188342 }; // 48.857960237872554, 2.370683325188342
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 13,
      center: uluru,
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
      position: uluru,
      map: map,
    });
  }
</script>

@if(Session::has('status'))
  <div class="w-6/12 mx-auto text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
      <p>{{ Session::get('status') }}</p>
  </div>    
@endif


@include('partials.terminal')

<div class="w-4/12 mx-auto mb-10">
  <img class="w-full" src="https://www.parisinfo.com/var/otcp/sites/images/node_43/node_51/node_77884/node_77887/meltdown-paris-joueurs-3-%7C-630x405-%7C-%C2%A9-meltdown-paris/21045799-1-fre-FR/Meltdown-Paris-Joueurs-3-%7C-630x405-%7C-%C2%A9-Meltdown-Paris.jpg" alt="Meltdown Paris">
</div>



<div class="w-10/12 mx-auto mb-10">
    <h1 class="text-3xl text-center mb-5">Horaires</h1>
    <div class="grid grid-rows-2 text-center bg-gray-50 rounded-lg gap-3 p-3">
      <div class="grid grid-cols-7 border-solid border-b-2 border-black pb-3 content-center">
        <p>Lundi</p>
        <p>Mardi</p>
        <p>Mercredi</p>
        <p>Jeudi</p>
        <p>Vendredi</p>
        <p>Samedi</p>
        <p>Dimanche</p>
      </div>
      <div class="grid grid-cols-7 pt-50 content-center">
        <p>{{ $horaires['Monday'] ? $horaires['Monday']['open'] . ' - ' . $horaires['Monday']['close'] : "Fermé" }}</p>
        <p>{{ $horaires['Tuesday'] ? $horaires['Tuesday']['open'] . ' - ' . $horaires['Tuesday']['close'] : "Fermé" }}</p>
        <p>{{ $horaires['Wednesday'] ? $horaires['Wednesday']['open'] . ' - ' . $horaires['Wednesday']['close'] : "Fermé" }}</p>
        <p>{{ $horaires['Thursday'] ? $horaires['Thursday']['open'] . ' - ' . $horaires['Thursday']['close'] : "Fermé" }}</p>
        <p>{{ $horaires['Friday'] ? $horaires['Friday']['open'] . ' - ' . $horaires['Friday']['close'] : "Fermé" }}</p>
        <p>{{ $horaires['Saturday'] ? $horaires['Saturday']['open'] . ' - ' . $horaires['Saturday']['close'] : "Fermé" }}</p>
        <p>{{ $horaires['Sunday'] ? $horaires['Sunday']['open'] . ' - ' . $horaires['Sunday']['close'] : "Fermé" }}</p>
      </div>
    </div>
</div>

<div class="bg-gray-50">
  <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
      <span class="block">Vous voulez réserver une horaire?</span>
      <span class="block text-indigo-600">Accédez au formulaire via le bouton "Réserver".</span>
    </h2>
    <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
      <div class="inline-flex rounded-md shadow">
        <a href="{{ route('booking.form') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
          Réserver
        </a>
      </div>
    </div>
  </div>
</div>

<div class="container mx-auto my-5" id="map"></div>

<script
      src="https://maps.googleapis.com/maps/api/js?key={{ $_ENV['API_KEY'] }}&callback=initMap&libraries=&v=weekly"
      async
></script>


@endSection