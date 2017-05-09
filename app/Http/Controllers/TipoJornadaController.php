<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;
use App\Tipo_Jornada as Tipo_Jornada;
use App\HTTp\Requests\StoreTipoJornadaRequest;
use App\Http\Requests\UpdateTipoJornadaRequest;

class TipoJornadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        #primero debo asegurarme que la persoana que intenta acceder tenga los permisos
        if (Auth::user()->can('listar_tipos_jornada')) {
            $tipo_jornada = Tipo_Jornada::orderBy('id', 'DESC')->get(); #me traigo de la bd los idiomas cargados en id descendentes

            return view('in.tipo_jornada.index')->with('tipo_jornada', $tipo_jornada);
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
          if(Auth::user()->can('crear_tipo_jornada')){
            return view('in.tipo_jornada.create');
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
    public function store(StoreTipoJornadaRequest $request)
    {
        if(Auth::user()->can('crear_tipo_jornada')){
        $tipo_jornada = new Tipo_Jornada($request->all());

        $tipo_jornada->save();

        Flash::success('Tipo Jornada' . $tipo_jornada->nombre_tipo_jornada . ' agregado.')->important();
        return redirect()->route('in.tipo_jornada.index');
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
        if(Auth::user()->can('modificar_tipo_jornada')){
            $tipo_jornada = Tipo_Jornada::find($id);
            return view('in.tipo_jornada.edit')->with('tipo_jornada',$tipo_jornada);
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
    public function update(UpdateTipoJornadaRequest $request, $id)
    {
        if(Auth::user()->can('modificar_tipo_jornada')){
            $tipo_jornada = Tipo_Jornada::find($id);

            $tipo_jornada->fill($request->all());
            $tipo_jornada->save();

            Flash::warning('Tipo Jornada ' . $tipo_jornada->nombre_tipo_jornada . ' modificado.')->important();
            return redirect()->route('in.tipo_jornada.index');
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
        //
    }
}
