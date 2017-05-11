<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Propuesta_Laboral as Propuesta_Laboral;
use App\Tipo_Trabajo as Tipo_Trabajo;
use App\Tipo_Jornada as Tipo_Jornada;
use App\Carrera as Carrera;
use App\Idioma as Idioma;
use App\Fisica as Fisica;
use App\Experiencia_Laboral as Experiencia_Laboral;
use App\Estudio_Academico as Estudio_Academico;
use App\Conocimiento_Idioma as Conocimiento_Idioma;
use App\Conocimiento_Informatico as Conocimiento_Informatico;
use App\Conocimiento_Adicional as Conocimiento_Adicional;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\PDF;
use File;
use Illuminate\Support\Facades\Mail;

class EstudianteController extends Controller
{

    const CANT_PAGINA = 5;
    const DESCRIPCION = 350;

    public function buscarOferta(Request $request)
    {
      if(Auth::user()->can('buscar_ofertas')){
        $tipos_trabajo = Tipo_Trabajo::all()->where('estado', 'activo');
        foreach ($tipos_trabajo as $key => $tipo_trabajo) {
          $tipos_trabajo[$key]->cantidad = Propuesta_Laboral::where('tipo_trabajo_id',$tipo_trabajo->id)
            ->where('estado_propuesta','activo')
            ->count();
        }

        $tipos_jornada= Tipo_Jornada::all()->where('estado', 'activo');
        foreach ($tipos_jornada as $key => $tipo_jornada) {
          $tipos_jornada[$key]->cantidad = Propuesta_Laboral::where('tipo_jornada_id',$tipo_jornada->id)
            ->where('estado_propuesta','activo')
            ->count();
        }

        $carreras = Carrera::all();
        foreach ($carreras as $key => $carrera) {
          $carreraId = $carrera->id;
          $carreras[$key]->cantidad = Propuesta_Laboral::whereHas('requisitosCarrera', function($query) use ($carreraId){
                $query->where('carrera_id',$carreraId);
            })
            ->where('estado_propuesta','activo')
            ->count();
        }

        $idiomas = Idioma::all()->where('estado', 'activo');;
        foreach ($idiomas as $key => $idioma) {
          $idiomaId = $idioma->id;
          $idiomas[$key]->cantidad = Propuesta_Laboral::whereHas('requisitosIdioma', function($query) use ($idiomaId){
                $query->where('idioma_id',$idiomaId);
            })
            ->where('estado_propuesta','activo')
            ->count();
        }

        $busqueda = true;
        $filtro = "Últimas Ofertas";

        //Filtro palabra clave.
        if(isset($request->buscar) && $request->buscar != null) {
          $palabra_a_buscar = preg_replace("/[^A-Za-z0-9 ]/", '', $request->buscar);
          $filtro = "Palabra Clave - ".$palabra_a_buscar;
          $propuestas = Propuesta_Laboral::where('titulo','LIKE', '%'.$palabra_a_buscar.'%')
            ->where('estado_propuesta','activo')
            ->where('fecha_fin_propuesta','>=',Carbon::today())
            ->orderBy('created_at','DESC')
            ->paginate(self::CANT_PAGINA);
        }
        else {
          //Filtro carrera.
          if (isset($request->carrera)) {
            $carreraId = $request->carrera;
            $propuestas = Propuesta_Laboral::whereHas('requisitosCarrera', function($query) use ($carreraId){
                  $query->where('carrera_id',$carreraId);
              })
              ->where('estado_propuesta','activo')
              ->where('fecha_fin_propuesta','>=',Carbon::today())
              ->orderBy('propuestas_laborales.created_at','DESC')
              ->paginate(self::CANT_PAGINA);
            $tipo_carrera_buscado = Carrera::find($request->carrera);
            $filtro = "Carrera - ".$tipo_carrera_buscado->nombre_carrera;
          }
          else {
            //Filtro tipo de trabajo.
            if (isset($request->tipo_trabajo)) {
              $propuestas = Propuesta_Laboral::where('tipo_trabajo_id',$request->tipo_trabajo)
                ->where('estado_propuesta','activo')
                ->where('fecha_fin_propuesta','>=',Carbon::today())
                ->orderBy('created_at','DESC')
                ->paginate(self::CANT_PAGINA);
              $tipo_trabajo_buscado = Tipo_Trabajo::find($request->tipo_trabajo);
              $filtro = "Tipo de Trabajo - ".$tipo_trabajo_buscado->nombre_tipo_trabajo;
            }
            else {
              //Filtro tipo de jornada.
              if (isset($request->tipo_jornada)) {
                $propuestas = Propuesta_Laboral::where('tipo_jornada_id',$request->tipo_jornada)
                  ->where('estado_propuesta','activo')
                  ->where('fecha_fin_propuesta','>=',Carbon::today())
                  ->orderBy('created_at','DESC')
                  ->paginate(self::CANT_PAGINA);
                $tipo_jornada_buscado = Tipo_Jornada::find($request->tipo_jornada);
                $filtro = "Tipo de Jornada - ".$tipo_jornada_buscado->nombre_tipo_jornada;
              }
              else {
                //Filtro idioma
                if (isset($request->idioma)) {
                  $idiomaId = $request->idioma;
                  $propuestas = Propuesta_Laboral::whereHas('requisitosIdioma', function($query) use ($idiomaId){
                        $query->where('idioma_id',$idiomaId);
                    })
                    ->where('estado_propuesta','activo')
                    ->where('fecha_fin_propuesta','>=',Carbon::today())
                    ->orderBy('propuestas_laborales.created_at','DESC')
                    ->paginate(self::CANT_PAGINA);
                  $idioma_buscado = Idioma::find($request->idioma);
                  $filtro = "Idioma - ".$idioma_buscado->nombre_idioma;
                }
                else {
                  //Sin filtro, ultimas propuestas.
                  $busqueda = false;
                  $propuestas = Propuesta_Laboral::where('estado_propuesta','activo')
                    ->where('fecha_fin_propuesta','>=',Carbon::today())
                    ->orderBy('created_at','DESC')
                    ->paginate(self::CANT_PAGINA);
                }
              }
            }
          }
        }

        foreach ($propuestas as $key => $propuesta) {
          $propuestas[$key]->descripcion = substr($propuestas[$key]->descripcion,0,self::DESCRIPCION).'...';
          $propuestas[$key]->fecha_inicio_propuesta = date('d-m-Y', strtotime($propuestas[$key]->fecha_inicio_propuesta));
        }

        return view('in.estudiante.buscar_ofertas')
          ->with('tipos_trabajo',$tipos_trabajo)
          ->with('tipos_jornada',$tipos_jornada)
          ->with('carreras',$carreras)
          ->with('idiomas',$idiomas)
          ->with('propuestas',$propuestas)
          ->with('filtro',$filtro)
          ->with('busqueda',$busqueda);
      }else{
        return redirect()->route('in.sinpermisos.sinpermisos');
      }
    }

