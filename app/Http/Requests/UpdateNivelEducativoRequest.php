<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class UpdateNivelEducativoRequest extends Request
{

    const CAMPO_NOMBRE = 'Nombre Nivel Educativo';
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
          'nombre_nivel_educativo' => 'min:4|required|unique:niveles_educativos,nombre_nivel_educativo,'.$this->route->getParameter('nivel_educativo'),
          'estado'=> 'required|in:activo,inactivo'
      ];
    }

    public function messages()
    {
      return [
        'nombre_nivel_educativo.min' => 'El campo '.self::CAMPO_NOMBRE.' debe contener al menos 4 caracteres.',
        'nombre_nivel_educativo.unique' => 'El elemento '.self::CAMPO_NOMBRE.' ya está en uso.',
        'estado.in' => 'Datos invalidos para el campo '.self::CAMPO_ESTADO.'.',
      ];
    }
}
