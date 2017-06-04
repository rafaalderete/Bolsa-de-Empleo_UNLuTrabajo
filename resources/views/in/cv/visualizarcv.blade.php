@extends('template.in_main')

@section('headTitle', 'UNLu Trabajo | Gestionar CV | Visualizar CV')

@section('bodyIndice')

  <div class="row">
    <div id="breadcrumb" class="col-xs-12">
      <ol class="breadcrumb">
        <li><a>Gestionar CV</a></li>
        <li><a>Visualizar CV</a></li>
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
      <h4 class="page-header">Visualizar CV</h4>

      <div class="wrapper">
        <div class="main-wrapper col-md-12" style="min-height:500px">

          <section>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-9">
                  <div class="row">
                    <p class="cv-nombre">
                      {{$pfisica->nombre_persona." ".$pfisica->apellido_persona}}
                    </p>
                  </div>
                </div>
                <div class="col-md-3 no-margin-padding">
                  @if(Auth::user()->imagen != null)
                    <img src="{{asset('img/usuarios').'/'.Auth::user()->imagen}}" class="cv-imagen img-rounded" alt="avatar">
                  @endif
                </div>
              </div>
            </div>
          </section>


          <section>
            <div class="col-md-12">
              <div class="row">
                <div class="cv-section-titulo">
                  <span>DATOS PERSONALES</span>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9 item">
                  <div class="col-sm-6">
                    <span class="cv-item-titulo">Nacimiento</span> :
                    <span class="cv-item-dato">{{$pfisica->fecha_nacimiento}}</span>
                  </div>
                  <div class="col-sm-6">
                    <span class="cv-item-titulo">{{$pfisica->tipoDocumento->nombre_tipo_documento}}</span> :
                    <span class="cv-item-dato">{{$pfisica->nro_documento}}</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9 item">
                  <div class="col-sm-6">
                    <span class="cv-item-titulo">Domicilio</span> :
                    <span class="cv-item-dato">{{$pfisica->persona->direccion->domicilio}}</span>
                  </div>
                  <div class="col-sm-6">
                    <span class="cv-item-titulo">Localidad</span> :
                    <span class="cv-item-dato">{{$pfisica->persona->direccion->localidad}}</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9 item">
                  @if ($telefono_fijo != "")
                    <div class="col-sm-6">
                      <span class="cv-item-titulo">Telefono</span> :
                      <span class="cv-item-dato">{{$telefono_fijo}}</span>
                    </div>
                  @endif
                  @if ($telefono_celular != "")
                    <div class="col-sm-6">
                      <span class="cv-item-titulo">Celular</span> :
                      <span class="cv-item-dato">{{$telefono_celular}}</span>
                    </div>
                  @endif
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9 item">
                  <div class="info col-sm-12">
                    <span class="cv-item-titulo">E-Mail</span> :
                    <span class="cv-item-dato">{{Auth::user()->email}}</span>
                  </div>
                </div>
              </div>
            </div>
          </section>

          @if (($pfisica->estudiante->cv->carta_presentacion != null) || ($pfisica->estudiante->cv->sueldo_bruto_pretendido != null))
            <section>
              <div class="col-md-12">
                <div class="row">
                  <div class="cv-section-titulo">
                    <span>OBJETIVO LABORAL</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 item">
                    @if ($pfisica->estudiante->cv->carta_presentacion != null)
                      <div class="col-sm-12 cv-objetivo">
                        {!!$pfisica->estudiante->cv->carta_presentacion !!}
                      </div>
                    @endif
                    @if ($pfisica->estudiante->cv->sueldo_bruto_pretendido != null)
                      <div class="col-sm-12">
                        <span>Mi sueldo bruto pretendido es</span> :
                        <span>{{$pfisica->estudiante->cv->sueldo_bruto_pretendido}}</span> $.
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </section>
          @endif

          @if(count($estudios) > 0 )
            <section>
              <div class="col-md-12">
                <div class="row">
                  <div class="cv-section-titulo">
                    <span>ESTUDIO ACADÉMICO</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    @foreach($estudios as $estudio)
                      <div class="item">
                        <div class="upper-row">
                          <h3 class="cv-item-titulo">{{$estudio->titulo}}</h3>
                          <div class="time">
                            <span>{{$estudio->periodo_inicio}}</span> /
                              @if($estudio->periodo_fin == 0)
                                <span>Presente</span>
                              @else
                                <span>{{$estudio->periodo_fin}}</span>
                              @endif
                          </div>
                        </div>
                        <div class="cv-item-dato">
                          <span>{{$estudio->estadoCarrera->nombre_estado_carrera}}</span> -
                            <span>{{$estudio->nombre_instituto}}</span>
                        </div>
                        <div class="cv-item-dato">
                          <span>Avance de la Carrera</span> :
                          <span>{{$estudio->materias_aprobadas}}</span> /
                          <span>{{$estudio->materias_total}}</span> Materias
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </section>
          @endif

          @if(count($expLaborales) > 0 )
            <section>
              <div class="col-md-12">
                <div class="row">
                  <div class="cv-section-titulo">
                    <span>EXPERIENCIA LABORAL</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    @foreach($expLaborales as $expLaboral)
                      <div class="item">
                        <div class="upper-row">
                          <h3 class="cv-item-titulo">{{$expLaboral->puesto}}</h3>
                          <div class="time">
                            <span>{{$expLaboral->periodo_inicio}}</span> /
                              @if($expLaboral->periodo_fin == 0)
                                <span>Presente</span>
                              @else
                                <span>{{$expLaboral->periodo_fin}}</span>
                              @endif
                          </div>
                        </div>
                        <div class="cv-item-dato">
                          <span>{{$expLaboral->nombre_empresa}}</span> -
                          <span>{{$expLaboral->rubroEmpresarial->nombre_rubro_empresarial}}</span>
                        </div>
                        <div class="cv-item-dato cv-objetivo">
                          <span>{!!$expLaboral->descripcion_tarea!!}</span>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </section>
          @endif

          @if(count($conocimientosIdiomas) > 0 )
            <section>
              <div class="col-md-12">
                <div class="row">
                  <div class="cv-section-titulo-2">
                    <span>CONOCIMIENTO IDIOMA</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    @foreach($idiomas as $idioma)
                      <?php $cant = 0; ?>
                      @foreach($conocimientosIdiomas as $conocimientoIdioma)
                        @if ($idioma->id == $conocimientoIdioma->idioma_id)
                          <?php $cant++; ?>
                        @endif
                      @endforeach
                      @if ($cant > 0)
                        <div class="item">
                          <div class="upper-row">
                            <span class="cv-item-titulo">{{$idioma->nombre_idioma}}</span>
                          </div>
                          @foreach($conocimientosIdiomas as $conocimientoIdioma)
                            @if ($idioma->id == $conocimientoIdioma->idioma_id)
                              <div class="cv-item-dato">
                                <span>{{$conocimientoIdioma->tipoConocimientoIdioma->nombre_tipo_conocimiento_idioma." - ".$conocimientoIdioma->nivelConocimiento->nombre_nivel_conocimiento}}</span>
                              </div>
                            @endif
                          @endforeach
                        </div>
                      @endif
                      <?php $cant = 0; ?>
                    @endforeach
                  </div>
                </div>
              </div>
            </section>
          @endif

          @if(count($conocimientosInformaticos) > 0 )
            <section>
              <div class="col-md-12">
                <div class="row">
                  <div class="cv-section-titulo">
                    <span>CONOCIMIENTO INFORMÁTICO</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    @foreach($conocimientosInformaticos as $conocimientoInformatico)
                      <div class="item">
                        <div class="upper-row">
                          <span class="cv-item-titulo">{{$conocimientoInformatico->tipoSoftware->nombre_tipo_software}}</span>
                        </div>
                        <div class="cv-item-dato">
                          <span>{{$conocimientoInformatico->nivelConocimiento->nombre_nivel_conocimiento}}</span>
                        </div>
                        <div class="cv-item-dato cv-objetivo">
                          <span>{!!$conocimientoInformatico->descripcion_conocimiento!!}</span>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </section>
          @endif

          @if(count($conocimientosAdicionales) > 0)
            <section>
              <div class="col-md-12">
                <div class="row">
                  <div class="cv-section-titulo-2">
                    <span>CONOCIMIENTO ADICIONAL</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    @foreach($conocimientosAdicionales as $conocimientoAdicional)
                      <div class="item">
                        <span class="cv-item-titulo">{{$conocimientoAdicional->nombre_conocimiento}}</span>
                        <span class="cv-item-dato">{{$conocimientoAdicional->descripcion_conocimiento}}</span>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </section>
          @endif
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-12 text-center" style="margin-top:20px">
          <a href="{{ route('in.cv.descargarcv') }}" ><button class="btn btn-info btn-label-left">
            <span><i class="fa fa-download"></i></span>
            Descargar CV
          </button></a>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection

