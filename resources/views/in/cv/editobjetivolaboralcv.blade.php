@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Gestionar CV | Objetivo Laboral')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Modificar Objetivo Laboral</a></li>
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
      <h4 class="page-header"> Modificar Objetivo Laboral</h4>
      <!-- Mostrar Mensaje -->
      @include('flash::message')
      @include('template.partials.errors')

              <!-- Formulario -->
      {!! Form::open(['route' => ['in.cv.updateobjetivolaboralcv'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}

          <div class="form-group descripcion">
            {!! Form::label('carta_presentacion','Carta de Presentación: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-8">
              {!! Form::textarea('carta_presentacion',$pfisica->estudiante->cv->carta_presentacion, ['class' => 'form-control', 'placeholder' => 'Descripción', 'id' => 'textarea_carta'])!!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('sueldo_bruto_pretendido','Sueldo Bruto Pretendido: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-3">
              <div class="input-group">
                {!! Form::number('sueldo_bruto_pretendido',$pfisica->estudiante->cv->sueldo_bruto_pretendido,['class' => 'form-control', 'placeholder' => '0', 'min' => '0'])!!}
                <span class="input-group-addon"><i class="fa fa-usd"></i></span>
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
              <button type="button" class="btn btn-default btn-label-left" id="reset">
                <span><i class="fa fa-times-circle txt-danger"></i></span>
                Restablecer
              </button>
            </div>
          </div>

      {!! Form::close()!!}

      <a href="{{ route('in.cv.objetivolaboralcv') }}"  style="margin-top: -5px" class="btn btn-info pull-right">
          <span><i class="fa fa-reply"></i></span>
          Volver
      </a>


    </div>
  </div>
</div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    function restablecer (objetivo){
      $('#textarea_carta').summernote('code', objetivo['carta_presentacion']);
      $("input[name='sueldo_bruto_pretendido']").val(objetivo['sueldo_bruto_pretendido']);
    }

    $(document).ready(function() {

      //Valores para restablecer.
      var objetivo = [];
      objetivo['carta_presentacion'] = "{!!$pfisica->estudiante->cv->carta_presentacion!!}";
      objetivo['sueldo_bruto_pretendido'] = {{$pfisica->estudiante->cv->sueldo_bruto_pretendido}}

      $('#textarea_carta').summernote({
        lang: 'es-ES',
        height: 150,
        disableResizeEditor: true,
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline']],
          ['font', ['superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['para', ['ul', 'ol', 'paragraph']],
        ]
      });

      $("#reset").on("click", function() {
        restablecer(objetivo);
      });
    });

  </script>

@endsection
