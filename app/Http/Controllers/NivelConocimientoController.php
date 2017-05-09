<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreNivelConocimientoRequest;
use App\Http\Requests\UpdateNivelConocimientoRequest;
use App\Nivel_Conocimiento as Nivel_Conocimiento;
use App\Conocimiento_Informatico as Conocimiento_Informatico;

#estas clases tienen fk de conocimiento_informatico

use App\Conocimiento_Idioma as Conocimiento_Idioma;
use App\Requisito_Idioma as Requisito_Idioma;
use App\Requisito_Adicional as Requisito_Adicional;

class NivelConocimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        #primero debo asegurarme que la persoana que intenta acceder tenga los permisos
        if (Auth::user()->can('listar_niveles_conocimiento')) {
            $nivel_conocimiento = Nivel_Conocimiento::orderBy('id', 'DESC')->get(); #me traigo de la bd los idiomas cargados en id descendentes

            return view('in.nivel_conocimiento.index')->with('nivel_conocimiento', $nivel_conocimiento);
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
        if(Auth::user()->can('crear_nivel_conocimiento')){
            return view('in.nivel_conocimiento.create');
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
    public function store(StoreNivelConocimientoRequest $request)
    {
       if(Auth::user()->can('crear_nivel_conocimiento')){
        $nivel_conocimiento= new Nivel_Conocimiento($request->all());

        $nivel_conocimiento->save();

        Flash::success('Nivel Conocimiento' . $nivel_conocimiento->nombre_nivel_conocimiento. ' agregado.')->important();
        return redirect()->route('in.nivel_conocimiento.index');
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
        if(Auth::user()->can('modificar_nivel_conocimiento')){
        $nivel_conocimiento = Nivel_Conocimiento::find($id);
        return view('in.nivel_conocimiento.edit')->with('nivel_conocimiento',$nivel_conocimiento);
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
    public function update(UpdateNivelConocimientoRequest $request, $id)
    {
        if(Auth::user()->can('modificar_nivel_conocimiento')){
            $nivel_conocimiento = Nivel_Conocimiento::find($id);

            $nivel_conocimiento->fill($request->all());
            $nivel_conocimiento->save();

            Flash::warning('Idioma ' . $nivel_conocimiento->nombre_nivel_conocimiento . ' modificado.')->important();
            return redirect()->route('in.nivel_conocimiento.index');
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
        if(Auth::user()->can('eliminar_nivel_conocimiento')){
            $nivel_conocimiento = Nivel_Conocimiento::find($id);
            
            $conocimientoIdioma = Conocimiento_Idioma::where('nivel_conocimiento_id','=',$id)->get();
            
            $requisitoIdioma= Requisito_Idioma::where('nivel_conocimiento_id','=',$id)->get();

            $requisitoAdicional = Requisito_Adicional::where('nivel_conocimiento_id', '='. $id)->get();

            if( (count($conocimientoIdioma) == 0 ) && (count($requisitoIdioma) == 0 ) && (count($requisitoAdicional) == 0) ) {//Se verifica que no esta uso.

                $nivel_conocimiento->delete();

                Flash::error('Nivel Conocimiento ' . $nivel_conocimiento->nombre_nivel_conocimiento . ' eliminado.')->important();

                return redirect()->route('in.nivel_conocimiento.index');
            }
            else {
                Flash::error('El Rubro ' . $nivel_conocimiento->nombre_nivel_conocimiento . ' no se puede eliminar ya que se encuentra en uso.')->important();
                return redirect()->route('in.nivel_conocimiento.index');
                }
            }else{
                return redirect()->route('in.sinpermisos.sinpermisos');
            }
    }
}
