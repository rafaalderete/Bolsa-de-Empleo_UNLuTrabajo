<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experiencia_Laboral extends Model
{

    protected $table = "experiencias_laborales";
    protected $fillable = ['id','cv_id','nombre_empresa','puesto','descripcion_tarea',
                            'rubro_empresarial_id','periodo_fin','periodo_inicio'];

    public function cv(){
      return $this->belongsTo('App\Cv');
    }

    public function rubroEmpresarial(){
      return $this->belongsTo('App\Rubro_Empresarial');
    }

}
