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
      {!! Form::open(['route' => ['in.cv.updateobjetivolaboralcv'], 'method' => 'POST', 'class' => 'form-horizontal','files' => true]) !!}

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
            {!! Form::label('archivo_adjunto','Cv Adjunto: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-4">
              <div class="row">
                <div class="col-sm-4" style="margin-right:50px">
                  {!!Form::hidden('archivo_cargado',0,['id' => 'archivo_cargado'])!!}
                  <span class="nombre_archivo">{{$nombreAdjunto}}</span>
                </div>
                <div class="col-sm-6">
                  <div class="imagen-info">
                    <p>El archivo debe ser .pdf y no pesar más de 1 Mb</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6"style="margin-top:10px">
                  {!! Form::file('archivo_adjunto', ['id' => 'archivo']) !!}
                </div>
              </div>
              <div class="row error-imagen">
                <div class="col-sm-12">
                  <span>El archivo no debe pesar más de 1Mb</span>
                </div>
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
      $('#archivo_cargado').val(0);
      $('.nombre_archivo').text(objetivo['nombreAdjunto']);
      $('#textarea_carta').summernote('code', objetivo['carta_presentacion']);
      $("input[name='sueldo_bruto_pretendido']").val(objetivo['sueldo_bruto_pretendido']);
      $('.error-imagen').css('display', 'none');
    }

    function readURL(input) {
      if (input.files && input.files[0]) {
        if (input.files[0].size <= 1024000) {
          $('#archivo_cargado').val(1);
          $('.error-imagen').css('display', 'none');
          var fullPath = $("#archivo").val();
          var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
          var filename = fullPath.substring(startIndex);
          if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
              filename = filename.substring(1);
          }
          $('.nombre_archivo').text(filename.substring(0, filename.length-4));
        }
        else {
          $('#archivo').val(null);
          $('#archivo_cargado').val(0);
          $('.error-imagen').css('display', 'block');
        }
      }
    }

    $(document).ready(function() {

      //Valores para restablecer.
      var objetivo = [];
      objetivo['carta_presentacion'] = "{!!$pfisica->estudiante->cv->carta_presentacion!!}";
      objetivo['nombreAdjunto'] = "{!!$nombreAdjunto!!}";
      objetivo['sueldo_bruto_pretendido'] = {{$pfisica->estudiante->cv->sueldo_bruto_pretendido}}


      $('#textarea_carta').summernote({
        lang: 'es-ES',
        height: 150,
        disableResizeEditor: true,
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline']],
          ['para', ['ul', 'ol']],
        ]
      });

      $("#archivo").change(function(){
        readURL(this);
      });

      $("#reset").on("click", function() {
        restablecer(objetivo);
      });
    });

  </script>

@endsection
