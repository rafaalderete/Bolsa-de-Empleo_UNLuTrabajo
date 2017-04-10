<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Persona as Persona;
use App\Juridica as Juridica;
use App\Rubro_Empresarial as Rubro_Empresarial;
use App\Http\Requests\StorePersonaJuridicaRequest;
use App\Http\Requests\UpdatePersonaJuridicaRequest;
use Log;
use Illuminate\Support\Facades\Auth;

class JuridicasController extends PersonasController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('listar_empresas')){
            $pjuridicas = Juridica::orderBy('id','DESC')->get();
            return view('in.empresas.index')
                ->with('pjuridicas',$pjuridicas);
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
        if(Auth::user()->can('crear_empresa')){
          $rubros_empresariales = Rubro_Empresarial::all();
            return view('in.empresas.create')
              ->with('rubros_empresariales',$rubros_empresariales);
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
    public function store(StorePersonaJuridicaRequest $request)
    {
        if(Auth::user()->can('crear_empresa')){
            if( ($request->telefono_fijo == '') && ($request->telefono_celular == '') ){
              Flash::error('Debe ingresar al menos un Teléfono.')->important();
              return redirect()->back();
            }
            else {
              $persona_id = $this->storePersona($request,'juridica');//Inserta la Persona y devuelve el id asignado.

              $pjuridica = new Juridica();
              $pjuridica->persona_id = $persona_id;
              $pjuridica->nombre_comercial = $request->nombre_comercial;
              $pjuridica->cuit = $request->cuit;
              $pjuridica->fecha_fundacion = date('Y-m-d', strtotime($request->fecha_fundacion));
              $pjuridica->rubro_empresarial_id = $request->rubro_empresarial;
              $pjuridica->save();

              Flash::success('Empresa ' . $pjuridica->nombre_comercial . ' agregado.')->important();
              return redirect()->route('in.empresas.index');
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
        if(Auth::user()->can('modificar_empresa')){
            $pjuridica = Juridica::find($id);
            $pjuridica->fecha_fundacion = date('d-m-Y', strtotime($pjuridica->fecha_fundacion));
            $telefono_fijo = '';
            $telefono_celular = '';
            foreach ($pjuridica->persona->telefonos as $telefono) {
              if ($telefono->tipo_telefono == 'fijo') {
                $telefono_fijo = $telefono->nro_telefono;
              }
              if ($telefono->tipo_telefono == 'celular') {
                $telefono_celular = $telefono->nro_telefono;
              }
            }
            $rubros_empresariales = Rubro_Empresarial::orderBy('id','ASC')->lists('nombre_rubro_empresarial','id');

            return view('in.empresas.edit')
              ->with('pjuridica',$pjuridica)
              ->with('telefono_fijo',$telefono_fijo)
              ->with('telefono_celular',$telefono_celular)
              ->with('rubros_empresariales',$rubros_empresariales);
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
    public function update(UpdatePersonaJuridicaRequest $request, $id)
    {
        if(Auth::user()->can('modificar_empresa')){
          if( ($request->telefono_fijo == '') && ($request->telefono_celular == '') ){
            Flash::error('Debe ingresar al menos un Teléfono.')->important();
            return redirect()->back();
          }
          else {
            $pjuridica = Juridica::find($id);
            $pjuridica->nombre_comercial = $request->nombre_comercial;
            $pjuridica->cuit = $request->cuit;
            $pjuridica->fecha_fundacion = date('Y-m-d', strtotime($request->fecha_fundacion));
            $pjuridica->rubro_empresarial_id = $request->rubro_empresarial;
            $pjuridica->save();

            $this->updatePersona($request, $pjuridica->persona_id);

            Flash::warning('Empresa ' . $pjuridica->nombre_comercial . ' modificado.')->important();
            return redirect()->route('in.empresas.index');
          }
        }else{
            return redirect()->route('sinpermisos.sinpermisos');
        }
    }

}
