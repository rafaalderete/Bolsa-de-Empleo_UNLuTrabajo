@extends('template.in_main')

@section('headTitle', 'Mis Postulaciones')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Mis Postulaciones</a></li>
      </ol>
    </div>
  </div>

@endsection

@section('bodyContent')

  <div class="row">
    <!-- Box -->
    <div class="box" style="margin-top: -20px">
      <!-- Cuerpo del Box-->
      <div class="box-content dropbox">
        <!-- Titulo del Cuerpo del Box -->
        <h4 class="page-header">Mis Postulaciones</h4>

        @include('flash::message')
        @include('template.partials.errors')

        <div class="row">
          <div class="col-sm-2 buscar">
            {!! Form::open(['route' => ['in.mis-postulaciones'], 'method' => 'GET', 'class' => 'form-horizontal']) !!}
                <input type="text" name="buscar" class="form-control" placeholder="Buscar" id="buscar">
                <span class="fa fa-search iconspan"></span>
          	{!! Form::close()!!}
          </div>
        </div>

        <div class="anuncios">
          @if(count($propuestas) > 0)
            @foreach($propuestas as $propuesta)
              <a href={{ route('in.detalle-postulacion', $propuesta->id) }}>
                <div class="anuncio col-md-12">
                  @if($propuesta->juridica->persona->usuarios[0]->imagen != null)
                    <div class="avatar-grande col-md-2 text-center logo-anuncio">
                      <img src="{{asset('img/usuarios').'/'.$propuesta->juridica->persona->usuarios[0]->imagen}}" class="img-rounded" alt="Logo de la Empresa" />
                    </div>
                    <div class="descripcion col-md-10">
                  @else
                    <div class="descripcion col-md-12">
                  @endif
                    <div class="row">
                      <div class="col-md-12 anuncio-titulo">
                        <h2>{{ $propuesta->titulo }}</h2>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 anuncio-subtitulo">
                        <p>{{ $propuesta->juridica->nombre_comercial }} - {{ $propuesta->lugar_de_trabajo }} - {{ $propuesta->tipoJornada->nombre_tipo_jornada }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="detalle col-md-12">
                        <p>{{ strip_tags($propuesta->descripcion) }}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 anuncio-subtitulo">
                        @if ( ($propuesta->estado_propuesta == "inactivo") || ($propuesta->fecha_fin_propuesta < $fechaActual) )
                          <p>Publicado: {{ $propuesta->fecha_inicio_propuesta }} - Finalizada</p>
                        @else
                          <p>Publicado: {{ $propuesta->fecha_inicio_propuesta }}</p>
                        @endif
                      </div>
                    </div>
                    </div>
                  </div>
                </a>
            @endforeach
          @else
            <div class="col-md-12 text-center">
              @if ($busqueda)
                <p>No se han encontrado coincidencias.</p>
              @else
                <p>No ha realizado Postulaciones.</p>
              @endif
            </div>
          @endif
          </div>

          <div class="text-center">
           {!! $propuestas->render()!!}
          </div>

      </div>
    </div>
  </div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    $(document).ready(function() {

      $('#buscar').keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
        {
          e.preventDefault();
          $(this).val($(this).val().replace(/[^a-zA-Z0-9+]/g, ""));
          $(this).closest("form").submit();
        }
      });

    });


  </script>

@endsection
