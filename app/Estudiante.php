<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{

    protected $table = "estudiantes";
    protected $fillable = ['id','fisica_id','unlu_estudiante_id','cv_id'];

    public function fisica(){
      return $this->belongsTo('App\Fisica');
    }

    public function cv(){
      return $this->belongsTo('App\Cv');
    }

    public function unluEstudiante(){
      return $this->belongsTo('App\Unlu_Estudiante');
    }

    public function propuestasLaborales(){
      return $this->belongsToMany('App\Propuesta_Laboral')->withPivot('fecha_postulacion');
    }

}
