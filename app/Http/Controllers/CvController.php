<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Persona as Persona;
use App\Fisica as Fisica;
use App\Experiencia_Laboral as Experiencia_Laboral;
use App\Estudio_Academico as Estudio_Academico;
use App\Conocimiento_Idioma as Conocimiento_Idioma;
use App\Conocimiento_Informatico as Conocimiento_Informatico;
use App\Conocimiento_Adicional as Conocimiento_Adicional;
use App\Cv as Cv;
use App\Http\Requests\UpdateObjetivoLaboralRequest;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;

class CvController extends Controller
{
    public function visualizarCv()
    {
        if(Auth::user()->can('visualizar_cv')){
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
            /*
            $pdf = \PDF::loadView('emails.cv_estudiante',['pfisica' => $pfisica, 'telefono_fijo' => $telefono_fijo, 'telefono_celular' => $telefono_celular, 'expLaborales' => $expLaborales, 'estudios' => $estudios, 'conocimientosInformaticos' => $conocimientosInformaticos, 'conocimientosIdiomas' => $conocimientosIdiomas, 'conocimientosAdicionales' => $conocimientosAdicionales]);
            return $pdf->stream('Arch.pdf');
            */
            return view('in.cv.visualizarcv')
              ->with('pfisica',$pfisica)
              ->with('telefono_fijo',$telefono_fijo)
              ->with('telefono_celular',$telefono_celular)
              ->with('expLaborales',$expLaborales)
              ->with('estudios',$estudios)
              ->with('conocimientosInformaticos',$conocimientosInformaticos)
              ->with('conocimientosIdiomas',$conocimientosIdiomas)
              ->with('conocimientosAdicionales',$conocimientosAdicionales);
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }  
    }

    public function visualizarDatosPersonales()
    {
        if(Auth::user()->can('visualizar_datos_personales_cv')){
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

            return view('in.cv.datospersonalescv')
              ->with('pfisica',$pfisica)
              ->with('telefono_fijo',$telefono_fijo)
              ->with('telefono_celular',$telefono_celular);
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }

    public function visualizarObjetivoLaboral()
    {
        if(Auth::user()->can('visualizar_objetivo_laboral_cv')){
            $pfisica = Fisica::where('persona_id',Auth::user()->persona_id)->first();
            return view('in.cv.objetivolaboralcv')
              ->with('pfisica',$pfisica);
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }
    
    public function editObjetivoLaboral()
    {
        if(Auth::user()->can('modificar_objetivo_laboral_cv')){
            $pfisica = Fisica::where('persona_id',Auth::user()->persona_id)->first();
            return view('in.cv.editobjetivolaboralcv')
              ->with('pfisica',$pfisica);
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }

    public function postObjetivoLaboral(UpdateObjetivoLaboralRequest $request)
    {
        if(Auth::user()->can('modificar_objetivo_laboral_cv')){
            $cv = Cv::find(Auth::User()->persona->fisica->estudiante->cv->id);
            $cv->carta_presentacion = $request->carta_presentacion;
            $cv->sueldo_bruto_pretendido = $request->sueldo_bruto_pretendido;
            $cv->save();

            Flash::warning('Objevito Laboral actualizado con exito')->important();
            return redirect()->route('in.cv.objetivolaboralcv');
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }
}
