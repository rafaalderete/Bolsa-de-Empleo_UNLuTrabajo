<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propuesta_Laboral extends Model
{

    protected $table = "propuestas_laborales";
    protected $fillable = ['id','juridica_id','titulo','descripcion','requisito',
                            'fecha_inicio_propuesta','fecha_fin_propuesta','estado_propuesta',
                            'tipo_trabajo_id','tipo_jornada_id'];

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
      return $this->belongsToMany('App\Estudiante')->withPivot('fecha_postulacion');;
    }

    public function unluCarreras(){
      return $this->belongsToMany('App\Unlu_Carrera');
    }

}
