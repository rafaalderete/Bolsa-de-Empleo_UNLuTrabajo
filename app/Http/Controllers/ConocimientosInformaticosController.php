<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Conocimiento_Informatico as Conocimiento_Informatico;
use App\Tipo_Software as Tipo_Software;
use App\Nivel_Conocimiento as Nivel_Conocimiento;
use App\Http\Requests\StoreConocimientoInformaticoRequest;
use Illuminate\Support\Facades\Auth;

class ConocimientosInformaticosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('listar_conocimientos_informaticos_cv')){
            $conocimientosInformaticos = Conocimiento_Informatico::where('cv_id',Auth::user()->persona->fisica->estudiante->cv->id)->orderBy('id','DESC')->get();
            return view('in.cv.conocimientos_informaticos.index')
                ->with('conocimientosInformaticos',$conocimientosInformaticos);
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
        if(Auth::user()->can('crear_conocimiento_informatico_cv')){
            $tiposSoftware = Tipo_Software::all()->where('estado','activo');
            $nivelesConocimientos = Nivel_Conocimiento::all()->where('estado','activo');
            return view('in.cv.conocimientos_informaticos.create')
              ->with('tiposSoftware',$tiposSoftware)
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
    public function store(StoreConocimientoInformaticoRequest $request)
    {
        if(Auth::user()->can('crear_conocimiento_informatico_cv')){
            $registro = Conocimiento_Informatico::
                where('cv_id','=',Auth::user()->persona->fisica->estudiante->cv->id)
                ->where('tipo_software_id','=',$request->tipo_software)->get();
            if(count($registro)> 0){
                Flash::error('• El conocimiento informatico ya existe en el cv.')->important();
                return redirect()->back();
            }

            $conocimientoInformatico = new Conocimiento_Informatico();
            $conocimientoInformatico->cv_id = Auth::user()->persona->fisica->estudiante->cv->id;
            $conocimientoInformatico->tipo_software_id = $request->tipo_software;
            $conocimientoInformatico->nivel_conocimiento_id = $request->nivel_conocimiento;
            $conocimientoInformatico->save();

            Flash::success('Conocimiento Informático en ' . $conocimientoInformatico->tipoSoftware->nombre_tipo_software . ' agregado.')->important();
              return redirect()->route('in.gestionar-cv.conocimientos-informaticos.index');
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
        if(Auth::user()->can('modificar_conocimiento_informatico_cv')){
          $conocimientoInformatico = Conocimiento_Informatico::find($id); // busca el usuario por su id
          $tiposSoftware = Tipo_Software::where('estado','activo')->orderBy('id','ASC')->lists('nombre_tipo_software','id');
          $nivelesConocimientos = Nivel_Conocimiento::where('estado','activo')->orderBy('id','ASC')->lists('nombre_nivel_conocimiento','id');

          return view('in.cv.conocimientos_informaticos.edit')
                                ->with('conocimientoInformatico',$conocimientoInformatico)
                                ->with('tiposSoftware',$tiposSoftware)
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
    public function update(StoreConocimientoInformaticoRequest $request, $id)
    {
        if(Auth::user()->can('modificar_conocimiento_informatico_cv')){
            $registro = Conocimiento_Informatico::
                where('cv_id','=',Auth::user()->persona->fisica->estudiante->cv->id)
                ->where('tipo_software_id','=',$request->tipo_software)
                ->where('id','<>',$id)->get();
            if(count($registro)> 0){
                Flash::error('• El conocimiento informatico ya existe en el cv.')->important();
                return redirect()->back();
            }

            $conocimientoInformatico = Conocimiento_Informatico::find($id);
            $conocimientoInformatico->cv_id = Auth::user()->persona->fisica->estudiante->cv->id;
            $conocimientoInformatico->tipo_software_id = $request->tipo_software;
            $conocimientoInformatico->nivel_conocimiento_id = $request->nivel_conocimiento;
            $conocimientoInformatico->save();

            Flash::warning('Conocimiento Informatico en ' . $conocimientoInformatico->tipoSoftware->nombre_tipo_software . ' modificado.')->important();
              return redirect()->route('in.gestionar-cv.conocimientos-informaticos.index');
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
        if(Auth::user()->can('eliminar_conocimiento_informatico_cv')){
          $conocimientoInformatico = Conocimiento_Informatico::find($id); // busca el usuario por su id

          $conocimientoInformatico->delete(); // lo elimina

          Flash::error('Conocimiento Informático en ' . $conocimientoInformatico->tipoSoftware->nombre_tipo_software . ' eliminado.')->important();
          return redirect()->route('in.gestionar-cv.conocimientos-informaticos.index');
        }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }
}