    public function getDetalleOferta($id)
    {
      if(Auth::user()->can('listar_detalle_propuesta_laboral')){

        $puede_postularse = true;
        $postulacion = false;// Para verificar si se visualiza la oferta o la postulacion.

        $propuesta = Propuesta_Laboral::where('id',$id)
          ->where('estado_propuesta','activo')
          ->first();

        if ($propuesta == null) {
          return redirect()->route('in.buscar-ofertas');
        }
        else {
          //Verifica si ya se ha postulado a la oferta
          foreach ($propuesta->estudiantes as $estudiante) {
            if ($estudiante->id == Auth::user()->persona->fisica->estudiante->id) {
              $puede_postularse = false;
            }
          }
          $propuesta->fecha_inicio_propuesta = date('d-m-Y', strtotime($propuesta->fecha_inicio_propuesta));
          $propuesta->fecha_fin_propuesta = date('d-m-Y', strtotime($propuesta->fecha_fin_propuesta));

          return view('in.estudiante.detalle-oferta')
            ->with('propuesta',$propuesta)
            ->with('postulacion',$postulacion)
            ->with('puede_postularse',$puede_postularse);
        }

      }else{
        return redirect()->route('in.sinpermisos.sinpermisos');
      }
    }

    public function postularse($id)
    {
      if(Auth::user()->can('postularse')){

        $propuesta = Propuesta_Laboral::where('id',$id)
          ->where('estado_propuesta','activo')
          ->first();

        if ($propuesta == null) {
          return redirect()->route('in.buscar-ofertas');
        }
        else {
          $postulado = false;
          foreach ($propuesta->estudiantes as $estudiante) {
            if ($estudiante->id == Auth::user()->persona->fisica->estudiante->id) {
              $postulado = true;
            }
          }

          if (!$postulado) {
            //Mail al Empleador.
            define('BUDGETS_DIR', public_path('uploads/budgets'));

            if (!is_dir(BUDGETS_DIR)){
                mkdir(BUDGETS_DIR, 0755, true);
            }

            $data['nombre_estudiante'] = Auth::user()->persona->fisica->nombre_persona." ".Auth::user()->persona->fisica->apellido_persona;
            $data['titulo_propuesta'] = $propuesta->titulo;
            $data['email_empleador'] = $propuesta->juridica->persona->usuarios[0]->email;

            $outputName = str_random(10);
            $pdfPath = BUDGETS_DIR.'/UNLuTrabajo_'.$data['titulo_propuesta']."_".$data['nombre_estudiante']."_".$outputName.'.pdf';

            // DATOS DEL CV
            // Datos Personales y Objetivo Laboral
            $pfisica = Fisica::where('persona_id',Auth::user()->persona_id)->first();
            $pfisica->fecha_nacimiento = date('d / m / Y', strtotime($pfisica->fecha_nacimiento));
            $telefono_fijo = '';
            $telefono_celular = '';
            foreach ($pfisica->persona->telefonos as $telefono) {
              if ($telefono->tipo_telefono == 'fijo') {
                $telefono_fijo = $telefono->nro_telefono;
              }
              if ($telefono->tipo_telefono == 'celular') {
                $telefono_celular = $telefono->nro_telefono;
              }
            }

            //Experiencias Laborales
            $expLaborales = Experiencia_Laboral::where('cv_id',Auth::user()->persona->fisica->estudiante->cv->id)->orderBy('id','DESC')->get();

            // Estudios Academicos
            $estudios = Estudio_Academico::where('cv_id',Auth::user()->persona->fisica->estudiante->cv->id)->orderBy('id','DESC')->get();

            // Conocimientos Idiomas
            $conocimientosIdiomas = Conocimiento_Idioma::where('cv_id',Auth::user()->persona->fisica->estudiante->cv->id)->orderBy('id','DESC')->get();

            // Conocimientos Informaticos
            $conocimientosInformaticos = Conocimiento_Informatico::where('cv_id',Auth::user()->persona->fisica->estudiante->cv->id)->orderBy('id','DESC')->get();

            // Conocimientos Adicionales
            $conocimientosAdicionales = Conocimiento_Adicional::where('cv_id',Auth::user()->persona->fisica->estudiante->cv->id)->orderBy('id','DESC')->get();

            File::put($pdfPath, \PDF::loadView('emails.cv_estudiante',['pfisica' => $pfisica, 'telefono_fijo' => $telefono_fijo, 'telefono_celular' => $telefono_celular, 'expLaborales' => $expLaborales, 'estudios' => $estudios, 'conocimientosInformaticos' => $conocimientosInformaticos, 'conocimientosIdiomas' => $conocimientosIdiomas, 'conocimientosAdicionales' => $conocimientosAdicionales])->output());

            Mail::send('emails.postulacion_a_oferta', ['data' => $data], function($message) use ($pdfPath,$data){
                $message->from('unlutrabajo@gmail.com', 'UNLu Trabajo');
                $message->subject('Nueva Postulación - '.$data['titulo_propuesta']." - ".$data['nombre_estudiante']);
                $message->to($data['email_empleador']);
                $message->attach($pdfPath);
            });

            File::delete($pdfPath);

            //Postulación.
            $propuesta->estudiantes()->sync([Auth::user()->persona->fisica->estudiante->id => ['fecha_postulacion' => Carbon::now()]]);

            Flash::success('Postulación realizada.')->important();
            return redirect()->route('in.buscar-ofertas');
          }
          else {
            Flash::error('Ya se ha postulado a ésta Oferta.')->important();
            return redirect()->route('in.buscar-ofertas');
          }
        }

      }else{
        return redirect()->route('in.sinpermisos.sinpermisos');
      }
    }

