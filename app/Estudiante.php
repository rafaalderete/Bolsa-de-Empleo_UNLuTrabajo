<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{

    protected $table = "estudiantes";
    protected $fillable = ['id','legajo','carrera_id','nombre_estudiante','apellido_estudiante',
                            'fecha_nacimiento_estudiante','cuil','tipo_documento','nro_documento',
                            'email_estudiante','telefono','celular','domicilio','localidad','residencia_provincia',
                            'residencia_pais'];

    public function carrera(){
      return $this->belongsTo('App\Carrera');
    }

    public function postulante(){
      return $this->hasOne('App\Postulante');
    }

}
