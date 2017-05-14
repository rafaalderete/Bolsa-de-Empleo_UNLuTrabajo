<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreConocimientoAdicionalRequest extends Request
{
    const CAMPO_NOMBRE_CONOCIMIENTO = 'Nombre Conocimiento';
    const CAMPO_DESCRIPCION_CONOCIMIENTO = 'Descripcion Conocimiento';
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
            'nombre_conocimiento' => 'required|max:70',
            'descripcion_conocimiento' => 'required|max:150'
        ];
    }

    public function messages()
    {
        return [
            'nombre_conocimiento.max' => 'El campo '. self::CAMPO_NOMBRE_CONOCIMIENTO .' no puede tener más de 70 caracteres.',
            'descripcion_conocimiento.max' => 'El campo ' . self::CAMPO_DESCRIPCION_CONOCIMIENTO . ' no puede tener más de 150 caracteres.',
        ];
    }
}