    public function getPostulaciones(Request $request)
    {
      if(Auth::user()->can('listar_postulaciones')){

        $busqueda = false;

        $estudianteId = Auth::user()->persona->fisica->estudiante->id;
        if(isset($request->buscar) && $request->buscar != null) {
          $palabra_a_buscar = preg_replace("/[^A-Za-z0-9 ]/", '', $request->buscar);
          $busqueda = true;
          $propuestas = Propuesta_Laboral::whereHas('estudiantes', function($query) use ($estudianteId){
                $query->where('estudiante_id',$estudianteId);
            })
            ->where('titulo','LIKE', '%'.$palabra_a_buscar.'%')
            ->orderBy('created_at','DESC')
            ->paginate(self::CANT_PAGINA);
        }
        else {
          $propuestas = Propuesta_Laboral::whereHas('estudiantes', function($query) use ($estudianteId){
                $query->where('estudiante_id',$estudianteId);
            })
            ->orderBy('created_at','DESC')
            ->paginate(self::CANT_PAGINA);
        }

        foreach ($propuestas as $key => $propuesta) {
          $today = Carbon::today()->toDateString();
          $propuestas[$key]->finalizada = false;
          if ($today > $propuestas[$key]->fecha_fin_propuesta) {
            $propuestas[$key]->finalizada = true;
          }
          $propuestas[$key]->descripcion = substr($propuestas[$key]->descripcion,0,self::DESCRIPCION).'...';
          $propuestas[$key]->fecha_inicio_propuesta = date('d-m-Y', strtotime($propuestas[$key]->fecha_inicio_propuesta));
        }

        return view('in.estudiante.postulaciones')
          ->with('propuestas',$propuestas)
          ->with('busqueda',$busqueda);

      }else{
        return redirect()->route('in.sinpermisos.sinpermisos');
      }
    }

