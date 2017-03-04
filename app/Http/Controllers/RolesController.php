<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Role as Rol;
use App\Http\Requests\RolRequest;

use App\Permission as Permiso;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::orderBy('id','DESC')->paginate();

        return view('in.roles.index')
            ->with('roles',$roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisos = Permiso::orderBy('name','ASC')->where('estado_permiso', 'activo')->lists('name','id');// devuelve la lista

        return view('in.roles.create')
             ->with('permisos',$permisos);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolRequest $request)
    {
        $rol = new Rol($request->all());

        $rol->save();

        //sincronizo con la tabla pivot
        $permisos = $request->input('permisos', []);
        $rol->permissions()->sync($permisos);


        Flash::success('Rol ' . $rol->name . ' agregado');
        return redirect()->route('in.roles.index');
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
        $rol = Rol::find($id);

        $permisos = Permiso::orderBy('name','ASC')->lists('name','id');// devuelve la lista

        // necesito el array de los permisos q contiene
        $my_permisos = $rol->permissions->lists('id')->toArray(); // pasa un objeto a un array

        // retorna una vista con un parametro
        return view('in.roles.edit')
          ->with('rol',$rol)
          ->with('permisos',$permisos)
          ->with('my_permisos',$my_permisos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolRequest $request, $id)
    {
        $rol = Rol::find($id);

        // pasa todo los valores actializado de request en la user
        $rol->fill($request->all());
        $rol->save();


        //sincronizo con la tabla pivot
        $permisos = $request->input('permisos', []);
        $rol->permissions()->sync($permisos);


        Flash::warning('Rol ' . $rol->name . ' modificado');
        return redirect()->route('in.roles.index');
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
        $rol = Rol::find($id);

        $rol->delete();

        Flash::error('Rol ' . $rol->name . ' eliminado');
        return redirect()->route('in.roles.index');
    }
}
