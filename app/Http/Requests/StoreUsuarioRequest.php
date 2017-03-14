<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Persona as Persona;
use App\Role as Rol;

class StoreUsuarioRequest extends Request
{

    const CAMPO_NOMBRE = 'Nombre Permiso';
    const CAMPO_PERSONA = 'Persona';
    const CAMPO_EMAIL = 'E-mail';
    const CAMPO_PASSWORD = 'Contraseña';
    const CAMPO_ROLES = 'Roles';

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
      $roles = Rol::all()->where('estado_rol', 'activo');
      $personas = Persona::all()->where('estado_persona', 'activo');

      $roles_disponibles = 'in:'.$roles[0]->id;
      for ($x = 1; $x < sizeof($roles); $x++) {
          $roles_disponibles = $roles_disponibles.','.$roles[$x]->id;
      }

      $personas_disponibles = 'required|in:'.$personas[0]->id;
      for ($y = 1; $y < sizeof($personas); $y++) {
          $personas_disponibles = $personas_disponibles.','.$personas[$y]->id;
      }

      return [
          'password' => 'min:6|max:20|required',
          'persona_id' => $personas_disponibles,
          'roles[]' => $roles_disponibles,
          'email' => 'min:4|max:20|email|required|unique:usuarios',
          'nombre_usuario' => 'min:4|max:20|required|unique:usuarios',
      ];
    }

    public function messages()
    {
      return [
          'nombre_usuario.min' => 'El campo '.self::CAMPO_NOMBRE.' debe contener al menos 4 caracteres.',
          'nombre_usuario.max' => 'El campo '.self::CAMPO_NOMBRE.' debe contener 20 caracteres como máximo.',
          'nombre_usuario.unique' => 'El elemento '.self::CAMPO_NOMBRE.' ya está en uso.',
          'email.min' => 'El campo '.self::CAMPO_EMAIL.' debe contener al menos 4 caracteres.',
          'email.max' => 'El campo '.self::CAMPO_EMAIL.' debe contener 20 caracteres como máximo.',
          'email.unique' => 'El elemento '.self::CAMPO_EMAIL.' ya está en uso.',
          'email.email' => 'El campo '.self::CAMPO_EMAIL.' no corresponde con una dirección de e-mail válida.',
          'password.min' => 'El campo '.self::CAMPO_PASSWORD.' debe contener al menos 6 caracteres.',
          'password.max' => 'El campo '.self::CAMPO_PASSWORD.' debe contener 20 caracteres como máximo.',
          'roles[].in' => 'Datos invalidos para el campo '.self::CAMPO_ROLES,
          'persona_id.in' => 'Datos invalidos para el campo '.self::CAMPO_PERSONA,
      ];
    }

}
