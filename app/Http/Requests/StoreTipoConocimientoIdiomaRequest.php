<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreTipoConocimientoIdiomaRequest extends Request
{

    const CAMPO_NOMBRE = 'Nombre Tipo Conocmiento Idioma';

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
          'nombre_tipo_conocimiento_idioma' => 'min:4|required|unique:tipos_conocimiento_idioma'
      ];
    }

    public function messages()
    {
      return [
        'nombre_tipo_conocimiento_idioma.min' => 'El campo '.self::CAMPO_NOMBRE.' debe contener al menos 4 caracteres.',
        'nombre_tipo_conocimiento_idioma.unique' => 'El elemento '.self::CAMPO_NOMBRE.' ya está en uso.',
      ];
    }

}
