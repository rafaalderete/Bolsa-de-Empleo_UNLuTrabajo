<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Estudio_Academico as Estudio_Academico;
use App\Nivel_Educativo as Nivel_Educativo;
use App\Estado_Carrera as Estado_Carrera;
use App\Cv as Cv;
use App\Http\Requests\StoreEstudioAcademicoRequest;
use App\Http\Requests\UpdateEstudioAcademicoRequest;
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
            $estudios = Estudio_Academico::where('cv_id',Auth::user()->persona->fisica->estudiante->cv->id)->orderBy('created_at','ASC')->get();
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
    public function store(StoreEstudioAcademicoRequest $request)
    {
        if(Auth::user()->can('crear_estudio_academico_cv')){
            if ( $request->materias_aprobadas > $request->materias_total){
                Flash::error('• Las Materias Aprobadas deben ser menor a Materias Total de la carrera.')->important();
                return redirect()->back();
            }

            $estadoCarrera = Estado_Carrera::find($request->estados_carrera);
            if($estadoCarrera->nombre_estado_carrera =='Finalizado'){

                if(strlen($request->periodo_fin) == 0){
                    Flash::error('• El campo periodo fin es obligatorio.')->important();
                    return redirect()->back();
                }

                $datetime1 = new \DateTime($request->periodo_inicio);
                $datetime2 = new \DateTime($request->periodo_fin);
                $interval = $datetime1->diff($datetime2);

                $esta_bien = false;

                if(($interval->format('%R%a')) >= 0){
                  $esta_bien = true;
                }

                if($esta_bien == false && strlen($request->periodo_fin) != 0){
                    Flash::error('• La fecha de inicio debe ser menor a la fecha de finalización.')->important();
                    return redirect()->back();
                }
            }

            $estudio = new Estudio_Academico();
            $estudio->cv_id = Auth::user()->persona->fisica->estudiante->cv->id;
            $estudio->titulo = $request->titulo;
            $estudio->nombre_instituto = $request->nombre_instituto;
            $estudio->nivel_educativo_id = $request->nivel_educativo;
            $estudio->estado_carrera_id = $request->estados_carrera;
            $estudio->materias_total = $request->materias_total;
            $estudio->materias_aprobadas = $request->materias_aprobadas;
            $estudio->periodo_inicio = $request->periodo_inicio;
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

          $estudio = Estudio_Academico::find($id);
          $cv = Cv::find(Auth::user()->persona->fisica->estudiante->cv->id);
          $error = false;
          //Control de que el estudio exista y sea del usuario.
          if ($estudio != null) {
            if ($cv->id == $estudio->cv->id) {
              $primerRegistro = false;
              if ($cv->estudiosAcademicos[0]->id == $id) {
                $primerRegistro = true;
              }
              $nivelesEducativos = Nivel_Educativo::where('estado','activo')->orderBy('id','ASC')->lists('nombre_nivel_educativo','id');
              $estadosCarrera = Estado_Carrera::where('estado','activo')->orderBy('id','ASC')->lists('nombre_estado_carrera','id');
              $finalizadoEstado = Estado_Carrera::where('nombre_estado_carrera','Finalizado')->first();

              $minY = date('Y', strtotime($estudio->periodo_inicio));
              $minM = date('m', strtotime($estudio->periodo_inicio));
              $minD = date('d', strtotime($estudio->periodo_inicio));

              return view('in.cv.estudios_academicos.edit')
                ->with('primerRegistro',$primerRegistro)
                ->with('estudio',$estudio)
                ->with('nivelesEducativos',$nivelesEducativos)
                ->with('estadosCarrera',$estadosCarrera)
                ->with('finalizado',$finalizadoEstado->id)
                ->with('minY',$minY)
                ->with('minM',$minM)
                ->with('minD',$minD);
            }
            else {
              $error = true;
            }
          }
          else {
            $error = true;
          }

          if ($error) {
            return redirect()->route('in.gestionar-cv.estudios-academicos.index');
          }
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
    public function update(UpdateEstudioAcademicoRequest $request, $id)
    {
        if(Auth::user()->can('modificar_estudio_academico_cv')){

            if ( $request->materias_aprobadas > $request->materias_total){
                Flash::error('• Las Materias Aprobadas deben ser menor a Materias Total de la carrera.')->important();
                return redirect()->back();
            }

            $estadoCarrera = Estado_Carrera::find($request->estado_carrera);
            if($estadoCarrera->nombre_estado_carrera =='Finalizado'){

                if(strlen($request->periodo_fin) == 0){
                    Flash::error('• El campo periodo fin es obligatorio.')->important();
                    return redirect()->back();
                }

                $datetime1 = new \DateTime($request->periodo_inicio);
                $datetime2 = new \DateTime($request->periodo_fin);
                $interval = $datetime1->diff($datetime2);

                $esta_bien = false;

                if(($interval->format('%R%a')) >= 0){
                  $esta_bien = true;
                }

                if($esta_bien == false && strlen($request->periodo_fin) != 0){
                    Flash::error('• La fecha de inicio debe ser menor a la fecha de finalización.')->important();
                    return redirect()->back();
                }
            }

            $estudio = Estudio_Academico::find($id);
            $cv = Cv::find(Auth::user()->persona->fisica->estudiante->cv->id);
            $error = false;
            //Control de que el estudio exista y sea del usuario.
            if ($estudio != null) {
              if ($cv->id == $estudio->cv->id) {
                //Titulo, nombre instituto y nivel educativo no se pueden modificar para el primer registro.
                if ($cv->estudiosAcademicos[0]->id != $id) {
                  $estudio->titulo = $request->titulo;
                  $estudio->nombre_instituto = $request->nombre_instituto;
                  $estudio->nivel_educativo_id = $request->nivel_educativo;
                }
                $estudio->estado_carrera_id = $request->estado_carrera;
                $estudio->materias_total = $request->materias_total;
                $estudio->materias_aprobadas = $request->materias_aprobadas;
                $estudio->periodo_inicio = $request->periodo_inicio;
                if ($estadoCarrera->nombre_estado_carrera =='Finalizado') {
                    $estudio->periodo_fin = $request->periodo_fin;
                }else{
                    $estudio->periodo_fin = "00-00-0000"; // Esta en Presente
                }
                $estudio->save();

                Flash::warning('Estudio Academico de ' . $estudio->titulo . ' modificado.')->important();
                  return redirect()->route('in.gestionar-cv.estudios-academicos.index');
              }
              else {
                $error = true;
              }
            }
            else {
              $error = true;
            }

            if ($error) {
              return redirect()->route('in.gestionar-cv.estudios-academicos.index');
            }

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
          $error = false;
          $cv = Cv::find(Auth::user()->persona->fisica->estudiante->cv->id);
          //Control de que el estudio exista y sea del usuario.
          if ($estudio != null) {
            if ( ($cv->id == $estudio->cv->id) && ($cv->estudiosAcademicos[0]->id != $id) ) {
              $estudio->delete(); // lo elimina

              Flash::error('Estudio Academico de '. $estudio->titulo . ' eliminado.')->important();
              return redirect()->route('in.gestionar-cv.estudios-academicos.index');
            }
            else {
              $error = true;
            }
          }
          else {
            $error = true;
          }

          if ($error) {
            return redirect()->route('in.gestionar-cv.estudios-academicos.index');
          }
        }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }
}
