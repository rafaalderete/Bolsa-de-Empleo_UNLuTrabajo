<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

		protected $table = 'roles';
    protected $fillable = ['id','descripcion_rol','estado_rol','name'];

    public function permissions() {
    	return $this->belongsToMany('App\Permission')->withTimestamps();
    }

    public function usuarios() {
      return $this->belongsToMany('App\Usuario')->withTimestamps();
    }

}
