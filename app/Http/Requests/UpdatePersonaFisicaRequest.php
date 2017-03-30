<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class UpdatePersonaFisicaRequest extends Request
{

    const CAMPO_NOMBRE = 'Nombre';
    const CAMPO_APELLIDO = 'Apellido';
    const CAMPO_FECHA_NACIMIENTO = 'Fecha Nacimiento';
    const CAMPO_TIPO_DOCUMENTO = 'Tipo Documento';
    const CAMPO_NRO_DOCUMENTO = 'N° Documento';
    const CAMPO_CUIL = 'Cuil';
    const CAMPO_DOMICILIO = 'Domicilio';
    const CAMPO_LOCALIDAD = 'Localidad';
    const CAMPO_Provincia = 'Provincia';
    const CAMPO_PAIS = 'Pais';
    const CAMPO_TELEFONO1 = 'Telefono Fijo';
    const CAMPO_TELEFONO2 = 'Telefono Celular';
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
        'fecha_nacimiento' => 'required|date_format:d-m-Y',
        'nro_documento' => 'min:5|max:12|required|unique:fisicas,nro_documento,'.$this->route->getParameter('personas'),
        'cuil' => 'min:8|max:15|required|unique:fisicas,cuil,'.$this->route->getParameter('personas'),
        'telefono_fijo' => 'max:20',
        'telefono_celular' => 'max:20',
        'tipo_documento' => 'required|exists:tipos_documento,id'
      ];
    }

    public function messages()
    {
      return [
          'nombre_persona.min' => 'El campo '.self::CAMPO_NOMBRE.' debe contener al menos 4 caracteres.',
          'nombre_persona.max' => 'El campo '.self::CAMPO_NOMBRE.' debe contener 20 caracteres como máximo.',
          'apellido_persona.min' => 'El campo '.self::CAMPO_APELLIDO.' debe contener al menos 4 caracteres.',
          'apellido_persona.max' => 'El campo '.self::CAMPO_APELLIDO.' debe contener 20 caracteres como máximo.',
          'fecha_nacimiento.date_format' => 'El campo '.self::CAMPO_FECHA_NACIMIENTO.' debe ser una fecha válida.',
          'tipo_documento.exists' => 'Datos invalidos para el campo '.self::CAMPO_TIPO_DOCUMENTO,
          'nro_documento.min' => 'El campo '.self::CAMPO_NRO_DOCUMENTO.' debe contener al menos 5 caracteres.',
          'nro_documento.max' => 'El campo '.self::CAMPO_NRO_DOCUMENTO.' debe contener 12 caracteres como máximo.',
          'nro_documento.unique' => 'El elemento '.self::CAMPO_NRO_DOCUMENTO.' ya está en uso.',
          'cuil.min' => 'El campo '.self::CAMPO_CUIL.' debe contener al menos 8 caracteres.',
          'cuil.max' => 'El campo '.self::CAMPO_CUIL.' debe contener 15 caracteres como máximo.',
          'cuil.unique' => 'El elemento '.self::CAMPO_CUIL.' ya está en uso.',
          'telefono_fijo.max' => 'El campo '.self::CAMPO_TELEFONO1.' debe contener 20 caracteres como máximo.',
          'telefono_celular.max' => 'El campo '.self::CAMPO_TELEFONO2.' debe contener 20 caracteres como máximo.'
      ];
    }
}
