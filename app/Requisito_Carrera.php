<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisito_Carrera extends Model
{

    protected $table = "requisitos_carrera";
    protected $fillable = ['id','propuesta_laboral_id','carrera_id','estado_carrera_id',
                            'excluyente'];

    public function propuestaLaboral(){
      return $this->belongsTo('App\Propuesta_Laboral');
    }

    public function carrera(){
      return $this->belongsTo('App\Carrera');
    }

    public function estadoCarrera(){
      return $this->belongsTo('App\Estado_Carrera');
    }

}
