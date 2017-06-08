@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Roles | Registrar Rol')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Roles</a></li>
        <li><a>Registrar Rol</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')

  <div class="row" style="margin-top:-20px">
    <!-- Box -->
    <div class="box">
      <!-- Cuerpo del Box-->
      <div class="box-content dropbox">
        <h4 class="page-header">Registro de Rol</h4>

        <!-- Mostrar Mensaje -->
        @include('flash::message')
        @include('template.partials.errors')

        <!-- Formulario -->
        {!! Form::open(['route' => 'in.roles.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

      		<div class="form-group">
      			{!! Form::label('name','Nombre Rol', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
              {!! Form::text('name',null,['class' => 'form-control', 'placeholder' => 'Nombre Rol', 'required'])!!}
            </div>
      		</div>

      		<div class="form-group">
      			{!! Form::label('descripcion_rol','Descripción Rol', ['class' => 'col-sm-2 control-label'])!!}
            <div class="col-sm-4">
      			  {!! Form::text('descripcion_rol', null, ['class' => 'form-control', 'placeholder' => 'Descripción Rol', 'required'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('permisos','Permisos', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-8">
              {!! Form::select('permisos[]',$permisos, null, ['multiple', 'id' => 'selectPermisos'])!!}
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
              <button type="button" class="btn btn-default btn-label-left" id="reset">
                <span><i class="fa fa-times-circle txt-danger"></i></span>
                Borrar
              </button>
            </div>
          </div>

      	{!! Form::close()!!}

        <a href="{{ route('in.roles.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver al Listado
        </a>
      </div>
    </div>
  </div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    function borrar (){
      $("input[type='text']").val("");
      $('#selectPermisos').select2().select2("val", null);
      $('#selectPermisos').attr('placeholder', 'Asignar Permisos');
      $('#selectPermisos').select2();
    }

    $(document).ready(function() {
      // Select
      $('#selectPermisos').select2({
        placeholder: "Asignar Permisos"
      });

      $("#reset").on("click", function() {
        borrar();
      });
    });

  </script>

@endsection
