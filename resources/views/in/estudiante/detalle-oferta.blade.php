@extends('template.in_main')

@if ($postulacion)
  @section('headTitle', 'UNLu Trabajo | Visualizar Postulación')
@else
  @section('headTitle', 'UNLu Trabajo | Visualizar Oferta Laboral')
@endif


@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        @if ($postulacion)
          <li><a>Mis Postulaciones</a></li>
          <li><a>Visualizar Postulación</a></li>
        @else
          <li><a>Buscar Oferta</a></li>
          <li><a>Visualizar Oferta Laboral</a></li>
        @endif
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
        @if ($postulacion)
            <h4 class="page-header">Visualizar Postulación</h4>
        @else
            <h4 class="page-header">Visualizar Oferta Laboral</h4>
        @endif

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
              @if (!$postulacion)
                <p>Publicado: {{ $propuesta->fecha_inicio_propuesta }} - Finaliza: {{ $propuesta->fecha_fin_propuesta }} </p>
              @else
                @if ( ($propuesta->estado_propuesta == "inactivo") || ($propuesta->finalizada) )
                  <p>Publicado: {{ $propuesta->fecha_inicio_propuesta }} - Finalizada</p>
                @else
                  <p>Publicado: {{ $propuesta->fecha_inicio_propuesta }} - Finaliza: {{ $propuesta->fecha_fin_propuesta }} </p>
                @endif
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
                <p>Requisitos a considerar:</p>
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
                                   - <span class="importante">Importante</span>
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
                            @foreach ($idiomas as $idioma)
                              <?php $cant = 0 ?>
                              @foreach($propuesta->requisitosIdioma as $requisito_idioma)
                                @if ($idioma->id == $requisito_idioma->idioma_id)
                                  <?php $cant++; ?>
                                @endif
                              @endforeach
                              @if ($cant > 0)
                                <li>
                                  {{ $idioma->nombre_idioma }}
                                  <ul>
                                  @foreach ($propuesta->requisitosIdioma as $requisito_idioma)
                                    @if ($idioma->id == $requisito_idioma->idioma_id)
                                      <li>
                                        {{ $requisito_idioma->tipoConocimientoIdioma->nombre_tipo_conocimiento_idioma }} -
                                        {{ $requisito_idioma->nivelConocimiento->nombre_nivel_conocimiento }}
                                        @if($requisito_idioma->excluyente)
                                           - <span class="importante">Importante</span>
                                        @endif
                                      </li>
                                    @endif
                                  @endforeach
                                  </ul>
                                </li>
                              @endif
                              <?php $cant = 0 ?>
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
                                   - <span class="importante">Importante</span>
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

        <div class="form-group">
  <div>
    <p>* <span class="importante">Importante</span>: Requisitos que serán un plus para el estudiante y/o serán evaluados en la entrevista.</p>
    <p>* <span class="excluyente">Excluyente</span>: Requisitos al cual el estudiante no podrá postularse al menos que lo cumpla.</p>
  </div>
</div>

        @if (!$postulacion)
          @if(Entrust::can('postularse'))
            @if ($puede_postularse)
              <a href="{{ route('in.postularse', $propuesta->id) }}"  style="margin-top: -5px; margin-right: 30px" class="btn btn-info btn-label-left pull-right">
                <span><i class="fa fa-check-square"></i></span>
                Postularse
              </a>
            @else
              <div class="imagen-info">
                <p>Ya se ha postulado a ésta Oferta</p>
              </div>
            @endif
          @endif
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
