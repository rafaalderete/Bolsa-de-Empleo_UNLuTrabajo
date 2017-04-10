<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\Traits\StorePersona;
use App\Persona as Persona;
use App\Telefono as Telefono;
use App\Direccion as Direccion;
use Log;
use Illuminate\Support\Facades\Auth;

class PersonasController extends Controller
{
    use StorePersona; //Metodo storePersona()

    protected function updatePersona($request, $id) {

      $persona_actual = Persona::find($id);
      $direccion = Direccion::find($persona_actual->direccion->id);
      $direccion->domicilio = $request->domicilio_residencia;
      $direccion->localidad = $request->localidad_residencia;
      $direccion->provincia = $request->provincia_residencia;
      $direccion->pais = $request->pais_residencia;
      $direccion->save();

      //Verifica si ya tiene un teléfono fijo.
      $telefono_fijo_actual = Telefono::where('persona_id',$id)
        ->where('tipo_telefono','fijo')
        ->get();
      if(count($telefono_fijo_actual) == 0) {
        if($request->telefono_fijo != '') { //Si no existe un teléfono fijo y recibe un nuevo teléfono fijo, lo crea.
          $fijo = new Telefono();
          $fijo->persona_id = $id;
          $fijo->tipo_telefono = 'fijo';
          $fijo->nro_telefono = $request->telefono_fijo;
          $fijo->save();
        }
      }
      else {
        if($request->telefono_fijo != '')  { //Si ya existe un teléfono fijo y recibe un nuevo teléfono fijo, lo actualiza.
          $fijo = Telefono::find($telefono_fijo_actual[0]->id);
          $fijo->nro_telefono = $request->telefono_fijo;
        }
        else{ //Si ya existe un teléfono fijo y NO recibe un telefono fijo, lo borra.
          $fijo = Telefono::find($telefono_fijo_actual[0]->id);
          $fijo->delete();
        }
      }

      //Verifica si ya tiene un teléfono celular.
      $telefono_celular_actual = Telefono::where('persona_id',$id)
        ->where('tipo_telefono','celular')
        ->get();
      if(count($telefono_celular_actual) == 0) {
        if($request->telefono_celular != '') {
          $celular = new Telefono();
          $celular->persona_id = $id;
          $celular->tipo_telefono = 'celular';
          $celular->nro_telefono = $request->telefono_celular;
          $celular->save();
        }
      }
      else {
        if($request->telefono_celular != '')  {
          $celular = Telefono::find($telefono_celular_actual[0]->id);
          $celular->nro_telefono = $request->telefono_celular;
          $celular->save();
        }
        else{
          $celular = Telefono::find($telefono_celular_actual[0]->id);
          $celular->delete();
        }
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
        if(Auth::user()->can('eliminar_persona')){
            $persona = Persona::find($id);
            $tipo_persona = $persona->tipo_persona;
            if ($tipo_persona == 'fisica') {
              $nombre = $persona->fisica->nombre_persona;
            }
            else {
              $nombre = $persona->juridica->nombre_comercial;
            }
            $persona->delete();

            if ($tipo_persona == 'fisica') {
              Flash::error('Persona ' . $nombre . ' eliminada.')->important();
              return redirect()->route('in.personas.index');
            }
            else {
              Flash::error('Empresa ' . $nombre . ' eliminada.')->important();
              return redirect()->route('in.empresas.index');
            }
        }else{
            return redirect()->route('sinpermisos.sinpermisos');
        }
    }
}
