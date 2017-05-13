<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreTipoConocimientoIdiomaRequest;
use App\Http\Requests\UpdateTipoConocimientoIdiomaRequest;

#por la FK 
use App\Conocimiento_Idioma as Conocimiento_Idioma;
use App\Requisito_Idioma as Requisito_Idioma;

use App\Tipo_Conocimiento_Idioma as Tipo_Conocimiento_Idioma;

class TipoConocimientoIdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        #primero debo asegurarme que la persoana que intenta acceder tenga los permisos
        if (Auth::user()->can('listar_tipos_conocimiento_idioma')) {
            $tipo_conocimiento_idioma = Tipo_Conocimiento_Idioma::orderBy('id', 'DESC')->get(); #me traigo de la bd los idiomas cargados en id descendentes

            return view('in.tipo_conocimiento_idioma.index')->with('tipos_conocimiento_idioma', $tipo_conocimiento_idioma);
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
          if(Auth::user()->can('crear_tipo_conocimiento_idioma')){
            return view('in.tipo_conocimiento_idioma.create');
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
    public function store(StoreTipoConocimientoIdiomaRequest $request)
    {
        if(Auth::user()->can('crear_tipo_conocimiento_idioma')){
        $tipo_conocimiento_idioma = new Tipo_Conocimiento_Idioma($request->all());

        $tipo_conocimiento_idioma->save();

        Flash::success('Tipo Conocmiento Idioma' . $tipo_conocimiento_idioma->nombre_tipo_conocimiento_idioma . ' agregado.')->important();
        return redirect()->route('in.tipo_conocimiento_idioma.index');
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
        if(Auth::user()->can('modificar_tipo_conocimiento_idioma')){
            $tipo_conocimiento_idioma = Tipo_Conocimiento_Idioma::find($id);
            return view('in.tipo_conocimiento_idioma.edit')->with('tipo_conocimiento_idioma',$tipo_conocimiento_idioma);
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
    public function update(UpdateTipoConocimientoIdiomaRequest $request, $id)
    {
        if(Auth::user()->can('modificar_tipo_conocimiento_idioma')){
            $tipo_conocimiento_idioma = Tipo_Conocimiento_Idioma::find($id);

            $tipo_conocimiento_idioma->fill($request->all());
            $tipo_conocimiento_idioma->save();

            Flash::warning('Tipo Conocimiento Idioma ' . $tipo_conocimiento_idioma->nombre_tipo_conocimiento_idioma . ' modificado.')->important();
            return redirect()->route('in.tipo_conocimiento_idioma.index');
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
        if(Auth::user()->can('eliminar_tipo_conocimiento_idioma')){
            $tipo_conocimiento_idioma = Tipo_Conocimiento_Idioma::find($id);
            
            $requisitoIdioma = Requisito_Idioma::where('id','=',$id)->get();

        if( (count($requisitoIdioma) == 0 ) ) {//Se verifica que no esta uso.

          $tipo_conocimiento_idioma->delete();

          Flash::error('Tipo Conocimiento Idioma ' . $tipo_conocimiento_idioma->nombre_tipo_conocimiento_idioma . ' eliminado.')->important();
          return redirect()->route('in.tipo_conocimiento_idioma.index');
        }
        else {
          Flash::error('El Tipo Conocimiento Idioma ' . $tipo_conocimiento_idioma->nombre_tipo_conocimiento_idioma . ' no se puede eliminar ya que se encuentra en uso.')->important();
          return redirect()->route('in.tipo_conocimiento_idioma.index');
        }
      }else{
        return redirect()->route('in.sinpermisos.sinpermisos');
      }
    }
}
