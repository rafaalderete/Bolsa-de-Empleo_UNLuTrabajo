<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Usuario as Usuario;
use App\Persona as Persona;
use App\Tipo_Documento as Tipo_Documento;
use App\Role as Rol;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Mail;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // pantalla principal donde lista los usuarios
    {
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

    private function isSuperUsuario ($id)
    {
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
    public function create() // envia a la vista para cargar los datos del nuevo usuario
    {
        if(Auth::user()->can('crear_usuario')){
          if (Auth::user()->hasRole('super_usuario')) {
            $roles = Rol::orderBy('name', 'ASC')->where('estado_rol', 'activo')->lists('name', 'id'); // trae todos los roles activos
          }
          else {
            $roles = Rol::orderBy('name', 'ASC')->where('estado_rol', 'activo')->where('name','<>','super_usuario')->lists('name', 'id');
          }
          $personas = Persona::all()->where('estado_persona', 'activo'); // recupero array de personas que estan activas

          return view('in.usuarios.create')
              ->with('personas',$personas)
              ->with('roles',$roles);
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
    public function store(StoreUsuarioRequest $request) // almacena los datos en Base y muestra el msj de OK, devuelve al index
    {
        if(Auth::user()->can('crear_usuario')){
          // se usan los valores de la vista del usuario creado
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

          Flash::success('Usuario ' . $usuario->nombre_usuario . ' agregado')->important(); // se muestra el msj de usuario creado
          return redirect()->route('in.usuarios.index'); // se devuelve al index
        }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // envia a la vista para evitar los datos del usurio.
                              // No siempre se pueden editar todos los mismos datos que al crear
    {
        if( (Auth::user()->can('modificar_usuario') && !$this->isSuperUsuario($id)) ||  Auth::user()->hasRole('super_usuario')){
          $usuario = Usuario::find($id); // busca al usuario por el id

          $personasAct = Persona::all()->where('estado_persona', 'activo'); // recupero array de
          foreach ($personasAct as $persona) {
            if($persona->tipo_persona == 'fisica') {
              $personas[$persona->id] = $persona->fisica->nombre_persona.' '.$persona->fisica->apellido_persona;
            }
            else {
              $personas[$persona->id] = $persona->juridica->nombre_comercial;
            }
          }
          //dd($personas);

          $my_persona = $usuario->persona_id; // recupero id de persona asociada

          if (Auth::user()->hasRole('super_usuario')) {
            $roles = Rol::orderBy('name', 'ASC')->paginate()->where('estado_rol', 'activo')->lists('name', 'id'); // trae todos los roles activos
          }
          else {
            $roles = Rol::orderBy('name', 'ASC')->where('estado_rol', 'activo')->where('name','<>','super_usuario')->lists('name', 'id');
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsuarioRequest $request, $id) // permite modificar los datos del usuario
    {
        if( (Auth::user()->can('modificar_usuario') && !$this->isSuperUsuario($id)) ||  Auth::user()->hasRole('super_usuario')){
          $usuario = Usuario::find($id); // busca el usario al modificar

          // se borra en caso de ser actualizada
          $imagenVieja = $usuario->imagen;

          // pasa todo los valores actializado de request en la user
          $usuario->fill($request->all()); // se asignan todos los valores modificados del usuario al usuario

          //Garda la Imagen. Manipular Imagenes y no coliciones de nombres
          if ($request->file('imagen')) {
              File::delete(public_path().'/img/usuarios/'.$imagenVieja);
              $file = $request->file('imagen');
              $name = 'image_' . time().'.'. $file->getClientOriginalExtension();
              $path = public_path(). '/img/usuarios/';
              $file->move($path, $name);
              $usuario->imagen = $name;
          }

          $usuario->save(); // se guarda en BD

          //sincronizo con la tabla pivot
          $roles = $request->input('roles', []);
          $usuario->roles()->sync($roles);

          Flash::warning('Usuario ' . $usuario->nombre_usuario . ' modificado')->important();
          return redirect()->route('in.usuarios.index');
        }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }

    protected function getRegistro(){

        $tipos_documento = Tipo_Documento::all();

        return view('auth.registro')
        ->with('tipos_documento',$tipos_documento);

    }

    protected function postRegistro(Request $request){

        $usuario = new Usuario();
        $usuario->nombre_usuario = $request->nombre_usuario;
        $usuario->email = $request->email;
        $data['email'] = $usuario->email;
        $usuario->password = bcrypt($request->password);
        $usuario->estado_usuario = 'inactivo';
        $usuario->persona_id = 1;
        $usuario->confirmacion_token = str_random(100);
        $data['confirmacion_token'] = $usuario->confirmacion_token;
        $usuario->save();

        Mail::send('emails.confirmacion_usuario', ['data' => $data], function($message) use ($data){
          $message->from('unlutrabajo@gmail.com', 'UNLu Trabajo');
          $message->subject('Verificación de Usuario');
          $message->to($data['email']);
        });

        Flash::success('¡Registro exitoso, se ha enviado un e-mail para verificar su usuario!')->important();
        return redirect()->route('registro');

    }

    protected function confirmacionCuenta(Request $request){

        $usuario = Usuario::where('email', '=', $request->email)
        ->where('confirmacion_token', '=', $request->token)
        ->get();

        if (count($usuario) > 0) {
          $usuario[0]->estado_usuario = 'activo';
          $usuario[0]->confirmacion_token = null;
          $usuario[0]->save();
          Flash::success('¡Usuario verificado!')->important();
          return redirect()->route('auth.login');
        }
        else {
          return redirect()->route('auth.login');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // elimina el usuario de la BD
    {
        if( (Auth::user()->can('modificar_usuario') && !$this->isSuperUsuario($id)) ||  Auth::user()->hasRole('super_usuario')){
          $usuario = Usuario::find($id); // busca el usuario por su id

          $usuario->delete(); // lo elimina

          Flash::error('Usuario ' . $usuario->nombre_usuario . ' eliminado')->important();
          return redirect()->route('in.usuarios.index');
        }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }
}
