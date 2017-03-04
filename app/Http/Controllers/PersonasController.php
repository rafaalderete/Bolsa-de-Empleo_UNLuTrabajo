<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Persona as Persona;
use App\Http\Requests\PersonaRequest;
use Log;
use Carbon\Carbon;

class PersonasController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::orderBy('id','ASC')->paginate();
        return view('in.personas.index')
            ->with('personas',$personas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           return view('in.personas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonaRequest $request)
    {
        $persona = new Persona($request->all());
        $persona->fecha_nacimiento_persona = date('Y-m-d', strtotime($persona->fecha_nacimiento_persona));
        $persona->save();

        Flash::success('Persona ' . $persona->nombre_persona . ' agregado');
        return redirect()->route('in.personas.index');
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
        $persona = Persona::find($id);
        // parsear fecha a formato estandar
        $persona->fecha_nacimiento_persona = date('d-m-Y', strtotime($persona->fecha_nacimiento_persona));
        //dd($date);
        // retorna una vista con un parametro
        return view('in.personas.edit')->with('persona',$persona);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonaRequest $request, $id)
    {
        $persona = Persona::find($id);
        // pasa todo los valores actializado de request en la user
        $persona->fill($request->all());
        $persona->fecha_nacimiento_persona = date('Y-m-d', strtotime($request->fecha_nacimiento_persona));
        $persona->save();

        Flash::warning('Persona ' . $persona->nombre_persona . ' modificado');
        return redirect()->route('in.personas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::find($id);
        $persona->delete();

        Flash::error('Persona ' . $persona->nombre_persona . ' eliminada');
        return redirect()->route('in.personas.index');
    }
}
