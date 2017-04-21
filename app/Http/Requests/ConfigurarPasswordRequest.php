<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ConfigurarPasswordRequest extends Request
{
    const CAMPO_PASSWORD_ACTUAL = 'Contraseña Actual';
    const CAMPO_PASSWORD = 'Nueva Contraseña';

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
        'password_actual' => 'required|min:6',
        'password' => 'required|confirmed|min:6'
      ];
    }

    public function messages()
    {
      return [
        'password_actual.min' => 'El campo '.self::CAMPO_PASSWORD_ACTUAL.' debe contener al menos 4 caracteres.',
        'password.min' => 'El campo '.self::CAMPO_PASSWORD.' debe contener al menos 4 caracteres.',
        'password.confirmed' => 'El campo '.self::CAMPO_PASSWORD.' debe coincidir con la confirmación.'
      ];
    }

}
