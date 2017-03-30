<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conocimiento_Informatico extends Model
{

    protected $table = "conocimientos_informaticos";
    protected $fillable = ['id','cv_id','tipo_software_id','nivel_conocimiento_id'];

    public function cv(){
      return $this->belongsTo('App\Cv');
    }

    public function tipoSoftware(){
      return $this->belongsTo('App\Tipo_Software');
    }

    public function nivelConocimiento(){
      return $this->belongsTo('App\Nivel_Conocimiento');
    }

}
