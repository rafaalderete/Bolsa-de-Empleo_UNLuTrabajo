<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreIdiomaRequest;
use App\Http\Requests\UpdateIdiomaRequest;
use App\Idioma as Idiomas;
use App\Conocimiento_Idioma as Conocimiento_Idioma;

class IdiomasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        #primero debo asegurarme que la persoana que intenta acceder tenga los permisos
        if (Auth::user()->can('listar_idiomas')) {
            $idioma = Idiomas::orderBy('id', 'DESC')->get(); #me traigo de la bd los idiomas cargados en id descendentes

            return view('in.idiomas.index')->with('idiomas', $idioma);
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
        if(Auth::user()->can('crear_idioma')){
            return view('in.idiomas.create');
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
    public function store(Request $request)
    {
       if(Auth::user()->can('crear_idioma')){
        $idioma = new Idiomas($request->all());

        $idioma->save();

        Flash::success('Idiomas' . $idioma->nombre_idioma . ' agregado.')->important();
        return redirect()->route('in.idiomas.index');
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
        if(Auth::user()->can('modificar_idioma')){
        $idioma = Idiomas::find($id);
        return view('in.idiomas.edit')->with('idioma',$idioma);
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
    public function update(Request $request, $id)
    {
        if(Auth::user()->can('modificar_idioma')){
            $idioma = Idiomas::find($id);

            $idioma->fill($request->all());
            $idioma->save();

            Flash::warning('Idioma ' . $idioma->nombre_idioma . ' modificado.')->important();
            return redirect()->route('in.idiomas.index');
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
        if(Auth::user()->can('eliminar_idioma')){
            $idioma = Idiomas::find($id);
            $cidioma = Conocimiento_Idioma::where('idioma_id','=',$id)->get();
            $experiencias_laborales = Conocimiento_Idioma::where('idioma_id','=',$id)->get();
            if( (count($cidioma) == 0) ) {//Se verifica que no esta uso.

              $idioma->delete();

              Flash::error('Idioma ' . $idioma->nombre_idioma . ' eliminado.')->important();
              return redirect()->route('in.idiomas.index');
            }
            else {
              Flash::error('El Idioma ' . $idioma->nombre_idioma . ' no se puede eliminar ya que se encuentra en uso.')->important();
              return redirect()->route('in.idiomas.index');
            }
          }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
          }
    }
}
