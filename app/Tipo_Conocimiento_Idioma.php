<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Conocimiento_Idioma extends Model
{

    protected $table = "tipos_conocimiento_idioma";
    protected $fillable = ['id','nombre_tipo_conocimiento_idioma'];

    public function conocimientosIdiomas(){
      return $this->hasMany('App\Conocimiento_Idioma');
    }

}
