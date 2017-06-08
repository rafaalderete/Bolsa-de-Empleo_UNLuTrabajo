@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Gestionar CV | Objetivo Laboral')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Visualizar Objetivo Laboral</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')


<div class="row" style="margin-top:-20px">
  <!-- Box -->
  <div class="box no-box-shadow">
    <!-- Cuerpo del Box-->

    @include('template.partials.sidebar-gestionarcv')

    <div class="box-content dropbox">
      <h4 class="page-header">Objetivo Laboral</h4>
      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')

      <div class="form-group detalle-descripcion col-sm-12">
          {!! Form::label('nombre_persona','Carta de Presentación:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="row">
            <div class="col-md-6">
              @if($pfisica->estudiante->cv->carta_presentacion != null)
                <span>{!!$pfisica->estudiante->cv->carta_presentacion!!}</span>
              @else
                <p>( Sin Descripción. )</p>
              @endif
            </div>
          </div>
        </div>

      <div class="form-group col-sm-12">
          {!! Form::label('nombre_persona','Sueldo bruto Pretendido:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-4">
            @if($pfisica->estudiante->cv->sueldo_bruto_pretendido != null)
              <span>{{$pfisica->estudiante->cv->sueldo_bruto_pretendido}}</span> $.
            @else
              <span>0</span> $.
            @endif
          </div>
      </div>

      <div class="form-group col-sm-12">
          {!! Form::label('archivo_adjunto','Cv Adjunto:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-4">
            <p>{{$nombreAdjunto}}</p>
          </div>
      </div>

     <div class="form-group">
        <div class="col-sm-12 text-center">
          <a  href="{{ route('in.cv.editobjetivolaboralcv') }}" ><button class="btn btn-info btn-label-left">
            <span><i class="fa fa-pencil"></i></span>
            Modificar
          </button></a>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection
