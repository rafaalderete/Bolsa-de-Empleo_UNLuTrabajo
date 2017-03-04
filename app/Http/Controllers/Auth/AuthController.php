<?php

namespace App\Http\Controllers\Auth;

use App\Usuario;
use Validator;
use Auth;
use View;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/in';
    protected $loginPath = 'auth/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre_usuario' => 'required|max:255',
            'email' => 'required|email|max:255|unique:usuarios',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Usuario::create([
            'nombre_usuario' => $data['nombre_usuario'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function getLogin(){

        return View::make('auth.login');
    }

    /* public function postLogin()
    {
        // Guardamos en un arreglo los datos del usuario.
        $userdata = array(
            'email' => Input::get('email'),
            'password'=> Input::get('password')
        );
        if(Auth::attempt($userdata))
        {
            // De ser datos válidos nos mandara a la bienvenida
            return Redirect::to('/admin');
        }

        Flash::warning('Los datos ingresados no son correctos');
        return Redirect::to('auth/login');
    } */
}
