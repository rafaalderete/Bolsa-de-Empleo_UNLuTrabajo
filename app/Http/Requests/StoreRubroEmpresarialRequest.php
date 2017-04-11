<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreRubroEmpresarialRequest extends Request
{

    const CAMPO_NOMBRE = 'Nombre Rubro Empresarial';

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
          'nombre_rubro_empresarial' => 'min:4|required|unique:rubros_empresariales'
      ];
    }

    public function messages()
    {
      return [
        'nombre_rubro_empresarial.min' => 'El campo '.self::CAMPO_NOMBRE.' debe contener al menos 4 caracteres.',
        'nombre_rubro_empresarial.unique' => 'El elemento '.self::CAMPO_NOMBRE.' ya está en uso.',
      ];
    }

}
