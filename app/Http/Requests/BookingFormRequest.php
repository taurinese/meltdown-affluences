<?php

namespace App\Http\Requests;

use App\Rules\AlreadyExistsReservationRule;
use App\Rules\AvailableDateReservationRule;
use App\Rules\MaximumReservationRule;
use App\Rules\ReservationIsPastRule;
use Illuminate\Foundation\Http\FormRequest;

class BookingFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', new AlreadyExistsReservationRule(request()->get('datetime'))],
            'datetime' => ['required', new ReservationIsPastRule, new AvailableDateReservationRule, new MaximumReservationRule],
            'cgu' => ['required']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Une adresse mail est obligatoire.',
            'datetime.required' => 'Une date de réservation est obligatoire.',
            'cgu.required' => 'Vous devez accepter les CGU avant de réserver votre place.'
        ];
    }
}
