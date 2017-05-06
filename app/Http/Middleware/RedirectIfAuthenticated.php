<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfAuthenticated
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) {
          //Redirects a las paginas de inicio de cada rol.
          if($this->auth->user()->hasRole('administrador') || $this->auth->user()->hasRole('super_usuario')) {
            $redirectPath = 'in/registro-empleador';
          }
          else {
            if ($this->auth->user()->hasRole('empleador')) {
              $redirectPath = 'in/propuestas-laborales';
            }
            else {
              $redirectPath = 'in/buscar-ofertas';
            }
          }
          return redirect($redirectPath);
        }

        return $next($request);
    }
}