    public function getDetallePostulacion($id)
    {
      if(Auth::user()->can('listar_detalle_propuesta_laboral')){

        $puede_postularse = false;
        $postulacion = true;// Para verificar si se visualiza la oferta o la postulacion.

        $propuesta = Propuesta_Laboral::where('id',$id)
          ->first();

        if ($propuesta == null) {
          return redirect()->route('in.buscar-ofertas');
        }
        else {
          //Verifica si realmente es una postulacion del usuario.
          $postulado = false;
          foreach ($propuesta->estudiantes as $estudiante) {
            if ($estudiante->id == Auth::user()->persona->fisica->estudiante->id) {
              $postulado = true;
            }
          }

          if ($postulado) {
            $today = Carbon::today()->toDateString();
            $propuesta->finalizada = false;
            if ($today > $propuesta->fecha_fin_propuesta) {
              $propuesta->finalizada = true;
            }
            $propuesta->fecha_inicio_propuesta = date('d-m-Y', strtotime($propuesta->fecha_inicio_propuesta));
            $propuesta->fecha_fin_propuesta = date('d-m-Y', strtotime($propuesta->fecha_fin_propuesta));

            return view('in.estudiante.detalle-oferta')
              ->with('propuesta',$propuesta)
              ->with('postulacion',$postulacion)
              ->with('puede_postularse',$puede_postularse);
          }
          else{
            return redirect()->route('in.mis-postulaciones');
          }

        }

      }else{
        return redirect()->route('in.sinpermisos.sinpermisos');
      }
    }

}
