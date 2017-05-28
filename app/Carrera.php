<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{

    protected $table = "carreras";
    protected $fillable = ['id','nombre_carrera','total_materias'];

    public function estudiantes(){
      return $this->hasMany('App\Estudiante');
    }

    public function requisitosCarrera(){
      return $this->hasMany('App\Requisito_Carrera');
    }

}
