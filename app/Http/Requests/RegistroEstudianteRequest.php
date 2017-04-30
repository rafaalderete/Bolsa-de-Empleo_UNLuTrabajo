<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistroEstudianteRequest extends Request
{

    const CAMPO_NOMBRE = 'Nombre';
    const CAMPO_APELLIDO = 'Apellido';
    const CAMPO_LEGAJO = 'Legajo';
    const CAMPO_TIPO_DOCUMENTO = 'Tipo Documento';
    const CAMPO_NRO_DOCUMENTO = 'N° Documento';
    const CAMPO_USUARIO = 'Nombre Usuario';
    const CAMPO_EMAIL = 'E-mail';
    const CAMPO_PASSWORD = 'Contraseña';

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
        'legajo' => 'required',
        'nro_documento' => 'min:5|max:12|required',
        'tipo_documento' => 'required|exists:tipos_documento,id',
        'email' => 'email|required|unique:usuarios',
        'nombre_usuario' => 'min:4|max:20|required|unique:usuarios',
        'password' => 'required|confirmed|min:6'
      ];
    }

    public function messages()
    {
      return [
        'nombre_persona.min' => 'El campo '.self::CAMPO_NOMBRE.' debe contener al menos 4 caracteres.',
        'nombre_persona.max' => 'El campo '.self::CAMPO_NOMBRE.' debe contener 20 caracteres como máximo.',
        'apellido_persona.min' => 'El campo '.self::CAMPO_APELLIDO.' debe contener al menos 4 caracteres.',
        'apellido_persona.max' => 'El campo '.self::CAMPO_APELLIDO.' debe contener 20 caracteres como máximo.',
        'tipo_documento.exists' => 'Datos invalidos para el campo '.self::CAMPO_TIPO_DOCUMENTO.'.',
        'nro_documento.min' => 'El campo '.self::CAMPO_NRO_DOCUMENTO.' debe contener al menos 5 caracteres.',
        'nro_documento.max' => 'El campo '.self::CAMPO_NRO_DOCUMENTO.' debe contener 12 caracteres como máximo.',
        'email.unique' => 'El elemento '.self::CAMPO_EMAIL.' ya está en uso.',
        'email.email' => 'El campo '.self::CAMPO_EMAIL.' no corresponde con una dirección de e-mail válida.',
        'nombre_usuario.min' => 'El campo '.self::CAMPO_USUARIO.' debe contener al menos 4 caracteres.',
        'nombre_usuario.max' => 'El campo '.self::CAMPO_USUARIO.' debe contener 20 caracteres como máximo.',
        'nombre_usuario.unique' => 'El elemento '.self::CAMPO_USUARIO.' ya está en uso.',
        'password.min' => 'El campo '.self::CAMPO_PASSWORD.' debe contener al menos 4 caracteres.',
        'password.confirmed' => 'La contraseña debe coincidir con la confirmación.'
      ];
    }
}
