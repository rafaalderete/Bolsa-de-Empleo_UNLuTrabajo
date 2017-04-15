<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisito_Adicional extends Model
{

    protected $table = "requisitos_adicionales";
    protected $fillable = ['id','propuesta_laboral_id','nombre_requisito','nivel_conocimiento_id',
                            'excluyente'];

    public function propuestaLaboral(){
      return $this->belongsTo('App\Propuesta_Laboral');
    }

    public function nivelConocimiento(){
      return $this->belongsTo('App\Nivel_Conocimiento');
    }

}
