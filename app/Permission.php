<?php 

namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
	protected $table = 'permissions';

    protected $fillable = ['id','descripcion_permiso','estado_permiso',
                            'funcionalidad_permiso','name'];

    public function roles() {

    	return $this->belongsToMany('App\Role');
    }
}
