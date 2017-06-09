<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportesAdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('super_usuario')){
            $propuestasPorEmpresa = DB::select('select count(*) as cantidad_propuestas, j.nombre_comercial
                                                from juridicas as j join propuestas_laborales as pl on j.id = pl.juridica_id join personas p on j.persona_id = p.id
                                                where p.estado_persona = ?
                                                group by j.nombre_comercial
                                                order by cantidad_propuestas Desc',['activo']);
            // LAS 5 EMPRESAS MAS INACTIVAS
            $EmpresasConMasPropuestas = [];
            $i = 0;
            while ( ($i <= 4) && ( $i < sizeof($propuestasPorEmpresa))){
                    $propuestasPorEmpresa[$i]->nombre_comercial = str_limit($propuestasPorEmpresa[$i]->nombre_comercial, $limit = 20, $end = '...');
                    $EmpresasConMasPropuestas[$i] = $propuestasPorEmpresa[$i];
                    $i++;
            }

            //--------------------------------------------//
            // Busco las empresas Activas
            $empresasActivas = DB::select('select j.id, j.nombre_comercial
                                from juridicas as j join personas as p on j.persona_id = p.id
                                where p.estado_persona = ?',['activo']);

            // Busco las ultimas ofertas realizadas
            foreach ($empresasActivas as $key => $empresaActiva) {
                $ultima_propuesta = DB::select('select fecha_inicio_propuesta as fecha
                                        from propuestas_laborales
                                        where juridica_id = ?
                                        order by created_at Desc limit 1',[$empresaActiva->id]);
                if ($ultima_propuesta != null){
                    $empresasActivas[$key]->fecha_ultima_propuesta = $ultima_propuesta[0]->fecha;
                }else{
                    $empresasActivas[$key]->fecha_ultima_propuesta = null;
                }
            }

            // ordemaniento por fecha de ultima oferta
            for($i=1;$i<sizeof($empresasActivas);$i++){
                for($j=0;$j<sizeof($empresasActivas)-$i;$j++){
                    if($empresasActivas[$j]->fecha_ultima_propuesta > $empresasActivas[$j+1]->fecha_ultima_propuesta){
                        $k=$empresasActivas[$j+1];
                        $empresasActivas[$j+1]=$empresasActivas[$j];
                        $empresasActivas[$j]=$k;
                    }
                }
            }

            // LAS 5 EMPRESAS MAS INACTIVAS
            $EmpresasMasInactivas = [];
            $i = 0;
            while ( ($i <= 4) && ( $i < sizeof($empresasActivas))){
                    $empresasActivas[$i]->nombre_comercial = str_limit($empresasActivas[$i]->nombre_comercial, $limit = 20, $end = '...');
                    $EmpresasMasInactivas[$i] = $empresasActivas[$i];
                    $i++;
            }

            $today = Carbon::today();
            // Define la cantidad de dias inactivos
            foreach ($EmpresasMasInactivas as $key => $empresa) {
                    $datetime1 = new \DateTime($empresa->fecha_ultima_propuesta);
                    $datetime2 = new \DateTime($today);
                    $interval = $datetime1->diff($datetime2);
                    $EmpresasMasInactivas[$key]->dias_inactivo = $interval->format('%R%a');
            }

            //-------------------------------------------------------//

            $cantidadEstudiantePorCarrera = DB::select('
                                                select count(*) as cantidad_estudiantes, c.nombre_carrera
                                                from estudiantes as e join carreras as c on e.carrera_id = c.id
                                                group by e.carrera_id
                                                order by cantidad_estudiantes Desc');

            // LAS 5 CARRERAS CON MAYOR CANTIDAD DE ESTUDIANTES
            $carrerasConMayorCantidadEstudiantes = [];
            $i = 0;
            while ( ($i <= 4) && ( $i < sizeof($cantidadEstudiantePorCarrera))){
                    $cantidadEstudiantePorCarrera[$i]->nombre_carrera = str_limit($cantidadEstudiantePorCarrera[$i]->nombre_carrera, $limit = 20, $end = '...');
                    $carrerasConMayorCantidadEstudiantes[$i] = $cantidadEstudiantePorCarrera[$i];
                    $i++;
            }

            //-------------------------------------------------------//

            $cantidadEmpresasPorRubro = DB::select('
                                                select count(*) as cantidad_empresas, re.nombre_rubro_empresarial
                                                from juridicas as j join rubros_empresariales as re on j.rubro_empresarial_id = re.id
                                                group by j.rubro_empresarial_id
                                                order by cantidad_empresas Desc');

            // LOS RUBROS CON MAYOR CANTIDAD DE EMPRESAS
            $rubrosConMayorCantidadEmpresas = [];
            $i = 0;
            while ( $i < sizeof($cantidadEmpresasPorRubro)){
                    $cantidadEmpresasPorRubro[$i]->nombre_rubro_empresarial = str_limit($cantidadEmpresasPorRubro[$i]->nombre_rubro_empresarial, $limit = 20, $end = '...');
                    $rubrosConMayorCantidadEmpresas[$i] = $cantidadEmpresasPorRubro[$i];
                    $i++;
            }

            //-----------------------------------------------------//

            $today = Carbon::today();
            $desde = $today->subYear()->toDateString();
            $hasta = Carbon::today()->toDateString();

            $cantidadPropuestaPorMes = DB::select('select count(*) as cantidad_propuesta, MONTH(fecha_inicio_propuesta) as mes,  YEAR(fecha_inicio_propuesta) as anio
                                                    from propuestas_laborales
                                                    where fecha_inicio_propuesta >= ? and fecha_inicio_propuesta <= ?
                                                    group by Mes, Anio
                                                    order by fecha_inicio_propuesta Desc',[$desde,$hasta]);

            //-----------------------------------------------------//

            // por defecto seria empresa, ultimo mes, vigentes

            $today = Carbon::today();
            $desde = $today->subMonth()->toDateString();
            $today = Carbon::today()->toDateString();

            $cantidadPropuestasPorEmpresa = DB::select('
                                        select count(*) as cantidad_propuestas, j.nombre_comercial
                                        from propuestas_laborales as pl join juridicas as j on pl.juridica_id = j.id join personas p on j.persona_id = p.id
                                        where fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ? and p.estado_persona = ?
                                        group by pl.juridica_id
                                        order by cantidad_propuestas Asc',[$desde,$today,'activo']);

            $cantidadPropuestas = [];
            $i = 0;
            while ( ($i <= 9) && ( $i < sizeof($cantidadPropuestasPorEmpresa))){
                    $cantidadPropuestasPorEmpresa[$i]->nombre_comercial = str_limit($cantidadPropuestasPorEmpresa[$i]->nombre_comercial, $limit = 20, $end = '...');
                    $cantidadPropuestas[$i] = $cantidadPropuestasPorEmpresa[$i];
                    $i++;
            }

            return view('in.reportes.administrador.index')
                    ->with('EmpresasConMasPropuestas',$EmpresasConMasPropuestas)
                    ->with('EmpresasMasInactivas',$EmpresasMasInactivas)
                    ->with('carrerasConMayorCantidadEstudiantes',$carrerasConMayorCantidadEstudiantes)
                    ->with('rubrosConMayorCantidadEmpresas',$rubrosConMayorCantidadEmpresas)
                    ->with('cantidadPropuestaPorMes',$cantidadPropuestaPorMes)
                    ->with('cantidadPropuestas',$cantidadPropuestas);

        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }

    public function getDatosEstadistica(Request $request){

      if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('super_usuario')){

          $today = Carbon::today();
          if($request->tiempo == "ultimo_mes"){
              $desde = $today->subMonth()->toDateString();
          }else{
              if($request->tiempo == "ultimos_6_meses"){
                  $desde = $today->subMonth(6)->toDateString();
              }else{
                  if($request->tiempo =="ultimo_anio"){
                      $desde = $today->subYear()->toDateString();
                  }else{
                      $desde = "0000-00-00"; //valor por defecto
                  }
              }
          }

          if($request->filtro == "empresa"){
              $today = Carbon::today();
              if($request->estado == "vigente"){
                  $cantidadPropuestasPorFiltro = DB::select('
                                              select count(*) as cantidad_propuestas, j.nombre_comercial as filtro
                                              from propuestas_laborales as pl join juridicas as j on pl.juridica_id = j.id join personas p on j.persona_id = p.id
                                              where fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ? and p.estado_persona = ?
                                              group by pl.juridica_id
                                              order by cantidad_propuestas Asc',[$desde,$today,'activo']);
              }else{
                  $cantidadPropuestasPorFiltro = DB::select('
                                              select count(*) as cantidad_propuestas, j.nombre_comercial as filtro
                                              from propuestas_laborales as pl join juridicas as j on pl.juridica_id = j.id join personas p on j.persona_id = p.id
                                              where fecha_inicio_propuesta >= ? and p.estado_persona = ?
                                              group by pl.juridica_id
                                              order by cantidad_propuestas Asc',[$desde,'activo']);
              }
          }else{
              if($request->filtro == "carrera"){
                  if($request->estado == "vigente"){
                      $cantidadPropuestasPorFiltro = DB::select('select count(*) as cantidad_propuestas, ca.nombre_carrera as filtro
                                                      from propuestas_laborales as pl join requisitos_carrera as rc on pl.id = rc.propuesta_laboral_id join carreras as ca on rc.carrera_id = ca.id
                                                      where pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Asc',[$desde,$today]);

                  }else{
                      $cantidadPropuestasPorFiltro = DB::select('select count(*) as cantidad_propuestas, ca.nombre_carrera as filtro
                                                      from propuestas_laborales as pl join requisitos_carrera as rc on pl.id = rc.propuesta_laboral_id join carreras as ca on rc.carrera_id = ca.id
                                                      where pl.fecha_inicio_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Asc',[$desde]);

                  }
              }else{
                  if($request->filtro == "idioma"){
                      if($request->estado == "vigente"){
                          $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, i.nombre_idioma as filtro
                                                      from propuestas_laborales as pl join (select distinct propuesta_laboral_id, idioma_id
                                                    from requisitos_idioma) as ri on pl.id = ri.propuesta_laboral_id join idiomas as i on ri.idioma_id = i.id
                                                      where pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Asc',[$desde,$today]);

                      }else{
                          $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, i.nombre_idioma as filtro
                                                      from propuestas_laborales as pl join (select distinct propuesta_laboral_id, idioma_id
                                                    from requisitos_idioma) as ri on pl.id = ri.propuesta_laboral_id join idiomas as i on ri.idioma_id = i.id
                                                      where pl.fecha_inicio_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Asc',[$desde]);

                      }
                  }else{
                      if($request->filtro == "tipo_trabajo"){
                          if($request->estado == "vigente"){
                              $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, tt.nombre_tipo_trabajo as filtro
                                                      from propuestas_laborales as pl join tipos_trabajo as tt on pl.tipo_trabajo_id = tt.id
                                                      where pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Asc',[$desde,$today]);

                          }else{
                              $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, tt.nombre_tipo_trabajo as filtro
                                                      from propuestas_laborales as pl join tipos_trabajo as tt on pl.tipo_trabajo_id = tt.id
                                                      where pl.fecha_inicio_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Asc',[$desde]);
                          }
                      }else{
                          if($request->filtro == "tipo_jornada"){
                              if($request->estado == "vigente"){
                                  $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, tj.nombre_tipo_jornada filtro
                                                      from propuestas_laborales as pl join tipos_jornada as tj on pl.tipo_jornada_id = tj.id
                                                      where pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Asc',[$desde,$today]);

                              }else{
                                  $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, tj.nombre_tipo_jornada filtro
                                                      from propuestas_laborales as pl join tipos_jornada as tj on pl.tipo_jornada_id = tj.id
                                                      where pl.fecha_inicio_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Asc',[$desde]);

                              }
                          }
                      }
                  }
              }
          }


          $cantidadPropuestas = [];
          $i = 0;
          while ( ($i <= 9) && ( $i < sizeof($cantidadPropuestasPorFiltro))){
                  $cantidadPropuestasPorFiltro[$i]->filtro = str_limit($cantidadPropuestasPorFiltro[$i]->filtro, $limit = 20, $end = '...');
                  $cantidadPropuestas[$i] = $cantidadPropuestasPorFiltro[$i];
                  $i++;
          }


          return response()->json([
          'cantidadPropuestas' => $cantidadPropuestas
        ]);
      }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
      }
    }

    public function getEmpresasMasPropuestas(){

        if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('super_usuario')){
            $propuestasPorEmpresa = DB::select('select count(*) as cantidad_propuestas, j.nombre_comercial
                                                from juridicas as j join propuestas_laborales as pl on j.id = pl.juridica_id join personas p on j.persona_id = p.id
                                                where p.estado_persona = ?
                                                group by j.nombre_comercial
                                                order by cantidad_propuestas Desc',['activo']);

             return view('in.reportes.administrador.tablasonline.empresas_mas_propuestas')
                    ->with('propuestasPorEmpresa',$propuestasPorEmpresa);

        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

    public function getEmpresasMasPropuestasPdf(){

         if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('super_usuario')){
            $today = Carbon::today()->format('d-m-Y');
            $propuestasPorEmpresa = DB::select('select count(*) as cantidad_propuestas, j.nombre_comercial
                                                from juridicas as j join propuestas_laborales as pl on j.id = pl.juridica_id join personas p on j.persona_id = p.id
                                                where p.estado_persona = ?
                                                group by j.nombre_comercial
                                                order by cantidad_propuestas Desc',['activo']);
            $EmpresasConMasPropuestas = [];
            $i = 0;
            while ( ($i <= 4) && ( $i < sizeof($propuestasPorEmpresa))){
              $EmpresasConMasPropuestas[$i] = $propuestasPorEmpresa[$i];
              $i++;
            }

            $pdf = \PDFjs::loadView('in.reportes.administrador.tablaspdf.empresas_mas_propuestas',['propuestasPorEmpresa' => $propuestasPorEmpresa,'EmpresasConMasPropuestas' => $EmpresasConMasPropuestas, 'today' => $today]);
            $pdf->setOption('enable-javascript', true);
            return $pdf->stream('Reporte-empresas-con-mas-propuestas.pdf');

        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

    public function getEmpresasMasDiasInactividad(){

        if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('super_usuario')){
            // Busco las empresas Activas
            $empresasActivas = DB::select('select j.id, j.nombre_comercial
                                from juridicas as j join personas as p on j.persona_id = p.id
                                where p.estado_persona = ?',['activo']);

            // Busco las ultimas ofertas realizadas
            foreach ($empresasActivas as $key => $empresaActiva) {
                $ultima_propuesta = DB::select('select fecha_inicio_propuesta as fecha
                                        from propuestas_laborales
                                        where juridica_id = ?
                                        order by created_at Desc limit 1',[$empresaActiva->id]);
                if ($ultima_propuesta != null){
                    $empresasActivas[$key]->fecha_ultima_propuesta = $ultima_propuesta[0]->fecha;
                }else{
                    $empresasActivas[$key]->fecha_ultima_propuesta = null;
                }
            }

            // ordemaniento por fecha de ultima oferta
            for($i=1;$i<sizeof($empresasActivas);$i++){
                for($j=0;$j<sizeof($empresasActivas)-$i;$j++){
                    if($empresasActivas[$j]->fecha_ultima_propuesta > $empresasActivas[$j+1]->fecha_ultima_propuesta){
                        $k=$empresasActivas[$j+1];
                        $empresasActivas[$j+1]=$empresasActivas[$j];
                        $empresasActivas[$j]=$k;
                    }
                }
            }

            $today = Carbon::today();
            // Define la cantidad de dias inactivos
            foreach ($empresasActivas as $key => $empresa) {
                    $datetime1 = new \DateTime($empresa->fecha_ultima_propuesta);
                    $datetime2 = new \DateTime($today);
                    $interval = $datetime1->diff($datetime2);
                    $empresasActivas[$key]->dias_inactivo = (int) $interval->format('%R%a');
            }

            return view('in.reportes.administrador.tablasonline.empresas_mas_dias_inactividad')
                    ->with('empresasActivas',$empresasActivas);

        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

    public function getEmpresasMasDiasInactividadPdf(){

         if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('super_usuario')){
            $hoy = Carbon::today()->format('d-m-Y');
            // Busco las empresas Activas
            $empresasActivas = DB::select('select j.id, j.nombre_comercial
                                from juridicas as j join personas as p on j.persona_id = p.id
                                where p.estado_persona = ?',['activo']);

            // Busco las ultimas ofertas realizadas
            foreach ($empresasActivas as $key => $empresaActiva) {
                $ultima_propuesta = DB::select('select fecha_inicio_propuesta as fecha
                                        from propuestas_laborales
                                        where juridica_id = ?
                                        order by created_at Desc limit 1',[$empresaActiva->id]);
                if ($ultima_propuesta != null){
                    $empresasActivas[$key]->fecha_ultima_propuesta = $ultima_propuesta[0]->fecha;
                }else{
                    $empresasActivas[$key]->fecha_ultima_propuesta = null;
                }
            }

            // ordemaniento por fecha de ultima oferta
            for($i=1;$i<sizeof($empresasActivas);$i++){
                for($j=0;$j<sizeof($empresasActivas)-$i;$j++){
                    if($empresasActivas[$j]->fecha_ultima_propuesta > $empresasActivas[$j+1]->fecha_ultima_propuesta){
                        $k=$empresasActivas[$j+1];
                        $empresasActivas[$j+1]=$empresasActivas[$j];
                        $empresasActivas[$j]=$k;
                    }
                }
            }

            $today = Carbon::today();
            // Define la cantidad de dias inactivos
            foreach ($empresasActivas as $key => $empresa) {
                    $datetime1 = new \DateTime($empresa->fecha_ultima_propuesta);
                    $datetime2 = new \DateTime($today);
                    $interval = $datetime1->diff($datetime2);
                    $empresasActivas[$key]->dias_inactivo = (int) $interval->format('%R%a');
            }

            $EmpresasMasInactivas = [];
            $i = 0;
            while ( ($i <= 4) && ( $i < sizeof($empresasActivas))){
              $EmpresasMasInactivas[$i] = $empresasActivas[$i];
              $i++;
            }

            $pdf = \PDFjs::loadView('in.reportes.administrador.tablaspdf.empresas_mas_dias_inactividad',['empresasActivas' => $empresasActivas,'EmpresasMasInactivas' => $EmpresasMasInactivas, 'today' => $hoy]);
            $pdf->setOption('enable-javascript', true);
            return $pdf->download('Reporte-empresas-mas-dias-inactividad.pdf');

        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

    public function getCarrerasMasEstudiantes(){

        if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('super_usuario')){
            $cantidadEstudiantePorCarrera = DB::select('
                                                select count(*) as cantidad_estudiantes, c.nombre_carrera
                                                from estudiantes as e join carreras as c on e.carrera_id = c.id
                                                group by e.carrera_id
                                                order by cantidad_estudiantes Desc');

            return view('in.reportes.administrador.tablasonline.carreras_mas_estudiantes')
                    ->with('cantidadEstudiantePorCarrera',$cantidadEstudiantePorCarrera);

        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

    public function getCarrerasMasEstudiantesPdf(){

        if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('super_usuario')){
            $today = Carbon::today()->format('d-m-Y');
            $cantidadEstudiantePorCarrera = DB::select('
                                                select count(*) as cantidad_estudiantes, c.nombre_carrera
                                                from estudiantes as e join carreras as c on e.carrera_id = c.id
                                                group by e.carrera_id
                                                order by cantidad_estudiantes Desc');

            $carrerasConMayorCantidadEstudiantes = [];
            $i = 0;
            while ( ($i <= 4) && ( $i < sizeof($cantidadEstudiantePorCarrera))){
              $carrerasConMayorCantidadEstudiantes[$i] = $cantidadEstudiantePorCarrera[$i];
              $i++;
            }

            $pdf = \PDFjs::loadView('in.reportes.administrador.tablaspdf.carreras_mas_estudiantes',['cantidadEstudiantePorCarrera' => $cantidadEstudiantePorCarrera,'carrerasConMayorCantidadEstudiantes' => $carrerasConMayorCantidadEstudiantes, 'today' => $today]);
            $pdf->setOption('enable-javascript', true);
            return $pdf->download('Reporte-carreras-mas-estudiantes.pdf');

        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

    public function getEmpresasRubroEmpresarial(){

        if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('super_usuario')){
            $cantidadEmpresasPorRubro = DB::select('
                                                select count(*) as cantidad_empresas, re.nombre_rubro_empresarial
                                                from juridicas as j join rubros_empresariales as re on j.rubro_empresarial_id = re.id
                                                group by j.rubro_empresarial_id
                                                order by cantidad_empresas Desc');

            return view('in.reportes.administrador.tablasonline.empresas_por_rubro')
                    ->with('cantidadEmpresasPorRubro',$cantidadEmpresasPorRubro);

        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

    public function getEmpresasRubroEmpresarialPdf(){

        if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('super_usuario')){
            $today = Carbon::today()->format('d-m-Y');
            $cantidadEmpresasPorRubro = DB::select('
                                                select count(*) as cantidad_empresas, re.nombre_rubro_empresarial
                                                from juridicas as j join rubros_empresariales as re on j.rubro_empresarial_id = re.id
                                                group by j.rubro_empresarial_id
                                                order by cantidad_empresas Desc');

            $rubrosConMayorCantidadEmpresas = [];
            $i = 0;
            while ( $i < sizeof($cantidadEmpresasPorRubro)){
                $rubrosConMayorCantidadEmpresas[$i] = $cantidadEmpresasPorRubro[$i];
                $i++;
            }

            $pdf = \PDFjs::loadView('in.reportes.administrador.tablaspdf.empresas_por_rubro',['cantidadEmpresasPorRubro' => $cantidadEmpresasPorRubro,'rubrosConMayorCantidadEmpresas'=>$rubrosConMayorCantidadEmpresas, 'today' => $today]); 
            $pdf->setOption('enable-javascript', true);
            return $pdf->download('Reporte-empresas-por-rubro.pdf');

        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

    public function getPropuestasUltimoAnio(){

        if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('super_usuario')){
            $today = Carbon::today();

            $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

            $reporteMes = [];
            $fecha = Carbon::today();

            for ($i = 0; $i < 12; $i++){
              $strFecha = $fecha->toDateString();
              $resultado = DB::select('select count(*) as cantidad from propuestas_laborales where MONTH(fecha_inicio_propuesta) =  MONTH(?)',[$strFecha]);
              $reporteMes[$i] = [
                "mes" => $meses[(int) substr($fecha, 5, 2) - 1] .' '. substr($fecha, 0, 4),
                "cantidad" =>$resultado[0]->cantidad
              ];
              $fecha = $fecha->subMonth();
            }

            return view('in.reportes.administrador.tablasonline.cantidad_propuestas_ultimo_anio')
                    ->with('reporteMes',$reporteMes);

        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

    public function getPropuestasUltimoAnioPdf(){

        if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('super_usuario')){
            $hoy = Carbon::today()->format('d-m-Y');
            $today = Carbon::today();

            $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

            $reporteMes = [];
            $fecha = Carbon::today();

            for ($i = 0; $i < 12; $i++){
              $strFecha = $fecha->toDateString();
              $resultado = DB::select('select count(*) as cantidad from propuestas_laborales where MONTH(fecha_inicio_propuesta) =  MONTH(?)',[$strFecha]);
              $reporteMes[$i] = [
                "mes" => $meses[(int) substr($fecha, 5, 2) - 1] .' '. substr($fecha, 0, 4),
                "cantidad" =>$resultado[0]->cantidad
              ];
              $fecha = $fecha->subMonth();
            }

            $today = Carbon::today();
            $desde = $today->subYear()->toDateString();
            $hasta = Carbon::today()->toDateString();

            $cantidadPropuestaPorMes = DB::select('select count(*) as cantidad_propuesta, MONTH(fecha_inicio_propuesta) as mes,  YEAR(fecha_inicio_propuesta) as anio
                                                    from propuestas_laborales
                                                    where fecha_inicio_propuesta >= ? and fecha_inicio_propuesta <= ?
                                                    group by Mes, Anio
                                                    order by fecha_inicio_propuesta Asc',[$desde,$hasta]);

            $pdf = \PDFjs::loadView('in.reportes.administrador.tablaspdf.cantidad_propuestas_ultimo_anio',['reporteMes' => $reporteMes,'cantidadPropuestaPorMes'=>$cantidadPropuestaPorMes, 'today' => $hoy]);
            $pdf->setOption('enable-javascript', true);
            return $pdf->download('Reporte-cantidad-propuestas-ultimo-anio.pdf');
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

    public function getCantidadPropuestas(Request $request){

        if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('super_usuario')){
          
          $today = Carbon::today();
          if($request->tiempo == "ultimo_mes"){
              $desde = $today->subMonth()->toDateString();
          }else{
              if($request->tiempo == "ultimos_6_meses"){
                  $desde = $today->subMonth(6)->toDateString();
              }else{
                  if($request->tiempo =="ultimo_anio"){
                      $desde = $today->subYear()->toDateString();
                  }else{
                      $desde = "0000-00-00"; //valor por defecto
                  }
              }
          }

          if($request->filtro == "empresa"){
              $today = Carbon::today();
              if($request->estado == "vigente"){
                  $cantidadPropuestasPorFiltro = DB::select('
                                              select count(*) as cantidad_propuestas, j.nombre_comercial as filtro
                                              from propuestas_laborales as pl join juridicas as j on pl.juridica_id = j.id join personas p on j.persona_id = p.id
                                              where fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ? and p.estado_persona = ?
                                              group by pl.juridica_id
                                              order by cantidad_propuestas Desc',[$desde,$today,'activo']);
              }else{
                  $cantidadPropuestasPorFiltro = DB::select('
                                              select count(*) as cantidad_propuestas, j.nombre_comercial as filtro
                                              from propuestas_laborales as pl join juridicas as j on pl.juridica_id = j.id join personas p on j.persona_id = p.id
                                              where fecha_inicio_propuesta >= ? and p.estado_persona = ?
                                              group by pl.juridica_id
                                              order by cantidad_propuestas Desc',[$desde,'activo']);
              }
          }else{
              if($request->filtro == "carrera"){
                  if($request->estado == "vigente"){
                      $cantidadPropuestasPorFiltro = DB::select('select count(*) as cantidad_propuestas, ca.nombre_carrera as filtro
                                                      from propuestas_laborales as pl join requisitos_carrera as rc on pl.id = rc.propuesta_laboral_id join carreras as ca on rc.carrera_id = ca.id
                                                      where pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde,$today]);

                  }else{
                      $cantidadPropuestasPorFiltro = DB::select('select count(*) as cantidad_propuestas, ca.nombre_carrera as filtro
                                                      from propuestas_laborales as pl join requisitos_carrera as rc on pl.id = rc.propuesta_laboral_id join carreras as ca on rc.carrera_id = ca.id
                                                      where pl.fecha_inicio_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde]);

                  }
              }else{
                  if($request->filtro == "idioma"){
                      if($request->estado == "vigente"){
                          $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, i.nombre_idioma as filtro
                                                      from propuestas_laborales as pl join (select distinct propuesta_laboral_id, idioma_id
                                                    from requisitos_idioma) as ri on pl.id = ri.propuesta_laboral_id join idiomas as i on ri.idioma_id = i.id
                                                      where pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde,$today]);

                      }else{
                          $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, i.nombre_idioma as filtro
                                                      from propuestas_laborales as pl join (select distinct propuesta_laboral_id, idioma_id
                                                    from requisitos_idioma) as ri on pl.id = ri.propuesta_laboral_id join idiomas as i on ri.idioma_id = i.id
                                                      where pl.fecha_inicio_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde]);

                      }
                  }else{
                      if($request->filtro == "tipo_trabajo"){
                          if($request->estado == "vigente"){
                              $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, tt.nombre_tipo_trabajo as filtro
                                                      from propuestas_laborales as pl join tipos_trabajo as tt on pl.tipo_trabajo_id = tt.id
                                                      where pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde,$today]);

                          }else{
                              $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, tt.nombre_tipo_trabajo as filtro
                                                      from propuestas_laborales as pl join tipos_trabajo as tt on pl.tipo_trabajo_id = tt.id
                                                      where pl.fecha_inicio_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde]);
                          }
                      }else{
                          if($request->filtro == "tipo_jornada"){
                              if($request->estado == "vigente"){
                                  $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, tj.nombre_tipo_jornada filtro
                                                      from propuestas_laborales as pl join tipos_jornada as tj on pl.tipo_jornada_id = tj.id
                                                      where pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde,$today]);

                              }else{
                                  $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, tj.nombre_tipo_jornada filtro
                                                      from propuestas_laborales as pl join tipos_jornada as tj on pl.tipo_jornada_id = tj.id
                                                      where pl.fecha_inicio_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde]);

                              }
                          }
                      }
                  }
              }
          }

          return view('in.reportes.administrador.tablasonline.total_propuestas')
                    ->with('cantidadPropuestasPorFiltro',$cantidadPropuestasPorFiltro)
                    ->with('combo',$request);

        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

    public function getCantidadPropuestasPdf(Request $request){

        $hoy = Carbon::today()->format('d-m-Y');

        if(Auth::user()->hasRole('administrador') || Auth::user()->hasRole('super_usuario')){

          //dd($request->tiempo);
          
          $today = Carbon::today();
          if($request->tiempo == "ultimo_mes"){
              $desde = $today->subMonth()->toDateString();
          }else{
              if($request->tiempo == "ultimos_6_meses"){
                  $desde = $today->subMonth(6)->toDateString();
              }else{
                  if($request->tiempo =="ultimo_anio"){
                      $desde = $today->subYear()->toDateString();
                  }else{
                      $desde = "0000-00-00"; //valor por defecto
                  }
              }
          }

          if($request->filtro == "empresa"){
              $today = Carbon::today();
              if($request->estado == "vigente"){
                  $cantidadPropuestasPorFiltro = DB::select('
                                              select count(*) as cantidad_propuestas, j.nombre_comercial as filtro
                                              from propuestas_laborales as pl join juridicas as j on pl.juridica_id = j.id join personas p on j.persona_id = p.id
                                              where fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ? and p.estado_persona = ?
                                              group by pl.juridica_id
                                              order by cantidad_propuestas Desc',[$desde,$today,'activo']);
              }else{
                  $cantidadPropuestasPorFiltro = DB::select('
                                              select count(*) as cantidad_propuestas, j.nombre_comercial as filtro
                                              from propuestas_laborales as pl join juridicas as j on pl.juridica_id = j.id join personas p on j.persona_id = p.id
                                              where fecha_inicio_propuesta >= ? and p.estado_persona = ?
                                              group by pl.juridica_id
                                              order by cantidad_propuestas Desc',[$desde,'activo']);
              }
          }else{
              if($request->filtro == "carrera"){
                  if($request->estado == "vigente"){
                      $cantidadPropuestasPorFiltro = DB::select('select count(*) as cantidad_propuestas, ca.nombre_carrera as filtro
                                                      from propuestas_laborales as pl join requisitos_carrera as rc on pl.id = rc.propuesta_laboral_id join carreras as ca on rc.carrera_id = ca.id
                                                      where pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde,$today]);

                  }else{
                      $cantidadPropuestasPorFiltro = DB::select('select count(*) as cantidad_propuestas, ca.nombre_carrera as filtro
                                                      from propuestas_laborales as pl join requisitos_carrera as rc on pl.id = rc.propuesta_laboral_id join carreras as ca on rc.carrera_id = ca.id
                                                      where pl.fecha_inicio_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde]);

                  }
              }else{
                  if($request->filtro == "idioma"){
                      if($request->estado == "vigente"){
                          $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, i.nombre_idioma as filtro
                                                      from propuestas_laborales as pl join (select distinct propuesta_laboral_id, idioma_id
                                                    from requisitos_idioma) as ri on pl.id = ri.propuesta_laboral_id join idiomas as i on ri.idioma_id = i.id
                                                      where pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde,$today]);

                      }else{
                          $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, i.nombre_idioma as filtro
                                                      from propuestas_laborales as pl join (select distinct propuesta_laboral_id, idioma_id
                                                    from requisitos_idioma) as ri on pl.id = ri.propuesta_laboral_id join idiomas as i on ri.idioma_id = i.id
                                                      where pl.fecha_inicio_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde]);

                      }
                  }else{
                      if($request->filtro == "tipo_trabajo"){
                          if($request->estado == "vigente"){
                              $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, tt.nombre_tipo_trabajo as filtro
                                                      from propuestas_laborales as pl join tipos_trabajo as tt on pl.tipo_trabajo_id = tt.id
                                                      where pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde,$today]);

                          }else{
                              $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, tt.nombre_tipo_trabajo as filtro
                                                      from propuestas_laborales as pl join tipos_trabajo as tt on pl.tipo_trabajo_id = tt.id
                                                      where pl.fecha_inicio_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde]);
                          }
                      }else{
                          if($request->filtro == "tipo_jornada"){
                              if($request->estado == "vigente"){
                                  $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, tj.nombre_tipo_jornada filtro
                                                      from propuestas_laborales as pl join tipos_jornada as tj on pl.tipo_jornada_id = tj.id
                                                      where pl.fecha_inicio_propuesta >= ? and pl.fecha_fin_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde,$today]);

                              }else{
                                  $cantidadPropuestasPorFiltro = DB::select('
                                                      select count(*) as cantidad_propuestas, tj.nombre_tipo_jornada filtro
                                                      from propuestas_laborales as pl join tipos_jornada as tj on pl.tipo_jornada_id = tj.id
                                                      where pl.fecha_inicio_propuesta >= ?
                                                      group by filtro
                                                      order by cantidad_propuestas Desc',[$desde]);

                              }
                          }
                      }
                  }
              }
          }

          $cantidadPropuestas = [];
          $i = sizeof($cantidadPropuestasPorFiltro) - 1;
          while ($i >= 0){
            $cantidadPropuestas[$i] = $cantidadPropuestasPorFiltro[$i];
            $i--;
          }

          $pdf = \PDFjs::loadView('in.reportes.administrador.tablaspdf.total_propuestas',['cantidadPropuestasPorFiltro' => $cantidadPropuestasPorFiltro, 'cantidadPropuestas' => $cantidadPropuestas, 'filtro' => $request->filtro, 'today' => $hoy]);
          $pdf->setOption('enable-javascript', true);
          return $pdf->download('Reporte-total-propuestas.pdf');

        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }

    }

}
