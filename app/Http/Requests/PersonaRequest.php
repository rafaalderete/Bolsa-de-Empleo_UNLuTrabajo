<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PersonaRequest extends Request
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
          'nombre_persona' => 'min:4|max:20|required',
          'apellido_persona' => 'min:4|max:20|required',
          'domicilio_residencia_persona' => 'max:30|required',
          'fecha_nacimiento_persona' => 'required',
          'nro_documento_persona' => 'min:5|max:12|required',
          'telefono_contacto_persona' => 'max:20|required',
          'tipo_documento_persona' => 'required'
        ];
    }
}
