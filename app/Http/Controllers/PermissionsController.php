<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Permission as Permiso;
use App\Http\Requests\StorePermisoRequest;
use App\Http\Requests\UpdatePermisoRequest;
use Illuminate\Support\Facades\Auth;

class PermissionsController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      if(Auth::user()->can('listar_permisos')){
        $permisos = Permiso::orderBy('id','DESC')->get();

        return view('in.permisos.index')
            ->with('permisos',$permisos);
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
      if(Auth::user()->can('crear_permiso')){
        return view('in.permisos.create');
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
  public function store(StorePermisoRequest $request)
  {
      if(Auth::user()->can('crear_permiso')){
        $permiso = new Permiso($request->all());

        $permiso->save();

        Flash::success('Permiso ' . $permiso->name . ' agregado.')->important();
        return redirect()->route('in.permisos.index');
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
      if(Auth::user()->can('modificar_permiso')){
        $permiso = Permiso::find($id);
        // retorna una vista con un parametro
        return view('in.permisos.edit')->with('permiso',$permiso);
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
  public function update(UpdatePermisoRequest $request, $id)
  {
      if(Auth::user()->can('modificar_permiso')){
        $permiso = Permiso::find($id);

        // pasa todo los valores actializado de request en la user
        $permiso->fill($request->all());
        $permiso->save();

        Flash::warning('Permiso ' . $permiso->name . ' modificado.')->important();
        return redirect()->route('in.permisos.index');
      }else{
        return redirect()->route('in.sinpermisos.sinpermisos');
      }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      if(Auth::user()->can('eliminar_permiso')){
        $permiso = Permiso::find($id);

        $permiso->delete();

        Flash::error('Permiso ' . $permiso->name . ' eliminado.')->important();
        return redirect()->route('in.permisos.index');
      }else{
        return redirect()->route('in.sinpermisos.sinpermisos');
      }
  }
}
