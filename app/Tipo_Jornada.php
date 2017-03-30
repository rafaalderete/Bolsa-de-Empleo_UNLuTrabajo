<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Jornada extends Model
{

    protected $table = "tipos_jornada";
    protected $fillable = ['id','nombre_tipo_jornada'];

    public function propuestasLaborales(){
      return $this->hasMany('App\Propuesta_Laboral');
    }

}
