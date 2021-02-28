<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class BookingCancelController extends Controller
{
    public function show(Request $request, $token)
    {
        $date = DB::table('booking')->select('date')->where('token', "=", $token)->get();
        if(count($date) == 0) {
            return redirect()->route('index');
        }
        else 
            return view('cancelreservation', ['date' => $date[0]->date, 'token' => $token]);
    }

    public function delete(Request $request, $token){
        $request->validate([
            'confirm_cancel' => 'required'
        ]);
        $data = DB::table('booking')->select(['date', 'email'])->where('token', '=', $token)->get()->toArray()[0];
        $params = [
            'email' => $data->email,
            'date' => Carbon::parse($data->date)->format('d-m-Y à H:i')
        ];

        /* var_dump($params);
        die(); */
        DB::table('booking')->where('token', '=', $token)->delete();
        Mail::send('emails.cancel', $params, function($m) use ($params){
            $m->from($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
            $m->to($params['email'], $_ENV['MAIL_FROM_NAME'])->subject("Confirmation d'annulation de réservation pour le " . $params['date']);
            });
        return redirect()->route('booking.form')->with('status', 'Votre réservation a été annulée!');
    }
    
}
