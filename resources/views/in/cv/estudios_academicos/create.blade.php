@extends('template.in_main')

@section('headTitle', 'Gestionar CV | Estudio Academico')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Agregar Estudio Académico</a></li>
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
      <h4 class="page-header">Agregar Estudio Académico</h4>
        
      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')
      
      <!-- Formulario -->
      {!! Form::open(['route' => 'in.gestionar-cv.estudios-academicos.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

        <div class="form-group">
          {!! Form::label('titulo','Carrera:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('titulo', null, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
          </div>
          {!! Form::label('nivel_educativo','Nivel Educativo:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-2">
            <select name="nivel_educativo" class="populate placeholder" id="selectSimpleNE" required>
              <option value=""></option>
              @foreach($nivelesEducativos as $nivelEducativo)
                <option value="{{$nivelEducativo->id}}">{{$nivelEducativo->nombre_nivel_educativo}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('nombre_instituto','Instituto:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('nombre_instituto', null, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
          </div>
          {!! Form::label('estados_carrera','Estado de la Carrera:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-2">
            <select name="estados_carrera" class="populate placeholder" id="selectSimpleEC" required>
              <option value=""></option>
              @foreach($estadosCarrera as $estadoCarrera)
                <option value="{{$estadoCarrera->id}}">{{$estadoCarrera->nombre_estado_carrera}}</option>
              @endforeach
            </select>
          </div>
        </div>
        
		<div class="form-group">
		  {!! Form::label('materias_total','Materias Total:', ['class' => 'col-sm-2 control-label']) !!}
		  <div class="col-sm-2">
		    {!! Form::number('materias_total', null, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
		  </div>
		  {!! Form::label('periodo_inicio','Periodo Inicio:', ['class' => 'col-sm-4 control-label']) !!}
		  <div class="col-sm-2">
		    {!! Form::text('periodo_inicio', null, ['id' => 'input_date_inicio', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa'])!!}
		  </div>
		</div>

		<div class="form-group">
          {!! Form::label('materias_aprobadas','Materias Aprobadas:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::number('materias_aprobadas', null, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
          </div>
          {!! Form::label('periodo_fin','Periodo Fin:', ['class' => 'col-sm-4 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('periodo_fin', null, ['id' => 'input_date_fin', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa'])!!}
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

        <a href="{{ route('in.gestionar-cv.estudios-academicos.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver a la Tabla
        </a>
      
      
      
    </div>  
  </div>
</div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    $(document).ready(function() {
      // Fecha
      $('#input_date_inicio').datepicker({setDate: new Date()});
      $('#input_date_fin').datepicker({setDate: new Date()});
      
      // Select
      $('#selectSimpleNE').select2({
        placeholder: "Tipo"
      });
      $('#selectSimpleEC').select2({
        placeholder: "Tipo"
      });

      $('#selectSimpleEC').on('change', function() {
        if($(this).val() == {{$finalizado}}){           
          $('#input_date_fin').prop('disabled', false);
          $('#input_date_fin').prop('required', true);
        }else{          
          $('#input_date_fin').prop('disabled', true);
          $('#input_date_fin').val('');
          $('#input_date_fin').prop('required', false);
        }    
      });
    });

    <!-- Cambiar el idioma de datepiker -->
    $.datepicker.regional['es'] = {
      closeText: 'Cerrar',
      prevText: '< Ant',
      nextText: 'Sig >',
      currentText: 'Hoy',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
      dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
      weekHeader: 'Sm',
      dateFormat: 'dd-mm-yy',
      firstDay: 1,
      isRTL: false,
      showMonthAfterYear: false,
      yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $(function () {
      $("#fecha").datepicker();
    });

  </script>

@endsection

