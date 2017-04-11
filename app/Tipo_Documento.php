<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Documento extends Model
{

    protected $table = "tipos_documento";
    protected $fillable = ['id','nombre_tipo_documento','estado'];

    public function fisicas(){
      return $this->hasMany('App\Fisica');
    }

}
