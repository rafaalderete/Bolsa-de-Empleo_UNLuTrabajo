<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Permission as Permiso;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class UpdateRolRequest extends Request
{

    const CAMPO_NOMBRE_ROL = 'Nombre Rol';
    const CAMPO_DESCRIPCION = 'Descripción Rol';
    const CAMPO_PERMISOS = 'Permisos';
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
      //Se traen los permisos disponibles para hacer las validaciones.
      if (Auth::user()->hasRole('super_usuario')) {
        $permisos = Permiso::where('estado_permiso', 'activo')
        ->get();
      }
      else {
        $permisos = Permiso::where('estado_permiso', 'activo')
        ->where('name','<>','crear_permiso')
        ->where('name','<>','eliminar_permiso')
        ->where('name','<>','modificar_permiso')
        ->get();
      }

      $permisos_disponibles = 'array|in:'.$permisos[0]->id;
      for ($x = 1; $x < sizeof($permisos); $x++) {
          $permisos_disponibles = $permisos_disponibles.','.$permisos[$x]->id;
      }

      return [
          'name' => 'min:4|max:20|required|unique:roles,name,'.$this->route->getParameter('roles'),
          'descripcion_rol' => 'required',
          'permisos' => $permisos_disponibles,
          'estado_rol'=> 'required|in:activo,inactivo'
      ];
    }

    public function messages()
    {
      return [
          'name.min' => 'El campo '.self::CAMPO_NOMBRE_ROL.' debe contener al menos 4 caracteres.',
          'name.max' => 'El campo '.self::CAMPO_NOMBRE_ROL.' debe contener 20 caracteres como máximo.',
          'name.unique' => 'El elemento '.self::CAMPO_NOMBRE_ROL.' ya está en uso.',
          'permisos.in' => 'Datos invalidos para el campo '.self::CAMPO_PERMISOS,
          'estado_rol.in' => 'Datos invalidos para el campo '.self::CAMPO_ESTADO,
      ];
    }

}
