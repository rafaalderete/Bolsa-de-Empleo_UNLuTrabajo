<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Estudio_Academico as Estudio_Academico;
use App\Nivel_Educativo as Nivel_Educativo;
use App\Estado_Carrera as Estado_Carrera;
use Illuminate\Support\Facades\Auth;

class EstudiosAcademicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('listar_estudios_academicos_cv')){
            $estudios = Estudio_Academico::where('cv_id',Auth::user()->persona->fisica->estudiante->cv->id)->orderBy('id','DESC')->get();
            return view('in.cv.estudios_academicos.index')
                ->with('estudios',$estudios);
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
        if(Auth::user()->can('crear_estudio_academico_cv')){
            $nivelesEducativos = Nivel_Educativo::all()->where('estado','activo');
            $estadosCarrera = Estado_Carrera::all()->where('estado','activo');
            $finalizadoEstado = Estado_Carrera::where('nombre_estado_carrera','Finalizado')->first();
            return view('in.cv.estudios_academicos.create')
              ->with('nivelesEducativos',$nivelesEducativos)
              ->with('estadosCarrera',$estadosCarrera)
              ->with('finalizado',$finalizadoEstado->id);
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
        if(Auth::user()->can('crear_estudio_academico_cv')){
            $estudio = new Estudio_Academico();
            $estudio->cv_id = Auth::user()->persona->fisica->estudiante->cv->id;
            $estudio->titulo = $request->titulo;
            $estudio->nombre_instituto = $request->nombre_instituto;
            $estudio->nivel_educativo_id = $request->nivel_educativo;
            $estudio->estado_carrera_id = $request->estados_carrera;
            $estudio->materias_total = $request->materias_total;
            $estudio->materias_aprobadas = $request->materias_aprobadas;
            $estudio->periodo_inicio = $request->periodo_inicio;
            $estadoCarrera = Estado_Carrera::find($estudio->estado_carrera_id);
            if ($estadoCarrera->nombre_estado_carrera =='Finalizado') {
                $estudio->periodo_fin = $request->periodo_fin;
            }else{
                $estudio->periodo_fin = "00-00-0000"; // Esta en Presente
            }
            $estudio->save();

            Flash::success('Estudio Academico de ' . $estudio->titulo . ' agregado.')->important();
              return redirect()->route('in.gestionar-cv.estudios-academicos.index');
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
        if(Auth::user()->can('modificar_estudio_academico_cv')){
          $estudio = Estudio_Academico::find($id); // busca el usuario por su id
          $nivelesEducativos = Nivel_Educativo::where('estado','activo')->orderBy('id','ASC')->lists('nombre_nivel_educativo','id');
          $estadosCarrera = Estado_Carrera::where('estado','activo')->orderBy('id','ASC')->lists('nombre_estado_carrera','id');

          return view('in.cv.estudios_academicos.edit')
                                ->with('estudio',$estudio)
                                ->with('nivelesEducativos',$nivelesEducativos)
                                ->with('estadosCarrera',$estadosCarrera);
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
        if(Auth::user()->can('modificar_estudio_academico_cv')){
            $estudio = Estudio_Academico::find($id);
            $estudio->cv_id = Auth::user()->persona->fisica->estudiante->cv->id;
            $estudio->titulo = $request->titulo;
            $estudio->nombre_instituto = $request->nombre_instituto;
            $estudio->nivel_educativo_id = $request->nivel_educativo;
            $estudio->estado_carrera_id = $request->estado_carrera;
            $estudio->materias_total = $request->materias_total;
            $estudio->materias_aprobadas = $request->materias_aprobadas;
            $estudio->periodo_inicio = $request->periodo_inicio;
            $estadoCarrera = Estado_Carrera::find($estudio->estado_carrera_id);
            if ($estadoCarrera->nombre_estado_carrera =='En curso') {
                $estudio->periodo_fin = "00-00-0000"; // Esta en Presente
            }else{
                $estudio->periodo_fin = $request->periodo_fin;
            }
            $estudio->save();

            Flash::warning('Estudio Academico de ' . $estudio->titulo . ' modificado.')->important();
              return redirect()->route('in.gestionar-cv.estudios-academicos.index');
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
        if(Auth::user()->can('eliminar_estudio_academico_cv')){
          $estudio = Estudio_Academico::find($id); // busca el usuario por su id

          $estudio->delete(); // lo elimina

          Flash::error('Estudio Academico de '. $estudio->titulo . ' eliminado.')->important();
          return redirect()->route('in.gestionar-cv.estudios-academicos.index');
        }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }
}
