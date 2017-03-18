<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Persona as Persona;
use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PersonasController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('listar_personas')){
            $personas = Persona::orderBy('id','ASC')->get();
            return view('in.personas.index')
                ->with('personas',$personas);
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
        if(Auth::user()->can('crear_persona')){
            return view('in.personas.create');
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
    public function store(StorePersonaRequest $request)
    {
        if(Auth::user()->can('crear_persona')){
            $persona = new Persona($request->all());
            $persona->fecha_nacimiento_persona = date('Y-m-d', strtotime($persona->fecha_nacimiento_persona));
            $persona->save();

            Flash::success('Persona ' . $persona->nombre_persona . ' agregado')->important();
            return redirect()->route('in.personas.index');
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
        if(Auth::user()->can('modificar_persona')){
            $persona = Persona::find($id);
            // parsear fecha a formato estandar
            $persona->fecha_nacimiento_persona = date('d-m-Y', strtotime($persona->fecha_nacimiento_persona));
            //dd($date);
            // retorna una vista con un parametro
            return view('in.personas.edit')->with('persona',$persona);
        }else{
            return redirect()->route('sinpermisos.sinpermisos');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersonaRequest $request, $id)
    {
        if(Auth::user()->can('modificar_persona')){
            $persona = Persona::find($id);
            // pasa todo los valores actializado de request en la user
            $persona->fill($request->all());
            $persona->fecha_nacimiento_persona = date('Y-m-d', strtotime($request->fecha_nacimiento_persona));
            $persona->save();

            Flash::warning('Persona ' . $persona->nombre_persona . ' modificado')->important();
            return redirect()->route('in.personas.index');
        }else{
            return redirect()->route('sinpermisos.sinpermisos');
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
        if(Auth::user()->can('eliminar_persona')){
            $persona = Persona::find($id);
            $persona->delete();

            Flash::error('Persona ' . $persona->nombre_persona . ' eliminada')->important();
            return redirect()->route('in.personas.index');
        }else{
            return redirect()->route('sinpermisos.sinpermisos');
        }
    }
}
