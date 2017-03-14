<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StorePermisoRequest extends Request
{

    const CAMPO_NOMBRE = 'Nombre Permiso';
    const CAMPO_FUNCIONALIDAD = 'Funcionalidad Permiso';

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
          'name' => 'min:4|max:20|required|unique:permissions',
          'funcionalidad_permiso' => 'required'
      ];
    }

    public function messages()
    {
      return [
          'name.min' => 'El campo '.self::CAMPO_NOMBRE.' debe contener al menos 4 caracteres.',
          'name.max' => 'El campo '.self::CAMPO_NOMBRE.' debe contener 20 caracteres como máximo.',
          'name.unique' => 'El elemento '.self::CAMPO_NOMBRE.' ya está en uso.',
      ];
    }

}
