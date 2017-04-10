<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unlu_Estudiante extends Model
{

    protected $table = "unlu_estudiantes";
    protected $fillable = ['id','legajo','unlu_carrera_id','nombre_estudiante','apellido_estudiante',
                            'fecha_nacimiento_estudiante','cuil','tipo_documento','nro_documento',
                            'email_estudiante','telefono','celular','domicilio','localidad','residencia_provincia',
                            'residencia_pais'];

    public function unluCarrera(){
      return $this->belongsTo('App\Unlu_Carrera');
    }

    public function estudiantes(){
      return $this->hasMany('App\Postulante');
    }

}
