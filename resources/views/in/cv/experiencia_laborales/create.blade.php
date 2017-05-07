@extends('template.in_main')

@section('headTitle', 'Gestionar CV | Experiencia Laboral')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Agregar Experiencia Laboral</a></li>
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
      <h4 class="page-header">Agregar Experiencia Laboral</h4>
        
      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')
      
      <!-- Formulario -->
      {!! Form::open(['route' => 'in.gestionar-cv.experiencia-laborales.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

        <div class="form-group">
          {!! Form::label('nombre_empresa','Empresa:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('nombre_empresa', null, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
          </div>
          {!! Form::label('rubro_empresarial','Rubro Empresarial:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-3">
            <select name="rubro_empresarial" class="populate placeholder" id="selectSimple" required>
              <option value=""></option>
              @foreach($rubros_Empresariales as $rubro_Empresarial)
                <option value="{{$rubro_Empresarial->id}}">{{$rubro_Empresarial->nombre_rubro_empresarial}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('puesto','Puesto:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('puesto', null, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
          </div>
          {!! Form::label('periodo_inicio','Periodo Inicio:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('periodo_inicio', null, ['id' => 'input_date_inicio', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa'])!!}
          </div>
        </div>
        
        <div class="form-group">
          {!! Form::label('descripcion_tarea','Tareas:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::textarea('descripcion_tarea', null, ['class' => 'form-control', 'placeholder' => '', 'required'])!!}
          </div>
          {!! Form::label('periodo_fin','Periodo Fin:', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-2">
            {!! Form::text('periodo_fin', null, ['id' => 'input_date_fin', 'class' => 'form-control', 'placeholder' => 'dd-mm-aaaa'])!!}
          </div>
          <div class="col-sm-2">
            <div class="checkbox" name="presente">
              <label>
                Presente
                <input type="checkbox" name='presente' id='checkPresente' class="form-control"/>
                <i class="fa fa-square-o"></i>
              </label>
            </div>
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

        <a href="{{ route('in.gestionar-cv.experiencia-laborales.index') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
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
      $('#selectSimple').select2({
        placeholder: "Tipo"
      });

      $('#checkPresente').on('change', function() {
        if($(this).is(':checked')){           
          $('#input_date_fin').prop('disabled', true);
          $('#input_date_fin').val('');   
        }else{          
          $('#input_date_fin').prop('disabled', false);
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

