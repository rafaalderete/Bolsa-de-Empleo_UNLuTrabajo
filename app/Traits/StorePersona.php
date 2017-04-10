<?php

namespace App\Traits;

use App\Persona as Persona;
use App\Telefono as Telefono;
use App\Direccion as Direccion;

trait StorePersona
{

    public function storePersona($persona, $tipo_persona)
    {
      $nueva_persona = new Persona();
      $nueva_persona->tipo_persona = $tipo_persona;
      $nueva_persona->estado_persona = 'activo';
      $nueva_persona->save();

      $direccion = new Direccion();
      $direccion->persona_id = $nueva_persona->id;
      $direccion->domicilio = $persona->domicilio_residencia;
      $direccion->localidad = $persona->localidad_residencia;
      $direccion->provincia = $persona->provincia_residencia;
      $direccion->pais = $persona->pais_residencia;
      $direccion->save();

      if($persona->telefono_fijo != '') {
        $fijo = new Telefono();
        $fijo->persona_id = $nueva_persona->id;
        $fijo->tipo_telefono = 'fijo';
        $fijo->nro_telefono = $persona->telefono_fijo;
        $fijo->save();
      }

      if($persona->telefono_celular != '') {
        $celular = new Telefono();
        $celular->persona_id = $nueva_persona->id;
        $celular->tipo_telefono = 'celular';
        $celular->nro_telefono = $persona->telefono_celular;
        $celular->save();
      }

      return $nueva_persona->id;
    }

}
