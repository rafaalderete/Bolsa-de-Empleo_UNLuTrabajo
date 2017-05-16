<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Tipo_Software as Tipo_Software;
use App\Nivel_Conocimiento as Nivel_Conocimiento;

class StoreConocimientoInformaticoRequest extends Request
{
    const CAMPO_TIPO_SOFTWARE = 'Tipo Software';
    const CAMPO_NIVEL_CONOCIMIENTO = 'Nivel Conocimiento';
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
        $tipos_software = Tipo_Software::where('estado', 'activo')->get();

        $tipos_software_disponibles = 'required|in:'.$tipos_software[0]->id;
        for ($x = 1; $x < sizeof($tipos_software); $x++) {
            $tipos_software_disponibles = $tipos_software_disponibles.','.$tipos_software[$x]->id;
        }

        $niveles_conocimientos = Nivel_Conocimiento::where('estado', 'activo')->get();

        $niveles_conocimientos_disponibles = 'required|in:'.$niveles_conocimientos[0]->id;
        for ($x = 1; $x < sizeof($niveles_conocimientos); $x++) {
            $niveles_conocimientos_disponibles = $niveles_conocimientos_disponibles.','.$niveles_conocimientos[$x]->id;
        }
        return [
            'tipo_software' => $tipos_software_disponibles,
            'nivel_conocicmiento' => $niveles_conocimientos_disponibles
        ];
    }

    public function messages()
    {
        return [
            'tipo_software.in' => 'Datos invalidos para el campo '.self::CAMPO_TIPO_SOFTWARE.'.',
            'nivel_conocicmiento.in' => 'Datos invalidos para el campo '.self::CAMPO_NIVEL_CONOCIMIENTO.'.'
        ];
    }
}
