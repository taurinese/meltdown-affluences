<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingFormRequest;
use App\Rules\AlreadyDeletedRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class ApiBookingController extends Controller
{
    public function getBooking(){
        return response()->json(Config::get('information'), 200);
    }

    public function addBooking(BookingFormRequest $request){
        $params = [
            'email' => $request->get('email'),
            'date' => $request->get('datetime'),
            'token' => md5(uniqid(true))
        ];

        DB::table('booking')->insert([
            'email' => $params['email'],
            'token' => $params['token'],
            'date' => $params['date'],
            'created_at' => Carbon::now()->addHour()
        ]);
        $params['date'] = Carbon::parse($params['date'])->format('d-m-Y à H:i');
        return response()->json('Votre réservation pour le ' . $params['date'] . ' a été prise en compte.', 201);
    }

    public function deleteBooking(Request $request, $token){
        $request->request->add(['token' => $token]);
        $request->validate([
            'confirm_cancel' => ['required'],
            'token' => [new AlreadyDeletedRule($token)]
        ], [
            'confirm_cancel.required' => "Vous devez confirmer l'annulation de votre réservation."
        ]);
        
        DB::table('booking')->where('token', '=', $token)->delete();
        return response()->json('', 204);
    }
}
