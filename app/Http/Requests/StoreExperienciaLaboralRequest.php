<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Rubro_Empresarial as Rubro_Empresarial;

class StoreExperienciaLaboralRequest extends Request
{
    const CAMPO_NOMBRE_EMPRESA = 'Nombre Empresa';
    const CAMPO_PUESTO = 'Puesto';
    const CAMPO_DESCRIPCION_TAREA = 'Tareas';
    const CAMPO_RUBRO_EMPRESARIAL = 'Rubro Empresarial';
    const CAMPO_PERIODO_INICIO = 'Periodo Inicio';
    const CAMPO_PERIODO_FIN = 'Periodo Fin';

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
        $rubro_empresariales = Rubro_Empresarial::where('estado', 'activo')->get();

        $rubro_empresariales_disponibles = 'required|in:'.$rubro_empresariales[0]->id;
        for ($x = 1; $x < sizeof($rubro_empresariales); $x++) {
            $rubro_empresariales_disponibles = $rubro_empresariales_disponibles.','.$rubro_empresariales[$x]->id;
        }

        return [
            'nombre_empresa' => 'required|max:50',
            'puesto' => 'required|max:70',
            'descripcion_tarea' => 'required|max:150',
            'rubro_empresarial' => $rubro_empresariales_disponibles,
            'periodo_inicio' => 'required|date_format:d-m-Y',
            'periodo_fin' => 'date_format:d-m-Y'

        ];
    }


    public function messages()
    {
        return [
            'nombre_empresa.max' => 'El campo '. self::CAMPO_NOMBRE_EMPRESA .' no puede tener más de 50 caracteres.',
            'puesto.max' => 'El campo '. self::CAMPO_PUESTO .' no puede tener más de 70 caracteres.',
            'descripcion_tarea.max' => 'El campo '. self::CAMPO_DESCRIPCION_TAREA .' no puede tener más de 70 caracteres.',
            'rubro_empresarial.in' => 'Datos invalidos para el campo '. self::CAMPO_RUBRO_EMPRESARIAL .'.',
            'periodo_inicio.date_format' => 'El campo '. self::CAMPO_PERIODO_INICIO .' debe ser una fecha válida.',
            'periodo_fin.date_format' => 'El campo '.self::CAMPO_PERIODO_FIN.' debe ser una fecha válida.'
        ];
    }
}
