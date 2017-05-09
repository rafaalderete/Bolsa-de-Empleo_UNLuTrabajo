<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tipo_Trabajo as Tipo_Trabajo;
use App\Http\Requests\StoreTipoTrabajoRequest;
use App\Http\Requests\UpdateTipoTrabajoRequest;

class TipoTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('listar_tipos_trabajo')){
        $tipo_trabajo = Tipo_Trabajo::orderBy('id','DESC')->get();

        return view('in.tipo_trabajo.index')
            ->with('tipo_trabajo',$tipo_trabajo);
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
        if(Auth::user()->can('crear_tipo_trabajo')){
            return view('in.tipo_trabajo.create');
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
    public function store(StoreTipoTrabajoRequest $request)
    {
        if(Auth::user()->can('crear_tipo_trabajo')){
            $tipo_trabajo = new Tipo_Trabajo($request->all());

        $tipo_trabajo->save();

        Flash::success('Tipo Trabajo ' . $tipo_trabajo->nombre_tipo_trabajo . ' agregado.')->important();
        return redirect()->route('in.tipo_trabajo.index');
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
        if(Auth::user()->can('modificar_tipo_trabajo')){
         $tipo_trabajo = Tipo_Trabajo::find($id);
        return view('in.tipo_trabajo.edit')->with('tipo_trabajo',$tipo_trabajo);
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
    public function update(UpsateTipoTrabajoRequest $request, $id)
    {
        //
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
