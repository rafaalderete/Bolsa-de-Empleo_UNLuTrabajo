<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Idioma as Idioma;
use App\Tipo_Conocimiento_Idioma as Tipo_Conocimiento_Idioma;
use App\Nivel_Conocimiento as Nivel_Conocimiento;

class StoreConocimientoIdiomaRequest extends Request
{
    const CAMPO_IDIOMA = 'Idioma';
    const CAMPO_TIPO_CONOCIMIENTO = 'Tipo Conocimiento';
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
        $idiomas = Idioma::where('estado', 'activo')->get();

        $idiomas_disponibles = 'required|in:'.$idiomas[0]->id;
        for ($x = 1; $x < sizeof($idiomas); $x++) {
            $idiomas_disponibles = $idiomas_disponibles.','.$idiomas[$x]->id;
        }

        $tipos_conocimientos = Tipo_Conocimiento_Idioma::where('estado', 'activo')->get();

        $tipos_conocimientos_disponibles = 'required|in:'.$tipos_conocimientos[0]->id;
        for ($x = 1; $x < sizeof($tipos_conocimientos); $x++) {
            $tipos_conocimientos_disponibles = $tipos_conocimientos_disponibles.','.$tipos_conocimientos[$x]->id;
        }

        $niveles_conocimientos = Nivel_Conocimiento::where('estado', 'activo')->get();

        $niveles_conocimientos_disponibles = 'required|in:'.$niveles_conocimientos[0]->id;
        for ($x = 1; $x < sizeof($niveles_conocimientos); $x++) {
            $niveles_conocimientos_disponibles = $niveles_conocimientos_disponibles.','.$niveles_conocimientos[$x]->id;
        }
        return [
            'idioma' => $idiomas_disponibles,
            'tipo_conocimiento_idioma' => $tipos_conocimientos_disponibles,
            'nivel_conocimiento' => $niveles_conocimientos_disponibles
        ];
    }

    public function messages()
    {
        return [
            'idioma.in' => 'Datos invalidos para el campo '.self::CAMPO_IDIOMA.'.',
            'tipo_conocimiento_idioma.in' => 'Datos invalidos para el campo '.self::CAMPO_TIPO_CONOCIMIENTO.'.',
            'nivel_conocimiento.in' => 'Datos invalidos para el campo '.self::CAMPO_NIVEL_CONOCIMIENTO.'.'

        ];
    }
}
