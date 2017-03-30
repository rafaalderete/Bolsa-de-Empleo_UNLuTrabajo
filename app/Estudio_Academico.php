<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudio_Academico extends Model
{

    protected $table = "estudios_academicos";
    protected $fillable = ['id','cv_id','nombre_instituto','titulo','materias_total',
                            'materias_aprobadas','nivel_educativo_id','estados_carrera',
                            'periodo_fin','periodo_inicio'];

    public function cv(){
      return $this->belongsTo('App\Cv');
    }

    public function nivelEducativo(){
      return $this->belongsTo('App\Nivel_Educativo');
    }

    public function estadoCarrera(){
      return $this->belongsTo('App\Estado_Carrera');
    }

}
