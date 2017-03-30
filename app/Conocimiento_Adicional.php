<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conocimiento_Adicional extends Model
{

    protected $table = "conocimientos_adicionales";
    protected $fillable = ['id','cv_id','nombre_conocimiento','descripcion_conocimiento'];

    public function cv(){
      return $this->belongsTo('App\Cv');
    }

}
