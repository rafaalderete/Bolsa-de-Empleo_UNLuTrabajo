<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Juridica as Juridica;
use App\Rubro_Empresarial as Rubro_Empresarial;
use App\Experiencia_Laboral as Experiencia_Laboral;
use App\Http\Requests\StoreRubroEmpresarialRequest;
use App\Http\Requests\UpdateRubroEmpresarialRequest;
use Illuminate\Support\Facades\Auth;

class RubrosEmpresarialesController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      if(Auth::user()->can('listar_rubros_empresariales')){
        $rubros = Rubro_Empresarial::orderBy('id','DESC')->get();

        return view('in.rubros_empresariales.index')
            ->with('rubros',$rubros);
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
      if(Auth::user()->can('crear_rubro_empresarial')){
        return view('in.rubros_empresariales.create');
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
  public function store(StoreRubroEmpresarialRequest $request)
  {
      if(Auth::user()->can('crear_rubro_empresarial')){
        $rubro = new Rubro_Empresarial($request->all());

        $rubro->save();

        Flash::success('Rubro Empresarial ' . $rubro->nombre_rubro_empresarial . ' agregado.')->important();
        return redirect()->route('in.rubros-empresariales.index');
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
      if(Auth::user()->can('modificar_rubro_empresarial')){
        $rubro = Rubro_Empresarial::find($id);
        return view('in.rubros_empresariales.edit')->with('rubro',$rubro);
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
  public function update(UpdateRubroEmpresarialRequest $request, $id)
  {
      if(Auth::user()->can('modificar_rubro_empresarial')){
        $rubro = Rubro_Empresarial::find($id);

        $rubro->fill($request->all());
        $rubro->save();

        Flash::warning('Rubro ' . $rubro->nombre_rubro_empresarial . ' modificado.')->important();
        return redirect()->route('in.rubros-empresariales.index');
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
      if(Auth::user()->can('eliminar_rubro_empresarial')){
        $rubro = Rubro_Empresarial::find($id);
        $pjuridicas = Juridica::where('rubro_empresarial_id','=',$id)->get();
        $experiencias_laborales = Experiencia_Laboral::where('rubro_empresarial_id','=',$id)->get();
        if( (count($pjuridicas) == 0 ) && (count($experiencias_laborales) == 0 ) ) {//Se verifica que no esta uso.

          $rubro->delete();

          Flash::error('Rubro ' . $rubro->nombre_rubro_empresarial . ' eliminado.')->important();
          return redirect()->route('in.rubros-empresariales.index');
        }
        else {
          Flash::error('El Rubro ' . $rubro->nombre_rubro_empresarial . ' no se puede eliminar ya que se encuentra en uso.')->important();
          return redirect()->route('in.rubros-empresariales.index');
        }
      }else{
        return redirect()->route('in.sinpermisos.sinpermisos');
      }
  }
}
