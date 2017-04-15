<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propuesta_Laboral extends Model
{

    protected $table = "propuestas_laborales";
    protected $fillable = ['id','juridica_id','titulo','descripcion','vacantes',
                            'requisito_años_experiencia_laboral','fecha_inicio_propuesta',
                            'fecha_fin_propuesta','estado_propuesta','tipo_trabajo_id','tipo_jornada_id'];

    public function juridica(){
      return $this->belongsTo('App\Juridica');
    }

    public function tipoJornada(){
      return $this->belongsTo('App\Tipo_Jornada');
    }

    public function tipoTrabajo(){
      return $this->belongsTo('App\Tipo_Trabajo');
    }

    public function postulantes(){
      return $this->belongsToMany('App\Postulante')->withPivot('fecha_postulacion');;
    }

    public function requisitosCarrera(){
      return $this->hasMany('App\Requisito_Carrera');
    }

    public function requisitosIdioma(){
      return $this->hasMany('App\Requisito_Idioma');
    }

    public function requisitosResidencia(){
      return $this->hasMany('App\Requisito_Residencia');
    }

    public function requisitosAdicionales(){
      return $this->hasMany('App\Requisito_Adicional');
    }

}
