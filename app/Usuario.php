<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class Usuario extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use EntrustUserTrait{
            EntrustUserTrait ::can insteadof Authorizable; //add insteadof avoid php trait conflict resolution
        }

    protected $table = "usuarios";
    protected $fillable = ['password','email','descripcion_usuario',
                          'estado_usuario','nombre_usuario','persona_id'];

    protected $hidden = ['password', 'remember_token'];

    public function persona(){
    	return $this->belongsTo('App\Persona');
    }

    public function roles(){
    	return $this->belongsToMany('App\Role')->withTimestamps();
    }
}
