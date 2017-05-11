<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class UpdateTipoDocumentoRequest extends Request
{

    const CAMPO_NOMBRE = 'Nombre Tipo Documento';
    const CAMPO_ESTADO = 'Estado';
    private $route;

    public function __construct(Route $route) {

      $this->route = $route;

    }
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
          'nombre_tipo_documento' => 'min:4|required|unique:tipos_documento,nombre_tipo_documento,'.$this->route->getParameter('tipo_software'),
          'estado'=> 'required|in:activo,inactivo'
      ];
    }

    public function messages()
    {
      return [
        'nombre_tipo_documento.min' => 'El campo '.self::CAMPO_NOMBRE.' debe contener al menos 4 caracteres.',
        'nombre_tipo_documento.unique' => 'El elemento '.self::CAMPO_NOMBRE.' ya está en uso.',
        'estado.in' => 'Datos invalidos para el campo '.self::CAMPO_ESTADO.'.',
      ];
    }
}