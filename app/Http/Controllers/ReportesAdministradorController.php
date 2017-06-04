<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReportesAdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(true){
            return view('in.reportes.administrador.index');
        }else{
            return redirect()->route('in.sinpermisos.sinpermisos');
        }
    }
}