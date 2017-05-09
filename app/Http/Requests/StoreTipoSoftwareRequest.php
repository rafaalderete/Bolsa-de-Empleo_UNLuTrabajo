<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreTipoSoftwareRequest extends Request
{

    const CAMPO_NOMBRE = 'Nombre Tipo_Software';

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
          'nombre_tipo_software' => 'min:4|required|unique:tipo_software'
      ];
    }

    public function messages()
    {
      return [
        'nombre_tipo_software.min' => 'El campo '.self::CAMPO_NOMBRE.' debe contener al menos 4 caracteres.',
        'nombre_tipo_software.unique' => 'El elemento '.self::CAMPO_NOMBRE.' ya está en uso.',
      ];
    }

}

