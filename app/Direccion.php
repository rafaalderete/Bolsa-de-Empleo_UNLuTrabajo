<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{

    protected $table = "direcciones";
    protected $fillable = ['id','persona_id','domicilio','localidad','provincia',
                          'pais'];

    public function persona(){
      return $this->belongsTo('App\Persona');
    }

}
