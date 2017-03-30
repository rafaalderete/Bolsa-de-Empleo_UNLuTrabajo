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

//------------- RUTAS PARA REGISTRAR Y CONFIRMAR USUARIO -----------------------------------

Route::get('registro', [
	'uses'	=>	'UsuariosController@getRegistro',
	'as'	=>	'registro'
]);

Route::post('registro', [
	'uses'	=>	'UsuariosController@postRegistro',
	'as'	=>	'registro'
]);

Route::get('registro/confirmacion/{token}', [
	'uses'	=>	'UsuariosController@confirmacionCuenta',
	'as'	=>	'registro.confirmacion'
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


	Route::resource('personas','FisicasController');
	Route::delete('personas/{id}/destroy', [
		'uses'	=>	'FisicasController@destroy',
		'as'	=>	'in.personas.destroy',
	]);

	Route::resource('empresas','JuridicasController');
	Route::delete('empresas/{id}/destroy', [
		'uses'	=>	'JuridicasController@destroy',
		'as'	=>	'in.empresas.destroy',
	]);

	Route::resource('roles', 'RolesController');
	Route::delete('roles/{id}/destroy', [
		'uses'	=>	'RolesController@destroy',
		'as'	=>	'in.roles.destroy',
	]);

	Route::resource('usuarios', 'UsuariosController');
	Route::delete('usuarios/{id}/destroy', [
		'uses'	=>	'UsuariosController@destroy',
		'as'	=>	'in.usuarios.destroy',
    ]);

  Route::resource('permisos', 'PermissionsController');
	Route::delete('permisos/{id}/destroy', [
		'uses'	=>	'PermissionsController@destroy', 
			'as'	=>	'in.permisos.destroy',
	]);

});
