<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Conocimiento_Idioma as Conocimiento_Idioma;
use App\Idioma as Idioma;
use App\Tipo_Conocimiento_Idioma as Tipo_Conocimiento_Idioma;
use App\Nivel_Conocimiento as Nivel_Conocimiento;
use App\Http\Requests\StoreConocimientoIdiomaRequest;
use Illuminate\Support\Facades\Auth;


class ConocimientosIdiomasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('listar_conocimientos_idiomas_cv')){
            $conocimientosIdiomas = Conocimiento_Idioma::where('cv_id',Auth::user()->persona->fisica->estudiante->cv->id)->orderBy('id','DESC')->get();
            return view('in.cv.conocimientos_idiomas.index')
                ->with('conocimientosIdiomas',$conocimientosIdiomas);
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
        if(Auth::user()->can('crear_conocimiento_idioma_cv')){
            $idiomas = Idioma::all()->where('estado','activo');
            $tiposConocimientosIdiomas = Tipo_Conocimiento_Idioma::all()->where('estado','activo');
            $nivelesConocimientos = Nivel_Conocimiento::all()->where('estado','activo');
            return view('in.cv.conocimientos_idiomas.create')
              ->with('idiomas',$idiomas)
              ->with('tiposConocimientosIdiomas',$tiposConocimientosIdiomas)
              ->with('nivelesConocimientos',$nivelesConocimientos);
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
    public function store(StoreConocimientoIdiomaRequest $request)
    {
        if(Auth::user()->can('crear_conocimiento_idioma_cv')){
            $registro = Conocimiento_Idioma::
                where('cv_id','=',Auth::user()->persona->fisica->estudiante->cv->id)
                ->where('idioma_id','=',$request->idioma)
                ->where('tipo_conocimiento_idioma_id','=',$request->tipo_conocimiento_idioma)->get();
            if(count($registro)> 0){
                Flash::error('• El conocimiento idioma ya existe en el cv.')->important();
                return redirect()->back();
            }

            $conocimientoIdioma = new Conocimiento_Idioma();
            $conocimientoIdioma->cv_id = Auth::user()->persona->fisica->estudiante->cv->id;
            $conocimientoIdioma->idioma_id = $request->idioma;
            $conocimientoIdioma->tipo_conocimiento_idioma_id = $request->tipo_conocimiento_idioma;
            $conocimientoIdioma->nivel_conocimiento_id = $request->nivel_conocimiento;
            $conocimientoIdioma->save();

            Flash::success('Conocimiento ' . $conocimientoIdioma->tipoConocimientoIdioma->nombre_tipo_conocimiento_idioma . ' del idioma ' . $conocimientoIdioma->idioma->nombre_idioma . ' agregado.')->important();
              return redirect()->route('in.gestionar-cv.conocimientos-idiomas.index');
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
        if(Auth::user()->can('modificar_conocimiento_idioma_cv')){
          $conocimientoIdioma = Conocimiento_Idioma::find($id); // busca el usuario por su id
          $idiomas = Idioma::where('estado','activo')->orderBy('id','ASC')->lists('nombre_idioma','id');
          $tiposConocimientosIdiomas = Tipo_Conocimiento_Idioma::where('estado','activo')->orderBy('id','ASC')->lists('nombre_tipo_conocimiento_idioma','id');
          $nivelesConocimientos = Nivel_Conocimiento::where('estado','activo')->orderBy('id','ASC')->lists('nombre_nivel_conocimiento','id');

          return view('in.cv.conocimientos_idiomas.edit')
                                ->with('conocimientoIdioma',$conocimientoIdioma)
                                ->with('idiomas',$idiomas)
                                ->with('tiposConocimientosIdiomas',$tiposConocimientosIdiomas)
                                ->with('nivelesConocimientos',$nivelesConocimientos);
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
    public function update(StoreConocimientoIdiomaRequest $request, $id)
    {
        if(Auth::user()->can('modificar_conocimiento_idioma_cv')){
            $registro = Conocimiento_Idioma::
                where('cv_id','=',Auth::user()->persona->fisica->estudiante->cv->id)
                ->where('idioma_id','=',$request->idioma)
                ->where('tipo_conocimiento_idioma_id','=',$request->tipo_conocimiento_idioma)
                ->where('id','<>',$id)->get();
            if(count($registro)> 0){
                Flash::error('• El conocimiento idioma ya existe en el cv.')->important();
                return redirect()->back();
            }
            $conocimientoIdioma = Conocimiento_Idioma::find($id);
            $conocimientoIdioma->cv_id = Auth::user()->persona->fisica->estudiante->cv->id;
            $conocimientoIdioma->idioma_id = $request->idioma;
            $conocimientoIdioma->tipo_conocimiento_idioma_id = $request->tipo_conocimiento_idioma;
            $conocimientoIdioma->nivel_conocimiento_id = $request->nivel_conocimiento;
            $conocimientoIdioma->save();

            Flash::warning('Conocimiento ' . $conocimientoIdioma->tipoConocimientoIdioma->nombre_tipo_conocimiento_idioma . ' del idioma ' . $conocimientoIdioma->idioma->nombre_idioma . ' modificado.')->important();
              return redirect()->route('in.gestionar-cv.conocimientos-idiomas.index');
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
        if(Auth::user()->can('eliminar_conocimiento_idioma_cv')){
          $conocimientoIdioma = Conocimiento_Idioma::find($id); // busca el usuario por su id

          $conocimientoIdioma->delete(); // lo elimina

          Flash::error('Conocimiento ' . $conocimientoIdioma->tipoConocimientoIdioma->nombre_tipo_conocimiento_idioma . ' del idioma ' . $conocimientoIdioma->idioma->nombre_idioma . ' eliminado.')->important();
          return redirect()->route('in.gestionar-cv.conocimientos-idiomas.index');
        }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }
}
