<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsuarioRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // se cambia a true para q se utilice la validacion de datos
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() // Aca se definen los requisitos que deben cumplir los campos
    {
        return [
            'password' => 'min:6|max:20|required',
            'persona_id' => 'required',
            'email' => 'min:4|max:20|email|required|unique:usuarios',
            'nombre_usuario' => 'min:4|max:20|required|unique:usuarios',
        ];
    }
}
