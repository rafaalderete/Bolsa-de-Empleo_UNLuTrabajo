<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_Carrera extends Model
{

    protected $table = "estados_carrera";
    protected $fillable = ['id','nombre_estado_carrera','estado'];

    public function estudiosAcademicos(){
      return $this->hasMany('App\Estudio_Academico');
    }

}
