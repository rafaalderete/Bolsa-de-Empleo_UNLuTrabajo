@extends('template.in_main')

@section('headTitle', 'Buscar Ofertas')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Buscar Ofertas</a></li>
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
        <h4 class="page-header">Buscar Ofertas</h4>

        @include('flash::message')
        @include('template.partials.errors')

        <div class="row">

          <div class="col-sm-3 col-md-3">
            <div class="panel-group" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title text-center">
                  </span>Filtros</a>
                  </h4>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="fa fa-search titulo-filtro"></span>
                      Palabra Clave
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                  <div class="panel-body" id="columna-buscar">
                    {!! Form::open(['route' => ['in.buscar-ofertas'], 'method' => 'GET', 'class' => 'form-horizontal']) !!}
                      <input type="text" name="buscar" class="form-control" placeholder="Buscar" id="buscar">
                      <span class="fa fa-search iconspan"></span>
                    {!! Form::close()!!}
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                      <span class="fa fa-university titulo-filtro"></span>
                      Carrera
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                  <div class="panel-body" id="columna">
                    <table class="table">
                      @foreach ($carreras as $key => $carrera)
                        <tr>
                          @if ($key == 0)
                            <td class="primer-elemento-filtro">
                          @else
                            <td>
                          @endif
                            {!! Form::open(['route' => ['in.buscar-ofertas'], 'method' => 'GET', 'class' => 'form-horizontal']) !!}
                              <input type="hidden" name="carrera" value={{ $carrera->id }}>
                              <a class="filtro-submit">{{ $carrera->nombre_carrera }}</a> <span class="label label-success">{{ $carrera->cantidad }}</span>
                            {!! Form::close()!!}
                          </td>
                        </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="fa fa-handshake-o titulo-filtro"></span>
                      Tipo de Trabajo
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse">
                  <div class="panel-body" id="columna">
                    <table class="table">
                      @foreach ($tipos_trabajo as $key => $tipo_trabajo)
                        <tr>
                          @if ($key == 0)
                            <td class="primer-elemento-filtro">
                          @else
                            <td>
                          @endif
                          {!! Form::open(['route' => ['in.buscar-ofertas'], 'method' => 'GET', 'class' => 'form-horizontal']) !!}
                            <input type="hidden" name="tipo_trabajo" value={{ $tipo_trabajo->id }}>
                            <a class="filtro-submit">{{ $tipo_trabajo->nombre_tipo_trabajo }}</a> <span class="label label-success">{{ $tipo_trabajo->cantidad }}</span>
                          {!! Form::close()!!}
                          </td>
                        </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="fa fa-calendar titulo-filtro"></span>
                      Tipo de Jornada
                    </a>
                  </h4>
                </div>
                <div id="collapseFour" class="panel-collapse collapse">
                  <div class="panel-body" id="columna">
                    <table class="table">
                      @foreach ($tipos_jornada as $key => $tipo_jornada)
                        <tr>
                          @if ($key == 0)
                            <td class="primer-elemento-filtro">
                          @else
                            <td>
                          @endif
                            {!! Form::open(['route' => ['in.buscar-ofertas'], 'method' => 'GET', 'class' => 'form-horizontal']) !!}
                              <input type="hidden" name="tipo_jornada" value={{ $tipo_jornada->id }}>
                              <a class="filtro-submit">{{ $tipo_jornada->nombre_tipo_jornada }}</a> <span class="label label-success">{{ $tipo_jornada->cantidad }}</span>
                            {!! Form::close()!!}
                          </td>
                        </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"><span class="fa fa-language titulo-filtro"></span>
                      Idioma
                    </a>
                  </h4>
                </div>
                <div id="collapseFive" class="panel-collapse collapse">
                  <div class="panel-body" id="columna">
                    <table class="table">
                      @foreach ($idiomas as $key => $idioma)
                        <tr>
                          @if ($key == 0)
                            <td class="primer-elemento-filtro">
                          @else
                            <td>
                          @endif
                          {!! Form::open(['route' => ['in.buscar-ofertas'], 'method' => 'GET', 'class' => 'form-horizontal']) !!}
                            <input type="hidden" name="idioma" value={{ $idioma->id }}>
                            <a class="filtro-submit">{{ $idioma->nombre_idioma }}</a> <span class="label label-success">{{ $idioma->cantidad }}</span>
                          {!! Form::close()!!}
                          </td>
                        </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
              </div>
              @if ($busqueda)
                <div class="elminar-filtro">
                  <a href={{ route('in.buscar-ofertas') }}>Eliminar Filtro<span class="glyphicon glyphicon-remove"></span></a>
                </div>
              @endif
            </div>
          </div>


          <div class="col-sm-9 col-md-9">
            <div class="row">
              <div class="col-md-12">
                <h4>Filtro - {{ $filtro }}</h4>
              </div>
            </div>
            <div class="anuncios">
              @if(count($propuestas) > 0)
                @foreach($propuestas as $propuesta)
                  <a href={{ route('in.detalle-oferta', $propuesta->id) }}>
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
                            <p>Publicado: {{ $propuesta->fecha_inicio_propuesta }}</p>
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
                    <p>No se han realizado Propuestas.</p>
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

      $(".filtro-submit").on("click", function() {
        $(this).closest("form").submit();
      });

    });


  </script>

@endsection
