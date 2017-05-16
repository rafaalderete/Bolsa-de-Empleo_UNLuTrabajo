<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Experiencia_Laboral as Experiencia_Laboral;
use App\Rubro_Empresarial as Rubro_Empresarial;
use App\Http\Requests\StoreExperienciaLaboralRequest;
use Illuminate\Support\Facades\Auth;



class ExperienciaLaboralesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('listar_experiencias_laborales_cv')){
            $expLabolares = Experiencia_Laboral::where('cv_id',Auth::user()->persona->fisica->estudiante->cv->id)->orderBy('id','DESC')->get();
            return view('in.cv.experiencia_laborales.index')
                ->with('expLaborales',$expLabolares);
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
        if(Auth::user()->can('crear_experiencia_laboral_cv')){
            $rubros_Empresariales = Rubro_Empresarial::all()->where('estado','activo');
            return view('in.cv.experiencia_laborales.create')
              ->with('rubros_Empresariales',$rubros_Empresariales);
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
    public function store(StoreExperienciaLaboralRequest $request)
    {
        if(Auth::user()->can('crear_experiencia_laboral_cv')){

            if(!isset($request->presente)){
                
                if(strlen($request->periodo_fin) == 0){
                    Flash::error('• El campo periodo fin es obligatorio.')->important();
                    return redirect()->back();
                }

                $datetime1 = new \DateTime($request->periodo_inicio);
                $datetime2 = new \DateTime($request->periodo_fin);
                $interval = $datetime1->diff($datetime2);
                
                $esta_bien = false;
                
                if(($interval->format('%R%a')) > 0){
                  $esta_bien = true;
                }
                
                if($esta_bien == false && strlen($request->periodo_fin) != 0){
                    Flash::error('• La fecha de inicio debe ser menor a la fecha de finalización.')->important();
                    return redirect()->back();
                }
            }

            $expLaboral = new Experiencia_Laboral();
            $expLaboral->cv_id = Auth::user()->persona->fisica->estudiante->cv->id;
            $expLaboral->nombre_empresa = $request->nombre_empresa;
            $expLaboral->rubro_empresarial_id = $request->rubro_empresarial;
            $expLaboral->puesto = $request->puesto;
            $expLaboral->descripcion_tarea = $request->descripcion_tarea;
            $expLaboral->periodo_inicio = $request->periodo_inicio;
            if (isset($request->presente)) {
                $expLaboral->periodo_fin = "00-00-0000"; // Esta en Presente
            }else{
                $expLaboral->periodo_fin = $request->periodo_fin;
            }
            $expLaboral->save();

            Flash::success('Experiencia Laboral de ' . $expLaboral->puesto . ' en ' . $expLaboral->nombre_empresa . ' agregada.')->important();
              return redirect()->route('in.gestionar-cv.experiencia-laborales.index');
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
        if(Auth::user()->can('modificar_experiencia_laboral_cv')){
          $expLaboral = Experiencia_Laboral::find($id); // busca el usuario por su id
          $rubros_Empresariales = Rubro_Empresarial::where('estado','activo')->orderBy('id','ASC')->lists('nombre_rubro_empresarial','id');

          return view('in.cv.experiencia_laborales.edit')
                                ->with('expLaboral',$expLaboral)
                                ->with('rubros_Empresariales',$rubros_Empresariales);
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
    public function update(StoreExperienciaLaboralRequest $request, $id)
    {
        if(Auth::user()->can('modificar_experiencia_laboral_cv')){

            if(!isset($request->presente)){
                
                if(strlen($request->periodo_fin) == 0){
                    Flash::error('• El campo periodo fin es obligatorio.')->important();
                    return redirect()->back();
                }

                $datetime1 = new \DateTime($request->periodo_inicio);
                $datetime2 = new \DateTime($request->periodo_fin);
                $interval = $datetime1->diff($datetime2);
                
                $esta_bien = false;
                
                if(($interval->format('%R%a')) > 0){
                  $esta_bien = true;
                }
                
                if($esta_bien == false && strlen($request->periodo_fin) != 0){
                    Flash::error('• La fecha de inicio debe ser menor a la fecha de finalización.')->important();
                    return redirect()->back();
                }
            }

            $expLaboral = Experiencia_Laboral::find($id);
            $expLaboral->nombre_empresa = $request->nombre_empresa;
            $expLaboral->rubro_empresarial_id = $request->rubro_empresarial;
            $expLaboral->puesto = $request->puesto;
            $expLaboral->descripcion_tarea = $request->descripcion_tarea;
            $expLaboral->periodo_inicio = $request->periodo_inicio;
            if (isset($request->presente)) {
                $expLaboral->periodo_fin = "00-00-0000"; // Esta en Presente
            }else{
                $expLaboral->periodo_fin = $request->periodo_fin;
            }
            $expLaboral->save();

            Flash::warning('Experiencia Laboral de ' . $expLaboral->puesto . ' en ' . $expLaboral->nombre_empresa . ' modificada.')->important();
              return redirect()->route('in.gestionar-cv.experiencia-laborales.index');
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
        if(Auth::user()->can('eliminar_experiencia_laboral_cv')){
          $expLaboral = Experiencia_Laboral::find($id); // busca el usuario por su id

          $expLaboral->delete(); // lo elimina

          Flash::error('Experiencia Laboral de '. $expLaboral->puesto . ' en ' . $expLaboral->nombre_empresa . ' eliminada.')->important();
          return redirect()->route('in.gestionar-cv.experiencia-laborales.index');
        }else{
          return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }
}
