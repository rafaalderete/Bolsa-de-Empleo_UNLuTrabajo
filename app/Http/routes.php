<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',[
	'uses'	=>	'Auth\AuthController@getLogin',
	'as'	=>	'auth.login'
]);

//------------- RUTAS DEL LOGIN -----------------------------------

// se establecen las rutas del login.
Route::get('auth/login', [
	'uses'	=>	'Auth\AuthController@getLogin',
	'as'	=>	'auth.login'
]);

Route::post('auth/login', [
	'uses'	=>	'Auth\AuthController@postLogin',
	'as'	=>	'auth.login'
]);

// para salir del login
Route::get('auth/logout', [
	'uses'	=>	'Auth\AuthController@getLogout',
	'as'	=>	'auth.logout'
]);

//------------- RUTAS PARA RESTABLECER CONTRASEÑA -----------------------------------

Route::get('password/email', [
	'uses'	=>	'Auth\PasswordController@getEmail',
	'as'	=>	'password.email'
]);
Route::post('password/email', [
	'uses'	=>	'Auth\PasswordController@postEmail',
	'as'	=>	'password.email'
]);

Route::get('password/reset/{token}', [
	'uses'	=>	'Auth\PasswordController@getReset',
	'as'	=>	'password.reset'
]);
Route::post('password/reset', [
	'uses'	=>	'Auth\PasswordController@postReset',
	'as'	=>	'password.reset'
]);

//------------- RUTAS DEL PANEL DE ADMINISTRACION -----------------------------------

// las rutas dentro de este grupo deben cumplir con el middleware auth
Route::group(['prefix' => 'in', 'middleware' => 'auth'], function(){

	// pagina para mostrar cuando no se tiene acceso a un lugar
	Route::get('sinpermisos', ['as' => 'in.sinpermisos.sinpermisos', function () {
	    return view('in.sinpermisos.sinpermisos');
	}]);


	// pagina de inicio de admin
	Route::get('/', ['as' => 'in.index', function () {
    	return view('in.index');
	}]);

	//  resource: toma los metodos del controlador y los define como rutas
	// resource('nombre para el conjunto de rutas','nombre del controlador')
	Route::resource('personas','PersonasController');
	// se crea la ruta necesaria si no existe
	Route::delete('personas/{id}/destroy', [
		'uses'	=>	'PersonasController@destroy', // se define el metodo del controlador a utilizar
		'as'	=>	'in.personas.destroy', // se define la ruta
	]);

	Route::resource('roles', 'RolesController');
	// se crea la ruta necesaria si no existe
	Route::delete('roles/{id}/destroy', [
		'uses'	=>	'RolesController@destroy', // se define el metodo del controlador a utilizar
		'as'	=>	'in.roles.destroy', // se define la ruta
	]);

	Route::resource('usuarios', 'UsuariosController');
	// se crea la ruta necesaria si no existe
	Route::delete('usuarios/{id}/destroy', [
		'uses'	=>	'UsuariosController@destroy', // se define el metodo del controlador a utilizar
		'as'	=>	'in.usuarios.destroy', // se define la ruta para ingresar desde la vista
    ]);

  Route::resource('permisos', 'PermissionsController');
  // se crea la ruta necesaria si no existe
	Route::delete('permisos/{id}/destroy', [
		'uses'	=>	'PermissionsController@destroy', // se define el metodo del controlador a utilizar
			'as'	=>	'in.permisos.destroy', // se define la ruta
	]);

});
