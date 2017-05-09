<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreIdiomaRequest;
use App\Http\Requests\UpdateIdiomaRequest;
use App\Tipo_Software as Tipo_Software;
use App\Conocimiento_Informatico as Conocimiento_Informatico;

class TiposSoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        if (Auth::user()->can('listar_tipos_software')) {
            $tipo_software = Tipo_Software::orderBy('id', 'DESC')->get(); #me traigo de la bd los idiomas cargados en id descendentes

            return view('in.tipo_software.index')->with('tipo_software', $tipo_software);
        } else {
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
         if(Auth::user()->can('crear_tipo_software')){
            return view('in.tipo_software.create');
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
       if(Auth::user()->can('crear_tipo_software')){
        $tipo_software = new Tipo_Software($request->all());

        $tipo_software->save();

        Flash::success('Tipo_Software' . $tipo_software->nombre_tipo_software . ' agregado.')->important();
        return redirect()->route('in.tipo_software.index');
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
        if(Auth::user()->can('modificar_tipo_software')){
            $tipo_software = Tipo_Software::find($id);
            return view('in.tipo_software.edit')->with('tipo_software',$tipo_software);
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
         if(Auth::user()->can('modificar_tipo_software')){
            $tipo_software = Tipo_Software::find($id);

            $tipo_software->fill($request->all());
            $tipo_software->save();

            Flash::warning('Tipo Software ' . $tipo_software->nombre_tipo_software. ' modificado.')->important();
            return redirect()->route('in.tipo_software.index');
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
        if(Auth::user()->can('eliminar_tipo_software')){
            $tipo_software = Tipo_Software::find($id);
            $cinformatico = Conocimiento_Informatico::where('tipo_software_id', '=',$id)->get();
                       
            if( (count($cinformatico) == 0) ) {//Se verifica que no esta uso.

              $tipo_software->delete();

              Flash::error('Tipo Software ' . $tipo_software->nombre_tipo_software . ' eliminado.')->important();
              return redirect()->route('in.tipo_software.index');
            }
            else {
              Flash::error('El Tipo Software ' . $tipo_software->nombre_tipo_software . ' no se puede eliminar ya que se encuentra en uso.')->important();
              return redirect()->route('in.tipo_software.index');
            }
          }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
          }
    }
}
