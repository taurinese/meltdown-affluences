<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class AvailableDateReservationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Vérifier s'il correspond aux horaires d'ouverture
        // Convertir les dates en Carbon pour vérifier le jour (Lundi, Mardi, etc...) et l'heure
        $date = Carbon::parse($value);
        $horaires = config('information.horaires');
        if(isset($horaires[$date->formatLocalized('%A')]['open'])){
            $horaire = [
                'open' => $date->copy()->startOfDay()->addHours(intval($horaires[$date->formatLocalized('%A')]['open'])),
                'close' => $date->copy()->startOfDay()->addHours(intval($horaires[$date->formatLocalized('%A')]['close']))
            ];
        }
        else return false;
        if($date->lt($horaire['open']) OR $date->gte($horaire['close'])) return false;
        else return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "L'établissement n'est pas ouvert à l'horaire choisie.";
    }
}
