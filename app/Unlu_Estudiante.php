<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unlu_Estudiante extends Model
{

    protected $table = "unlu_estudiantes";
    protected $fillable = ['id','legajo','unlu_carrera_id','fecha_inicio_carrera','total_materias_aprobadas',
                            'nombre','apellido','fecha_nacimiento','cuil','tipo_documento','nro_documento',
                            'email','telefono','celular','domicilio','localidad','residencia_provincia',
                            'residencia_pais'];

    public function unluCarrera(){
      return $this->belongsTo('App\Unlu_Carrera');
    }

    public function estudiante(){
      return $this->hasOne('App\Estudiante');
    }

}
