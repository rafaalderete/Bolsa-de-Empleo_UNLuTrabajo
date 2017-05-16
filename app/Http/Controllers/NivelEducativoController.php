<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

use App\Nivel_Educativo as Nivel_Educativo;
use App\Estudio_Academico as Estudio_Academico;
use App\Http\Requests\StoreNivelEducativoRequest;
use App\Http\Requests\UpdateNivelEducativoRequest;
use Illuminate\Support\Facades\Auth;

class NivelEducativoController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      if(Auth::user()->can('listar_niveles_educativos')){
        $nivel_educativo = Nivel_Educativo::orderBy('id','DESC')->get();

        return view('in.nivel_educativo.index')
            ->with('niveles_educativos',$nivel_educativo);
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
      if(Auth::user()->can('crear_nivel_educativo')){
        return view('in.nivel_educativo.create');
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
  public function store(StoreNivelEducativoRequest $request)
  {
      if(Auth::user()->can('crear_nivel_educativo')){
        $nivel_educativo = new Nivel_Educativo($request->all());

        $nivel_educativo->save();

        Flash::success('Nivel Educativo ' . $nivel_educativo->nombre_nivel_educativo . ' agregado.')->important();
        return redirect()->route('in.nivel_educativo.index');
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
      if(Auth::user()->can('modificar_nivel_educativo')){
        $nivel_educativo = Nivel_Educativo::find($id);
        return view('in.nivel_educativo.edit')->with('niveles_educativos',$nivel_educativo);
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
  public function update(UpdateNivelEducativoRequest $request, $id)
  {
      if(Auth::user()->can('modificar_nivel_educativo')){
        $nivel_educativo = Nivel_Educativo::find($id);

        $nivel_educativo->fill($request->all());
        $nivel_educativo->save();

        Flash::warning('Nivel Educativo ' . $nivel_educativo->nombre_nivel_educativo . ' modificado.')->important();
        return redirect()->route('in.nivel_educativo.index');
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
      if(Auth::user()->can('eliminar_nivel_educativo')){
        $nivel_educativo = Nivel_Educativo::find($id);
        $estudio_academico = Estudio_Academico::where('nivel_educativo_id','=',$id)->get();
        if( (count($estudio_academico) == 0 ) ) {//Se verifica que no esta uso.

          $nivel_educativo->delete();

          Flash::error('Nivel Educativo ' . $nivel_educativo->nombre_nivel_educativo . ' eliminado.')->important();
          return redirect()->route('in.nivel_educativo.index');
        }
        else {
          Flash::error('El Nivel Educativo ' . $nivel_educativo->nombre_nivel_educativo . ' no se puede eliminar ya que se encuentra en uso.')->important();
          return redirect()->route('in.nivel_educativo.index');
        }
      }else{
        return redirect()->route('in.sinpermisos.sinpermisos');
      }
  }
}
