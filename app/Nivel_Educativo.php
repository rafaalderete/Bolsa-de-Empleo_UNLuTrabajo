<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel_Educativo extends Model
{

    protected $table = "niveles_educativos";
    protected $fillable = ['id','nombre_nivel_educativo','estado'];

    public function estudiosAcademicos(){
      return $this->hasMany('App\Estudio_Academico');
    }

}
