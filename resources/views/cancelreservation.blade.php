@extends('layouts.default', ['title' => "Réservation"])

@section('content')


<div class="w-10/12 mx-auto mb-10 text-center">
@if ($errors->any())
    <div class="w-6/12 mx-auto text-white px-6 py-4 border-0 rounded relative mb-4 bg-yellow-500">
        <span class="inline-block align-middle">
            <ul>
                @foreach($errors->all() as $error)
                    <li> {{ $error }} </li> <!-- Normalement c'est {{ $error }} mais vu qu'il n'y a qu'une erreur possible ça évite de devoir créer une request pour personnaliser le message d'erreur. -->
                @endforeach
            </ul>
        </span>
    </div>
@endif
    <h1 class="text-3xl mb-10">Annulation de réservation</h1>
    <div>
        <p>Lieu: {{ config('information.name' )}}</p>
        <p>Date: {{ $date }}</p>
        <form method="post" action="{{ route('booking.delete', ['token' => $token]) }}" class="mt-5">
        @csrf
            <input type="checkbox" name="confirm_cancel" id="confirm_cancel" required>
            <label for="confirm_cancel">Je suis sur de vouloir annuler ma réservation.</label> <br>
            <button type="submit" class="bg-red-500 p-3 rounded-lg">Annuler ma réservation</button>
        </form>
    </div>
</div>

@endSection