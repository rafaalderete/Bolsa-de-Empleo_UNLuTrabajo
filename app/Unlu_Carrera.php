<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unlu_Carrera extends Model
{

    protected $table = "unlu_carreras";
    protected $fillable = ['id','nombre_unlu_carrera'];

    public function unluEstudiantes(){
      return $this->hasMany('App\Unlu_Estudiante');
    }

}
