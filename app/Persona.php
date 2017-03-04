<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
     protected $table = "personas";
     protected $fillable = ['id','nombre_persona','apellido_persona','descripcion_persona',
                            'estado_persona','fecha_nacimiento_persona',
                            'tipo_documento_persona','nro_documento_persona',
                            'domicilio_residencia_persona','localidad_residencia_persona',
                            'provincia_residencia_persona','pais_residencia_persona',
                            'telefono_contacto_persona'];

    public function users(){

    	return $this->hasMany('App/Usuario');
    }
}
