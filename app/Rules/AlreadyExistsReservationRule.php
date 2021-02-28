<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AlreadyExistsReservationRule implements Rule
{

    protected $date;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($param)
    {
        $this->date = $param;
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
        // Vérifier que cet utilisateur n'a pas déjà réservé à cette date (vérifier avec l'email et la date)
        if(DB::table('booking')->where('email', "=", $value)->where('date', "=", $this->date)->exists()) return false;
        else return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Vous avez déjà réservé pour cette horaire.';
    }
}
