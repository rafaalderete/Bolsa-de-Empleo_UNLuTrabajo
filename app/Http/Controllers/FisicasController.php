<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Persona as Persona;
use App\Fisica as Fisica;
use App\Tipo_Documento as Tipo_Documento;
use App\Http\Requests\StorePersonaFisicaRequest;
use App\Http\Requests\UpdatePersonaFisicaRequest;
use Log;
use Illuminate\Support\Facades\Auth;

class FisicasController extends PersonasController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('listar_personas')){
            $pfisicas = Fisica::orderBy('id','DESC')->get();
            return view('in.personas.index')
                ->with('pfisicas',$pfisicas);
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
          $tipos_documento = Tipo_Documento::all();
            return view('in.personas.create')
              ->with('tipos_documento',$tipos_documento);
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
    public function store(StorePersonaFisicaRequest $request)
    {
        if(Auth::user()->can('crear_persona')){
            if( ($request->telefono_fijo == '') && ($request->telefono_celular == '') ){
              Flash::error('Debe ingresar al menos un Teléfono.')->important();
              return redirect()->back();
            }
            else {
              $persona_id = $this->storePersona($request,'fisica');//Inserta la Persona y devuelve el id asignado.

              $pfisica = new Fisica();
              $pfisica->persona_id = $persona_id;
              $pfisica->nombre_persona = $request->nombre_persona;
              $pfisica->apellido_persona = $request->apellido_persona;
              $pfisica->cuil = $request->cuil;
              $pfisica->fecha_nacimiento = date('Y-m-d', strtotime($request->fecha_nacimiento));
              $pfisica->tipo_documento_id = $request->tipo_documento;
              $pfisica->nro_documento = $request->nro_documento;
              $pfisica->save();

              Flash::success('Persona ' . $pfisica->nombre_persona . ' agregado.')->important();
              return redirect()->route('in.personas.index');
            }
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
            $pfisica = Fisica::find($id);
            $pfisica->fecha_nacimiento = date('d-m-Y', strtotime($pfisica->fecha_nacimiento));
            $telefono_fijo = '';
            $telefono_celular = '';
            foreach ($pfisica->persona->telefonos as $telefono) {
              if ($telefono->tipo_telefono == 'fijo') {
                $telefono_fijo = $telefono->nro_telefono;
              }
              if ($telefono->tipo_telefono == 'celular') {
                $telefono_celular = $telefono->nro_telefono;
              }
            }
            $tipos_documento = Tipo_Documento::orderBy('id','ASC')->lists('nombre_tipo_documento','id');

            return view('in.personas.edit')
              ->with('pfisica',$pfisica)
              ->with('telefono_fijo',$telefono_fijo)
              ->with('telefono_celular',$telefono_celular)
              ->with('tipos_documento',$tipos_documento);
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
    public function update(UpdatePersonaFisicaRequest $request, $id)
    {
        if(Auth::user()->can('modificar_persona')){
          if( ($request->telefono_fijo == '') && ($request->telefono_celular == '') ){
            Flash::error('Debe ingresar al menos un Teléfono.')->important();
            return redirect()->back();
          }
          else {
            $pfisica = Fisica::find($id);
            $pfisica->nombre_persona = $request->nombre_persona;
            $pfisica->apellido_persona = $request->apellido_persona;
            $pfisica->cuil = $request->cuil;
            $pfisica->fecha_nacimiento = date('Y-m-d', strtotime($request->fecha_nacimiento));
            $pfisica->tipo_documento_id = $request->tipo_documento;
            $pfisica->nro_documento = $request->nro_documento;
            $pfisica->save();

            $this->updatePersona($request, $pfisica->persona_id);

            Flash::warning('Persona ' . $pfisica->nombre_persona . ' modificado.')->important();
            return redirect()->route('in.personas.index');
          }
        }else{
            return redirect()->route('sinpermisos.sinpermisos');
        }
    }

}
