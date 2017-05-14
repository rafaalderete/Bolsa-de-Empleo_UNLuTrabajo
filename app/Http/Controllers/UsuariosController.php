<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PersonasController;
use Laracasts\Flash\Flash;
use App\Usuario as Usuario;
use App\Persona as Persona;
use App\Juridica as Juridica;
use App\Fisica as Fisica;
use App\Estudiante as Estudiante;
use App\Cv as Cv;
use App\Unlu_Estudiante as Unlu_Estudiante;
use App\Tipo_Documento as Tipo_Documento;
use App\Role as Rol;
use App\Rubro_Empresarial as Rubro_Empresarial;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Http\Requests\RegistroEmpleadorRequest;
use App\Http\Requests\RegistroEstudianteRequest;
use App\Http\Requests\ConfigurarDatosPersonaFisicaRequest;
use App\Http\Requests\ConfigurarDatosPersonaJuridicaRequest;
use App\Http\Requests\ConfigurarPasswordRequest;
use Illuminate\Support\Facades\Auth;
use File;
use Hash;
use Illuminate\Support\Facades\Mail;

class UsuariosController extends PersonasController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){ // pantalla principal donde lista los usuarios
        if(Auth::user()->can('listar_usuarios')){
          $usuarios = Usuario::orderBy('id','DESC')->get();

          $personas = Persona::all();

          return view('in.usuarios.index')
              ->with('usuarios',$usuarios)
              ->with('personas',$personas); // se lo envia para controlar q no pueda crear usuarios si no hay personas
        }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }

    private function isSuperUsuario ($id){
      $usuario = Usuario::find($id);
      if ($usuario->hasRole('super_usuario')) {
        return true;
      }
      else {
        return false;
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){ // envia a la vista para cargar los datos del nuevo usuario
        if(Auth::user()->can('crear_usuario')){
          $personas = [];
          $personasAux = Persona::all()->where('estado_persona', 'activo'); // recupero array de personas que estan activas

          //Solo trae las personas juridicas que no tengan usuario y las personas físicas.
          foreach ($personasAux as $key => $personaAux) {
            if ( ($personaAux->tipo_persona == 'fisica')  || (($personaAux->tipo_persona == 'juridica') && (count($personaAux->usuarios) == 0)) ) {
              array_push($personas,$personaAux);
            }
          }

          return view('in.usuarios.create')
              ->with('personas',$personas);
        }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsuarioRequest $request){ // almacena los datos en Base y muestra el msj de OK, devuelve al index
        if(Auth::user()->can('crear_usuario')){
          $error = false;
          $errorMsj = "";
          $persona = Persona::find($request->persona_id);
          $roles_seleccionados = $request->roles;
          $rol_empleador = false;
          $rol_postulante = false;
          foreach ($roles_seleccionados as $rol_seleccionado) {
            $rol = Rol::find($rol_seleccionado);
            if ($rol->name == 'empleador'){
              $rol_empleador = true;
            }
            if ($rol->name == 'postulante'){
              $rol_postulante = true;
            }
          }

          //Control de que una persona fisica no puede ser empleador y una persona juridica solo puede ser empleador.
          if ($persona->tipo_persona == 'fisica' && $rol_empleador) {
            $error = true;
            $errorMnj = 'Datos invalidos para el campo Roles.';
          }
          if ( (count($roles_seleccionados) == 1) && ($persona->tipo_persona == 'juridica' && !$rol_empleador) ) {
            $error = true;
            $errorMnj = 'Datos invalidos para el campo Roles.';
          }
          //Control para que una persona juridica no tenga más de un usuario.
          if ( ($persona->tipo_persona == 'juridica') && (count($persona->usuarios) > 0) ) {
            $error = true;
            $errorMnj = 'Persona inválida.';
          }
          if ($persona->tipo_persona == 'fisica' && $rol_postulante) {
            $unlu_estudiante = new Unlu_Estudiante();
            $unlu_estudiante = Unlu_Estudiante::where('nro_documento',$persona->fisica->nro_documento)
              ->where('email',$request->email)
              ->first();
            if($unlu_estudiante == null){
              $error = true;
              $errorMnj = 'No existe un estudiante con los datos ingresados.';
            }
          }
          if ($error) {
            Flash::error($errorMnj)->important();
            return redirect()->back();
          }
          else {
            //Si aun no tiene estudiante y tiene rol postulante, se crea el estudiante y el cv.
            if ($persona->tipo_persona == 'fisica' && $rol_postulante) {
              if ($persona->fisica->estudiante == null) {
                $estudiante = new Estudiante();
                $estudiante->fisica_id = $persona->fisica->id;
                $estudiante->unlu_estudiante_id = $unlu_estudiante->id;
                $estudiante->legajo = $unlu_estudiante->legajo;
                $estudiante->carrera_id = $unlu_estudiante->unlu_carrera_id;
                $estudiante->save();//Se inserta el postulante.

                $cv = new Cv();
                $cv->estudiante_id = $estudiante->id;
                $cv->save();//Se inserta el Cv.
              }
            }

            $usuario = new Usuario($request->all()); // se asignan todos los valores de los atributos al nuevo usuario creado.
                                                     // all() solo trae los atributos los usuario para agregar

            //Guarda la Imagen. Manipular Imagenes y no coliciones de nombres
            if ($request->file('imagen')) {
                $file = $request->file('imagen');
                $name = 'image_' . time().'.'. $file->getClientOriginalExtension();
                $path = public_path(). '/img/usuarios/';
                $file->move($path, $name);
                $usuario->imagen = $name;
            }

            $usuario->password = bcrypt($request->password); // se encripta la contraseña
            $usuario->save(); // se almacena el objeto en la Base

            //sincronizo con la tabla pivot
            $roles = $request->input('roles', []);
            $usuario->roles()->sync($roles);

            Flash::success('Usuario ' . $usuario->nombre_usuario . ' agregado.')->important(); // se muestra el msj de usuario creado
            return redirect()->route('in.usuarios.index'); // se devuelve al index
          }
        }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){ // envia a la vista para evitar los datos del usurio.
                              // No siempre se pueden editar todos los mismos datos que al crear
        if( (Auth::user()->can('modificar_usuario') && !$this->isSuperUsuario($id)) ||  Auth::user()->hasRole('super_usuario')){
          $usuario = Usuario::find($id); // busca al usuario por el id

          $personasAct = Persona::all()->where('estado_persona', 'activo');
          foreach ($personasAct as $persona) {
            if($persona->tipo_persona == 'fisica') {
              $personas[$persona->id] = $persona->fisica->nombre_persona.' '.$persona->fisica->apellido_persona;
            }
            else {
              //Si se desea modificar un usuario con persona física, solo trae las personas juridicas que no tengan usuario.
              if ($usuario->persona->tipo_persona == 'fisica'){
                if ( ($persona->tipo_persona == 'juridica') && (count($persona->usuarios) == 0) ) {
                  $personas[$persona->id] = $persona->juridica->nombre_comercial;
                }
              }
              else {
                //Si se desea modificar un usuario con persona juridica, solo trae las personas juridicas que no tengan usuario y la persona juridica que se desea modificar.
                if ( (($persona->tipo_persona == 'juridica') && (count($persona->usuarios) == 0)) || ($persona->juridica->id == $usuario->persona->juridica->id) ) {
                  $personas[$persona->id] = $persona->juridica->nombre_comercial;
                }
              }
            }
          }

          $my_persona = $usuario->persona_id; // recupero id de persona asociada

          $persona = $usuario->persona;
          if ($persona->tipo_persona == 'fisica') {//Obtengo los roles dependiendo el tipo de persona.
            if (Auth::user()->hasRole('super_usuario')) {
              $roles = Rol::orderBy('name', 'ASC')->where('estado_rol', 'activo')
                ->where('name','<>','empleador')
                ->lists('name', 'id');
            }
            else {
              $roles = Rol::orderBy('name', 'ASC')->where('estado_rol', 'activo')
                ->where('name','<>','empleador')
                ->where('name','<>','super_usuario')
                ->lists('name', 'id');
            }
          }
          else {
            $roles = Rol::orderBy('name', 'ASC')->where('estado_rol', 'activo')
              ->where('name','=','empleador')
              ->lists('name', 'id');
          }

          // necesito el array de los roles q contiene
          $my_roles = $usuario->roles->lists('id')->toArray(); // pasa los roles del usuario (son objetos) a un array

          // retorna una vista con un parametro
          return view('in.usuarios.edit')
            ->with('usuario',$usuario)
            ->with('roles',$roles)
            ->with('my_roles',$my_roles)
            ->with('personas', $personas)
            ->with('my_persona', $my_persona);
        }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

    private function updateImagen($imagenVieja, $usuario, $request){

      //Guarda la Imagen. Manipular Imagenes y no colisiones de nombres
      if ($request->imagen == null) {
        if ($request->imagen_cambiada == 1) {
          $usuario->imagen = null;
          File::delete(public_path().'/img/usuarios/'.$imagenVieja);
        }
      }
      else {
        if ($request->file('imagen')) {
            File::delete(public_path().'/img/usuarios/'.$imagenVieja);
            $file = $request->file('imagen');
            $name = 'image_' . time().'.'. $file->getClientOriginalExtension();
            $path = public_path(). '/img/usuarios/';
            $file->move($path, $name);
            $usuario->imagen = $name;
        }
      }

      return $usuario;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsuarioRequest $request, $id){
        if( (Auth::user()->can('modificar_usuario') && !$this->isSuperUsuario($id)) ||  Auth::user()->hasRole('super_usuario')){
          $error = false;
          $errorMnj = "";
          $usuario = Usuario::find($id);
          $persona = Persona::find($request->persona_id);
          $roles_seleccionados = $request->roles;
          $rol_empleador = false;
          $rol_postulante = false;
          foreach ($roles_seleccionados as $rol_seleccionado) {
            $rol = Rol::find($rol_seleccionado);
            if ($rol->name == 'empleador'){
              $rol_empleador = true;
            }
            if ($rol->name == 'postulante'){
              $rol_postulante = true;
            }
          }

          //Control de que una persona fisica no puede ser empleador y una persona juridica solo puede ser empleador.
          if ($persona->tipo_persona == 'fisica' && $rol_empleador) {
            $error = true;
            $errorMnj = 'Datos invalidos para el campo Roles.';
          }
          if ( (count($roles_seleccionados) == 1) && ($persona->tipo_persona == 'juridica' && !$rol_empleador) ) {
            $error = true;
            $errorMnj = 'Datos invalidos para el campo Roles.';
          }
          //Control para que una persona juridica no tenga más de un usuario y sea diferente al que se quiere modificar.
          if ( ($persona->tipo_persona == 'juridica') && (count($persona->usuarios) > 0) ) {
            if ($usuario->persona->id != $request->persona_id) {
              $error = true;
              $errorMnj = 'Persona inválida.';
            }
          }
          if ($persona->tipo_persona == 'fisica' && $rol_postulante) {
            $unlu_estudiante = new Unlu_Estudiante();
            $unlu_estudiante = Unlu_Estudiante::where('nro_documento',$persona->fisica->nro_documento)
              ->where('email',$request->email)
              ->first();
            if($unlu_estudiante == null){
              $error = true;
              $errorMnj = 'No existe un estudiante con los datos ingresados.';
            }
          }
          if ($error) {
            Flash::error($errorMnj)->important(); // se muestra el msj de usuario creado
            return redirect()->back();
          }
          else {
            //Si aun no tiene estudiante y tiene rol postulante, se crea el estudiante y el cv.
            if ($persona->tipo_persona == 'fisica' && $rol_postulante) {
              if ($persona->fisica->estudiante == null) {
                $estudiante = new Estudiante();
                $estudiante->fisica_id = $persona->fisica->id;
                $estudiante->unlu_estudiante_id = $unlu_estudiante->id;
                $estudiante->legajo = $unlu_estudiante->legajo;
                $estudiante->carrera_id = $unlu_estudiante->unlu_carrera_id;
                $estudiante->save();//Se inserta el postulante.

                $cv = new Cv();
                $cv->estudiante_id = $estudiante->id;
                $cv->save();//Se inserta el Cv.
              }
            }

            $usuario = Usuario::find($id); // busca el usario al modificar

            // se borra en caso de ser actualizada
            $imagenVieja = $usuario->imagen;

            // pasa todo los valores actializado de request en la user
            $usuario->fill($request->all()); // se asignan todos los valores modificados del usuario al usuario

            $usuario = $this->updateImagen($imagenVieja, $usuario, $request);

            $usuario->save(); // se guarda en BD

            //sincronizo con la tabla pivot
            $roles = $request->input('roles', []);
            $usuario->roles()->sync($roles);

            Flash::warning('Usuario ' . $usuario->nombre_usuario . ' modificado')->important();
            return redirect()->route('in.usuarios.index');
          }
        }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }

    public function getRoles(Request $request){

      $persona = Persona::find($request->persona_id);
      if ($persona->tipo_persona == 'fisica') {//Obtengo los roles dependiendo el tipo de persona.
        if (Auth::user()->hasRole('super_usuario')) {
          $roles = Rol::orderBy('name', 'ASC')->where('estado_rol', 'activo')
            ->where('name','<>','empleador')
            ->lists('name', 'id');
        }
        else {
          $roles = Rol::orderBy('name', 'ASC')->where('estado_rol', 'activo')
            ->where('name','<>','empleador')
            ->where('name','<>','super_usuario')
            ->lists('name', 'id');
        }
      }
      else {
        $roles = Rol::orderBy('name', 'ASC')->where('estado_rol', 'activo')
          ->where('name','=','empleador')
          ->lists('name', 'id');
      }
      return response()->json([
        'roles' => $roles
      ]);

    }

    //------------- CONFIGURACION -------------------

    public function getConfigurarDatos(){

      if (Auth::user()->hasRole('empleador')){
        $pjuridica = Juridica::find(Auth::user()->persona->juridica->id);
        $telefono_fijo = '';
        $telefono_celular = '';
        foreach ($pjuridica->persona->telefonos as $telefono) {
          if ($telefono->tipo_telefono == 'fijo') {
            $telefono_fijo = $telefono->nro_telefono;
          }
          if ($telefono->tipo_telefono == 'celular') {
            $telefono_celular = $telefono->nro_telefono;
          }
        }
        $rubros_empresariales = Rubro_Empresarial::orderBy('id','ASC')
          ->where('estado','activo')->lists('nombre_rubro_empresarial','id');

        return view('in.empresas.configurar-datos')
          ->with('pjuridica',$pjuridica)
          ->with('telefono_fijo',$telefono_fijo)
          ->with('telefono_celular',$telefono_celular)
          ->with('rubros_empresariales',$rubros_empresariales);
      }
      else {
        $pfisica = Fisica::find(Auth::user()->persona->fisica->id);
        $telefono_fijo = '';
        $telefono_celular = '';
        foreach ($pfisica->persona->telefonos as $telefono) {
          if ($telefono->tipo_telefono == 'fijo') {
            $telefono_fijo = $telefono->nro_telefono;
          }
          if ($telefono->tipo_telefono == 'celular') {
            $telefono_celular = $telefono->nro_telefono;
          }
        }

        return view('in.personas.configurar-datos')
          ->with('pfisica',$pfisica)
          ->with('telefono_fijo',$telefono_fijo)
          ->with('telefono_celular',$telefono_celular);
      }

    }

    public function postConfigurarDatosEmpresa(ConfigurarDatosPersonaJuridicaRequest $request){

      if( ($request->telefono_fijo == '') && ($request->telefono_celular == '') ){
        Flash::error('Debe ingresar al menos un Teléfono.')->important();
        return redirect()->back();
      }
      else {
        $this->updatePersona($request, Auth::user()->persona->id);

        $pjuridica = Juridica::find(Auth::user()->persona->juridica->id);
        $pjuridica->rubro_empresarial_id = $request->rubro_empresarial;
        $pjuridica->save();

        $usuario = Usuario::find(Auth::user()->id);
        $imagenVieja = $usuario->imagen;
        $usuario = $this->updateImagen($imagenVieja, $usuario, $request);
        $usuario->save();


        Flash::warning('Datos Modificados.')->important();
        return redirect()->route('in.configurar-datos');
      }

    }

    public function postConfigurarDatosPersona(ConfigurarDatosPersonaFisicaRequest $request){

      if( ($request->telefono_fijo == '') && ($request->telefono_celular == '') ){
        Flash::error('Debe ingresar al menos un Teléfono.')->important();
        return redirect()->back();
      }
      else {
        $this->updatePersona($request, Auth::user()->persona->id);

        $usuario = Usuario::find(Auth::user()->id);
        $imagenVieja = $usuario->imagen;
        $usuario = $this->updateImagen($imagenVieja, $usuario, $request);
        $usuario->save();

        Flash::warning('Datos Modificados.')->important();
        return redirect()->route('in.configurar-datos');
      }

    }

    public function getConfigurarCuentaPassword(){

      return view('in.usuarios.configurar-cuenta-password');

    }

    public function postConfigurarCuentaPassword(ConfigurarPasswordRequest $request){

      if (Hash::check($request->password_actual, Auth::user()->password)) {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        Flash::warning('Contraseña Modificada.')->important();
        return redirect()->route('in.configurar-cuenta-password');
      }
      else {
        Flash::error('Contraseña Incorrecta.')->important();
        return redirect()->route('in.configurar-cuenta-password');
      }

    }

    //------------- REGISTRO DE Estudiante -------------------

    protected function getRegistroEstudiante(){

        $tipos_documento = Tipo_Documento::all();

        return view('auth.registro_estudiante')
        ->with('tipos_documento',$tipos_documento);

    }

    protected function postRegistroEstudiante(RegistroEstudianteRequest $request){

        $error = false;
        $tipo_documento = Tipo_Documento::find($request->tipo_documento);
        $unlu_estudiante = Unlu_Estudiante::select()->where('legajo','=',$request->legajo)
          ->where('tipo_documento','=',$tipo_documento->nombre_tipo_documento)
          ->where('nro_documento','=',$request->nro_documento)
          ->where('email','=',$request->email)
          ->get(); //Comprobamos que la persona es realmente un estudiante de la UNLu.
        if (count($unlu_estudiante) > 0)  {
          $nombre_unlu_estudiante = strtolower($unlu_estudiante[0]->nombre);
          $apellido_unlu_estudiante = strtolower($unlu_estudiante[0]->apellido);
          $nombre_persona = strtolower($request->nombre_persona);
          $apellido_persona = strtolower($request->apellido_persona);
          if ( ($nombre_unlu_estudiante == $nombre_persona) && ($apellido_unlu_estudiante == $apellido_persona) ) { //Verificamos que el resto de sus datos sean correctos
            $persona = new \stdClass();
            $persona->domicilio_residencia = $unlu_estudiante[0]->domicilio;
            $persona->localidad_residencia = $unlu_estudiante[0]->localidad;
            $persona->provincia_residencia = $unlu_estudiante[0]->provincia;
            $persona->pais_residencia = $unlu_estudiante[0]->pais;
            $persona->telefono_fijo = $unlu_estudiante[0]->telefono_fijo;
            $persona->telefono_celular = $unlu_estudiante[0]->telefono_celular;
            $persona_id = $this->storePersona($persona,'Fisica');//Se inserta la persona.

            $pfisica = new Fisica();
            $pfisica->persona_id = $persona_id;
            $pfisica->nombre_persona = $unlu_estudiante[0]->nombre;
            $pfisica->apellido_persona = $unlu_estudiante[0]->apellido;
            $pfisica->fecha_nacimiento = $unlu_estudiante[0]->fecha_nacimiento;
            $pfisica->cuil = $unlu_estudiante[0]->cuil;
            $pfisica->tipo_documento_id = $request->tipo_documento;
            $pfisica->nro_documento = $request->nro_documento;
            $pfisica->save();//Se inserta la persona fisica.

            $estudiante = new Estudiante();
            $estudiante->fisica_id = $pfisica->id;
            $estudiante->unlu_estudiante_id = $unlu_estudiante[0]->id;
            $estudiante->legajo = $unlu_estudiante[0]->legajo;
            $estudiante->carrera_id = $unlu_estudiante[0]->unlu_carrera_id;
            $estudiante->save();//Se inserta el postulante.

            $cv = new Cv();
            $cv->estudiante_id = $estudiante->id;
            $cv->save();//Se inserta el Cv.

            $usuario = new Usuario();
            $usuario->nombre_usuario = $request->nombre_usuario;
            $usuario->email = $request->email;
            $data['email'] = $usuario->email;
            $usuario->password = bcrypt($request->password);
            $usuario->estado_usuario = 'inactivo';
            $usuario->persona_id = $persona_id;
            $usuario->verificacion_token = str_random(100);
            $data['verificacion_token'] = $usuario->verificacion_token;
            $usuario->save();//Se inserta el usuario.

            $rol = Rol::select()->where('name','=','postulante')
            ->get();
            $usuario->roles()->sync([$rol[0]->id]);;//Se inserta el rol.

            Mail::send('emails.verificacion_usuario_estudiante', ['data' => $data], function($message) use ($data){
              $message->from('unlutrabajo@gmail.com', 'UNLu Trabajo');
              $message->subject('Verificación de Usuario');
              $message->to($data['email']);
            });//Se manda mail de confirmacion.

            Flash::success('¡Registro exitoso, se ha enviado un e-mail para verificar su usuario!.')->important();
            return redirect()->route('auth.login');
          }
          else {
            $error = true;
          }
        }
        else {
          $error = true;
        }

        if ($error) {
          Flash::error('Los datos ingresados no coinciden con nuestros registros.')->important();
          return redirect()->back();
        }
    }

    protected function verificacionUsuarioEstudiante(Request $request){

      if(isset($_GET['email'])) {
        $usuario = Usuario::where('email', '=', $request->email)
        ->where('verificacion_token', '=', $request->token)
        ->get();

        if (count($usuario) > 0) {
          $usuario[0]->estado_usuario = 'activo';
          $usuario[0]->verificacion_token = null;
          $usuario[0]->save();
          Flash::success('¡Usuario verificado!')->important();
          return redirect()->route('auth.login');
        }
        else {
          Flash::error('Este token de verificación de usuario es inválido.')->important();
          return redirect()->route('auth.login');
        }
      }
      else {
        return redirect()->route('auth.login');
      }

    }

    //------------- REGISTRO DE EMPLEADOR -------------------

    protected function getRegistroEmpleador(){

      if( (Auth::user()->can('crear_empresa')) && (Auth::user()->can('crear_usuario')) ){
        $rubros_empresariales = Rubro_Empresarial::all()->where('estado','activo');

        return view('in.empresas.registro_empleador')
        ->with('rubros_empresariales',$rubros_empresariales);
      }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
      }
    }

    protected function postRegistroEmpleador(RegistroEmpleadorRequest $request){

      if( (Auth::user()->can('crear_empresa')) && (Auth::user()->can('crear_usuario')) ){
          if( ($request->telefono_fijo == '') && ($request->telefono_celular == '') ){
            Flash::error('Debe ingresar al menos un Teléfono.')->important();
            return redirect()->back();
          }
          else {
            $persona_id = $this->storePersona($request,'juridica');//Inserta la Persona y devuelve el id asignado.

            $pjuridica = new Juridica();
            $pjuridica->persona_id = $persona_id;
            $pjuridica->nombre_comercial = $request->nombre_comercial;
            $pjuridica->cuit = $request->cuit;
            $pjuridica->fecha_fundacion = date('Y-m-d', strtotime($request->fecha_fundacion));
            $pjuridica->rubro_empresarial_id = $request->rubro_empresarial;
            $pjuridica->save();//Inserta la Empresa

            $usuario = new Usuario();
            $usuario->nombre_usuario = $request->nombre_usuario;
            $usuario->email = $request->email;
            $data['email'] = $usuario->email;
            $usuario->estado_usuario = 'inactivo';
            $usuario->persona_id = $persona_id;
            $usuario->verificacion_token = str_random(100);
            $data['verificacion_token'] = $usuario->verificacion_token;
            $usuario->save();//Inserta el usuario

            $rol = Rol::select()->where('name','=','empleador')
            ->get();
            $usuario->roles()->sync([$rol[0]->id]);;//Se inserta el rol.

            Mail::send('emails.verificacion_usuario_empleador', ['data' => $data], function($message) use ($data){
              $message->from('unlutrabajo@gmail.com', 'UNLu Trabajo');
              $message->subject('Registro - Verificación de Usuario');
              $message->to($data['email']);
            });//Se manda mail de confirmacion.

            Flash::success('Empresa ' . $pjuridica->nombre_comercial . ' registrada,
                            se ha enviado un e-mail esperando su verificación.')->important();
            return redirect()->route('in.registro-empleador');
          }
      }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
      }

    }

    protected function getVerificacionUsuarioEmpleador($token = null){

      if(isset($_GET['email'])) {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        return view('auth.password_verificacion_empleador')
          ->with('token', $token);
      }
      else {
        return redirect()->route('auth.login');
      }

    }

    protected function postVerificacionUsuarioEmpleador(Request $request){
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $usuario = Usuario::where('email', '=', $request->email)
        ->where('verificacion_token', '=', $request->token)
        ->get();

        if (count($usuario) > 0) {
          $usuario[0]->estado_usuario = 'activo';
          $usuario[0]->verificacion_token = null;
          $usuario[0]->password = bcrypt($request->password);
          $usuario[0]->save();
          Flash::success('¡Usuario verificado!')->important();
          return redirect()->route('auth.login');
        }
        else {
          Flash::error('Este token de verificación de usuario es inválido.')->important();
          return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){ // elimina el usuario de la BD
        if( (Auth::user()->can('modificar_usuario') && !$this->isSuperUsuario($id)) ||  Auth::user()->hasRole('super_usuario')){
          $usuario = Usuario::find($id); // busca el usuario por su id

          File::delete(public_path().'/img/usuarios/'.$usuario->imagen);
          $usuario->delete(); // lo elimina

          Flash::error('Usuario ' . $usuario->nombre_usuario . ' eliminado.')->important();
          return redirect()->route('in.usuarios.index');
        }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }
}
