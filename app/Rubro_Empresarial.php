<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubro_Empresarial extends Model
{

    protected $table = "rubros_empresariales";
    protected $fillable = ['id','nombre_rubro_empresarial'];

    public function juridicas(){
      return $this->hasMany('App\Juridica');
    }

    public function experienciasLaborales(){
      return $this->hasMany('App\Experiencia_Laboral');
    }

}
