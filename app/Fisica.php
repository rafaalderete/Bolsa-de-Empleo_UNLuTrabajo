<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fisica extends Model
{

    protected $table = "fisicas";
    protected $fillable = ['id','persona_id','nombre_persona','apellido_persona','cuil',
                            'fecha_nacimiento','tipo_documento_id','nro_documento'];

    public function persona(){
      return $this->belongsTo('App\Persona');
    }

    public function tipoDocumento(){
      return $this->belongsTo('App\Tipo_Documento');
    }

    public function estudiante(){
      return $this->hasOne('App\Estudiante');
    }

}
