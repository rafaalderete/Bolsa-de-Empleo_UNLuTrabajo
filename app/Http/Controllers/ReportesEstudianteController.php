<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB; 
use Carbon\Carbon;

class ReportesEstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(true){

            $estudianteId = Auth::user()->persona->fisica->estudiante->id;
            $carreraId = Auth::user()->persona->fisica->estudiante->carrera_id;

            //-------------------------------------------------------//

            $cantEstadosEnPostulaciones = DB::select('select count(*) cantidad, epl.estado_postulacion
                                                from estudiante_propuesta_laboral as epl
                                                where epl.estudiante_id = ?
                                                group by estado_postulacion
                                                order by cantidad Desc',[$estudianteId]);

            //-------------------------------------------------------//

            $empConPropParaMiCarrera = DB::select('select count(*) cantidad, j.nombre_comercial
                                    from propuestas_laborales as pl join requisitos_carrera as rc on pl.id = rc.propuesta_laboral_id
                                            join juridicas as j on pl.juridica_id = j.id 
                                    where rc.carrera_id = ?
                                    group by j.nombre_comercial
                                    order by cantidad Desc',[$carreraId]);

            $EmpConMayorPropParaMiCarrera = [];
            $i = 0;
            while ( ($i < 10 ) && ( $i < sizeof($empConPropParaMiCarrera))){
                    $empConPropParaMiCarrera[$i]->nombre_comercial = str_limit($empConPropParaMiCarrera[$i]->nombre_comercial, $limit = 20, $end = '...');
                    $EmpConMayorPropParaMiCarrera[$i] = $empConPropParaMiCarrera[$i];
                    $i++;
            }

            //-------------------------------------------------------//

            $idiomasEnMiCarrera = DB::select('select count(*) cantidad, i.nombre_idioma
                                    from propuestas_laborales as pl join requisitos_carrera as rc on pl.id = rc.propuesta_laboral_id
                                            join (select distinct propuesta_laboral_id, idioma_id 
                                                  from requisitos_idioma) as ri on ri.propuesta_laboral_id = pl.id
                                            join idiomas as i on ri.idioma_id = i.id
                                    where rc.carrera_id = ?
                                    group by i.nombre_idioma
                                    order by cantidad Desc',[$carreraId]);

            $idiomasMayorCantidadEnMiCarrera = [];
            $i = 0;
            while ( ($i < 5) && ( $i < sizeof($idiomasEnMiCarrera))){
                    $idiomasEnMiCarrera[$i]->nombre_idioma = str_limit($idiomasEnMiCarrera[$i]->nombre_idioma, $limit = 20, $end = '...');
                    $idiomasMayorCantidadEnMiCarrera[$i] = $idiomasEnMiCarrera[$i];
                    $i++;
            }
            
            return view('in.reportes.estudiante.index')
                    ->with('cantEstadosEnPostulaciones',$cantEstadosEnPostulaciones)
                    ->with('EmpConMayorPropParaMiCarrera',$EmpConMayorPropParaMiCarrera)
                    ->with('idiomasMayorCantidadEnMiCarrera',$idiomasMayorCantidadEnMiCarrera);

        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }

    public function getIdiomasSolicitados()
    {
        
        if(true){
            $carreraId = Auth::user()->persona->fisica->estudiante->carrera_id;

            $idiomasEnMiCarrera = DB::select('select count(*) cantidad, i.nombre_idioma
                                    from propuestas_laborales as pl join requisitos_carrera as rc on pl.id = rc.propuesta_laboral_id
                                            join (select distinct propuesta_laboral_id, idioma_id 
                                                  from requisitos_idioma) as ri on ri.propuesta_laboral_id = pl.id
                                            join idiomas as i on ri.idioma_id = i.id
                                    where rc.carrera_id = ?
                                    group by i.nombre_idioma
                                    order by cantidad Desc',[$carreraId]);
            
            return view('in.reportes.estudiante.tablasonline.idiomas_solicitados')
                    ->with('idiomasEnMiCarrera',$idiomasEnMiCarrera);
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }

    public function getIdiomasSolicitadosPdf()
    {
        
        if(true){
            $today = Carbon::today()->format('d-m-Y');
            $carreraId = Auth::user()->persona->fisica->estudiante->carrera_id;

            $idiomasEnMiCarrera = DB::select('select count(*) cantidad, i.nombre_idioma
                                    from propuestas_laborales as pl join requisitos_carrera as rc on pl.id = rc.propuesta_laboral_id
                                            join (select distinct propuesta_laboral_id, idioma_id 
                                                  from requisitos_idioma) as ri on ri.propuesta_laboral_id = pl.id
                                            join idiomas as i on ri.idioma_id = i.id
                                    where rc.carrera_id = ?
                                    group by i.nombre_idioma
                                    order by cantidad Desc',[$carreraId]);
            
            $pdf = \PDF::loadView('in.reportes.estudiante.tablaspdf.idiomas_solicitados',['idiomasEnMiCarrera' => $idiomasEnMiCarrera, 'today' => $today]);
            return $pdf->stream('Reporte-idiomas-solicitados.pdf');
            
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }

    public function getEstadosPostulaciones(){

        if(true){
            $estudianteId = Auth::user()->persona->fisica->estudiante->id;

            $cantEstadosEnPostulaciones = DB::select('select count(*) cantidad, epl.estado_postulacion
                                                from estudiante_propuesta_laboral as epl
                                                where epl.estudiante_id = ?
                                                group by estado_postulacion
                                                order by cantidad Desc',[$estudianteId]);
            
             return view('in.reportes.estudiante.tablasonline.estados_postulaciones')
                    ->with('cantEstadosEnPostulaciones',$cantEstadosEnPostulaciones);
            
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }

    public function getEstadosPostulacionesPdf(){

        if(true){
            $today = Carbon::today()->format('d-m-Y');
            $estudianteId = Auth::user()->persona->fisica->estudiante->id;

            $cantEstadosEnPostulaciones = DB::select('select count(*) cantidad, epl.estado_postulacion
                                                from estudiante_propuesta_laboral as epl
                                                where epl.estudiante_id = ?
                                                group by estado_postulacion
                                                order by cantidad Desc',[$estudianteId]);
            
             $pdf = \PDF::loadView('in.reportes.estudiante.tablaspdf.estados_postulaciones',['cantEstadosEnPostulaciones' => $cantEstadosEnPostulaciones, 'today' => $today]);
            return $pdf->stream('Reporte-estados-postulaciones.pdf');
            
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

    public function getEmpresasPropuestasMiCarrera(){

        if(true){
            $carreraId = Auth::user()->persona->fisica->estudiante->carrera_id;

            $empConPropParaMiCarrera = DB::select('select count(*) cantidad, j.nombre_comercial
                                    from propuestas_laborales as pl join requisitos_carrera as rc on pl.id = rc.propuesta_laboral_id
                                            join juridicas as j on pl.juridica_id = j.id 
                                    where rc.carrera_id = ?
                                    group by j.nombre_comercial
                                    order by cantidad Desc',[$carreraId]);
            
             return view('in.reportes.estudiante.tablasonline.empresas_propuestas_mi_carrera')
                    ->with('empConPropParaMiCarrera',$empConPropParaMiCarrera);
            
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

    public function getEmpresasPropuestasMiCarreraPdf(){

         if(true){
            $today = Carbon::today()->format('d-m-Y');
            $carreraId = Auth::user()->persona->fisica->estudiante->carrera_id;

            $empConPropParaMiCarrera = DB::select('select count(*) cantidad, j.nombre_comercial
                                    from propuestas_laborales as pl join requisitos_carrera as rc on pl.id = rc.propuesta_laboral_id
                                            join juridicas as j on pl.juridica_id = j.id 
                                    where rc.carrera_id = ?
                                    group by j.nombre_comercial
                                    order by cantidad Desc',[$carreraId]);
            
             $pdf = \PDF::loadView('in.reportes.estudiante.tablaspdf.empresas_propuestas_mi_carrera',['empConPropParaMiCarrera' => $empConPropParaMiCarrera, 'today' => $today]);
            return $pdf->stream('Reporte-empresas-propuestas-mi-carrera.pdf');
            
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }


    }

}
