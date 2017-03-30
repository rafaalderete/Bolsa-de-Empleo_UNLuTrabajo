<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conocimiento_Idioma extends Model
{

    protected $table = "conocimientos_idiomas";
    protected $fillable = ['id','cv_id','idioma_id','tipo_conocimiento_idioma_id',
                            'nivel_conocimiento_id'];

    public function cv(){
      return $this->belongsTo('App\Cv');
    }

    public function nivelConocimiento(){
      return $this->belongsTo('App\Nivel_Conocimiento');
    }

    public function idioma(){
      return $this->belongsTo('App\Idioma');
    }

    public function tipoConocimientoIdioma(){
      return $this->belongsTo('App\Tipo_Conocimiento_Idioma');
    }

}
