<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisito_Residencia extends Model
{

    protected $table = "requisitos_residencia";
    protected $fillable = ['id','propuesta_laboral_id','lugar','excluyente'];

    public function propuestaLaboral(){
      return $this->belongsTo('App\Propuesta_Laboral');
    }

}
