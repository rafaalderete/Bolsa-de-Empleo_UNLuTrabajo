<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateObjetivoLaboralRequest extends Request
{
     const CAMPO_CARTA = 'Carta de Presentación';
     const CAMPO_SUELDO = 'Sueldo Bruto Pretendido';
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
            'carta_presentacion' => 'max:1000',
            'sueldo_bruto_pretendido' => 'numeric|min:0'
        ];
    }

    public function messages()
    {
      return [
        'carta_presentacion.max' => 'El campo '.self::CAMPO_CARTA.' debe contener como máximo 500 caracteres.',
        'sueldo_bruto_pretendido.numeric' => 'El campo '.self::CAMPO_SUELDO.' debe ser numerico.',
        'sueldo_bruto_pretendido.min' => 'El campo '.self::CAMPO_SUELDO.' debe ser mayor o igual a 0.',
      ];
    }
}
