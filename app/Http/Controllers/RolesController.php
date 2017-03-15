<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Role as Rol;
use App\Http\Requests\StoreRolRequest;
use App\Http\Requests\UpdateRolRequest;
use App\Permission as Permiso;
use Illuminate\Support\Facades\Auth;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('listar_roles')){
            $roles = Rol::orderBy('id','DESC')->paginate();

            return view('in.roles.index')
                ->with('roles',$roles);
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->can('crear_rol')){
          if (Auth::user()->hasRole('super_usuario')) {
            $permisos = Permiso::orderBy('name','ASC')->where('estado_permiso', 'activo')->lists('name','id'); // trae todos los roles activos
          }
          else {
            $permisos = Permiso::orderBy('name','ASC')
            ->where('estado_permiso', 'activo')
            ->where('name','<>','crear_permiso')
            ->where('name','<>','eliminar_permiso')
            ->where('name','<>','modificar_permiso')
            ->lists('name','id');
          }
          return view('in.roles.create')
                  ->with('permisos',$permisos);
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
    public function store(StoreRolRequest $request)
    {
        if(Auth::user()->can('crear_rol')){
            $rol = new Rol($request->all());

            $rol->save();

            //sincronizo con la tabla pivot
            $permisos = $request->input('permisos', []);
            $rol->permissions()->sync($permisos);


            Flash::success('Rol ' . $rol->name . ' agregado')->important();
            return redirect()->route('in.roles.index');
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
    public function edit($id)
    {
        if((Auth::user()->can('modificar_rol') && ($id != 1)) || Auth::user()->hasRole('super_usuario')){
            $rol = Rol::find($id);

            if (Auth::user()->hasRole('super_usuario')) {
              $permisos = Permiso::orderBy('name','ASC')->where('estado_permiso', 'activo')->lists('name','id'); // trae todos los roles activos
            }
            else {
              $permisos = Permiso::orderBy('name','ASC')
              ->where('estado_permiso', 'activo')
              ->where('name','<>','crear_permiso')
              ->where('name','<>','eliminar_permiso')
              ->where('name','<>','modificar_permiso')
              ->lists('name','id');
            }

            // necesito el array de los permisos q contiene
            $my_permisos = $rol->permissions->lists('id')->toArray(); // pasa un objeto a un array

            // retorna una vista con un parametro
            return view('in.roles.edit')
              ->with('rol',$rol)
              ->with('permisos',$permisos)
              ->with('my_permisos',$my_permisos);
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
    public function update(UpdateRolRequest $request, $id)
    {
        if((Auth::user()->can('modificar_rol') && ($id != 1)) || Auth::user()->hasRole('super_usuario')){
            $rol = Rol::find($id);

            // pasa todo los valores actializado de request en la user
            $rol->fill($request->all());
            $rol->save();


            //sincronizo con la tabla pivot
            $permisos = $request->input('permisos', []);
            $rol->permissions()->sync($permisos);


            Flash::warning('Rol ' . $rol->name . ' modificado')->important();
            return redirect()->route('in.roles.index');
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }
/*
    public function asignar_permisos($id)
    {
        $rol = Rol::find($id);

        $permisos = Permiso::orderBy('name','ASC')->lists('name','id');// devuelve la lista

        // necesito el array de los permisos q contiene
        $my_permisos = $rol->permissions->lists('id')->toArray(); // pasa un objeto a un array

        // retorna una vista con un parametro
        return view('admin.roles.asignar_permisos')
          ->with('rol',$rol)
          ->with('permisos',$permisos)
          ->with('my_permisos',$my_permisos);
    }

    public function asignar_permisos_update(Request $request, $id)
    {
        $rol = Rol::find($id);

        // pasa todo los valores actializado de request en la user
        $rol->fill($request->all());
        $rol->save();

        //sincronizo con la tabla pivot
        $permisos = $request->input('permisos', []);
        $rol->permissions()->sync($permisos);

        Flash::warning('Permisos asignados a ' . $rol->name);
        return redirect()->route('admin.roles.index');
    }
*/
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if((Auth::user()->can('eliminar_rol') && ($id != 1)) || Auth::user()->hasRole('super_usuario')){
            $rol = Rol::find($id);

            $rol->delete();

            Flash::error('Rol ' . $rol->name . ' eliminado')->important();
            return redirect()->route('in.roles.index');
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }
}
