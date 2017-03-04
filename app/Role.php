<?php 

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	protected $table = 'roles';

    protected $fillable = ['id','descripcion_rol','estado_rol','nombre_amigable_rol',
                            'name'];

    public function permissions() {

    	return $this->belongsToMany('App\Permission');
    }

    public function users() {

        return $this->belongsToMany('App\Usuario');
    }
}
