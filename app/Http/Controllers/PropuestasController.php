<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tipo_Trabajo as Tipo_Trabajo;
use App\Tipo_Jornada as Tipo_Jornada;
use App\Tipo_Conocimiento_Idioma as Tipo_Conocimiento_Idioma;
use App\Nivel_Conocimiento as Nivel_Conocimiento;
use App\Estado_Carrera as Estado_Carrera;
use Illuminate\Support\Facades\Auth;

class PropuestasController extends Controller
{

    public function getRealizarPropuesta(Request $request)
    {
      if(Auth::user()->can('crear_propuesta_laboral')){
        $tipos_trabajo = Tipo_Trabajo::all()->where('estado', 'activo'); // recupero array de personas que estan activas
        $tipos_jornada= Tipo_Jornada::all()->where('estado', 'activo');
        $tipos_conocimiento_idioma = Tipo_Conocimiento_Idioma::all()->where('estado', 'activo');
        $niveles_conocimiento = Nivel_Conocimiento::all()->where('estado', 'activo');
        $estados_carrera = Estado_Carrera::all()->where('estado', 'activo');

        return view('in.propuestas_laborales.create')
            ->with('tipos_trabajo',$tipos_trabajo)
            ->with('tipos_jornada',$tipos_jornada)
            ->with('tipos_conocimiento_idioma',$tipos_conocimiento_idioma)
            ->with('niveles_conocimiento',$niveles_conocimiento)
            ->with('estados_carrera',$estados_carrera);
      }else{
        return redirect()->route('in.sinpermisos.sinpermisos');
      }
    }

    public function postRealizarPropuesta(Request $request)
    {
        dd($request);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
