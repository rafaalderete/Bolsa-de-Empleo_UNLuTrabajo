<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Tipo_Trabajo as Tipo_Trabajo;
use App\Tipo_Jornada as Tipo_Jornada;
use App\Tipo_Conocimiento_Idioma as Tipo_Conocimiento_Idioma;
use App\Nivel_Conocimiento as Nivel_Conocimiento;
use App\Estado_Carrera as Estado_Carrera;
use App\Idioma as Idioma;
use App\Carrera as Carrera;

class StoreUpdatePropuestaLaboralRequest extends Request
{

  const CAMPO_TITULO = 'Titulo de la Propuesta';
  const CAMPO_DESCRIPCION = 'Descripción de la Propuesta';
  const CAMPO_LUGAR_TRABAJO = 'Lugar de Trabajo';
  const CAMPO_TIPO_TRABAJO = 'Tipo de Trabajo';
  const CAMPO_TIPO_JORNADA = 'Tipo de Jornada';
  const CAMPO_VACANTES = 'Vacantes';
  const CAMPO_FECHA_FIN = 'Fecha Finalización Propuesta';
  const CAMPO_AÑOS_EXP = 'Años de Experiencia';
  const CAMPO_REQ_LUGAR = 'Lugar de Residencia';
  const CAMPO_REQ_IDIOMA = 'Idioma';
  const CAMPO_REQ_TIPO_CONOCIMIENTO_IDIOMA = 'Tipo Conocimiento';
  const CAMPO_REQ_NIVEL_CONOCIMIENTO_IDIOMA = 'Nivel Requisito Idioma';
  const CAMPO_REQ_CARRERA = 'Carrera';
  const CAMPO_REQ_ESTADO_CARRERA = 'Estado Carrera';
  const CAMPO_REQ_ADICIONAL = 'Nombre Requisito';
  const CAMPO_REQ_NIVEL_CONOCIMIENTO_ADICIONAL = 'Nivel Requisito Adicional';


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

    $tipos_trabajo = Tipo_Trabajo::where('estado', 'activo')
      ->get();

    $tipos_jornada = Tipo_Jornada::where('estado', 'activo')
      ->get();

    $idiomas = Idioma::where('estado', 'activo')
      ->get();

    $tipos_conocimiento = Tipo_Conocimiento_Idioma::where('estado', 'activo')
      ->get();

    $niveles_conocimiento = Nivel_Conocimiento::where('estado', 'activo')
      ->get();

    $carreras = Carrera::get();

    $estados_carrera = Estado_Carrera::where('estado', 'activo')
      ->get();

    $trabajos_disponibles = 'required|in:'.$tipos_trabajo[0]->id;
    for ($x = 1; $x < sizeof($tipos_trabajo); $x++) {
        $trabajos_disponibles = $trabajos_disponibles.','.$tipos_trabajo[$x]->id;
    }

    $jornadas_disponibles = 'required|in:'.$tipos_jornada[0]->id;
    for ($y = 1; $y < sizeof($tipos_jornada); $y++) {
        $jornadas_disponibles = $jornadas_disponibles.','.$tipos_jornada[$y]->id;
    }

    $idiomas_disponibles = 'array|in:'.$idiomas[0]->id;
    for ($y = 1; $y < sizeof($idiomas); $y++) {
        $idiomas_disponibles = $idiomas_disponibles.','.$idiomas[$y]->id;
    }

    $tipos_conocimiento_disponibles = 'array|in:'.$tipos_conocimiento[0]->id;
    for ($y = 1; $y < sizeof($tipos_conocimiento); $y++) {
        $tipos_conocimiento_disponibles = $tipos_conocimiento_disponibles.','.$tipos_conocimiento[$y]->id;
    }

    $niveles_disponibles = 'array|in:'.$niveles_conocimiento[0]->id;
    for ($y = 1; $y < sizeof($niveles_conocimiento); $y++) {
        $niveles_disponibles = $niveles_disponibles.','.$niveles_conocimiento[$y]->id;
    }

    $carreras_disponibles = 'array|in:'.$carreras[0]->id;
    for ($y = 1; $y < sizeof($carreras); $y++) {
        $carreras_disponibles = $carreras_disponibles.','.$carreras[$y]->id;
    }

    $estados_carrera_disponibles = 'array|in:'.$estados_carrera[0]->id;
    for ($y = 1; $y < sizeof($estados_carrera); $y++) {
        $estados_carrera_disponibles = $estados_carrera_disponibles.','.$estados_carrera[$y]->id;
    }

    return [
        'titulo' => 'required',
        'descripcion' => 'required',
        'lugar_de_trabajo' => 'required',
        'tipo_trabajo_id' => $trabajos_disponibles,
        'tipo_jornada_id' => $jornadas_disponibles,
        'vacantes' => 'integer|min:1|required',
        'fecha_fin_propuesta' => 'required|date_format:d-m-Y',
        'requisito_años_experiencia_laboral' => 'integer|min:0',
        'lugar' => 'array',
        'idioma' => $idiomas_disponibles,
        'tipo_conocimiento_idioma' => $tipos_conocimiento_disponibles,
        'nivel_conocimiento_idioma' => $niveles_disponibles,
        'carrera' => $carreras_disponibles,
        'estado_carrera' => $estados_carrera_disponibles,
        'nombre_requisito' => 'array',
        'nivel_conocimiento_adicional' => $niveles_disponibles
    ];
  }

  public function messages()
  {
    return [
        'tipo_trabajo_id.in' => 'Datos invalidos para el campo '.self::CAMPO_TIPO_TRABAJO.'.',
        'tipo_jornada_id.in' => 'Datos invalidos para el campo '.self::CAMPO_TIPO_JORNADA.'.',
        'vacantes.integer' => 'El campo '.self::CAMPO_VACANTES.' debe ser un número.',
        'vacantes.min' => 'El valor mínimo para el campo '.self::CAMPO_VACANTES.' es 1.',
        'fecha_fin_propuesta.date_format' => 'El campo '.self::CAMPO_FECHA_FIN.' debe ser una fecha válida.',
        'requisito_años_experiencia_laboral.integer' => 'El campo '.self::CAMPO_AÑOS_EXP.' debe ser un número.',
        'requisito_años_experiencia_laboral.min' => 'El valor mínimo para el campo '.self::CAMPO_AÑOS_EXP.' es 0.',
        'lugar.in' => 'Datos invalidos para el campo '.self::CAMPO_REQ_LUGAR.'.',
        'idioma.in' => 'Datos invalidos para el campo '.self::CAMPO_REQ_IDIOMA.'.',
        'tipo_conocimiento_idioma.in' => 'Datos invalidos para el campo '.self::CAMPO_REQ_TIPO_CONOCIMIENTO_IDIOMA.'.',
        'nivel_conocimiento_idioma.in' => 'Datos invalidos para el campo '.self::CAMPO_REQ_NIVEL_CONOCIMIENTO_IDIOMA.'.',
        'carrera.in' => 'Datos invalidos para el campo '.self::CAMPO_REQ_CARRERA.'.',
        'estado_carrera.in' => 'Datos invalidos para el campo '.self::CAMPO_REQ_ESTADO_CARRERA.'.',
        'nivel_conocimiento_adicional.in' => 'Datos invalidos para el campo '.self::CAMPO_REQ_NIVEL_CONOCIMIENTO_ADICIONAL.'.',
    ];
  }

}
