<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreNivelEducativoRequest extends Request
{

    const CAMPO_NOMBRE = 'Nombre Nivel Educativo';

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
          'nombre_nivel_educativo' => 'min:4|required|unique:niveles_educativos'
      ];
    }

    public function messages()
    {
      return [
        'nombre_nivel_educativo.min' => 'El campo '.self::CAMPO_NOMBRE.' debe contener al menos 4 caracteres.',
        'nombre_nivel_educativo.unique' => 'El elemento '.self::CAMPO_NOMBRE.' ya está en uso.',
      ];
    }

}
