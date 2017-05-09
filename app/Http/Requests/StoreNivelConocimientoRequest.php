<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreNivelConocimientoRequest extends Request
{

    const CAMPO_NOMBRE = 'Nombre Nivel Conocimiento';

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
          'nombre_nivel_conocimiento' => 'min:4|required|unique:niveles_conocimiento'
      ];
    }

    public function messages()
    {
      return [
        'nombre_nivel_conocimiento.min' => 'El campo '.self::CAMPO_NOMBRE.' debe contener al menos 4 caracteres.',
        'nombre_niveles_conocimiento.unique' => 'El elemento '.self::CAMPO_NOMBRE.' ya está en uso.',
      ];
    }

}
