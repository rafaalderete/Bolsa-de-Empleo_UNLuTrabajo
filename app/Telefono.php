<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{

    protected $table = "telefonos";
    protected $fillable = ['id','persona_id','tipo_telefono','nro_telefono'];

    public function persona(){
      return $this->belongsTo('App\Persona');
    }

}
