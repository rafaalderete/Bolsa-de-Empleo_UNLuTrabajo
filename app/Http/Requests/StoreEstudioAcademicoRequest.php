<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Estado_Carrera as Estado_Carrera;
use App\Nivel_Educativo as Nivel_Educativo;

class StoreEstudioAcademicoRequest extends Request
{
    const CAMPO_CARRERA = 'Carrera';
    const CAMPO_NOMBRE_INSTITUTO = 'Instituto';
    const CAMPO_MATERIAS_TOTAL = 'Materias Total';
    const CAMPO_MATERIAS_APROBADAS = 'Materias Aprobadas';
    const CAMPO_NIVEL_EDUCATIVO = 'Nivel educativo';
    const CAMPO_ESTADO_CARRERA = 'Estado carrera';
    const CAMPO_PERIODO_INICIO = ' Periodo Inicio';
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
        $estados_carrera = Estado_Carrera::where('estado', 'activo')
            ->get();

        $estados_carrera_disponibles = 'required|in:'.$estados_carrera[0]->id;
        for ($y = 1; $y < sizeof($estados_carrera); $y++) {
            $estados_carrera_disponibles = $estados_carrera_disponibles.','.$estados_carrera[$y]->id;
        }

        $niveles_educativos = Nivel_Educativo::where('estado', 'activo')
            ->get();
        
        $niveles_educativos_disponibles = 'required|in:'.$niveles_educativos[0]->id;
        for ($y = 1; $y < sizeof($niveles_educativos); $y++) {
            $niveles_educativos_disponibles = $niveles_educativos_disponibles.','.$niveles_educativos[$y]->id;
        }

        return [
            'titulo' => 'required|max:50',
            'nombre_instituto' => 'required|max:50',
            'materias_total' => 'required|min:0',
            'materias_aprobadas' => 'required|min:0', 
            'nivel_educativo' => $niveles_educativos_disponibles,
            'estados_carrera' => $estados_carrera_disponibles,
            'periodo_inicio' => 'required|date_format:d-m-Y',
            'periodo_fin' => 'date_format:d-m-Y'
        ];
    }

    public function messages()
  {
    return [
        'titulo.max' => 'El campo '. self::CAMPO_CARRERA .' no puede tener más de 50 caracteres.',
        'nombre_instituto.max' => 'El campo ' . self::CAMPO_NOMBRE_INSTITUTO . ' no puede tener más de 50 caracteres.',
        'materias_total.min' => 'El campo ' . self::CAMPO_MATERIAS_TOTAL . ' no puede ser negativo.',
        'materias_aprobadas.min' => 'El campo ' . self::CAMPO_MATERIAS_APROBADAS . ' no puede ser negativo.',
        'periodo_inicio.date_format' => 'El campo '. self::CAMPO_PERIODO_INICIO .' debe ser una fecha válida.',
        'periodo_fin.date_format' => 'El campo '.self::CAMPO_PERIODO_FIN.' debe ser una fecha válida.',
        'nivel_educativo.in' => 'Datos invalidos para el campo '. self::CAMPO_NIVEL_EDUCATIVO .'.',
        'estados_carrera.in' => 'Datos invalidos para el campo '. self::CAMPO_ESTADO_CARRERA .'.'
    ];
  }
}
