<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingFormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BookingFormController extends Controller
{
    public function show()
    {
        return view('reservation');
    }

    public function add(BookingFormRequest $request)
    {
        $params = [
            'email' => $request->get('email'),
            'date' => substr($request->get('datetime'), 0, -2) . "00",
            'token' => md5(uniqid(true))
        ];
        var_dump($params);
        die();
        DB::table('booking')->insert([
            'email' => $params['email'],
            'token' => $params['token'],
            'date' => $params['date'],
            'created_at' => Carbon::now()->addHour()
        ]);


        $params['date'] = Carbon::parse($params['date'])->format('d-m-Y à H:i');
        // Envoi du mail de confirmation
        Mail::send('emails.confirm', $params, function($m) use ($params){
        $m->from($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
        $m->to($params['email'], $_ENV['MAIL_FROM_NAME'])->subject('Confirmation de réservation pour le ' . $params['date']);
        });

        return redirect()->route('index')->with('status', 'Votre réservation pour le ' . $params['date'] . ' a été prise en compte.');
    }
}
