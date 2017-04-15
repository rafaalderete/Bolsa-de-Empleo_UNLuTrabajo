<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisito_Idioma extends Model
{

    protected $table = "requisitos_idioma";
    protected $fillable = ['id','propuesta_laboral_id','idioma_id','tipo_conocimiento_idioma_id',
                            'nivel_conocimiento_id','excluyente'];

    public function propuestaLaboral(){
      return $this->belongsTo('App\Propuesta_Laboral');
    }

    public function idioma(){
      return $this->belongsTo('App\Idioma');
    }

    public function tipoConocimientoIdioma(){
      return $this->belongsTo('App\Tipo_Conocimiento_Idioma');
    }

    public function nivelConocimiento(){
      return $this->belongsTo('App\Nivel_Conocimiento');
    }

}
