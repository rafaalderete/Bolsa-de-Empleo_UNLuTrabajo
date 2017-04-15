<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{

    protected $table = "postulantes";
    protected $fillable = ['id','fisica_id','estudiante_id'];

    public function fisica(){
      return $this->belongsTo('App\Fisica');
    }

    public function cv(){
      return $this->hasOne('App\Cv');
    }

    public function estudiante(){
      return $this->belongsTo('App\Estudiante');
    }

    public function propuestasLaborales(){
      return $this->belongsToMany('App\Propuesta_Laboral')->withPivot('fecha_postulacion');
    }

}
