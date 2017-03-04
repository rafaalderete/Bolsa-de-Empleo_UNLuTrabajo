<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Permission as Permiso;
use App\Http\Requests\PermisoRequest;

class PermissionsController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
       $permisos = Permiso::orderBy('id','DESC')->paginate();

      return view('in.permisos.index')
          ->with('permisos',$permisos);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('in.permisos.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(PermisoRequest $request)
  {
      $permiso = new Permiso($request->all());

      $permiso->save();

      Flash::success('Permiso ' . $permiso->nombre_permiso . ' agregado');
      return redirect()->route('in.permisos.index');
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
      $permiso = Permiso::find($id);
      // retorna una vista con un parametro
      return view('in.permisos.edit')->with('permiso',$permiso);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      $permiso = Permiso::find($id);

      // pasa todo los valores actializado de request en la user
      $permiso->fill($request->all());
      $permiso->save();

      Flash::warning('Permiso ' . $permiso->nombre_permiso . ' modificado');
      return redirect()->route('in.permisos.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      $permiso = Permiso::find($id);

      $permiso->delete();

      Flash::error('Permiso ' . $permiso->nombre_permiso . ' eliminado');
      return redirect()->route('in.permisos.index');
  }
}
