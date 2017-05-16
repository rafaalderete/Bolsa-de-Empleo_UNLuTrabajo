<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tipo_Documento as Tipo_Documento;
use App\Http\Requests\StoreTipoDocumentoRequest;
use App\Http\Requests\UpdateTipoDocumentoRequest;

# es fk en Persona Fisica
use App\Fisica as Fisica;

class TipoDocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('listar_tipos_documento')){
        $tipo_documento = Tipo_Documento::orderBy('id','DESC')->get();

        return view('in.tipo_documento.index')
            ->with('tipos_documento',$tipo_documento);
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
        if(Auth::user()->can('crear_tipo_documento')){
            return view('in.tipo_documento.create');
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
    public function store(StoreTipoDocumentoRequest $request)
    {
        if(Auth::user()->can('crear_tipo_documento')){
            $tipo_documento = new Tipo_Documento($request->all());

        $tipo_documento->save();

        Flash::success('Tipo Documento ' . $tipo_documento->nombre_tipo_documento . ' agregado.')->important();
        return redirect()->route('in.tipo_documento.index');
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
        if(Auth::user()->can('modificar_tipo_documento')){
         $tipo_documento = Tipo_Documento::find($id);
        return view('in.tipo_documento.edit')->with('tipo_documento',$tipo_documento);
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
    public function update(UpdateTipoDocumentoRequest $request, $id)
    {
        if(Auth::user()->can('modificar_tipo_documento')){
            $tipo_documento = Tipo_Documento::find($id);

            $tipo_documento->fill($request->all());
            $tipo_documento->save();

            Flash::warning('Tipo Jornada ' . $tipo_documento->nombre_tipo_documento . ' modificado.')->important();
            return redirect()->route('in.tipo_documento.index');
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
        if(Auth::user()->can('eliminar_tipo_documento')){
            $tipo_documento = Tipo_Documento::find($id);
            $fisica = Fisica::where('tipo_documento_id','=',$id)->get();

        if( (count($fisica) == 0 ) ) {//Se verifica que no esta uso.

          $tipo_documento->delete();

          Flash::error('Tipo de Documento ' . $tipo_documento->nombre_tipo_documento . ' eliminado.')->important();
          return redirect()->route('in.tipo_documento.index');
        }
        else {
          Flash::error('El Tipo Documento ' . $tipo_documento->nombre_tipo_documento . ' no se puede eliminar ya que se encuentra en uso.')->important();
          return redirect()->route('in.tipo_documento.index');
        }
      }else{
        return redirect()->route('in.sinpermisos.sinpermisos');
      }
    }
}
