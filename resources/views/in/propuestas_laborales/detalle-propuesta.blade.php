@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Visualizar Propuesta Laboral')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Mis Propuestas</a></li>
        <li><a>Visualizar Propuesta Laboral</a></li>
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
        <h4 class="page-header">Visualizar Propuesta Laboral</h4>

        @include('flash::message')
        @include('template.partials.errors')

        <div class="row detalle-titulo">
          <div class="row">
            <div class="col-md-12  anuncio-titulo">
              <h2>{{ $propuesta->titulo }}</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 anuncio-subtitulo divisor">
              @if ($propuesta->finalizada)
                <p>Publicado: {{ $propuesta->fecha_inicio_propuesta }} - Finalizada</p>
              @else
                <p>Publicado: {{ $propuesta->fecha_inicio_propuesta }} - Finaliza: {{ $propuesta->fecha_fin_propuesta }} </p>
              @endif
            </div>
          </div>
        </div>

        <div class="row detalle-info">
          @if($propuesta->juridica->persona->usuarios[0]->imagen != null)
            <div class="avatar-grande col-md-2 text-center logo-anuncio">
              <img src="{{asset('img/usuarios').'/'.$propuesta->juridica->persona->usuarios[0]->imagen}}" class="img-rounded" alt="Logo de la Empresa" />
            </div>
            <div class="descripcion col-md-10">
          @else
            <div class="descripcion col-md-12">
          @endif
              <div class="row">
                <div class="col-md-12">
                  <h2>{{ $propuesta->juridica->nombre_comercial }}</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 anuncio-subtitulo">
                  <p>Lugar de Trabajo: {{ $propuesta->lugar_de_trabajo }}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 anuncio-subtitulo">
                  <p>Tipo de Trabajo: {{ $propuesta->tipoTrabajo->nombre_tipo_trabajo }}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 anuncio-subtitulo">
                  <p>Tipo de Jornada: {{ $propuesta->tipoJornada->nombre_tipo_jornada }}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 anuncio-subtitulo">
                  <p>Vacantes: {{ $propuesta->vacantes }}</p>
                </div>
              </div>
            </div>
        </div>

        <div class="row detalle-descripcion">
          <div class="row">
            <div class="col-md-12 requisitos-label">
              <p>Descripción:</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p>{!! $propuesta->descripcion !!}</p>
            </div>
          </div>
        </div>

        <div class="row detalle-descripcion">
          @if( ($propuesta->requisito_años_experiencia_laboral != 0) || (count($propuesta->requisitosResidencia) > 0) || (count($propuesta->requisitosCarrera) > 0) || (count($propuesta->requisitosIdioma) > 0) || (count($propuesta->requisitosAdicionales) > 0) )
            <div class="row">
              <div class="col-md-12 requisitos-label">
                <p>Requisitos:</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <ul>

                      @if($propuesta->requisito_años_experiencia_laboral != 0)
                        <li>Años de Experiencia: {{ $propuesta->requisito_años_experiencia_laboral }}</li>
                      @endif

                      @if(count($propuesta->requisitosResidencia) > 0)
                        <li>Lugar de Residencia:</li>
                        <li class="item-no-dot">
                          <ul class="lista-interior">
                            @foreach ($propuesta->requisitosResidencia as $requisito_residencia)
                              <li>
                                {{ $requisito_residencia->lugar }}
                                @if($requisito_residencia->excluyente)
                                   - <span class="excluyente">Excluyente</span>
                                @endif
                              </li>
                            @endforeach
                          </ul>
                        </li>
                      @endif

                      @if(count($propuesta->requisitosCarrera) > 0)
                        <li>Carrera:</li>
                        <li class="item-no-dot">
                          <ul class="lista-interior">
                            @foreach ($propuesta->requisitosCarrera as $requisito_carrera)
                              <li>
                                {{ $requisito_carrera->carrera->nombre_carrera }} -
                                {{ $requisito_carrera->estadoCarrera->nombre_estado_carrera }}
                                @if($requisito_carrera->excluyente)
                                   - <span class="excluyente">Excluyente</span>
                                @endif
                              </li>
                            @endforeach
                          </ul>
                        </li>
                      @endif

                      @if(count($propuesta->requisitosIdioma) > 0)
                        <li>Idioma:</li>
                        <li class="item-no-dot">
                          <ul class="lista-interior">
                            @foreach ($propuesta->requisitosIdioma as $requisito_idioma)
                              <li>
                                {{ $requisito_idioma->idioma->nombre_idioma }} -
                                {{ $requisito_idioma->tipoConocimientoIdioma->nombre_tipo_conocimiento_idioma }} -
                                {{ $requisito_idioma->nivelConocimiento->nombre_nivel_conocimiento }}
                                @if($requisito_idioma->excluyente)
                                   - <span class="excluyente">Excluyente</span>
                                @endif
                              </li>
                            @endforeach
                          </ul>
                        </li>
                      @endif

                      @if(count($propuesta->requisitosAdicionales) > 0)
                        <li>Requisitos Adicionales:</li>
                        <li class="item-no-dot">
                          <ul class="lista-interior">
                            @foreach ($propuesta->requisitosAdicionales as $requisito_adicional)
                              <li>
                                {{ $requisito_adicional->nombre_requisito }} -
                                {{ $requisito_adicional->nivelConocimiento->nombre_nivel_conocimiento }}
                                @if($requisito_adicional->excluyente)
                                   - <span class="excluyente">Excluyente</span>
                                @endif
                              </li>
                            @endforeach
                          </ul>
                        </li>
                      @endif

                    </ul>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>

        @if(Entrust::can('listar_postulantes'))
          <a href="{{ route('in.propuestas-laborales.listado-postulantes', $propuesta->id) }}"  style="margin-top: -5px; margin-right: 30px" class="btn btn-info pull-left">
            Listado de Postulantes
          </a>
        @endif
        @if(Entrust::can('eliminar_propuesta_laboral'))
          {!! Form::open(['route' => ['in.propuestas-laborales.destroy', $propuesta->id], 'method' => 'DELETE']) !!}
          <a href="" class="btn btn-default btn-label-left pull-right" data-toggle="modal" data-target="#delSpk" data-title="Eliminar Propuesta"
            data-message="¿Seguro que quiere eliminar la Propuesta?" style="margin-top: -5px"><span><i class="fa fa-times-circle txt-danger"></i></span>Eliminar</a>
          {!! Form::close() !!}
        @endif
        @if(Entrust::can('modificar_propuesta_laboral'))
          <a href="{{ route('in.propuestas-laborales.edit', $propuesta->id) }}"  style="margin-top: -5px; margin-right: 30px" class="btn btn-info btn-label-left pull-right">
            <span><i class="fa fa-check-square"></i></span>
            Modificar
          </a>
        @endif

      </div>
    </div>
  </div>

@endsection

@section('bodyJS')

  <script type="text/javascript">

    $(document).ready(function(){

      //Modal
      $('#delSpk').on('show.bs.modal', function (e) {
        $message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text($message);
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
      });
      $('#delSpk').find('.modal-footer #confirm').on('click', function(){
        $(this).data('form').submit();
      });

    });

  </script>

@endsection
