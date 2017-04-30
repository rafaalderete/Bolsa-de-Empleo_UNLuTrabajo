<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propuesta_Laboral extends Model
{

    protected $table = "propuestas_laborales";
    protected $fillable = ['id','juridica_id','titulo','descripcion','vacantes','lugar_de_trabajo',
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

    public function estudiantes(){
      return $this->belongsToMany('App\Estudiante', 'estudiante_propuesta_laboral', 'estudiante_id', 'propuesta_laboral_id')->withPivot('fecha_postulacion');;
    }

    public function requisitosCarrera(){
      return $this->hasMany('App\Requisito_Carrera', 'propuesta_laboral_id', 'id');
    }

    public function requisitosIdioma(){
      return $this->hasMany('App\Requisito_Idioma', 'propuesta_laboral_id', 'id');
    }

    public function requisitosResidencia(){
      return $this->hasMany('App\Requisito_Residencia', 'propuesta_laboral_id', 'id');
    }

    public function requisitosAdicionales(){
      return $this->hasMany('App\Requisito_Adicional', 'propuesta_laboral_id', 'id');
    }

}
