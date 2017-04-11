<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel_Conocimiento extends Model
{

    protected $table = "niveles_conocimiento";
    protected $fillable = ['id','nombre_nivel_conocimiento','estado'];

    public function conocimientosInformaticos(){
      return $this->hasMany('App\Conocimiento_Informatico');
    }

    public function conocimientosIdiomas(){
      return $this->hasMany('App\Conocimiento_Idioma');
    }

}
