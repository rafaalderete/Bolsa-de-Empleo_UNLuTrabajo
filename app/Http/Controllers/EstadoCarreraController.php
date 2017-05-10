<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEstadoCarreraRequest;
use App\Http\Requests\UpdateEstadoCarreraRequest;
use App\Estado_Carrera as Estado_Carrera;

use App\Conocimiento_Informatico as Conocimiento_Informatico;

class EstadoCarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('listar_estados_carrera')) {
            $estado_carrera = Estado_Carrera::orderBy('id', 'DESC')->get(); #me traigo de la bd los idiomas cargados en id descendentes

            return view('in.estado_carrera.index')->with('estado_carrera', $estado_carrera);
        } else {
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
        if(Auth::user()->can('crear_estado_carrera')){
            return view('in.estado_carrera.create');
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
    public function store(StoreEstadoCarreraRequest $request)
    {
        if(Auth::user()->can('crear_estado_carrera')){
            $estado_carrera = new Estado_Carrera($request->all());

            $estado_carrera->save();

            Flash::success('Estado Carrera' . $estado_carrera->nombre_estado_carrera . ' agregado.')->important();
            return redirect()->route('in.estados_carrera.index');
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
        if(Auth::user()->can('modificar_estado_carrera')){
            $estado_carrera= Estado_Carrera::find($id);
            return view('in.estado_carrera.edit')->with('estados_carrera,$estado_carrera');
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
    public function update(UpdateEstadoCarreraRequest $request, $id)
    {
        if(Auth::user()->can('modificar_estado_carrera')){
            $estado_carrera = Estado_Carrera::find($id);

            $estado_carrera->fill($request->all());
            $estado_carrera->save();

            Flash::warning('Estado Carrera ' . $estado_carrera->nombre_estado_carrera. ' modificado.')->important();
            return redirect()->route('in.estado_carrera.index');
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
         if(Auth::user()->can('eliminar_estado_carrera')){
            $estado_carrera = Estado_Carrera::find($id);
            $cinformatico = Conocimiento_Informatico::where('estado_carrera_id', '=',$id)->get();
                       
            if( (count($cinformatico) == 0) ) {//Se verifica que no esta uso.

              $tipo_software->delete();

              Flash::error('Tipo Software ' . $estado_carrera->nombre_estado_carrera . ' eliminado.')->important();
              return redirect()->route('in.estado_carrera.index');
            }
            else {
              Flash::error('El Tipo Software ' . $estado_carrera->nombre_tipo_software . ' no se puede eliminar ya que se encuentra en uso.')->important();
              return redirect()->route('in.estado_carrera.index');
            }
          }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
          }
    }
}
