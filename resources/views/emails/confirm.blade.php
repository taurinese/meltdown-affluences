<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réservation</title>
    <style>
        * {
           font-family:'Times New Roman', Times, serif; 
        }
        #container {
            width:80%;
            margin:auto;
            padding:10px;
        }
        #container, #reservation, #cancel {
            display:flex;
            flex-flow:column;
            justify-content: center;
            align-items:center;
        }
        button {
            background-color: #DC3545;
            padding:10px;
            border-radius:10px;
            border:none;
            margin-bottom: 5px;
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
        }
        button:hover {
            cursor:pointer;
        }
    </style>
</head>
<body>
    <div id="container">
        <h1>Votre réservation a été confirmée.</h1>
        <div id="reservation">
            <h3>Récapitulatif de réservation:</h3>
            <p>Lieu: {{ config('information.name') }}</p>
            <p>Date: {{ $date }} </p>
            <p>Durée : {{ config('information.duree') }}h </p>
        </div>
        <div id="cancel">
            <p>Vous souhaitez annuler votre réservation?</p>
            <a href="{{ route('booking.cancel', ['token' => $token ]) }}">
                <button>Annuler</button>
            </a>
            <small>Le bouton ne s'affiche pas correctement? <a href="{{ route('booking.cancel', ['token' => $token ]) }}">Cliquez ici.</a></small>
        </div>
    </div>
</body>
</html>