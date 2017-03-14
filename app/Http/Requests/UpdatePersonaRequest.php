<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class UpdatePersonaRequest extends Request
{

    const CAMPO_NOMBRE = 'Nombre';
    const CAMPO_APELLIDO = 'Apellido';
    const CAMPO_FECHA_NACIMIENTO = 'Fecha Nacimiento';
    const CAMPO_TIPO_DOCUMENTO = 'Tipo Documento';
    const CAMPO_NRO_DOCUMENTO = 'Documento';
    const CAMPO_DOMICILIO = 'Domicilio';
    const CAMPO_LOCALIDAD = 'Localidad';
    const CAMPO_Provincia = 'Provincia';
    const CAMPO_PAIS = 'Pais';
    const CAMPO_TELEFONO = 'Telefono';
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
        'nombre_persona' => 'min:4|max:20|required',
        'apellido_persona' => 'min:4|max:20|required',
        'domicilio_residencia_persona' => 'max:30|required',
        'fecha_nacimiento_persona' => 'required|date',
        'nro_documento_persona' => 'min:5|max:12|required|unique:personas,nro_documento_persona,'.$this->route->getParameter('personas'),
        'telefono_contacto_persona' => 'max:20|required',
        'tipo_documento_persona' => 'required|in:DNI,LC,CI'
      ];
    }
    
    public function messages()
    {
      return [
          'nombre_persona.min' => 'El campo '.self::CAMPO_NOMBRE.' debe contener al menos 4 caracteres.',
          'nombre_persona.max' => 'El campo '.self::CAMPO_NOMBRE.' debe contener 20 caracteres como máximo.',
          'apellido_persona.min' => 'El campo '.self::CAMPO_APELLIDO.' debe contener al menos 4 caracteres.',
          'apeliido_persona.max' => 'El campo '.self::CAMPO_APELLIDO.' debe contener 20 caracteres como máximo.',
          'fecha_nacimiento_persona.date' => 'El campo '.self::CAMPO_FECHA_NACIMIENTO.' debe ser una fecha válida.',
          'tipo_documento_persona.in' => 'Datos invalidos para el campo '.self::CAMPO_TIPO_DOCUMENTO,
          'nro_documento_persona.min' => 'El campo '.self::CAMPO_NRO_DOCUMENTO.' debe contener al menos 5 caracteres.',
          'nro_documento_persona.max' => 'El campo '.self::CAMPO_NRO_DOCUMENTO.' debe contener 12 caracteres como máximo.',
          'nro_documento_persona.unique' => 'El elemento '.self::CAMPO_NRO_DOCUMENTO.' ya está en uso.',
          'telefono_contacto_persona.max' => 'El campo '.self::CAMPO_TELEFONO.' debe contener 20 caracteres como máximo.',
      ];
    }
}
