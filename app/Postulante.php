<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{

    protected $table = "postulantes";
    protected $fillable = ['id','fisica_id','unlu_estudiante_id'];

    public function fisica(){
      return $this->belongsTo('App\Fisica');
    }

    public function cv(){
      return $this->hasOne('App\Cv');
    }

    public function unluEstudiante(){
      return $this->belongsTo('App\Unlu_Estudiante');
    }

    public function propuestasLaborales(){
      return $this->belongsToMany('App\Propuesta_Laboral')->withPivot('fecha_postulacion');
    }

}
