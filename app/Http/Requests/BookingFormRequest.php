<?php

namespace App\Http\Requests;

use App\Rules\AlreadyExistsReservationRule;
use App\Rules\AvailableDateReservationRule;
use App\Rules\MaximumReservationRule;
use App\Rules\ReservationIsPastRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


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
            "email.email" => "Vous devez entrer une adresse mail correcte.",
            'datetime.required' => 'Une date de réservation est obligatoire.',
            'cgu.required' => 'Vous devez accepter les CGU avant de réserver votre place.'
        ];
    }

    protected function failedValidation(Validator $validator) { 
        $isFailed = false;
        $responseCode = 0;
        foreach($validator->failed() as $ruleValidate){
            if(array_key_exists("Email", $ruleValidate) OR array_key_exists("Required", $ruleValidate)){               
                $responseCode= 422;
                $isFailed = true;
            }
        }
        if(!$isFailed) $responseCode = 400;
        throw new HttpResponseException(
          response()->json([
            'status' => false,
            'messages' => $validator->errors()->all()              
        ], $responseCode)
        ); 
    }

}
