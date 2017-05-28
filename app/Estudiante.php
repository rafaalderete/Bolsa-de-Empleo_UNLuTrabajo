<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{

    protected $table = "estudiantes";
    protected $fillable = ['id','fisica_id','unlu_estudiante_id','carrera_id','legajo'];

    public function fisica(){
      return $this->belongsTo('App\Fisica');
    }

    public function cv(){
      return $this->hasOne('App\Cv');
    }

    public function unluEstudiante(){
      return $this->belongsTo('App\Unlu_Estudiante');
    }

    public function carrera(){
      return $this->belongsTo('App\Carrera');
    }

    public function propuestasLaborales(){
      return $this->belongsToMany('App\Propuesta_Laboral', 'estudiante_propuesta_laboral', 'estudiante_id', 'propuesta_laboral_id')->withPivot('fecha_postulacion')->withTimestamps();
    }

}
