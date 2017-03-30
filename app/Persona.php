<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{

    protected $table = "personas";
    protected $fillable = ['id','tipo_persona','estado_persona'];

    public function usuarios(){
    	return $this->hasMany('App\Usuario');
    }

    public function fisica(){
      return $this->hasOne('App\Fisica');
    }

    public function juridica(){
      return $this->hasOne('App\Juridica');
    }

    public function telefonos(){
      return $this->hasMany('App\Telefono');
    }

    public function direccion(){
      return $this->hasOne('App\Direccion');
    }

}
