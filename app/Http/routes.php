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

//------------- RUTAS PARA REGISTRAR Y CONFIRMAR USUARIO ESTUDIANTE -----------------------------------

Route::get('registro-estudiante', [
	'uses'	=>	'UsuariosController@getRegistroEstudiante',
	'as'	=>	'registro-estudiante'
]);

Route::post('registro-estudiante', [
	'uses'	=>	'UsuariosController@postRegistroEstudiante',
	'as'	=>	'registro-estudiante'
]);

Route::get('registro-estudiante/verificacion/{token}', [
	'uses'	=>	'UsuariosController@verificacionUsuarioEstudiante',
	'as'	=>	'registro-estudiante.verificacion'
]);

//------------- RUTAS PARA CONFIRMAR USUARIO EMPLEADOR -----------------------------------

Route::get('registro-empleador/verificacion/{token}', [
	'uses'	=>	'UsuariosController@getVerificacionUsuarioEmpleador',
	'as'	=>	'registro-empleador.verificacion'
]);

Route::post('registro-empleador/verificacion/{token}', [
	'uses'	=>	'UsuariosController@postVerificacionUsuarioEmpleador',
	'as'	=>	'registro-empleador.verificacion'
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

//------------- RUTA PARA VERIFICACION DE CAMBIO DE EMAIL ---------------------------

Route::get('configurar-cuenta-email/verificacion/{token}', [
	'uses'	=>	'EmailController@verificacionCambioEmail',
	'as'	=>	'configurar-cuenta-email.verificacion'
]);

//------------- RUTAS DE USUARIOS AUTENTICADOS -----------------------------------

// las rutas dentro de este grupo deben cumplir con el middleware auth
Route::group(['prefix' => 'in', 'middleware' => 'auth'], function(){

	// pagina para mostrar cuando no se tiene acceso a un lugar
	Route::get('sinpermisos', ['as' => 'in.sinpermisos.sinpermisos', function () {
	    return view('in.sinpermisos.sinpermisos');
	}]);

	//Ruta para redirección cuando no tiene el permiso.
	Route::get('/', ['as' => 'in', function () {
		if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('super_usuario')) {
			return redirect()->route('in.registro-empleador');
		}
		else {
			if(Auth::user()->hasRole('empleador')) {
				return redirect()->route('in.propuestas-laborales.index');
			}
			else {
				return redirect()->route('in.buscar-ofertas');
			}
		}
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

	Route::get('getRoles', [
		'uses'	=>	'UsuariosController@getRoles',
		'as'	=>	'in.getRoles'
	]);

  Route::resource('permisos', 'PermissionsController');
	Route::delete('permisos/{id}/destroy', [
		'uses'	=>	'PermissionsController@destroy',
			'as'	=>	'in.permisos.destroy',
	]);

	//------------- RUTAS DE CV -----------------------------

	Route::get('gestionar-cv/visualizar-cv', [
		'uses'	=>	'CvController@visualizarCv',
		'as'	=>	'in.cv.visualizarcv'
	]);

	Route::get('gestionar-cv/datos-personales-cv', [
		'uses'	=>	'CvController@visualizarDatosPersonales',
		'as'	=>	'in.cv.datospersonalescv'
	]);

	Route::get('gestionar-cv/objetivo-laboral-cv', [
		'uses'	=>	'CvController@visualizarObjetivoLaboral',
		'as'	=>	'in.cv.objetivolaboralcv'
	]);

	Route::get('gestionar-cv/objetivo-laboral-cv/edit', [
		'uses'	=>	'CvController@editObjetivoLaboral',
		'as'	=>	'in.cv.editobjetivolaboralcv'
	]);

	Route::post('gestionar-cv/objetivo-laboral-cv', [
		'uses'	=>	'CvController@postObjetivoLaboral',
		'as'	=>	'in.cv.updateobjetivolaboralcv'
	]);

	Route::resource('gestionar-cv/experiencia-laborales', 'ExperienciaLaboralesController');
	Route::delete('gestionar-cv/experiencia-laborales/{id}/destroy', [
		'uses'	=>	'ExperienciaLaboralesController@destroy',
		'as'	=>	'in.gestionar-cv.experiencia-laborales.destroy',
	]);

	Route::resource('gestionar-cv/estudios-academicos', 'EstudiosAcademicosController');
	Route::delete('gestionar-cv/estudios-academicos/{id}/destroy', [
		'uses'	=>	'EstudiosAcademicosController@destroy',
		'as'	=>	'in.gestionar-cv.estudios-academicos.destroy',
	]);

	Route::resource('gestionar-cv/conocimientos-idiomas', 'ConocimientosIdiomasController');
	Route::delete('gestionar-cv/conocimientos-idiomas/{id}/destroy', [
		'uses'	=>	'ConocimientosIdiomasController@destroy',
		'as'	=>	'in.gestionar-cv.conocimientos-idiomas.destroy',
	]);

	Route::resource('gestionar-cv/conocimientos-informaticos', 'ConocimientosInformaticosController');
	Route::delete('gestionar-cv/conocimientos-informaticos/{id}/destroy', [
		'uses'	=>	'ConocimientosInformaticosController@destroy',
		'as'	=>	'in.gestionar-cv.conocimientos-informaticos.destroy',
	]);

	Route::resource('gestionar-cv/conocimientos-adicionales', 'ConocimientosAdicionalesController');
	Route::delete('gestionar-cv/conocimientos-adicionales/{id}/destroy', [
		'uses'	=>	'ConocimientosAdicionalesController@destroy',
		'as'	=>	'in.gestionar-cv.conocimientos-adicionales.destroy',
	]);

	//------------- RUTAS DE PARAMETRIA ---------------------

	Route::resource('rubros-empresariales', 'RubrosEmpresarialesController');
	Route::delete('rubros-empresariales/{id}/destroy', [
		'uses'	=>	'RubrosEmpresarialesController@destroy',
			'as'	=>	'in.rubros-empresariales.destroy',
	]);

	##################################################################
	//------------------ RUTA PARA IDIOMAS -----------------------   #
	##################################################################
	Route::resource('idiomas','IdiomasController'); 
	Route::delete('idioma/{id}/destroy', [
		'uses'	=>	'IdiomasController@destroy',
			'as'	=>	'in.idiomas.destroy',
	]);

	//------------- RUTAS PARA REGISTRAR USUARIO EMPLEADOR ---------------------

	Route::get('registro-empleador', [
		'uses'	=>	'UsuariosController@getRegistroEmpleador',
		'as'	=>	'in.registro-empleador'
	]);

	Route::post('registro-empleador', [
		'uses'	=>	'UsuariosController@postRegistroEmpleador',
		'as'	=>	'in.registro-empleador'
	]);

	//------------- RUTAS PARA CONFIGURACION DE MAIL ---------------------
	Route::get('configurar-cuenta-email', [
		'uses'	=>	'EmailController@getConfigurarCuentaEmail',
		'as'	=>	'in.configurar-cuenta-email'
	]);

	Route::post('configurar-cuenta-email', [
		'uses'	=>	'EmailController@postConfigurarCuentaEmail',
		'as'	=>	'in.configurar-cuenta-email'
	]);

	//------------- RUTAS PARA CONFIGURACION DE PASSWORD ---------------------
	Route::get('configurar-cuenta-password', [
		'uses'	=>	'UsuariosController@getConfigurarCuentaPassword',
		'as'	=>	'in.configurar-cuenta-password'
	]);

	Route::post('configurar-cuenta-password', [
		'uses'	=>	'UsuariosController@postConfigurarCuentaPassword',
		'as'	=>	'in.configurar-cuenta-password'
	]);

	//------------- RUTAS PARA CONFIGURACION DE DATOS ---------------------
	Route::get('configurar-datos', [
		'uses'	=>	'UsuariosController@getConfigurarDatos',
		'as'	=>	'in.configurar-datos'
	]);

	Route::post('configurar-datos-persona', [
		'uses'	=>	'UsuariosController@postConfigurarDatosPersona',
		'as'	=>	'in.configurar-datos-persona'
	]);

	Route::post('configurar-datos-empresa', [
		'uses'	=>	'UsuariosController@postConfigurarDatosEmpresa',
		'as'	=>	'in.configurar-datos-empresa'
	]);

	//------------- RUTAS DEL EMPLEADOR ---------------------
	Route::get('realizar-propuesta', [
		'uses'	=>	'PropuestasController@getRealizarPropuesta',
		'as'	=>	'in.realizar-propuesta'
	]);

	Route::post('realizar-propuesta', [
		'uses'	=>	'PropuestasController@postRealizarPropuesta',
		'as'	=>	'in.realizar-propuesta'
	]);

	Route::resource('propuestas-laborales', 'PropuestasController');

	Route::get('propuestas-laborales/{id}/detalle', [
		'uses'	=>	'PropuestasController@getDetallePropuesta',
		'as'	=>	'in.propuestas-laborales.detalle'
	]);
	Route::delete('propuestas-laborales/{id}/destroy', [
		'uses'	=>	'PropuestasController@destroy',
			'as'	=>	'in.propuestas-laborales.destroy',
	]);

	//------------- RUTAS DEL ESTUDIANTE ---------------------
	Route::get('buscar-ofertas', [
		'uses'	=>	'EstudianteController@buscarOferta',
		'as'	=>	'in.buscar-ofertas'
	]);

	Route::get('{id}/detalle-oferta', [
		'uses'	=>	'EstudianteController@getDetalleOferta',
		'as'	=>	'in.detalle-oferta'
	]);

	Route::get('{id}/detalle-postulacion', [
		'uses'	=>	'EstudianteController@getDetallePostulacion',
		'as'	=>	'in.detalle-postulacion'
	]);

	Route::get('{id}/postularse', [
		'uses'	=>	'EstudianteController@postularse',
		'as'	=>	'in.postularse'
	]);

	Route::get('mis-postulaciones', [
		'uses'	=>	'EstudianteController@getPostulaciones',
		'as'	=>	'in.mis-postulaciones'
	]);


});
