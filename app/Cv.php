<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{

    protected $table = "cvs";
    protected $fillable = ['id','carta_presentacion','sueldo_bruto_pretendido'];

    public function experienciasLaborales(){
      return $this->hasMany('App\Experiencia_Laboral');
    }

    public function conocimientosAdicioales(){
      return $this->hasMany('App\Conocimiento_Adicional');
    }

    public function estudiosAcademicos(){
      return $this->hasMany('App\Estudio_Academico');
    }

    public function conocimientosInformaticos(){
      return $this->hasMany('App\Conocimiento_Informatico');
    }

    public function conocimientosIdiomas(){
      return $this->hasMany('App\Conocimiento_Idioma');
    }

}
