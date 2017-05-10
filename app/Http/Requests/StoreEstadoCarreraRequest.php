<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreEstadoCarreraRequest extends Request
{

    const CAMPO_NOMBRE = 'Nombre Estado Carrera';

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
          'nombre_estado_carrera' => 'min:4|required|unique:estados_carrera'
      ];
    }

    public function messages()
    {
      return [
        'nombre_estado_carrera.min' => 'El campo '.self::CAMPO_NOMBRE.' debe contener al menos 4 caracteres.',
        'nombre_estado_carrera.unique' => 'El elemento '.self::CAMPO_NOMBRE.' ya está en uso.',
      ];
    }

}
