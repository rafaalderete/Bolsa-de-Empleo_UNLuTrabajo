<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Software extends Model
{

    protected $table = "tipos_software";
    protected $fillable = ['id','nombre_tipo_software'];

    public function conocimientosInformaticos(){
      return $this->hasMany('App\Conocimiento_Informatico');
    }

}
