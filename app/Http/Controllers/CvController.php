<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Persona as Persona;
use App\Fisica as Fisica;
use App\Estudiante as Estudiante;
use App\Cv as Cv;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;

class CvController extends Controller
{
    public function visualizarCv()
    {
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


            return view('in.cv.visualizarcv')
              ->with('pfisica',$pfisica)
              ->with('telefono_fijo',$telefono_fijo)
              ->with('telefono_celular',$telefono_celular);
    }

    public function visualizarDatosPersonales()
    {
    	
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
    }

    public function visualizarObjetivoLaboral()
    {
            $pfisica = Fisica::where('persona_id',Auth::user()->persona_id)->first();
            return view('in.cv.objetivolaboralcv')
              ->with('pfisica',$pfisica);
    }
    
    public function editObjetivoLaboral()
    {
            $pfisica = Fisica::where('persona_id',Auth::user()->persona_id)->first();
            return view('in.cv.editobjetivolaboralcv')
              ->with('pfisica',$pfisica);
    }

    public function postObjetivoLaboral(Request $request)
    {
            $cv = Cv::find(Auth::User()->persona->fisica->estudiante->cv->id);
            $cv->carta_presentacion = $request->carta_presentacion;
            $cv->sueldo_bruto_pretendido = $request->sueldo_bruto_pretendido;
            $cv->save();

            Flash::warning('Objevito Laboral actualizado con exito')->important();
            return redirect()->route('in.cv.objetivolaboralcv');
    }
}
