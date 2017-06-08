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

	Route::get('getDatosReporteEstadisticaAdministrador', [
		'uses'	=>	'ReportesAdministradorController@getDatosEstadistica',
		'as'	=>	'in.getDatosReporteEstadisticaAdministrador'
	]);

	Route::get('getDatosReporteEstadisticaEmpleador', [
		'uses'	=>	'ReportesEmpleadorController@getDatosEstadistica',
		'as'	=>	'in.getDatosReporteEstadisticaEmpleador'
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

	Route::get('gestionar-cv/descargar-cv', [
		'uses'	=>	'CvController@descargarCv',
		'as'	=>	'in.cv.descargarcv'
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

	##################################################################
	//------------------ RUTA PARA REPORTES ----------------------   #
	##################################################################

	//------------- RUTAS DE REPORTES ADMIN -----------------------

	Route::get('reportes-administrador/reportes', [
		'uses'	=>	'ReportesAdministradorController@index',
		'as'	=>	'in.reportes.administrador.index'
	]);

	Route::get('reportes-administrador/reportes/tabla-empresas-mas-propuestas', [
		'uses'	=>	'ReportesAdministradorController@getEmpresasMasPropuestas',
		'as'	=>	'in.reportes.administrador.tablasonline.empresas-mas-propuestas'
	]);

	Route::get('reportes-administrador/reportes/tabla-empresas-mas-propuestas-pdf', [
		'uses'	=>	'ReportesAdministradorController@getEmpresasMasPropuestasPdf',
		'as'	=>	'in.reportes.administrador.tablaspdf.empresas-mas-propuestas'
	]);

	Route::get('reportes-administrador/reportes/tabla-empresas-mas-dias-inactividad', [
		'uses'	=>	'ReportesAdministradorController@getEmpresasMasDiasInactividad',
		'as'	=>	'in.reportes.administrador.tablasonline.empresas-mas-dias-inactividad'
	]);

	Route::get('reportes-administrador/reportes/tabla-empresas-mas-dias-inactividad-pdf', [
		'uses'	=>	'ReportesAdministradorController@getEmpresasMasDiasInactividadPdf',
		'as'	=>	'in.reportes.administrador.tablaspdf.empresas-mas-dias-inactividad'
	]);

	Route::get('reportes-administrador/reportes/tabla-carreras-mas-estudiantes', [
		'uses'	=>	'ReportesAdministradorController@getCarrerasMasEstudiantes',
		'as'	=>	'in.reportes.administrador.tablasonline.carreras-mas-estudiantes'
	]);

	Route::get('reportes-administrador/reportes/tabla-carreras-mas-estudiantes-pdf', [
		'uses'	=>	'ReportesAdministradorController@getCarrerasMasEstudiantesPdf',
		'as'	=>	'in.reportes.administrador.tablaspdf.carreras-mas-estudiantes'
	]);

	Route::get('reportes-administrador/reportes/tabla-propuestas-ultimo-anio', [
		'uses'	=>	'ReportesAdministradorController@getPropuestasUltimoAnio',
		'as'	=>	'in.reportes.administrador.tablasonline.propuestas-ultimo-anio'
	]);

	Route::get('reportes-administrador/reportes/tabla-propuestas-ultimo-anio-pdf', [
		'uses'	=>	'ReportesAdministradorController@getPropuestasUltimoAnioPdf',
		'as'	=>	'in.reportes.administrador.tablaspdf.propuestas-ultimo-anio'
	]);

	Route::get('reportes-administrador/reportes/tabla-empresas-rubro-empresarial', [
		'uses'	=>	'ReportesAdministradorController@getEmpresasRubroEmpresarial',
		'as'	=>	'in.reportes.administrador.tablasonline.empresas-rubro-empresarial'
	]);

	Route::get('reportes-administrador/reportes/tabla-empresas-rubro-empresarial-pdf', [
		'uses'	=>	'ReportesAdministradorController@getEmpresasRubroEmpresarialPdf',
		'as'	=>	'in.reportes.administrador.tablaspdf.empresas-rubro-empresarial'
	]);

	Route::post('reportes-administrador/reportes/tabla-cantidad-propuestas', [
		'uses'	=>	'ReportesAdministradorController@getCantidadPropuestas',
		'as'	=>	'in.reportes.administrador.tablasonline.cantidad-propuestas'
	]);

	Route::get('reportes-administrador/reportes/tabla-cantidad-propuestas-pdf', [
		'uses'	=>	'ReportesAdministradorController@getCantidadPropuestasPdf',
		'as'	=>	'in.reportes.administrador.tablaspdf.cantidad-propuestas'
	]);

	//------------- RUTAS DE REPORTES EMPLEADOR ----------------------

	Route::get('reportes-empleador/reportes', [
		'uses'	=>	'ReportesEmpleadorController@index',
		'as'	=>	'in.reportes.empleador.index'
	]);

	Route::get('reportes-empleador/reportes/tabla-carreras-mas-estudiantes', [
		'uses'	=>	'ReportesEmpleadorController@getCarrerasMasEstudiantes',
		'as'	=>	'in.reportes.empleador.tablasonline.carreras-mas-estudiantes'
	]);

	Route::get('reportes-empleador/reportes/tabla-carreras-mas-estudiantes-pdf', [
		'uses'	=>	'ReportesEmpleadorController@getCarrerasMasEstudiantesPdf',
		'as'	=>	'in.reportes.empleador.tablaspdf.carreras-mas-estudiantes'
	]);

	Route::get('reportes-empleador/reportes/tabla-estado-estudiantes', [
		'uses'	=>	'ReportesEmpleadorController@getEstadoEstudiantes',
		'as'	=>	'in.reportes.empleador.tablasonline.estado-estudiantes'
	]);

	Route::get('reportes-empleador/reportes/tabla-estado-estudiantes-pdf', [
		'uses'	=>	'ReportesEmpleadorController@getEstadoEstudiantesPdf',
		'as'	=>	'in.reportes.empleador.tablaspdf.estado-estudiantes'
	]);

	Route::get('reportes-empleador/reportes/tabla-promedio-sueldo-carreras', [
		'uses'	=>	'ReportesEmpleadorController@getPromedioSueldoCarreras',
		'as'	=>	'in.reportes.empleador.tablasonline.promedio-sueldo-carreras'
	]);

	Route::get('reportes-empleador/reportes/tabla-promedio-sueldo-carreras-pdf', [
		'uses'	=>	'ReportesEmpleadorController@getPromedioSueldoCarrerasPdf',
		'as'	=>	'in.reportes.empleador.tablaspdf.promedio-sueldo-carreras'
	]);

	Route::get('reportes-empleador/reportes/tabla-propuestas-mas-postulados-por-ver', [
		'uses'	=>	'ReportesEmpleadorController@getPropuestasMasPostuladosPorVer',
		'as'	=>	'in.reportes.empleador.tablasonline.propuestas-mas-postulados-por-ver'
	]);

	Route::get('reportes-empleador/reportes/tabla-propuestas-mas-postulados-por-ver-pdf', [
		'uses'	=>	'ReportesEmpleadorController@getPropuestasMasPostuladosPorVerPdf',
		'as'	=>	'in.reportes.empleador.tablaspdf.propuestas-mas-postulados-por-ver'
	]);

	Route::post('reportes-empleador/reportes/tabla-cantidad-propuestas', [
		'uses'	=>	'ReportesEmpleadorController@getCantidadPropuestas',
		'as'	=>	'in.reportes.empleador.tablasonline.cantidad-propuestas'
	]);

	Route::get('reportes-empleador/reportes/tabla-cantidad-propuestas-pdf', [
		'uses'	=>	'ReportesEmpleadorController@getCantidadPropuestasPdf',
		'as'	=>	'in.reportes.empleador.tablaspdf.cantidad-propuestas'
	]);

	//------------- RUTAS DE REPORTES ESTUDIANTE ----------------------

	Route::get('reportes-estudiante/reportes', [
		'uses'	=>	'ReportesEstudianteController@index',
		'as'	=>	'in.reportes.estudiante.index'
	]);

	Route::get('reportes-estudiante/reportes/tabla-idiomas-solicitados', [
		'uses'	=>	'ReportesEstudianteController@getIdiomasSolicitados',
		'as'	=>	'in.reportes.estudiante.tablasonline.idiomas-solicitados'
	]);

	Route::get('reportes-estudiante/reportes/tabla-idiomas-solicitados-pdf', [
		'uses'	=>	'ReportesEstudianteController@getIdiomasSolicitadosPdf',
		'as'	=>	'in.reportes.estudiante.tablaspdf.idiomas-solicitados'
	]);

	Route::get('reportes-estudiante/reportes/tabla-estados-postulaciones', [
		'uses'	=>	'ReportesEstudianteController@getEstadosPostulaciones',
		'as'	=>	'in.reportes.estudiante.tablasonline.estados-postulaciones'
	]);

	Route::get('reportes-estudiante/reportes/tabla-estados-postulaciones-pdf', [
		'uses'	=>	'ReportesEstudianteController@getEstadosPostulacionesPdf',
		'as'	=>	'in.reportes.estudiante.tablaspdf.estados-postulaciones'
	]);


	Route::get('reportes-estudiante/reportes/tabla-empresas-propuestas-mi-carrera', [
		'uses'	=>	'ReportesEstudianteController@getEmpresasPropuestasMiCarrera',
		'as'	=>	'in.reportes.estudiante.tablasonline.empresas-propuestas-mi-carrera'
	]);

	Route::get('reportes-estudiante/reportes/tabla-empresas-propuestas-mi-carrera-pdf', [
		'uses'	=>	'ReportesEstudianteController@getEmpresasPropuestasMiCarreraPdf',
		'as'	=>	'in.reportes.estudiante.tablaspdf.empresas-propuestas-mi-carrera'
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
	Route::delete('idiomas/{id}/destroy', [
		'uses'	=>	'IdiomasController@destroy',
			'as'	=>	'in.idiomas.destroy',
	]);

	##################################################################
	//------------------ RUTA PARA TIPO SOFTWARE -----------------   #
	##################################################################
	Route::resource('tipo_software','TiposSoftwareController');
	Route::delete('tipo_software/{id}/destroy', [
		'uses'	=>	'TiposSoftwareController@destroy',
			'as'	=>	'in.tipo_software.destroy',
	]);

	##################################################################
	//------------------ RUTA PARA TIPO ESTADO CARRERA---------------#
	##################################################################
	Route::resource('estado_carrera','EstadoCarreraController');
	Route::delete('estado_carrera/{id}/destroy', [
		'uses'	=>	'EstadoCarreraController@destroy',
			'as'	=>	'in.estado_carrera.destroy',
	]);
	##################################################################
	//------------------ RUTA PARA TIPO JORNADA  -----------------   #
	##################################################################
	Route::resource('tipo_jornada','TipoJornadaController');
	Route::delete('tipo_jornada/{id}/destroy', [
		'uses'	=>	'TipoJornadaController@destroy',
			'as'	=>	'in.tipo_jornada.destroy',
	]);

	##################################################################
	//------------------ RUTA PARA TIPO TRABAJO  -----------------   #
	##################################################################
	Route::resource('tipo_trabajo','TipoTrabajoController');
	Route::delete('tipo_trabajo/{id}/destroy', [
		'uses'	=>	'TipoTrabajoController@destroy',
			'as'	=>	'in.tipo_trabajo.destroy',
	]);


	##################################################################
	//------------- RUTA PARA NIVEL CONOCIMIENTO -----------------   #
	##################################################################
	Route::resource('nivel_conocimiento','NivelConocimientoController');
	Route::delete('nivel_conocimiento/{id}/destroy', [
		'uses'	=>	'NivelConocimientoController@destroy',
			'as'	=>	'in.nivel_conocimiento.destroy',
	]);

	##################################################################
	//------------------ RUTA PARA NIVEL EDUCATIVO ---------------   #
	##################################################################
	Route::resource('nivel_educativo','NivelEducativoController');
	Route::delete('nivel_educativo/{id}/destroy', [
		'uses'	=>	'NivelEducativoController@destroy',
			'as'	=>	'in.nivel_educativo.destroy',
	]);

	##################################################################
	//-------RUTA PARA TIPO CONOCIMIENTO IDIOMA ------------------   #
	##################################################################
	Route::resource('tipo_conocimiento_idioma','TipoConocimientoIdiomaController');
	Route::delete('tipo_conocimiento_idioma/{id}/destroy', [
		'uses'	=>	'TipoConocimientoIdiomaController@destroy',
			'as'	=>	'in.tipo_conocimiento_idioma.destroy',
	]);

	##################################################################
	//-------RUTA PARA TIPO DOCUMENTO -------------------------------#
	##################################################################
	Route::resource('tipo_documento','TipoDocumentoController');
	Route::delete('tipo_documento/{id}/destroy', [
		'uses'	=>	'TipoDocumentoController@destroy',
			'as'	=>	'in.tipo_documento.destroy',
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

	Route::get('propuestas-laborales/{id}/listado-postulantes', [
		'uses'	=>	'PropuestasController@getPostulantes',
		'as'	=>	'in.propuestas-laborales.listado-postulantes'
	]);

	Route::get('propuestas-laborales/{id_propuesta}/listado-postulantes/{id_estudiante}/vizualizar-cv', [
		'uses'	=>	'PropuestasController@getCvPostulante',
		'as'	=>	'in.propuestas-laborales.listado-postulantes.vizualizar-cv'
	]);

	Route::get('propuestas-laborales/{id_propuesta}/listado-postulantes/{id_estudiante}/vizualizar-cv/descargar-archivos', [
		'uses'	=>	'PropuestasController@descargarArchivosSimple',
		'as'	=>	'in.propuestas-laborales.listado-postulantes.vizualizar-cv.descargar-archivos'
	]);

	Route::post('propuestas-laborales/{id_propuesta}/listado-postulantes/descargar-archivos-grupo', [
		'uses'	=>	'PropuestasController@descargarArchivosGrupo',
		'as'	=>	'in.propuestas-laborales.listado-postulantes.descargar-archivos-grupo'
	]);

	Route::get('propuestas-laborales/{id_propuesta}/listado-postulantes/{id_estudiante}/vizualizar-cv/aceptar-postulacion', [
		'uses'	=>	'PropuestasController@aceptarPostulacion',
		'as'	=>	'in.propuestas-laborales.listado-postulantes.vizualizar-cv.aceptar-postulacion'
	]);

	Route::get('propuestas-laborales/{id_propuesta}/listado-postulantes/{id_estudiante}/vizualizar-cv/rechazar-postulacion', [
		'uses'	=>	'PropuestasController@rechazarPostulacion',
		'as'	=>	'in.propuestas-laborales.listado-postulantes.vizualizar-cv.rechazar-postulacion'
	]);

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

	Route::post('{id}/postularse', [
		'uses'	=>	'EstudianteController@postularse',
		'as'	=>	'in.postularse'
	]);

	Route::get('mis-postulaciones', [
		'uses'	=>	'EstudianteController@getPostulaciones',
		'as'	=>	'in.mis-postulaciones'
	]);


});
