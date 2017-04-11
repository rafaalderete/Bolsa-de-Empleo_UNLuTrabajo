<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Trabajo extends Model
{

    protected $table = "tipos_trabajo";
    protected $fillable = ['id','nombre_tipo_trabajo','estado'];

    public function propuestasLaborales(){
      return $this->hasMany('App\Propuesta_Laboral');
    }

}
