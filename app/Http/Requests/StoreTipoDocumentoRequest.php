<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreTipoDocumentoRequest extends Request
{

    const CAMPO_NOMBRE = 'Nombre Tipo Documento';

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
          'nombre_tipo_documento' => 'min:2|required|unique:tipos_documento'
      ];
    }

    public function messages()
    {
      return [
        'nombre_tipo_documento.min' => 'El campo '.self::CAMPO_NOMBRE.' debe contener al menos 2 caracteres.',
        'nombre_tipo_documento.unique' => 'El elemento '.self::CAMPO_NOMBRE.' ya está en uso.',
      ];
    }

}
