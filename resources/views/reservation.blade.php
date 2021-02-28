@extends('layouts.default', ['title' => "Réservation"])

@section('content')


<div class="w-10/12 mx-auto mb-5">
    <h1 class="text-3xl text-center mb-5">Meltdown Paris</h1>
    <h2 class="text-xl text-center mb-5">Réservation</h2>
    <p class="text-center mb-5">Réserver une place pour une durée d'une heure. (2 personnes maximum par heure)</p>
    <p class="text-center">Toute réservation débutera et se terminera sur une heure complète.</p>
    <p class="text-center mb-5 italic">exemple: de 15:00 à 16:00</p>

    @if(Session::has('status'))
        <div class="w-6/12 mx-auto text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
            <p>{{ Session::get('status') }}</p>
        </div>    
    @endif

    @if ($errors->any())
        <div class="w-6/12 mx-auto text-white px-6 py-4 border-0 rounded relative mb-4 bg-yellow-500">
            <span class="inline-block align-middle">
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                </ul>
            </span>
        </div>
    @endif
    <form class="w-6/12 bg-gray-100 rounded-lg p-10 mx-auto flex flex-col justify-center items-center" action="{{ route('booking.send') }}" method="post">
    @csrf 
        <div class="mb-5 w-full">
            <label class="w-full" for="datetime">Date et horaire de réservation</label> <br>
            <input class="w-full mt-5 p-3 rounded-lg" type="datetime-local" name="datetime" id="datetime" step="3600" value="{{ old('datetime', Carbon\Carbon::now('Europe/Paris')->format('Y-m-d\TH:00')) }}" min="{{ Carbon\Carbon::now('Europe/Paris')->format('Y-m-d\TH:00') }}" value="{{ old('datetime')}}" required> <br>     
        </div>
        <div class="mb-5 w-full">
            <label class="w-full" for="email">Adresse email</label> <br>
            <input class="w-full mt-5 p-3 rounded-lg" type="email" name="email" id="email" value="{{ old('email')}}" required> <br> 
        </div>
        <div class="mb-5 w-full">
            <input class="mt-5" type="checkbox" name="cgu" id="cgu" required>
            <label for="cgu">J'ai lu et accepté les conditions d'utilisation</label> <br>   
        </div>
        <button type="submit" class="bg-blue-300 p-3 rounded-lg m-auto w-52">Réserver</button>
    </form>
</div>

@endSection