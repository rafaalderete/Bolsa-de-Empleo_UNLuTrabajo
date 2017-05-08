<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Propuesta_Laboral as Propuesta_Laboral;
use App\Tipo_Trabajo as Tipo_Trabajo;
use App\Tipo_Jornada as Tipo_Jornada;
use App\Tipo_Conocimiento_Idioma as Tipo_Conocimiento_Idioma;
use App\Nivel_Conocimiento as Nivel_Conocimiento;
use App\Estado_Carrera as Estado_Carrera;
use App\Idioma as Idioma;
use App\Carrera as Carrera;
use App\Requisito_Residencia as Requisito_Residencia;
use App\Requisito_Idioma as Requisito_Idioma;
use App\Requisito_Carrera as Requisito_Carrera;
use App\Requisito_Adicional as Requisito_Adicional;
use App\Http\Requests\StoreUpdatePropuestaLaboralRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PropuestasController extends Controller
{

    const CANT_PAGINA = 5;
    const DESCRIPCION = 350; //Cantidad de caracteres que se mostrarán en el index.

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if(Auth::user()->can('listar_propuestas_laborales')){

        $busqueda = false;
        $fechaActual = Carbon::now();

        if(isset($request->buscar) && $request->buscar != null) {
          $palabra_a_buscar = preg_replace("/[^A-Za-z0-9 ]/", '', $request->buscar);
          $busqueda = true;
          $propuestas = Propuesta_Laboral::where('juridica_id',Auth::user()->persona->juridica->id)
            ->where('titulo','LIKE', '%'.$palabra_a_buscar.'%')
            ->where('estado_propuesta','activo')
            ->orderBy('created_at','DESC')
            ->paginate(self::CANT_PAGINA);
        }
        else {
          $propuestas = Propuesta_Laboral::where('juridica_id',Auth::user()->persona->juridica->id)
            ->where('estado_propuesta','activo')
            ->orderBy('created_at','DESC')
            ->paginate(self::CANT_PAGINA);
        }

        foreach ($propuestas as $key => $propuesta) {
          $propuestas[$key]->descripcion = substr($propuestas[$key]->descripcion,0,self::DESCRIPCION).'...';
          $propuestas[$key]->fecha_inicio_propuesta = date('d-m-Y', strtotime($propuestas[$key]->fecha_inicio_propuesta));
        }

        return view('in.propuestas_laborales.index')
          ->with('propuestas',$propuestas)
          ->with('busqueda',$busqueda)
          ->with('fechaActual',$fechaActual);

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
      if(Auth::user()->can('crear_propuesta_laboral')){
        $tipos_trabajo = Tipo_Trabajo::all()->where('estado', 'activo');
        $tipos_jornada= Tipo_Jornada::all()->where('estado', 'activo');
        $tipos_conocimiento_idioma = Tipo_Conocimiento_Idioma::all()->where('estado', 'activo');
        $niveles_conocimiento = Nivel_Conocimiento::all()->where('estado', 'activo');
        $estados_carrera = Estado_Carrera::all()->where('estado', 'activo');
        $idiomas = Idioma::all()->where('estado', 'activo');
        $carreras = Carrera::all();

        return view('in.propuestas_laborales.create')
            ->with('tipos_trabajo',$tipos_trabajo)
            ->with('tipos_jornada',$tipos_jornada)
            ->with('tipos_conocimiento_idioma',$tipos_conocimiento_idioma)
            ->with('niveles_conocimiento',$niveles_conocimiento)
            ->with('estados_carrera',$estados_carrera)
            ->with('idiomas',$idiomas)
            ->with('carreras',$carreras);
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
    private function storeRequisitos($propuestaId, $request)
    {
      if (isset($request->lugar)) {
        foreach ($request->lugar as $key => $lugar) {
          if ($lugar != "") {
            $req_residencia = new Requisito_Residencia();
            $req_residencia->propuesta_laboral_id = $propuestaId;
            $req_residencia->lugar = $lugar;
            $req_residencia->excluyente = false;
            if (isset($request->excluyente_residencia)) {
              foreach ($request->excluyente_residencia as $excluyente) {
                if ($excluyente == $key) {//Se verifica que el checkbox de su posición esté activado.
                  $req_residencia->excluyente = true;
                }
              }
            }
            $req_residencia->save(); //Se inserta los N requisitos de residencia.
          }
        }
      }

      if (isset($request->idioma)) {
        foreach ($request->idioma as $key => $idioma) {
          $req_idioma = new Requisito_Idioma();
          $req_idioma->propuesta_laboral_id = $propuestaId;
          $req_idioma->idioma_id = $idioma;
          $req_idioma->tipo_conocimiento_idioma_id = $request->tipo_conocimiento_idioma[$key];
          $req_idioma->nivel_conocimiento_id = $request->nivel_conocimiento_idioma[$key];
          $req_idioma->excluyente = false;
          if (isset($request->excluyente_idioma)) {
            foreach ($request->excluyente_idioma as $excluyente) {
              if ($excluyente == $key) {//Se verifica que el checkbox de su posición esté activado.
                $req_idioma->excluyente = true;
              }
            }
          }
          $req_idioma->save(); //Se inserta los N requisitos de idioma.
        }
      }

      if (isset($request->carrera)) {
        foreach ($request->carrera as $key => $carrera) {
          $req_carrera = new Requisito_Carrera();
          $req_carrera->propuesta_laboral_id = $propuestaId;
          $req_carrera->carrera_id = $carrera;
          $req_carrera->estado_carrera_id = $request->estado_carrera[$key];
          $req_carrera->excluyente = false;
          if (isset($request->excluyente_carrera)) {
            foreach ($request->excluyente_carrera as $excluyente) {
              if ($excluyente == $key) {//Se verifica que el checkbox de su posición esté activado.
                $req_carrera->excluyente = true;
              }
            }
          }
          $req_carrera->save(); //Se inserta los N requisitos de carrera.
        }
      }

      if (isset($request->nombre_requisito)) {
        foreach ($request->nombre_requisito as $key => $requisito) {
          if ($requisito != "") {
            $req_adicional = new Requisito_Adicional();
            $req_adicional->propuesta_laboral_id = $propuestaId;
            $req_adicional->nombre_requisito = $requisito;
            $req_adicional->nivel_conocimiento_id = $request->nivel_conocimiento_adicional[$key-1];
            $req_adicional->excluyente = false;
            if (isset($request->excluyente_adicional)) {
              foreach ($request->excluyente_adicional as $excluyente) {
                if ($excluyente == $key) {//Se verifica que el checkbox de su posición esté activado.
                  $req_adicional->excluyente = true;
                }
              }
            }
            $req_adicional->save(); //Se inserta los N requisitos adicionales.
          }
        }
      }
    }

    public function store(StoreUpdatePropuestaLaboralRequest $request)
    {
      if(Auth::user()->can('crear_propuesta_laboral')){

        $error = false;
        if (isset($request->idioma) && isset($request->tipo_conocimiento_idioma)) {
          for ($i=0; $i < sizeof($request->idioma); $i++) {
            $idioma = $request->idioma[$i];
            $tipo_conocimiento_idioma = $request->tipo_conocimiento_idioma[$i];
            $cant = 0;
            for ($j=0; $j < sizeof($request->idioma); $j++) {
              $idioma_aux = $request->idioma[$j];
              $tipo_conocimiento_idioma_aux = $request->tipo_conocimiento_idioma[$j];
              if ( ($idioma == $idioma_aux) && ($tipo_conocimiento_idioma == $tipo_conocimiento_idioma_aux) ) { //Se controla que no se repita idioma-tipo conocimiento.
                $cant++;
              }
            }
          }
          if ($cant >= 2) {
            $error = true;
          }
        }
        if (isset($request->carrera)) {
          for ($i=0; $i < sizeof($request->carrera) ; $i++) {
            $carrera = $request->carrera[$i];
            $cant = 0;
            for ($j=0; $j < sizeof($request->carrera) ; $j++) {
              $carrera_aux = $request->carrera[$j];
              if ($carrera == $carrera_aux) { //Se controla que no se repitan las carreras.
                $cant++;
              }
            }
          }
          if ($cant >= 2) {
            $error = true;
          }
        }
        if ($error) {
          Flash::error('Datos invalidos.')->important();
          return redirect()->back();
        }
        else { //No hay errores en los datos.

          $propuesta = new Propuesta_Laboral($request->all());
          $propuesta->juridica_id = Auth::user()->persona->juridica->id;
          $propuesta->fecha_inicio_propuesta = Carbon::now();
          $propuesta->fecha_fin_propuesta = date('Y-m-d', strtotime($request->fecha_fin_propuesta));
          $propuesta->save();//Se inserta la propuesta.

          $this->storeRequisitos($propuesta->id, $request);

          Flash::success('Propuesta realizada.')->important();
          return redirect()->route('in.propuestas-laborales.index');

        }
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

    public function getDetallePropuesta($id)
    {
      if(Auth::user()->can('listar_detalle_propuesta_laboral')){

        $fechaActual = Carbon::now();

        $propuesta = Propuesta_Laboral::where('juridica_id',Auth::user()->persona->juridica->id)
          ->where('id',$id)
          ->where('estado_propuesta','activo')
          ->first();

        if ($propuesta == null) {
          return redirect()->route('in.propuestas-laborales.index');
        }
        else {
          $propuesta->fecha_inicio_propuesta = date('d-m-Y', strtotime($propuesta->fecha_inicio_propuesta));
          $propuesta->fecha_fin_propuesta = date('d-m-Y', strtotime($propuesta->fecha_fin_propuesta));

          return view('in.propuestas_laborales.detalle-propuesta')
            ->with('propuesta',$propuesta)
            ->with('fechaActual',$fechaActual);
        }

      }else{
        return redirect()->route('in.sinpermisos.sinpermisos');
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if(Auth::user()->can('modificar_propuesta_laboral')){

        $propuesta = Propuesta_Laboral::where('juridica_id',Auth::user()->persona->juridica->id)
          ->where('id',$id)
          ->where('estado_propuesta','activo')
          ->first();

        if ($propuesta == null) {
          return redirect()->route('in.propuestas-laborales.index');
        }
        else {
          $propuesta->fecha_inicio_propuesta = date('d-m-Y', strtotime($propuesta->fecha_inicio_propuesta));
          $propuesta->fecha_fin_propuesta = date('d-m-Y', strtotime($propuesta->fecha_fin_propuesta));

          $tipos_trabajo = Tipo_Trabajo::all()->where('estado', 'activo')
            ->lists('nombre_tipo_trabajo', 'id');
          $tipos_jornada= Tipo_Jornada::all()->where('estado', 'activo')
            ->lists('nombre_tipo_jornada', 'id');
          $tipos_conocimiento_idioma = Tipo_Conocimiento_Idioma::all()->where('estado', 'activo');
          $array_tipos_conocimiento_idioma = Tipo_Conocimiento_Idioma::all()->where('estado', 'activo')
            ->lists('nombre_tipo_conocimiento_idioma', 'id');
          $niveles_conocimiento = Nivel_Conocimiento::all()->where('estado', 'activo');
          $array_niveles_conocimiento = Nivel_Conocimiento::all()->where('estado', 'activo')
            ->lists('nombre_nivel_conocimiento', 'id');
          $estados_carrera = Estado_Carrera::all()->where('estado', 'activo');
          $array_estados_carrera = Estado_Carrera::all()->where('estado', 'activo')
            ->lists('nombre_estado_carrera', 'id');
          $idiomas = Idioma::all()->where('estado', 'activo');
          $array_idiomas = Idioma::all()->where('estado', 'activo')
            ->lists('nombre_idioma', 'id');
          $carreras = Carrera::all();
          $array_carreras = Carrera::all()->lists('nombre_carrera', 'id');

          return view('in.propuestas_laborales.edit')
              ->with('propuesta',$propuesta)
              ->with('tipos_trabajo',$tipos_trabajo)
              ->with('tipos_jornada',$tipos_jornada)
              ->with('tipos_conocimiento_idioma',$tipos_conocimiento_idioma)
              ->with('array_tipos_conocimiento_idioma',$array_tipos_conocimiento_idioma)
              ->with('niveles_conocimiento',$niveles_conocimiento)
              ->with('array_niveles_conocimiento',$array_niveles_conocimiento)
              ->with('estados_carrera',$estados_carrera)
              ->with('array_estados_carrera',$array_estados_carrera)
              ->with('idiomas',$idiomas)
              ->with('array_idiomas',$array_idiomas)
              ->with('carreras',$carreras)
              ->with('array_carreras',$array_carreras);
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
    public function update(StoreUpdatePropuestaLaboralRequest $request, $id)
    {
      if(Auth::user()->can('modificar_propuesta_laboral')){

        $propuesta = Propuesta_Laboral::where('juridica_id',Auth::user()->persona->juridica->id)
          ->where('id',$id)
          ->where('estado_propuesta','activo')
          ->first();

        if ($propuesta == null) {
          return redirect()->route('in.propuestas-laborales.index');
        }
        else {
          $propuesta ->fill($request->all());
          $propuesta->fecha_fin_propuesta = date('Y-m-d', strtotime($request->fecha_fin_propuesta));
          $propuesta ->save();

          //Se borran los requisitos viejos.
          foreach ($propuesta->requisitosResidencia as $requisito_residencia) {
            $requisito_residencia->delete();
          }

          foreach ($propuesta->requisitosIdioma as $requisito_idioma) {
            $requisito_idioma->delete();
          }

          foreach ($propuesta->requisitosCarrera as $requisito_carrera) {
            $requisito_carrera->delete();
          }

          foreach ($propuesta->requisitosAdicionales as $requisito_adicional) {
            $requisito_adicional->delete();
          }

          //Se insertan los requisitos viejos y nuevos.
          $this->storeRequisitos($propuesta->id, $request);

          Flash::warning('Propuesta Modificada.')->important();
          return redirect()->route('in.propuestas-laborales.index');
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
      if(Auth::user()->can('eliminar_propuesta_laboral')){
        $propuesta = Propuesta_Laboral::where('juridica_id',Auth::user()->persona->juridica->id)
          ->where('id',$id)
          ->first();

        if ($propuesta == null) {
          return redirect()->route('in.propuestas-laborales.index');
        }
        else {
          if(count($propuesta->estudiantes) > 0) {
            $propuesta->estado_propuesta = "inactivo";
            $propuesta->save();
          }
          else {
            $propuesta->delete();
          }
          Flash::error('Propuesta eliminada.')->important();
          return redirect()->route('in.propuestas-laborales.index');
        }

      }else{
        return redirect()->route('in.sinpermisos.sinpermisos');
      }
    }
}
