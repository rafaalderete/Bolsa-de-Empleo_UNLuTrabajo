<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unlu_Carrera extends Model
{
  
    protected $table = "unlu_carreras";
    protected $fillable = ['id','nombre_carrera'];

    public function propuestasLaborales(){
      return $this->belongsToMany('App\Propuesta_Laboral');
    }

    public function unluEstudiantes(){
      return $this->hasMany('App\Unlu_Estudiante');
    }

}
