<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ConfigurarEmailRequest extends Request
{

    const CAMPO_EMAIL = 'Nuevo E-mail';

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
         'email' => 'email|required|confirmed'
       ];
     }

     public function messages()
     {
       return [
         'email.email' => 'El campo '.self::CAMPO_EMAIL.' no corresponde con una dirección de e-mail válida.',
         'email.confirmed' => 'El campo '.self::CAMPO_EMAIL.' debe coincidir con la confirmación.'
       ];
     }

}
