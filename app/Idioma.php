<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{

    protected $table = "idiomas";
    protected $fillable = ['id','nombre_idioma','estado'];

    public function conocimientosIdiomas(){
      return $this->hasMany('App\Conocimiento_Idioma');
    }

}
