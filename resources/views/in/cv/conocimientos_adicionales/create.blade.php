@extends('template.in_main')

@section('headTitle', 'Gestionar CV | Conocimientos Adicionales')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Agregar Conocimiento Adicional</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')


<div class="row" style="margin-top:-20px">
  <!-- Box -->
  <div class="box">
    <!-- Cuerpo del Box-->

    @include('template.partials.sidebar-gestionarcv')

    <div class="box-content dropbox">
      <h4 class="page-header">Agregar Conocimiento Adicional</h4>
        
      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')
      
      <!-- Formulario -->
      {!! Form::open(['route' => 'in.gestionar-cv.conocimientos-adicionales.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

		    <div class="form-group">
          {!! Form::label('nombre_conocimiento','Nombre Conocimiento:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('nombre_conocimiento', null, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
          </div>
        </div>

    		<div class="form-group">
          {!! Form::label('descripcion_conocicmiento','Descripción Conocimiento:', ['class' => 'col-sm-3 control-label']) !!}
          <div class="col-sm-6">
            {!! Form::text('descripcion_conocimiento', null, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
          </div>
        </div>
    
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-2">
              <button type="submit" class="btn btn-info btn-label-left">
                <span><i class="fa fa-check-square"></i></span>
                Aceptar
              </button>
            </div>
            <div class="col-sm-2">
              <button type="reset" class="btn btn-default btn-label-left">
                <span><i class="fa fa-times-circle txt-danger"></i></span>
                Borrar
              </button>
            </div>
          </div>

        {!! Form::close()!!}

        <a href="{{ route('in.gestionar-cv.conocimientos-adicionales.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver a la Tabla
        </a>
    </div>  
  </div>
</div>

@endsection


