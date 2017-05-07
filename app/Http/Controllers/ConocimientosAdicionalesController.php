<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Conocimiento_Adicional as Conocimiento_Adicional;
use Illuminate\Support\Facades\Auth;

class ConocimientosAdicionalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('listar_conocimientos_adicionales_cv')){
            $conocimientosAdicionales = Conocimiento_Adicional::where('cv_id',Auth::user()->persona->fisica->estudiante->cv->id)->orderBy('id','DESC')->get();
            return view('in.cv.conocimientos_adicionales.index')
                ->with('conocimientosAdicionales',$conocimientosAdicionales);
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
        if(Auth::user()->can('crear_conocimiento_adicional_cv')){
            return view('in.cv.conocimientos_adicionales.create');
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
    public function store(Request $request)
    {
        if(Auth::user()->can('crear_conocimiento_adicional_cv')){
            $conocimientoAdicional = new Conocimiento_Adicional();
            $conocimientoAdicional->cv_id = Auth::user()->persona->fisica->estudiante->cv->id;
            $conocimientoAdicional->nombre_conocimiento = $request->nombre_conocimiento;
            $conocimientoAdicional->descripcion_conocimiento = $request->descripcion_conocimiento;
            $conocimientoAdicional->save();

            Flash::success('Conocimiento Adicional ' . $conocimientoAdicional->nombre_conocimiento . ' agregado.')->important();
              return redirect()->route('in.gestionar-cv.conocimientos-adicionales.index');
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
        if(Auth::user()->can('modificar_conocimiento_adicional_cv')){
            $conocimientoAdicional = Conocimiento_Adicional::find($id); // busca el usuario por su id
            
            return view('in.cv.conocimientos_adicionales.edit')
                                ->with('conocimientoAdicional',$conocimientoAdicional);
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
    public function update(Request $request, $id)
    {
        if(Auth::user()->can('modificar_conocimiento_adicional_cv')){
            $conocimientoAdicional = Conocimiento_Adicional::find($id);
            $conocimientoAdicional->cv_id = Auth::user()->persona->fisica->estudiante->cv->id;
            $conocimientoAdicional->nombre_conocimiento = $request->nombre_conocimiento;
            $conocimientoAdicional->descripcion_conocimiento = $request->descripcion_conocimiento;
            $conocimientoAdicional->save();

            Flash::warning('Conocimiento Adicional ' . $conocimientoAdicional->nombre_conocimiento . ' modificado.')->important();
              return redirect()->route('in.gestionar-cv.conocimientos-adicionales.index');
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
        if(Auth::user()->can('eliminar_conocimiento_adicional_cv')){
          $conocimientoAdicional = Conocimiento_Adicional::find($id); // busca el usuario por su id

          $conocimientoAdicional->delete(); // lo elimina

          Flash::error('Conocimiento Adicional ' . $conocimientoAdicional->nombre_conocimiento . ' eliminado.')->important();
          return redirect()->route('in.gestionar-cv.conocimientos-adicionales.index');
        }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }
}
