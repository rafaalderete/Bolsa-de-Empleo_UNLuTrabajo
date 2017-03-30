<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Juridica extends Model
{

    protected $table = "juridicas";
    protected $fillable = ['id','persona_id','nombre_comercial','fecha_fundacion','cuit',
                            'rubro_empresarial_id'];

    public function persona(){
     return $this->belongsTo('App\Persona');
    }

    public function rubroEmpresarial(){
     return $this->belongsTo('App\Rubro_Empresarial');
    }

    public function propuestaLaboral(){
     return $this->hasMany('App\Propuesta_Laboral');
    }

}
