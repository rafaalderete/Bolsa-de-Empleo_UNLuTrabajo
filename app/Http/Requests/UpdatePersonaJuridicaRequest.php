<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class UpdatePersonaJuridicaRequest extends Request
{

    const CAMPO_NOMBRE = 'Nombre Comercial';
    const CAMPO_FECHA_FUNDACION = 'Fecha Fundacion';
    const CAMPO_RUBRO = 'Rubro Empresarial';
    const CAMPO_CUIT = 'Cuit';
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
        'nombre_comercial' => 'min:4|max:20|required',
        'fecha_fundacion' => 'required|date_format:d-m-Y',
        'rubro_empresarial' => 'required|exists:rubros_empresariales,id',
        'cuit' => 'required|min:11|max:11|unique:juridicas,cuit,'.$this->route->getParameter('empresas'),
        'telefono_fijo' => 'max:20',
        'telefono_celular' => 'max:20',
      ];
    }

    public function messages()
    {
      return [
        'nombre_comercial.min' => 'El campo '.self::CAMPO_NOMBRE.' debe contener al menos 4 caracteres.',
        'nombre_comercial.max' => 'El campo '.self::CAMPO_NOMBRE.' debe contener 20 caracteres como máximo.',
        'fecha_fundacion.date_format' => 'El campo '.self::CAMPO_FECHA_FUNDACION.' debe ser una fecha válida.',
        'rubro_empresarial.exists' => 'Datos invalidos para el campo '.self::CAMPO_RUBRO,
        'cuit.min' => 'El campo '.self::CAMPO_CUIT.' debe contener 11 caracteres.',
        'cuit.max' => 'El campo '.self::CAMPO_CUIT.' debe contener 11 caracteres.',
        'cuit.unique' => 'El elemento '.self::CAMPO_CUIT.' ya está en uso.',
        'telefono_fijo.max' => 'El campo '.self::CAMPO_TELEFONO1.' debe contener 20 caracteres como máximo.',
        'telefono_celular.max' => 'El campo '.self::CAMPO_TELEFONO2.' debe contener 20 caracteres como máximo.'
      ];
    }
}
