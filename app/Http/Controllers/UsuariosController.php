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
use App\Role as Rol;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Support\Facades\Auth;

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
          $usuarios = Usuario::orderBy('id','DESC')->get(); // trae los usarios los ordena en forma DESC por id
                                                                  // los pagina trayendolos en un array

         $personas = Persona::orderBy('nombre_persona', 'ASC')->lists('nombre_persona', 'id'); // lista los nombres de las personas asociandolos con sus id  Ej: id => nombre_persona

           $usuarios->each(function($usuarios){ // es un foreach por usuario
              // se llaman a los metodos del usuario q se relacionan con las otras tablas
              $usuarios->persona; // recupera los datos de la persona asociada al usuario
              $usuarios->roles; // recupera los datos de los roles asoaciado al asuario
          });

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
            $roles = Rol::orderBy('name', 'ASC')->paginate()->where('estado_rol', 'activo')->lists('name', 'id'); // trae todos los roles activos
          }
          else {
            $roles = Rol::orderBy('name', 'ASC')->where('estado_rol', 'activo')->where('name','<>','super_usuario')->lists('name', 'id');
          }
          $personas = Persona::orderBy('nombre_persona', 'ASC')->paginate()->where('estado_persona', 'activo'); // recupero array de personas que estan activas
          //dd($roles);
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

          $personasAct = Persona::orderBy('nombre_persona', 'ASC')->paginate()->where('estado_persona', 'activo'); // recupero array de
          foreach ($personasAct as $persona) {
            $personas[$persona->id] = "$persona->nombre_persona $persona->apellido_persona";
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
          //log::info($my_roles);

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

          // pasa todo los valores actializado de request en la user
          $usuario->fill($request->all()); // se asignan todos los valores modificados del usuario al usuario
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

/*
    public function asignar_roles($id)
    {
      $usuario = Usuario::find($id);
      log::info($usuario);

 Ejemplo utilizado para probar DB, Array y JSon esto va en el Modelo

      $result = DB::select("select * from usuarios" );
      $array = json_decode(json_encode($result), true);

      log::info($array);

      log::info(" El id es: {$array["0"]["id"]}");

      foreach($array as $objeto){
         log::info("El ID es: {$objeto["id"]}");
      }


      $u = $usuario->roles;
      log::info($u);
      $a = $usuario->roles()->toArray();
      log::info($a);

      $roles = Rol::orderBy('name', 'ASC')->lists('name', 'id'); // recupera todos los roles que existen
      log::info($roles);

      // necesito el array de los roles q contiene
      $my_roles = $usuario->roles->lists('id')->toArray(); // pasa los roles del usuario (son objetos) a un array
      log::info($my_roles);
      // retorna una vista con un parametro
      return view('admin.usuarios.asignar_roles')
        ->with('usuario',$usuario)
        ->with('roles',$roles)
        ->with('my_roles',$my_roles);
    }

    public function asignar_roles_update(Request $request, $id)
    {

      $usuario = Usuario::find($id);

      // pasa todo los valores actializado de request en la user
      $usuario->fill($request->all());
      $usuario->save();


      //sincronizo con la tabla pivot
      $roles = $request->input('roles', []);
      $usuario->roles()->sync($roles);

      Flash::warning('Roles asignados a ' . $usuario->nombre_usuario);
      return redirect()->route('admin.usuarios.index');
    }
*/

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
